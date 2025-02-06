<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets-front') }}/css/styles.css">
    <title>{{ config('app.name') }} - admin login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="center">
        <form action="{{ route('admin.login') }}" method="POST">
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
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input name="remember" id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <br>
                <input type="submit" class="button" value="Login">
                <p style="text-align:center;color:gray">Forgot Password ? <a style="text-decoration: none;"
                        href="{{ route('admin.password.email') }}">Click Here</a></p>
        </form>
    </div>
    </div>
</body>

</html>
