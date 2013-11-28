<!DOCTYPE HTML>
<html>
<head>
	@section('meta')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>@yield('title', 'Argo 2')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@show
	
	@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
	@show
	
	@section('javascript-head')
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	@show
	
</head>
<body>
	<div id="wrap">	
		@section('sidebar')
					
		<!-- Header -->
		<header class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					<a class="navbar-brand" href="{{ route('home') }}">Logo</small></a> 
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Tools <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class=""><a href="#">Link 1</a></li>
								<li class=""><a href="#">Link 2</a></li>
								<li><a href="#">Link 3</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">More Links</li>
								<li><a href="#">Link 4</a></li>
								<li><a href="#">Link 5</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					@if (!Sentry::check())
						<li><a href="{{ route('login') }}">Login</a></li>
					@else
						<li><a href="{{ route('logout') }}">Sign Out</a></li>
					@endif
					</ul>
				</div>
				<!--/.nav-collapse --> 
			</div>
		</header>
		@show
		<!-- end of Header -->

		
		<div id="pageBody">
			@yield('content', '<div class="container">Nothing to show...</div>')
		</div>
		<!-- end #pageBody -->
		
	</div>



	@section('footer')
	<!-- Footer -->
	<footer id="footer">
		<div class="container">
			<div id="copyright" class="text-muted">Logo - <a href="http://www.oacdesigns.com">OAC Designs</a>  &copy; <?php echo date("Y"); ?></div>
		</div>
	</div>
	@show
	<!-- end of Footer -->


	@section('javascript')
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	@show
</body>
</html>
