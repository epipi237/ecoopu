<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="eCoopu.The best" />
    <meta property="og:description" content="eCoopu is an awesome platform that helps you in making better deals by buying together with other people. Join eCoopu and make better buying deals." />

    <title>
        @yield('title')
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
    <div id="fb-root"></div>

    <script>
        window.fbAsyncInit = function() {
            FB.init({appId: '1342308649136602', status: true, cookie: true,
                xfbml: true});
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
    </script>
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

                    <!-- <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                    <li><a href="{{route('about-us')}}">About Us</a></li> -->

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
                    style="height: 100%; margin: 0px; padding: 0px; margin-right: 0px;" />
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="visible-xs" style="height: 100%; margin: 0px; padding: 0px; margin-right: 0px;" />
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
                    <a class="btn btn-default navbar-toggle" href="{{ route('expired') }}">
                        <i class="fa fa-stack-overflow"></i></i>  <span class="hidden-xs">Expired order List</span>
                    </a>
                    <a class="btn btn-default navbar-toggle" href="{{ route('order') }}">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Creat an order list</span>
                    </a>
                    @endif
                </div>
            </div>

            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    @if(Auth::guest())
                    <li class="@yield('active-home')">
                        <a class="" href="{{ url('/') }}">Home</a>
                    </li>
                    @else 
                    <li class="@yield('active-home')"><a href="{{ url('/home') }}">Home</a>
                    </li> 
                    @endif

                    <li class="@yield('active-shops-orderlists')"><a href="{{route('list_shops_and_orderlists')}}">Shops & Orderlists</a></li>
                    
                    <li class="dropdown @yield('active-market-places')">
                        @if(Auth::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Market Places <b class="caret"></b></a>
                        @endif
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <ul>
                                                @if(isset($countries))
                                                @foreach($countries as $country)
                                                <li><a href="/pages/market-places/{{$country->id}}">{{$country->name}}</a>
                                                </li>
                                                @endforeach
                                                @else
                                                <li><a>Market places can't be shown here</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="@yield('active-about-us')"><a href="{{route('about-us')}}">About Us</a></li>
                    <li class="@yield('active-contact-us')"><a href="{{route('contact-us')}}">Contact Us</a></li>
                    <!-- <li class=""><a href="#">FAQ</a>
                </li> -->
            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons right">

            @if(!Auth::guest())

            <div class="navbar-collapse collapse right" id="basket-overview">
                <a href="{{ route('expired') }}" class="btn btn-danger navbar-btn">
                <i class="fa fa-stack-overflow"></i><span class="hidden-sm">Expired orderlist</span>
                </a>
            </div>

            <div class="navbar-collapse collapse right">
                <a href="{{ route('order') }}" class="btn btn-danger navbar-btn">
                    <i class="fa fa-shopping-cart"></i><span class="hidden-sm">Create an orderlist</span>
                </a>
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
<!-- /#navbar -->

<!-- *** NAVBAR END *** -->


@yield('content')


 <!-- *** FOOTER ***
 _____________________________________________________________ -->
 <div id="footer" data-animate="fadeInUp">
    <div class="container">
        <div class="row" style="padding-left: 2.5%;">
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
                                        @if(isset($countries))
                                        @foreach($countries as $country)
                                        <li><a href="/pages/market-places/{{$country->id}}">{{$country->name}}</a>
                                        </li>
                                        @endforeach
                                        @else
                                        <li><a>Market places can't be shown here</a></li>
                                        @endif
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

                <a href="{{route('contact-us')}}">Go to contact page</a>

                <hr class="hidden-md hidden-lg">

            </div>
            <!-- /.col-md-3 -->



            <div class="col-md-3 col-sm-6">

                <!-- <h4>Get the news</h4>

                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <hr> -->
                <h4>Stay in touch</h4>
                <p class="social">
                    <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                    <a href="mailto:info@ecoopu.com" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
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

<!-- *** COPYRIGHT ***_________________________________________________________ -->
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
<!-- /#all -->

<!-- *** SCRIPTS TO INCLUDE ***_________________________________________________________ -->

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
        $('[data-toggle="popover"]').popover();   
        /*
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
        */
        // Sharing on social media

        var popupSize = {
            width: 780,
            height: 550
        };

        $(document).on('click', '.social-buttons > a', function(e){

            var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

            var popup = window.open($(this).prop('href'), 'social',
                'width='+popupSize.width+',height='+popupSize.height+
                ',left='+verticalPos+',top='+horisontalPos+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup){
                popup.focus();
                e.preventDefault();
            }

        });

    });
</script>

<script type="text/javascript">
    function share(name,link,picture,caption,description){
        FB.ui(
        {
            method: 'feed',
            name: name,
            link: link,
            picture: picture,
            caption: caption,
            description: description,
            message: ''
        });  
    }
</script>
</body>
</html>
