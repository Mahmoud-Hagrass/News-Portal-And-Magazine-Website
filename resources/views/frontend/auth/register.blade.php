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
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="text-field">
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                <span></span>
                <label for="">Name</label>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-field">
                <input type="text" name="username" id="username" value="{{ old('username') }}">
                <span></span>
                <label for="">Username</label>
            </div>
            <div class="text-field">
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <span></span>
                <label for="">Email</label>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="password">
                <span></span>
                <label for="">Password</label>
            </div>
            <div class="text-field">
                <input type="password" name="password_confirmation" id="password_confirmation">
                <span></span>
                <label for="">Password Confirmation</label>
            </div>
            <input type="submit" class="button" value="Register">
            <p style="text-align: center; color: grey;">Already have an account? <a href="#"
                    class="signin">SignIn</a></p>
        </form>
    </div>
</body>

</html>
