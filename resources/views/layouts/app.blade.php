<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        eCoopu : e-commerce template
    </title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{URL::to('images')}}/logo.gif">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <meta name="keywords" content="">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>


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
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.html">Register</a>
                    </li>
                    <li><a href="contact.html">Contact</a>
                    </li>
                    <li><a href="#">Privacy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="customer-orders.html" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>


                            <!-- Authentication Links -->
<!--                     @if (Auth::guest())
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
                    @endif -->


                </form>

                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

            </div>
        </div>
    </div>
</div>

</div>

<!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
    _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand home" href="index.html" data-animate-hover="bounce">
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="hidden-xs">
                    <img src="{{URL::to('images')}}/logo.gif" alt="eCoopu logo" class="visible-xs"><span class="sr-only">eCoopu - go to homepage</span>
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
                    <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Creat an order list</span>
                    </a>
                </div>
            </div>

            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.html">Home</a>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Market Places <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <ul>
                                                <li><a href="index.html">Denmark</a>
                                                </li>

                                                <li><a href="category.html">America</a>
                                                </li>

                                                <li><a href="category-right.html">Germany</a>
                                                </li>

                                                <li><a href="category-full.html">Australia</a>
                                                </li>

                                                <li><a href="detail.html">Austria</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <ul>
                                                <li><a href="register.html">Hungary</a>
                                                </li>
                                                <li><a href="customer-orders.html">Italy</a>
                                                </li>
                                                <li><a href="customer-order.html">India</a>
                                                </li>
                                                <li><a href="customer-wishlist.html">China</a>
                                                </li>
                                                <li><a href="customer-account.html">United Kingdom</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <ul>
                                                <li><a href="basket.html">Dubai</a>
                                                </li>
                                                <li><a href="checkout1.html">Japan</a>
                                                </li>
                                                <li><a href="checkout2.html">Netherland</a>
                                                </li>
                                                <li><a href="checkout3.html">Ukraine</a>
                                                </li>
                                                <li><a href="checkout4.html">South Africa</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <ul>
                                                <li><a href="blog.html">Belgium</a>
                                                </li>
                                                <li><a href="post.html">South Korea</a>
                                                </li>
                                                <li><a href="faq.html">Ireland</a>
                                                </li>
                                                <li><a href="text.html">Turkey</a>
                                                </li>
                                                <li><a href="text-right.html">Poland</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li class=""><a href="#">About Us</a>
                    </li>
                    <li class=""><a href="#">Contact Us</a>
                    </li>
                    <li class=""><a href="#">FAQ</a>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.html" class="btn btn-danger navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Create an orderlist</span></a>
                </div>
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
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <h4>Pages</h4>

                <ul>
                    <li><a href="text.html">Home</a>
                    </li>
                    <li><a href="text.html">Market Places</a>
                    </li>
                    <li><a href="text.html">About us</a>
                    </li>
                    <li><a href="text.html">Contact Us</a>
                    </li>
                    <li><a href="faq.html">FAQ</a>
                    </li>
                </ul>

                <hr>

                <h4>User section</h4>

                <ul>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.html">Regiter</a>
                    </li>
                </ul>

                <hr class="hidden-md hidden-lg hidden-sm">

            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-3 col-sm-6">

                <h4>Top categories</h4>

                <h5>Men</h5>

                <ul>
                    <li><a href="category.html">T-shirts</a>
                    </li>
                    <li><a href="category.html">Shirts</a>
                    </li>
                    <li><a href="category.html">Accessories</a>
                    </li>
                </ul>

                <h5>Ladies</h5>
                <ul>
                    <li><a href="category.html">T-shirts</a>
                    </li>
                    <li><a href="category.html">Skirts</a>
                    </li>
                    <li><a href="category.html">Pants</a>
                    </li>
                    <li><a href="category.html">Accessories</a>
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

                <a href="contact.html">Go to contact page</a>

                <hr class="hidden-md hidden-lg">

            </div>
            <!-- /.col-md-3 -->



            <div class="col-md-3 col-sm-6">

                <h4>Get the news</h4>

                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <hr>

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




        <!-- *** COPYRIGHT ***
        _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2016 eCoopu.</p>

                </div>
                <div class="col-md-6">
                </p>
            </div>
        </div>
    </div>
    <!-- *** COPYRIGHT END *** -->
</div>
<!-- /#all -->

    <!-- *** SCRIPTS TO INCLUDE ***
    _________________________________________________________ -->
    <script type="text/javascript" src="{{URL::to('assets')}}/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/waypoints.min.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/modernizr.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/bootstrap-hover-dropdown.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{{URL::to('assets')}}/js/front.js"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
