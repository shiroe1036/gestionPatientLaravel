<!DOCTYPE html>
<html lang="en" class="fixed">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/morris/morris.css')}}" />

    <!-- utilities -->
    <script src="{{ asset('template/octopus/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/theme.css')}}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/skins/default.css')}}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('template/octopus/assets/stylesheets/theme-custom.css')}}">

    <!-- personna css -->
    <link rel="stylesheet" href="{{ asset('css/custom/style.css')}}">

    <!-- Head Libs -->
    <script src="{{ asset('template/octopus/assets/vendor/modernizr/modernizr.js')}}"></script>
</head>

<body>