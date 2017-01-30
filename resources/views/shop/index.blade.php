<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        eCoopu
    </title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{URL::to('images')}}/logo.gif">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- styles -->
    <link href="{{URL::to('assets')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/css/animate.min.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/css/owl.theme.css" rel="stylesheet">
    <!-- theme stylesheet -->
    <link href="{{URL::to('assets')}}/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="{{URL::to('assets')}}/css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    <!-- *** TOPBAR ***
    _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 pull-right" data-animate="fadeInDown">
                <ul class="menu">

                    <!-- Authentication Links -->
                    @if(Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    <li>
                        <a href="#">
                            {{ ucfirst(Auth::user()->name) }} <!-- <span class="caret"></span> -->
                        </a>
                        <!-- <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul> -->
                    </li>
                    <li><a href="{{ URL::route('account') }}"><i class=""></i>Edit Profile</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    @endif

                    <!-- <li><a href="{{route('contact-us')}}">Contact</a></li>
                    <li><a href="{{route('about-us')}}">About</a></li> -->

                </ul>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
    _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand home" href="" data-animate-hover="bounce" style="">
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="hidden-xs" 
                    style="width: 45%; height: 100%; margin: 0px; padding: 0px; margin-right: 0px;" />
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="visible-xs" style="width: 45%; height: 100%; margin: 0px; padding: 0px; margin-right: 0px;" />
                    <span class="sr-only">eCoopu - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    @if(!Auth::guest())
                    <a class="btn btn-default navbar-toggle" href="{{ route('order') }}">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Creat an order list</span>
                    </a>
                    <a class="btn btn-default navbar-toggle" href="{{ route('expired') }}">
                        <i class=""></i>  <span class="hidden-xs">Expired order List</span>
                    </a>
                    @endif
                </div>
            </div>

            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation" style="margin-left: -8%;">

            <ul class="nav navbar-nav navbar-left">
                @if(Auth::guest())
                <li class="active">
                    <a class="" href="{{ url('/') }}">Home</a>
                </li>
                @else 
                <li class=""><a href="{{ route('shop_index') }}">Home</a>
                </li> 
                @endif

                <li class=""><a href="{{route('about-us')}}">About Us</a></li>
                <li class=""><a href="{{route('contact-us')}}">Contact Us</a></li>
                <!-- <li class=""><a href="#">FAQ</a></li> -->
            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons">

            @if(!Auth::guest())
            <div class="navbar-collapse collapse right" id="">
               <!--  <a href="{{ route('expired') }}" class="btn btn-danger navbar-btn"><i class=""></i><span class="hidden-sm">Add Shop</span></a> -->
               <button class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#myModal">Add Shop</button>
           </div>

           @endif
           <!--/.nav-collapse -->
           <div class="navbar-collapse collapse right" id="search-not-mobile">
            <button type="button" class="btn navbar-btn btn-danger" data-toggle="collapse" data-target="#search">
                <span class="sr-only">Toggle search</span>
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    <div class="collapse clearfix" id="search">
        <form class="navbar-form" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

    </div>
    <!--/.nav-collapse -->
</div>
<!-- /.container -->
</div>

<!-- Modal for shop owners to add shops-->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add Shop</h4>
            </div>
            <div class="modal-body">


                <form class="form-horizontal" role="form" method="POST" action="{{route('addshop')}}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Shop Name:</label>

                        <div class="col-md-6">
                            <input id="product" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">Address:</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duration" class="col-md-4 control-label">Market Place</label>
                        <div class="col-md-6">

                            <select class="form-control" name='market' required='required'>
                                @foreach($countries as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('duration'))
                            <span class="help-block">
                                <strong>{{ $errors->first('duration') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-add"></i> Add
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@yield('content')

<!-- *** FOOTER ***_____________________________________________________________ -->

<div id="footer" data-animate="fadeInUp">
    <div class="container">
        <div class="row" style="padding-left: 0%;">
            <div class="col-md-3 col-sm-6">
                <h4>Pages</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><!-- <a href="#"> -->Market Places<!-- </a> --></li>
                    <li><a href="{{route('about-us')}}">About us</a></li>
                    <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                    <!-- <li><a href="#">FAQ</a></li> -->
                </ul>

                <hr>

                <h4>User section</h4>

                <ul>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

                <hr class="hidden-md hidden-lg hidden-sm">

            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-3 col-sm-6">

                <h4>Market Places</h4>
                <ul>
                    <li>
                        <div class="yamm-content">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul>
                                        @foreach($countries as $country)
                                        <li><a href="/pages/market-places/{{$country->id}}">{{$country->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <hr class="hidden-md hidden-lg">

            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-3 col-sm-6">

                <h4>Where to find us</h4>

                <p><strong>eCoopu Ltd.</strong>
                    <br>13/25 New Avenue
                    <br>New Heaven
                    <br>45Y 73J
                    <br>Denmark
                    <br>
                    <strong></strong>
                </p>

                <a href="#">Go to contact page</a>

                <hr class="hidden-md hidden-lg">

            </div>
            <!-- /.col-md-3 -->



            <div class="col-md-3 col-sm-6">

                <h4>Stay in touch</h4>
                <p class="social">
                    <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                </p>


            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#footer -->

<!-- *** FOOTER END *** -->

<!-- *** COPYRIGHT ***___________________________________ -->
<div id="copyright">
    <div class="container">
        <div class="col-md-6">
            <p class="pull-left"> Copyright © 2016. eCoopu. All rights reserved.</p>
        </div>
        <div class="col-md-6">
        </p>
    </div>
</div>
</div>
<!-- *** COPYRIGHT END *** -->
</div>
</body>
<!-- /#all -->

<!-- *** SCRIPTS TO INCLUDE ***__________________________ -->

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/jquery.cookie.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/waypoints.min.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/modernizr.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/bootstrap-hover-dropdown.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{URL::to('assets')}}/js/front.js"></script>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script type="text/javascript">

    $(function () {

        //calculating the total price when this page loads
        var total_price = document.getElementById('total_price');
        var sub_prices = document.getElementsByClassName('sub_price');
        var first_sub_price = sub_prices[0];
        calculateTotal(first_sub_price);

        $("body").on("keyup", "input.sub_price", function () {
            calculateTotal(this);
        });

        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });     

        function calculateTotal(src) {
            var sum = 0,
            tbl = $(src).closest('form');
            tbl.find('input.sub_price').each(function(index, elem) {
                var val = parseFloat($(elem).val());
                if( !isNaN( val ) ) {
                    sum += val;
                }
            });
            total_price.value = sum;
        }

    });
</script>

</html>