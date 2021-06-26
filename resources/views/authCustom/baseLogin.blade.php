<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
        <script src="{{ asset('template/octopus/assets/vendor/jquery/jquery.min.js')}}"></script>
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/font-awesome/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/theme-custom.css')}}">

		<!-- Head Libs -->
		<script src="{{ asset('template/octopus/assets/vendor/modernizr/modernizr.js')}}"></script>

	</head>
	<body>

        @yield('auth')

		<!-- Vendor -->
		<script src="{{ asset('template/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('template/octopus/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('template/octopus/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('template/octopus/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('template/octopus/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('template/octopus/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('template/octopus/assets/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('template/octopus/assets/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('template/octopus/assets/javascripts/theme.init.js') }}"></script>

	</body>
</html>