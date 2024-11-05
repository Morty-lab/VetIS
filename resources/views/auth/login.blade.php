<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="{{ config('variables.systemDescription') ? config('variables.systemDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variable.systemKeyword') ? config('variables.systemKeyword') : '' }}">

    <title>Login | {{ config('variables.systemSuffix') ? config('variables.systemSuffix') : 'SystemSuffix'}}</title>

    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4 d-flex align-items-center justify-content-center">
                    <div class="row justify-content-center w-100">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Welcome to VetIS</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Login form-->
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Enter email address" value="{{ old('email')}}" required autocomplete="email" />
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" value="{{ old('password')}}" required autocomplete="current-password" />
                                        </div>
                                        <!-- Form Group (remember password checkbox)-->
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="remember" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }} />
                                                <label class="form-check-label" for="remember">Remember password</label>
                                            </div>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                            @endif
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                            @enderror
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                            @enderror
                                            <button class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright © Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="auth-login-basic.html#!">Privacy Policy</a>
                            ·
                            <a href="auth-login-basic.html#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script>
        (function() {
            var js = "window['__CF$cv$params']={r:'750b4b9be844073a',m:'XcCNQtsiZ9zaIrbjrXKlSZctCyFxb8XKDv1jRtqcUv0-1664187923-0-AcykVJiJu2/9wQizgMjlFBQpyyx7oLmrTCq0mawLM6zi0e5BPvPGQuOzNulAUUcTPxnjIhkm9El+jrCiKScFa5YwwCH0rcUQ8XTtvP+QLttfiOWebdvTYUHEuiYi5r1QK6SYCnkmnT+9xPJDv1mzaLc=',s:[0xbed09f9b75,0x4395878988],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";
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
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"750b4b9be844073a","token":"6e2c2575ac8f44ed824cef7899ba8463","version":"2022.8.1","si":100}' crossorigin="anonymous"></script>
</body>

</html>