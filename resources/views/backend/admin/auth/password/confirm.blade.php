<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets-back/admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets-back/admin') }}/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center min-vh-100">
            <!-- Added align-items-center and min-vh-100 -->
            <div class="col-xl-6 col-lg-8 col-md-10"> <!-- Adjusted column sizes for better centering -->
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12"> <!-- Removed the image column to focus on the form -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                        </div>
                                        @if (session('custom-error'))
                                            <div class="alert alert-danger">{{ session('custom-error') }}</div>
                                        @endif
                                        <form action="{{ route('admin.password.otp.verify') }}" method="POST">
                                            @csrf
                                        <div class="form-group">
                                            <input name="email" type="hidden" value="{{ $email }}" class="form-control form-control-user" 
                                                aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group">
                                            <input name="token" type="text" class="form-control form-control-user" aria-describedby="emailHelp">
                                        </div>
                                        <input type="submit" value="Submit Token"
                                            class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
