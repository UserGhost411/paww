<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Satap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .auth.login-bg {
            background: url("{{ asset('img/login.jpg') }}");
            background-size: cover;
        }

        .auth .login-half-bg {
            background: url("{{ asset('img/login.jpg') }}");
            background-size: cover;
        }
    </style>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Register Account</h3>
                            @if ($message = Session::get('error'))
                            <div class="alert alert-warning alert-block"><strong>{{ $message }}</strong></div>
                            @endif
                            <!-- Login submission form-->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Username <span style="color:red">*</span></label>
                                    <input type="text" class="form-control p_input" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label>Email <span style="color:red">*</span></label>
                                    <input type="email" class="form-control p_input" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password <span style="color:red">*</span></label>
                                    <input type="password" class="form-control p_input" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Re-Password <span style="color:red">*</span></label>
                                    <input type="password" class="form-control p_input" name="repassword" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>

                                <p class="sign-up">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('js/login.js') }}"></script>
    <!-- endinject -->
</body>

</html>