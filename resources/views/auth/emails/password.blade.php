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
			padding: 10px;
			color: #ffffff!important;
		}

		ul{
			list-style-type: none;
			display: inline-block;
			float: right;
		}

		li {
			float: left;
		}

		a {
			display: inline;
			text-align: center;
			text-decoration: none;
			color: #000000;
		}

		li a{
			color: #ffffff;
			padding: 10px 10px;
		}

		/* Change the link color to #111 (black) on hover */
		li a:hover {
			background-color: #D9534F !important;
			color: #cccccc;
		}

		p a{
			padding: 0px!important;
			margin: 0px!important;
			color: #D9534F!important;
		}

		p a:hover{
			color: #D9534F !important;
			padding: 0px;
		}

		h3{
			color: black;
			margin: 2%!important;
		}

		span.user-name{
			padding: 0px!important;
			margin: 0px!important;
			color: #D9534F!important;
		}

		img.img-sample{
			width: 95%; 
			height: 30%; 
			margin: 1%;
		}

		p.p_text {
			color: black;
			margin: 2%;
		}

		span.message{
			color: #000000!important;
			margin: 2%!important;
			padding: 2%!important;
		}

		span.message2{
			color: #000000!important;
			margin: 2%!important;
		}

	</style>
</head>

<body>
	<div class="head">
		<span class="logo">
			<a href="{{url('/')}}">
				<img src="{{URL::to('images')}}/logo.gif" style="width: 40%; height: 60%;" /><br>
				<span style="color: #ffffff!important;">eCoopu</span>
			</a>
		</span>

		<span style="width: 60%;">
			<ul>
				<li><a href="{{url('/')}}">Home</a></li>
				<li><a href="{{url('/')}}/contact-us">Contact</a></li>
			</ul>
		</span>
	</div>

	<p class="p_text">

		<h3> 
			Hi <span class="user-name">{{$user->email}}</span>,  
		</h3>

		<span class="message">You asked to reset your password </span>
		<br><br>
		<span class="message">Click the link below to reset your password:</span>
		<br><br>
		<span class="message">
			<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" style="color: #D9534F"> {{ $link }} </a>
		</span>
		<br><br>
		<span class="message2">Best Regards,</span>
		<br>
		<span class="message2">The eCoopu Team.</span>

	</p>

</body>

</html>
