<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:type"               content="article" />
  <meta property="og:title"              content="eCoopu.The best" />
  <meta property="og:description"        content="eCoopu is an awesome platform that helps you in making better deals by buying together with other people. Join eCoopu and make better buying deals." />

  <title>
    eCoopu
  </title>

  <!-- Fonts -->
  <link rel="icon" type="image/png" href="{{URL::to('images')}}/logo.gif">

  <style type="text/css">
    body{
      margin: 0px;
      padding: 0px;
      font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
      font-size: 14px;
      line-height: 1.42857143;
      color: #333;
    }

    .head {
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    .logo{
      display: inline-block;
      float: left;
    }

    ul{
      list-style-type: none;
      display: inline-block;
      width: 70%;
      padding-top: 3%;
    }

    li {
      float: left;
    }

    a, a:hover{
      display: inline;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    li a:hover {
      background-color: #D9534F !important;
    }

    p a{
      color: #000000;
      padding: 0px;
    }

    p a:hover{
      color: #D9534F !important;
      padding: 0px;
    }

  </style>
</head>

<body>
  <div class="head">
    <span class="logo">
      <a href="http://ecoopu.com">
        <img src="{{URL::to('images')}}/logo.gif">
        eCoopu
      </a>
    </span>

    <ul>
      <li><a href="http://ecoopu.com">Home</a></li>
      <li><a href="http://ecoopu.com/contact">Contact</a></li>
      <li style="float:right"><a class="active" href="http://ecoopu.com/about">About</a></li>
    </ul>
  </div>

  <p style="color:black;padding: 2%;">

    @if(isset($email))
    <h3 style="color:black;padding: 2%;">Hi {{$email}}, </h3>
    @else
    <h3 style="color:black;padding: 2%;"> Hi John,  </h3>
    @endif

  </p>

  <div class="item">
    <img class="img-responsive" style="width:95%; height:30%; margin: 1%;" src="{{URL::to('images')}}/main-slider3.jpg" alt="">
  </div>

  <div class="item">
    <img class="img-responsive" style="width:95%; height:30%; margin: 1%;" src="{{URL::to('images')}}/main-slider5.jpg" alt="">
  </div>

  <p style="color:black;padding: 2%;">
    Welcome to <a href="http://ecoopu.com">Ecoopu.com</a>. <a href="http://ecoopu.com">eCoopu</a> betters your buying deals and helps you buy at the cheapest rate. We encourage you to <a href="mailto:info@ecoopu.com">reply</a> to this email if you have some questions, thanks.
  </p>

</body>

</html>