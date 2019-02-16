<!doctype html>
<html lang="en-US">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ URL::asset('js/main.js') }}">
      <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
      <link href="https://account.africastalking.com/assets/img/favicons/favicon-32x32.png" rel="icon" type="image/png" sizes="32x32">
      <title>@yield('title')</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </head>
   <body background="https://africastalking.com/img/voice/banner.png">
   <div class="header">
               <img src ="https://account.africastalking.com/assets/img/logos/logo-full-color.png" class="center">
</div>
            <?php
               if (isset($direction)) {
                   echo "<b><span style='padding:1%'>Direction:</b>$direction</span><br>";
               } else {
                   $direction = " not provided";
                   echo "<b><span style='padding:1%'>Direction:</b>$direction</span><br>";
               }
               
               ?>
         @yield('content')
   </body>
</html>