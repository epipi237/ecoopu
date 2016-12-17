<?php
	// done.php

use Payum\Core\Request\GetHumanStatus;

include 'config.php';

$token = $payum->getHttpRequestVerifier()->verify($_REQUEST);

/** @var \Payum\Core\Storage\IdentityInterface $identity **/
$identity = $token->getDetails();
$model = $payum->getStorage($identity->getClass())->find($identity);

$gateway = $payum->getGateway($token->getGatewayName());
$gateway->execute($status = new GetHumanStatus($model));

// using shortcut
if ($status->isCaptured() || $status->isAuthorized()) {
	// success
	$payum->getHttpRequestVerifier()->invalidate($token);
}

// using shortcut
if ($status->isPending()) {
  	// most likely success, but you have to wait for a push notification.
	$payum->getHttpRequestVerifier()->invalidate($token);
}

// using shortcut
if ($status->isFailed() || $status->isCanceled()) {
  	// the payment has failed or user canceled it.
	$payum->getHttpRequestVerifier()->invalidate($token);
}