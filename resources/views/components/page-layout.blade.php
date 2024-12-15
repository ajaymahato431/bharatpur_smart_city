<!DOCTYPE html>
<html lang="en">

<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />

    <!-- DESCRIPTION -->
    <meta name="description" content="EduChamp : Education HTML Template" />

    <!-- OG -->
    <meta property="og:title" content="EduChamp : Education HTML Template" />
    <meta property="og:description" content="EduChamp : Education HTML Template" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- PAGE TITLE HERE ============================================= -->
    <title>EduChamp : Education HTML Template </title>

    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
 <script src="assets/js/html5shiv.min.js"></script>
 <script src="assets/js/respond.min.js"></script>
 <![endif]-->

    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/assets.css') }}">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/typography.css') }}">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes/shortcodes.css') }}">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('assets/css/color/color-1.css') }}">

    <style>
        /* Style the dropdown box */
        .goog-te-gadget-simple {
            border-radius: 6px;
            /* Slightly rounded corners */
            color: black;

        }

        /* Style the icon inside the box */
        .goog-te-gadget-simple img {
            display: none;
            /* Hide the Google Translate icon */
        }

        /* Hover effect */
        .goog-te-gadget-simple:hover {
            background-color: #d4e7ff;
            /* Darker blue on hover */
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            /* Slightly darker shadow */
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .form-container h3 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-container .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .file-upload {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .file-upload input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .file-upload label {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>

<body id="bg">
    <div class="page-wraper">
        <div id="loading-icon-bx"></div>


        <x-header />

        {{ $slot }}

        <x-footer />


        <button class="back-to-top fa fa-chevron-up"></button>
    </div>
    <!-- Google Translate Script -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <!-- External JavaScripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('assets/vendors/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendors/counter/waypoints-min.js') }}"></script>
    <script src="{{ asset('assets/vendors/counter/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/vendors/masonry/masonry.js') }}"></script>
    <script src="{{ asset('assets/vendors/masonry/filter.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scroller.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('assets/js/contact.js') }}"></script>
</body>

</html>
