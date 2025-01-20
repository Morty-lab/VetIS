<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PetHub</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    @yield('styles')
    <script data-search-pseudo-elements="" defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <!-- @vite('resources/js/app.js') -->
</head>

<body class="nav-fixed">
    @php
    if (auth()->check() && auth()->user()->role === 'client') {
    header('Location: ' . route('portal.dashboard'));
    exit;
    }
    @endphp
    <div class="">
        @include('layouts.navigation')
    </div>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav" class="">
            @include('layouts.sidenav')
        </div>
        <div id="layoutSidenav_content" class="">
            <main>
                @yield('content')
            </main>

            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright © PetHub 2024</div>
                        <!-- <div class="col-md-6 text-md-end small">
                            <a href="dashboard-1.html#!">Privacy Policy</a>
                            ·
                            <a href="dashboard-1.html#!">Terms &amp; Conditions</a>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables/datatables-simple-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/litepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @yield('scripts')

    <script>
        (function() {
            var js = "window['__CF$cv$params']={r:'750b4b957f85073a',m:'9YnjVxj1lvMSfJo7FsgPB016a2d5Mob2vA_RY8AwXr8-1664187922-0-AYAGUvWlfpTuG6aVTeb+LG7WyKDALTbQYNo0X5a9KafV+tJEYlT3I0N7gEOfaqulJhciJArCS3XY5iGoLdd3b2PKGtOM/dAqEvp7tMuwIgUcehMM66DnwO0Igodqcxkigmpdy+zBqltHzaAB3jq4tDU=',s:[0x7ca35a1970,0x45461e0d12],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";
            var _0xh = document.createElement('iframe');
            _0xh.height = 1;
            _0xh.width = 1;
            _0xh.style.position = 'absolute';
            _0xh.style.top = 0;
            _0xh.style.left = 0;
            _0xh.style.border = 'none';
            _0xh.style.visibility = 'hidden';
            document.body.appendChild(_0xh);

            function handler() {
                var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;
                if (_0xi) {
                    var _0xj = _0xi.createElement('script');
                    _0xj.nonce = '';
                    _0xj.innerHTML = js;
                    _0xi.getElementsByTagName('head')[0].appendChild(_0xj);
                }
            }
            if (document.readyState !== 'loading') {
                handler();
            } else if (window.addEventListener) {
                document.addEventListener('DOMContentLoaded', handler);
            } else {
                var prev = document.onreadystatechange || function() {};
                document.onreadystatechange = function(e) {
                    prev(e);
                    if (document.readyState !== 'loading') {
                        document.onreadystatechange = prev;
                        handler();
                    }
                };
            }
        })();
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"750b4b957f85073a","token":"6e2c2575ac8f44ed824cef7899ba8463","version":"2022.8.1","si":100}' crossorigin="anonymous"></script>

</body>

</html>
