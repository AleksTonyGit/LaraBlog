<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Larablog</title>
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery-3.0.0.js')}}"></script>
        
    </head><!--/head-->
    <body>
        @section('menu')
        <div class="mainmenu1 col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-pills nav-justified">    
                <li role="presentation" {{$page == 'Main page' ? 'class=active' : ''}}>
                    <a href="{{url('index')}}">Main Page</a></li>
                <li role="presentation"  {{$page == 'Forms' ? 'class=active' : ''}}>
                    <a href="{{url('create')}}">Content Control</a></li>
             </ul>
        </div>
        @show

        <div class="container col-sm-12 col-md-12 col-lg-12">
            @yield('content')
        </div>
    </body>
</html>