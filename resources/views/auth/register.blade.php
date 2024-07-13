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
    <link href="{{Helper::props('assets/img/favicon.png')}}" rel="icon">
</head>

<style>
    body {
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.6);
        background-blend-mode: darken;
    }

    .container {
        background-color: white;
        padding: 20px;
        border-radius: 20px;
        margin-top: 100px;
        width: 40%;
    }

    @media(max-width:1024px) {
        .container {
            width: 70%;
        }
    }

    @media(max-width:630px) {
        .container {
            width: 90%;
        }
    }

    @media(max-width:425px) {
        .container {
            width: 95%;
        }
    }

    input[type=text] {
        padding: 10px;
        width: 100%;
        border-radius: 10px;
    }

    input[type=password] {
        padding: 10px;
        width: 100%;
        border-radius: 10px;
    }
    input[type=email] {
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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Enter Your Name" value="{{old('name')}}" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{old('email')}}" placeholder="Enter Your Email"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Enter Your Password"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <input id="password_confirmation" class="block mt-1 w-full" type="password" placeholder="Re-Enter Your Password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="mb-3">
                    {{ __('Register') }}
                </x-primary-button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </div>
    </div>
</body>

</html>