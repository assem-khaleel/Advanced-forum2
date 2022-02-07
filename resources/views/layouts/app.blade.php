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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/atom-one-dark.min.css" rel="stylesheet">
    @toastr_css
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                @if ($errors->count()>0)
                    <ul class="list-group-item">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                <br><br>
                @endif

        <main class="py-4">
        <div class="container">
            <div class="row">
            <div class="col-md-4">

           <a href="{{route('discussion.create')}}" class="form-control btn btn-primary">Create a new Discussion</a>
                <br>
                <br>

                <div class="card">

                    <div class="card-body">
                        <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{route('forum')}}" style="text-decoration: none">Home</a>
                                </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=me" style="text-decoration: none">My Discussions</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=solved" style="text-decoration: none">Solved Discussions</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/forum?filter=unsolved" style="text-decoration: none">Unsolved Discussions</a>
                            </li>
                        </ul>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->admin)
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="/channels" style="text-decoration: none">All Channels</a>
                                </li>
                            </ul>
                        </div>
                        @endif
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                      Channels
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($channels as $channel)
                            <li class="list-group-item">
                                 <a href="{{route('channel',['slug'=>$channel->slug])}}" style="text-decoration: none">{{$channel->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
            </div>
        </div>
        </main>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
</body>
@jquery
@toastr_js
@toastr_render
</html>

