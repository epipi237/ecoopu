@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
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
                <!-- /#main-slider -->
            </div>
        </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
            _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible service ever</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best prices</a></h3>
                                <p>You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
            _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Start from here and join any market place</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                 <div class="same-height-row">
                   <div class="same-height-row">

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
<!--                                 <p class="social text-center">
                                    <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>                            
                                </p> -->

                                <p>
                                    @include('share.share', [
                                    'url' => request()->fullUrl(),
                                    'description' => 'Join by orderlist to shop from {{$order->shop}}',
                                    ])
                                </p>
                            </div>
                        </div>
                        @endforeach
                        <!-- /.row -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->

            </div>

            <div class="container center" >
                <span align="center">{{$orders->links()}}</span>

            </div>

        </div>
        <!-- /.product-slider -->
    </div>
    <!-- /.container -->

</div>
<!-- /#hot -->

<!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
            _________________________________________________________ -->
            
            <!-- *** GET INSPIRED END *** -->


            <!-- *** BLOG HOMEPAGE ***
            _________________________________________________________ -->

            <div class="box text-center" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="text-uppercase">Cantact Us</h3>

                        <p class="lead">Want to hear from us? wcontact us <a href="blog.html">here</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Our Mission</a></h4>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">Our Vision</a></h4>
                                <hr>
                                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean
                                    ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /#blog-homepage -->
                </div>
            </div>
            <!-- /.container -->
            <!-- *** BLOG HOMEPAGE END *** -->
        </div>
        <!-- /#content -->

        @endsection
