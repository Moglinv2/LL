<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- nice select css -->
    <link rel="stylesheet" href="assets/vendors/nice-select/css/nice-select.css" />
    <!-- magnific popup css -->
    <link rel="stylesheet" href="assets/vendors/magnific-popup/css/magnific-popup.css" />
    <!-- slick css -->
    <link rel="stylesheet" href="assets/vendors/slick/css/slick.css" />
    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- nice select js -->
    <script src="assets/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <!-- magnific popup js -->
    <script src="assets/vendors/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <!-- slick js -->
    <script src="assets/vendors/slick/js/slick.js"></script>
    <!-- shuffle js -->
    <script src="assets/vendors/shuffle/shuffle.min.js"></script>

    <!-- plugin js -->
    <script src="assets/js/plugin.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63d493ecc2f1ac1e203004fb/1gnr63kug';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>