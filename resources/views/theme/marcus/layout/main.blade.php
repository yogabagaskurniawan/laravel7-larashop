<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>marcus Ecommerce Bootstrap Html Page </title>
	<!-- Standard -->
	<link rel="shortcut icon" href="{{ asset('theme/marcus/assets/images/ficon.png') }}">
	<!-- Latest Bootstrap min CSS -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/css/bootstrap.min.css') }}" type="text/css">
	<!-- Dropdownhover CSS -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/css/bootstrap-dropdownhover.min.css') }}" type="text/css">
	<!-- latest fonts awesome -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/font/css/font-awesome.min.css') }}" type="text/css">
	<!-- simple line fonts awesome -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/simple-line-icon/css/simple-line-icons.css') }}" type="text/css">
	<!-- stroke-gap-icons -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/stroke-gap-icons/stroke-gap-icons.css') }}" type="text/css">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/css/animate.min.css') }}" type="text/css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/css/style.css') }}" type="text/css">
	<!--  baguetteBox -->
	<link rel="stylesheet" href="{{ asset('theme/marcus/assets/css/baguetteBox.css') }}">
	<!-- Owl Carousel Assets -->
	<link href="{{ asset('theme/marcus/assets/owl-carousel/owl.carousel.css" rel="stylesheet') }}">
	<link href="{{ asset('theme/marcus/assets/owl-carousel/owl.theme.css" rel="stylesheet') }}">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="home6" style="overflow-x: hidden;">
	<!--  Preloader  -->
	<div id="preloader">
		<div id="loading">
		</div>
	</div>
	@include('theme.marcus.partials.header')
	
	@yield('content')

	{{-- @include('theme.marcus.partials.services') --}}
	@include('theme.marcus.partials.footer')
	{{-- @include('theme.marcus.partials.modals') --}}
	
	<p id="back-top" style="display: block;">
		<a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	</p>
	<script src="{{ asset('theme/marcus/assets/js/jquery.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ asset('theme/marcus/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('theme/marcus/assets/js/bootstrap-dropdownhover.min.js') }}"></script>
	<!-- Plugin JavaScript -->
	<script src="{{ asset('theme/marcus/assets/js/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('theme/marcus/assets/js/wow.min.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ asset('theme/marcus/assets/owl-carousel/owl.carousel.js') }}"></script>
	<!--  Custom Theme JavaScript  -->
	<script src="{{ asset('theme/marcus/assets/js/custom.js') }}"></script>
	<!--  jcarousel Theme JavaScript  -->
	<script type="text/javascript" src="{{ asset('theme/marcus/assets/js/jquery.jcarousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('theme/marcus/assets/js/jcarousel.connected-carousels.js') }}"></script>
	<script type="text/javascript" src="{{ asset('theme/marcus/assets/js/jquery.elevatezoom.js') }}"></script>
	<script>
		$('.zoom_01').elevateZoom({
			zoomType: "inner",
			cursor: "crosshair",
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 750
		});
	</script>
	<script>
		$(".delete").on("click", function () {
			return confirm("Do you want to remove this?");
		});
	</script>
</body>

</html>