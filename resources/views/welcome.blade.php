@extends('layouts.app')

@section('title', 'eCoopu')

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

        <div class="container">
            <div class="col-md-12">
                <div id="main-slider">
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider8.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider7.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{URL::to('images')}}/main-slider1.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider3.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider4.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider5.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{URL::to('images')}}/main-slider6.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div id="advantages">

            <div class="container">
                <div class="same-height-row">
                    <div class="col-sm-4">
                        <div class="box same-height clickable">
                            <div class="icon"><i class="fa fa-heart"></i>
                            </div>

                            <h3><a href="#">We love our customers</a></h3>
                            <p>We are known to provide best possible service while offering the best deals ever.</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="box same-height clickable">
                            <div class="icon"><i class="fa fa-tags"></i>
                            </div>

                            <h3><a href="#">Best prices</a></h3>
                            <p>Sellers set the prices per the demand of that good. This gives you the opportunity to get the best discounts while ensuring a profit margin for our sellers.</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="box same-height clickable">
                            <div class="icon"><i class="fa fa-thumbs-up"></i>
                            </div>

                            <h3><a href="#">Use your favorite store and get discount</a></h3>
                            <p>Get the best discounts for everything you purchase plus refunds on everything within 3 months.</p>
                        </div>
                    </div>
                        
                </div>

            </div>

        </div>
        
        <div id="hot">

            <div class="box text-center" style="margin-left: 9.5%! important; margin-right: 9.5%! important;">
                <div class="container">
                    <div class="col-md-12">
                        <h2>We buy together to get better deals</h2>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="same-height-row">

                    @foreach($orders as $order)
                    <div class="col-sm-3">
                        <div class="box same-height clickable">
                            <h3><a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} items (<a 
                                @if(Auth::check())
                                @if($order->user->id==Auth::user()->id)
                                href="/pages/create/orderlist/{{$order->id}}">
                                Add items
                                @else
                                href="/pages/create/orderlist/{{$order->id}}">
                                Join List 
                                @endif         
                                @else
                                href="/login">
                                Join List 
                                @endif


                            </a>)</a></h3>
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

</div>

<div class="box text-center" data-animate="fadeInUp" style="margin-left: 9.5%! important; margin-right: 9.5%! important;">
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-uppercase">Cantact Us</h3>

            <p class="lead">Want to hear from us? contact us <a href="{{route('contact-us')}}">here</a>
            </p>
        </div>
    </div>
</div>

<div class="container">

    <div class="col-md-12" data-animate="fadeInUp">

        <div id="blog-homepage" class="row" style="padding-left: 1%;">
            <div class="col-sm-6">
                <div class="post">
                    <h4><a href="">Our Mission</a></h4>
                    <hr>
                    <p class="intro">Our goal is to make our clients make better deals with their sellers. By improving our clients shopping habits, we enrich both the clients and the sellers of the goods.</p>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="post">
                    <h4><a href="">Our Vision</a></h4>
                    <hr>
                    <p class="intro">We believe in reducing the cost of purchasing goods and services. This will not only save our clients money but enrich our sellers to make gains by selling in bulk.</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
