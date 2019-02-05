<!doctype html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://account.africastalking.com/assets/img/favicons/favicon-32x32.png" rel="icon" type="image/png" sizes="32x32">
        <title>@yield('title')</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
        <script>
        $(document).ready(function($){
        $('button').click(function(){
            var direction = $(this).val();
            $.post("/",
            {
                direction: direction
            },)
            alert(direction);
        });
        });
        </script>
    </head>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                color: #111111;
            }
            .menucol {
                height: 100%;
                width: 20%;
                position: fixed;
                z-index: 1;
                top: 0;
                overflow-x: hidden;
            }
            .left {
                left: 0;
                background-color: #f0f0f0;
            }
            .right {
                right: 0;
            }
            .fitW {
                width:100%;
            }
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                padding:30px;
            }
            ::-webkit-scrollbar { 
                display: none; 
            }
            .btn-group button {
                background-color: #007830; /* Green background */
                border: 1px #007830; /* Green border */
                color: white; /* White text */
                padding: 10px 24px;
                cursor: pointer; /* Pointer/hand icon */
                width: 100%;
                display: block; /* Make the buttons appear below each other */
            }
            .btn-group button:not(:last-child) {
                border-bottom: none; /* Prevent double borders */
            }
            .btn-group button:hover {
                background-color: #3e8e41;
            }
            .hidden {
            display: none;
            }
            table {   
                border: 2px solid #f0f0f0;
                color: white;
                border-radius: 5px;
            }
            td {
                border: 1px solid #f0f0f0;
                padding: 5px;
                background-color: #007848;
            }
            th{
                border: 1px solid #f0f0f0;
                padding: 10px;
                background-color: #f07830;
            }
            input {
                background-color: #f07830;
                border: 1px solid #f07830;
                padding: 5px;
                border-radius: 5px;
                color: white; 
            }
            #done:hover{
                background-color: 	#f09018;
            }
            select, option {
                background-color: #f07830;
                border: 1px solid #f07830;
                padding: 5px;
                border-radius: 5px;
                color: white; 
            }

        </style>   
    </head> 

    <body background="https://www.africastalking.com/img/new/landing-graphic.png">
    <div style= "background-color: #f0f0f0;">
    <div>
        <img src ="https://account.africastalking.com/assets/img/logos/logo-full-color.png" class="center">
    </div>
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