<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.8.3.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/f47da9f06d.js" crossorigin="anonymous"></script>
    <style>
        span.twitter-typeahead .tt-menu,
        span.twitter-typeahead .tt-dropdown-menu {
            cursor: pointer;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }
        span.twitter-typeahead .tt-suggestion {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }
        span.twitter-typeahead .tt-suggestion.tt-cursor,
        span.twitter-typeahead .tt-suggestion:hover,
        span.twitter-typeahead .tt-suggestion:focus {
            color: #ffffff;
            text-decoration: none;
            outline: 0;
            background-color: #337ab7;
        }
        .input-group.input-group-lg span.twitter-typeahead .form-control {
            height: 46px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.3333333;
            border-radius: 6px;
        }
        .input-group.input-group-sm span.twitter-typeahead .form-control {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        span.twitter-typeahead {
            width: 100%;
        }
        .input-group span.twitter-typeahead {
            display: block !important;
            height: 34px;
        }
        .input-group span.twitter-typeahead .tt-menu,
        .input-group span.twitter-typeahead .tt-dropdown-menu {
            top: 32px !important;
        }
        .input-group span.twitter-typeahead:not(:first-child):not(:last-child) .form-control {
            border-radius: 0;
        }
        .input-group span.twitter-typeahead:first-child .form-control {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .input-group span.twitter-typeahead:last-child .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .input-group.input-group-sm span.twitter-typeahead {
            height: 30px;
        }
        .input-group.input-group-sm span.twitter-typeahead .tt-menu,
        .input-group.input-group-sm span.twitter-typeahead .tt-dropdown-menu {
            top: 30px !important;
        }
        .input-group.input-group-lg span.twitter-typeahead {
            height: 46px;
        }
        .input-group.input-group-lg span.twitter-typeahead .tt-menu,
        .input-group.input-group-lg span.twitter-typeahead .tt-dropdown-menu {
            top: 46px !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        @if(Session::has('message'))
            <div class='flash alert alert-danger'>
                <p>{!! Session::get('message')!!}</p>
            </div><br>
        @endif
        @if($errors -> count())
            <div class="flash alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="flash alert alert-success text-center" role="alert">
                <p>{!! Session::get('success')!!}</p>
            </div>
        @endif
        @if(isset($success))
            <div class="flash alert alert-success text-center" role="alert">
                <p>{!! $success !!}</p>
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@yield('js')
</html>
