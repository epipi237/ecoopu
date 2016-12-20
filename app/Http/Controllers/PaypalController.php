<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Payum\LaravelPackage\Controller\PayumController;
use Payum\Core\Request\GetHumanStatus;
use App\transactions;
use App\User;
use App\Order;

class PaypalController extends PayumController
{

	public function prepare_paypal(Request $request){
		//dd($request->all());
		$storage = $this->getPayum()->getStorage('Payum\Core\Model\ArrayObject');
		$details = $storage->create();

		$fee = $request->fee;
		$user = User::find($request->user_id);
		if(!$user) return \Redirect::back()->with('status', 'No such user found');

		$order = Order::find($request->order_id);
		if(!$order) return \Redirect::back()->with('status', 'No such order found');

		$details['PAYMENTREQUEST_0_AMT'] = "$fee";
		$details['order_id'] = $request->order_id;
		$details['user_id'] = $request->user_id;
		$details['PAYMENTREQUEST_0_DESC'] = "Payment of Order ". $order->id . " by user with id ". $user->id;

		$details['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';
		$details['BRANDNAME'] = 'eCoopu';
		$details['description'] = "Payment of Order ". $order->id . " by user with id ". $user->id;;
		$storage->update($details);

		$captureToken = $this->getPayum()->getTokenFactory()->createCaptureToken('paypal_ec', $details, 'paypal_payment_done');
		return \Redirect::to($captureToken->getTargetUrl());
	}

	public function paypal_done(Request $request){
		$payum_token=$request->payum_token;

		/** @var Request $request */
		$request = \App::make('request');
		$request->attributes->set('payum_token', $payum_token);

		$token = $this->getPayum()->getHttpRequestVerifier()->verify($request);
		$gateway = $this->getPayum()->getGateway($token->getGatewayName());

		$gateway->execute($status = new GetHumanStatus($token));

		return \Response::json(array(
			'status' => $status->getValue(),
			'details' => json_encode($status->getFirstModel())
			));
	}

	public function authorize_done(Request $request){
		$payum_token=$request->payum_token;

		$request = \App::make('request');
		$request->attributes->set('payum_token', $payum_token);

		$token = $this->getPayum()->getHttpRequestVerifier()->verify($request);
		$gateway = $this->getPayum()->getGateway($token->getGatewayName());

		$gateway->execute($status = new GetHumanStatus($token));

		$details = iterator_to_array($status->getFirstModel());
		if($status->isCaptured()){
			$this->add_subscription($details['pack'], 'Credit Card');
		}
		else {
			$this->add_subscription($details['pack'], 'Credit Card');
		}

		return redirect()->to('/transactions')->with('message', 'payment done');

		return \Response::json(array(
			'status' => $status->getValue(),
			'details' => json_encode($status->getFirstModel())
			));
	}

}
