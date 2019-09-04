<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel MPS</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<!-- Styles -->
	<style>
		html, body {
			background-color: #636b6f;
			color: #ffffff;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
		}

		body * {
			box-sizing: border-box;
		}

		.full-height {
			height: 100vh;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.position-ref {
			position: relative;
		}

		.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
		}

		.content {
			text-align: center;
		}

		.title {
			display: inline-block;
			height: 120px;
			line-height: 120px;
		}

		.title > span {
			font-size: 84px;
			display: inline-block;
			position: relative;
			padding: 0 120px 0 0;
			height: 120px;
			line-height: 120px;
		}

		.title > span > a,
		.title > span > a:hover,
		.title > span > a:active,
		.title > span > a:visited {
			display: block;
			height: 38px;
			line-height: 38px;
			margin: 30px 0;
			font-size: 28px;
			background-color: rgba(152, 252, 152, 0.7);
			color: #ffffff;
			text-decoration: none;
			border-radius: 5px;
			position: absolute;
			top: 0;
			right: 0;
			width: 100px;
			text-align: center;
			font-weight: bold;
			cursor: pointer;
		}

		.links > a {
			color: #ffffff;
			padding: 0 25px;
			font-size: 13px;
			font-weight: 600;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
		}

		.m-b-md {
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
<div class="flex-center position-ref full-height">
	@if (Route::has('login'))
		<div class="top-right links">
			@auth
				<a href="{{ url('/home') }}">Home</a>
			@else
				<a href="{{ route('login') }}">Login</a>

				@if (Route::has('register'))
					<a href="{{ route('register') }}">Register</a>
				@endif
			@endauth
		</div>
	@endif

	<div class="content">
		<div class="title m-b-md">
			<span>
				Laravel

				<a href="https://github.com/hacpaka/laravel-mps">MPS</a>
			</span>
		</div>

		<div class="links">
			<a href="https://laravel.com/docs">Docs</a>
			<a href="https://laracasts.com">Laracasts</a>
			<a href="https://laravel-news.com">News</a>
			<a href="https://blog.laravel.com">Blog</a>
			<a href="https://nova.laravel.com">Nova</a>
			<a href="https://forge.laravel.com">Forge</a>
			<a href="https://vapor.laravel.com">Vapor</a>
			<a href="https://github.com/laravel/laravel">GitHub</a>
		</div>
	</div>
</div>
</body>
</html>
