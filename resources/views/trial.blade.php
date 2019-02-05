<?php
echo "<style> table, th, td {   border: 1px solid black; } </style>";
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2018-08-01&endDate=2018-08-31&metric=duration&currencyCode=KES",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
}
$jsonString = $response;
$jsonDecoded = json_decode($jsonString, true);
$jsonDecodedClean = $jsonDecoded["responses"]["numberTypeStats"];
echo"<table>";
echo "<tr><th>Date</th><th>Regular</th><th>SIP Phone</th></tr>";
$regulararray=array();
$siparray=array();
foreach($jsonDecodedClean as $row){
    $date=$row["date"];
    $regular=$row["elements"]["Regular"];
    $SIPPhone=$row["elements"]["SIPPhone"];
    array_push($regulararray,$regular);
    array_push($siparray,$SIPPhone);
    echo "<tr>";
    echo"<td>";
    echo $date;
    echo"</td>";
    echo"<td>";
    echo $regular;
    echo"</td>";
    echo"<td>";
    echo $SIPPhone;
    echo"</td>";
    echo"</tr>";
}
$sipTotal=array_sum($siparray);
$regularTotal=array_sum($regulararray);
echo"<tr>";
echo"<td>";
echo "<b>Total</b>";
echo"</td>";
echo"<td>";
echo $regularTotal;
echo"</td>";
echo"<td>";
echo $sipTotal;
echo"</td>";
echo"</tr>";
echo"</table>";

?>




<!doctype html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            var username = $(this).val();
            $.post("/",
            {
                username: username
            },)
            alert(username);
        });
        });
        </script>
        <script>
        $(document).ready(function($){
        $('a').click(function(){
            var direction = $(this).val();
            $.post("/",
            {
                direction: direction
            },)
            alert(direction);
        });
        });
        </script>
        <script>
        $(document).ready(function(){
            $("#showin").click(function(){
                $("#mySEC").show();
                $("#direction").hide();
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
                padding: 10px 24px; /* Some padding */
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
            .btn-group-user button {
                background-color: #007830; /* Green background */
                border: 1px #007830; /* Green border */
                color: white; /* White text */
                padding: 10px 24px; /* Some padding */
                cursor: pointer; /* Pointer/hand icon */
                width: 100%;
                display: block; /* Make the buttons appear below each other */
            }

        </style>   
    </head>

    <body background="https://www.africastalking.com/img/new/landing-graphic.png">
        <div style= "background-color: #f0f0f0;">
            <div>
                <img src ="https://account.africastalking.com/assets/img/logos/logo-full-color.png" class="center">
            </div>
        </div>
        <div style= "padding:15%;" >
            <section style="margin:0 auto;padding:25px; height: 50%;width: 50%; background-color: #f07830;"id="direction">
                <div>
                    <div>
                    <ul style="list-style-type:none;" id="direction_">
                       <li> <a href="http://127.0.0.1:8000/" id="showin" value="inbound">Inbound</a> </li>
                        <li> <a href="http://127.0.0.1:8000/" id="showout" value="outbound">Outbound</a> </li>
                    </ul>
                    </div>            
                </div>
            </section>
            <section style="background-color: #f07830;"id="mySEC">
            <h1>USERS</h1>
            <h2> <?php echo $date;?></h2>
            <div class="btn-group-user">
                <ul style="list-style-type:none;" id="user_">
                    @foreach(array_keys($users) as $userval)
                        <li ><button id="<?=$userval?>" value="<?=$userval?>">{{ $userval }}</button></li>
                    @endforeach
                </ul>
            </div>
            </section>
        </div>
    </body>
</html>






<?php
//user
function numberType(array $myarray)
{
  if (array_key_exists('TollFree',$myarray)){
    $number_type=$myarray;
  }
  elseif (array_key_exists('Regular',$myarray)) {
    $number_type=$myarray;
  }
  elseif (array_key_exists('SIPPhone',$myarray)) {
    $number_type=$myarray;
  }
  else {
    $number_type=$myarray;
    echo "Unknown number Type<br>";
    print_r ($myarray );
  }
  return $number_type;
}

$number = numberType($jsonDecodedClean);
$numberstats = $jsonDecoded["responses"];

$alldate=$jsonDecoded['responses']['phoneNumberStats'];

// echo "<pre>";
// print_r ($jsonDecoded);
// echo "</pre>";
// echo "<pre>";
// print_r ($number_type);
// echo "</pre>";
$date=array();
foreach ($alldate as $key => $value) {
  array_push($date,$value['date']);
}
  echo "<pre>";
  print_r ($jsonDecoded);
  echo "</pre>";



?>


@section('title')
    users
@endsection

@section('content')
<section class="center" style="margin-left:25%;margin-right:25%;margin-top:5%;">
    <div class="center"style=" background-color: #007848; border-radius: 10px;">
        <form action="/user">
            <input type="hidden" id="startDate" name="startDate" value="<?php echo $start?>">
            <input type="hidden" id="endDate" name="endDate" value="<?php echo $end?>">
            <input type="hidden" id="direction" name="direction" value="<?php echo $direction?>">
            <select name="username" required>
                <option value="">Please select username</option>
                @foreach($users as $userval)
                    <option value="<?php echo $userval?>">{{ $userval }}</option>
                @endforeach
            </select>
            <input type="submit" value="Go"/>
        </form> 
    </div> 
    </section>
@endsection