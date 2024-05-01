<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multi Auth | G2FAVerify</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('/admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/admin') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center " style="height: 70vh;S">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading font-weight-bold">G2FAVerify {{ session('g2fakey') }}</div>
                    <hr>


                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <p>Please enter the <strong>OTP</strong> generated on your Authenticator App. <br>
                                    Ensure
                                    you submit the current one because it refreshes every 30 seconds.</p>
                                <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>

                                <div class="col-md-6">
                                    <input id="one_time_password" type="number" class="form-control"
                                        name="one_time_password" required autofocus>

                                    <input id="g2fakey" type="hidden" class="form-control"
                                        value="{{ session('g2fakey') }}" name="g2fakey" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ url('/admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/admin') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
