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

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand home" href="{{ url('/') }}" data-animate-hover="bounce">
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="hidden-xs">
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="visible-xs"><span class="sr-only">eCoopu - go to homepage</span>
                </a>

            </div>

            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    @if(Auth::guest())
                    <li class="active">
                        <a class="" href="{{ url('/') }}">Home</a>
                    </li>
                    @else 
                    <li class=""><a href="{{ route('admin') }}">Home</a>
                    </li> 
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Market Places <b class="caret"></b></a>
                        <ul class="dropdown-menu">
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
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{route('contact-us')}}">Contact</a></li>
                    <li><a href="{{route('about-us')}}">About</a></li>

                </li>
            </ul>
        </div>

        <div class="navbar-buttons">
           <div class="nav navbar-nav pull-right">
               <!-- Authentication Links -->
               @if(Auth::guest())
               <li><a href="{{ url('/login') }}">Login</a></li>
               @else
               <li><a href="{{ URL::route('addAdmin') }}"><i class=""></i>Add Admin</a></li>
               <li><a href="{{ URL::route('market') }}"><i class=""></i>Market Places</a></li>
               <li class="dropdown">
                <a href="{{url('/admin/dashboard')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::route('account') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
            @endif
        </div>
    </div>

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
                            {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
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
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });

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
