<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets-front') }}/css/styles.css">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="center">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-top:20%;">
                <h1>Login</h1>
                <div class="text-field">
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                    <span></span>
                    <label for="">Email</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-field">
                    <input type="password" name="password" id="password">
                    <span></span>
                    <label for="">Password</label>
                </div>
                <input type="submit" class="button" value="Login">
                <p style="text-align:center;color:gray">Forgot Password ? <a style="text-decoration: none;"
                        href="{{ route('password.request') }}">Click Here</a></p>
                <p style="text-align:center;color:gray"> Don't have an account? <a style="text-decoration: none;"
                        href="{{ route('register') }} ">Register Account</a></p>
        </form>
    </div>
    </div>
</body>

</html>
