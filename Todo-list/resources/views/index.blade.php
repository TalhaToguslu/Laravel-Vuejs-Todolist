<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title','To-do List')</title>
        <!-- Fonts -->
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

    </head>
    <body class="antialiased">

      <!-- NAV -->
      <nav class="navbar navbar-light bg-white shadow m-1">
        <a class="navbar-brand" href="#">Todo List</a>
      </nav>
      <!-- NAV -->

        <div id="app" class="contanier m-3 p-1">
          @yield('content')
        </div>

    </body>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('assets/sweetalert2/dist/sweetalert2.all.js')}}"></script>
    @include('sweetalert::alert')
</html>
