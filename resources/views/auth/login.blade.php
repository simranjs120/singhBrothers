<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Singh Brothers - Admin Panel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{Helper::props('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{Helper::props('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<style>
body{
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.6);
  background-blend-mode: darken;
}
.container{
    background-color: white;
    padding: 20px;
    border-radius: 20px;
    margin-top: 100px;
    width: 40%;
}
@media(max-width:1024px){
    .container{
        width: 70%;
    }
}
@media(max-width:630px){
    .container{
        width: 90%;
    }
}
@media(max-width:425px){
    .container{
        width: 95%;
    }
}
input[type=text]{
    padding: 10px;
    width: 100%;
    border-radius: 10px;
}
input[type=password]{
    padding: 10px;
    width: 100%;
    border-radius: 10px;
}
</style>

<body background="{{Helper::props('assets/img/home-bg.png')}}">
    <div class="container">
        <div>
            <center>
                <a href="/">
                    <img class="img-fluid" src="{{Helper::props('admin/images/logo.png')}}" />
                </a>
            </center>
        </div>
        <br>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
             <center>
                    <input type="text" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter Your Email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </center>
            </div>

            <!-- Password -->
            <div class="mt-4">
            <center>
                <input type="password" id="password" class="block mt-1 w-full" type="password" placeholder="Enter Your Password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </center>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember Me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-1 mb-3">
                <x-primary-button class="mt-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
        </form>
    </div>
    </div>
</body>

</html>