@extends('layouts.app')

@section('title', 'Home eCoopu')

@section('active-home', 'active')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {{ session('status') }}
</div>
@endif

<div id="all">
    <div id="content">

        <div id="hot">

            <div  class="box text-center" style="margin-left: 9.5%! important; margin-right: 9.5%! important;">
                <div class="container">
                    <div class="col-md-12">
                        <h2>Your Orders</h2>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="same-height-row">
                    <div class="same-height-row">
                        <?php
                        $orders = App\Order::join('order_items', function($query){
                            $query->on('orders.id', '=', 'order_items.order_id')->where('order_items.user_id', '=', Auth::user()->id);
                        })->paginate(4);
                        ?>
                        @foreach($orders as $order)
                        <div class="col-sm-3">
                            <div class="box same-height clickable">
                                <h3><a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} items (<a href="/pages/create/orderlist/{{$order->id}}">add items</a>)</a></h3>
                                <p>Shop: {{$order->shop}}</p>
                                <p>Country: <b>{{$order->country->name}}</b></p>
                                <p>
                                    <?php 
                                    $date1=date_create($order->duration);
                                    $date2=date_create(date('Y-m-d H:i:s'));
                                    $DateInterval=date_diff($date1,$date2);
                                    echo '<b>Time Left: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s)';
                                    ?>
                                </p>
                                <p>
                                    @include('share.share', [
                                    'url' => request()->fullUrl(),
                                    'description' => 'Join by orderlist to shop from {{$order->shop}}',
                                    ])
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="container center" >
                <span align="center">{{$orders->links()}}</span>

            </div>

        </div>

        <div class="row" style="margin-left: 8%! important; margin-right: 8%! important;">

            <div id="hot" class="col-md-6">

                <div  class="box text-center">
                    <div class="container" style="width: 100%!important;">
                        <div class="col-md-12">
                        <h3>Order Lists You Might Be Intereseted In Joining</h3>
                        </div>
                    </div>
                    <div class="same-height-row">
                        <div class="same-height-row">
                            <?php
                            $orders = App\Order::whereNotIn('user_id', [Auth::user()->id])->paginate(2);
                            ?>
                            @foreach($orders as $order)
                            <div class="col-sm-6">
                                <div class="box same-height clickable">
                                    <h3><a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} items (<a href="/pages/create/orderlist/{{$order->id}}">add items</a>)</a></h3>
                                    <p>Shop: {{$order->shop}}</p>
                                    <p>Country: <b>{{$order->country->name}}</b></p>
                                    <p>
                                        <?php 
                                        $date1=date_create($order->duration);
                                        $date2=date_create(date('Y-m-d H:i:s'));
                                        $DateInterval=date_diff($date1,$date2);
                                        echo '<b>Time Left: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s)';
                                        ?>
                                    </p>
                                    <p>
                                        @include('share.share', [
                                        'url' => request()->fullUrl(),
                                        'description' => 'Join by orderlist to shop from {{$order->shop}}',
                                        ])
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            <br>
                            <span align="center">{{$orders->links()}}</span>
                        </div>
                    </div>
                </div>
            </div>    

            <div id="hot" class="col-md-6">
                <div class="box text-center">
                    <div class="container" style="width: 100%!important;">
                        <div class="col-md-12">
                            <h3>Shops</h3>
                        </div>
                    </div>
                    <div class="same-height-row">
                        <div class="same-height-row">
                            <?php
                            $shops = App\Shop::paginate(5);
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Shop No</th>
                                        <th>Name of Shop</th>
                                        <th>Market Place</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shops as $shop)
                                    <tr>
                                        <td>{{$shop->id}}</td>
                                        <td>{{ucfirst($shop->name)}}</td>
                                        <td>{{$shop->country->name}}</td>
                                        <td>
                                            <a href="/shop/{{$shop->id}}"><button type="button" class="btn btn-info"> More</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <span align="center">{{$shops->links()}}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
