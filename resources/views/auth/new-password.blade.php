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



    <div class="mb-4 text-sm text-gray-600">
        {{ __('Create a new password here, Then try to login with your Email ID & your new password !!') }}
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Email Address -->
         <center>
        <div>
            <input type="hidden" value="{{$userId}}" name="userId"/>
            <input id="password" class="block mt-1 w-full" type="password" name="password"  placeholder="Enter New Password Here..." required autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            
        </div>
        </center>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</div>
    </div>
</body>

</html>
