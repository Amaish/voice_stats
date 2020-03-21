<?php
//@extends('layout')
echo "<style> table, th, td {   border: 1px solid black; } </style>";
$curl = curl_init();
curl_setopt_array(
    $curl, array(
    CURLOPT_URL => "http://$domain/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$User",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
    'ApiKey: $key',
    ),
    )
);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
}
$jsonString = $response;
$jsonDecoded = json_decode($jsonString, true);
echo "<pre>";
$users=$jsonDecoded["responses"]["userStats"][0]["elements"];
//print_r($users);
echo "</pre>";
echo"<table>";
echo "<tr><th>Date</th><th>Username</th><th>Phonenumber</th><th>Country</th><th>Duration In Minutes</th></tr>";
foreach(array_keys($users) as $user){
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => "http://$domain/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$User",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
        'ApiKey: $key',
        ),
        )
    );
    $newresponse = curl_exec($curl);
    $newerr = curl_error($curl);
    curl_close($curl);
    if ($newerr) {
        echo "cURL Error #:" . $newerr;
    }
    $newjsonString = $newresponse;
    $newjsonDecoded = json_decode($newjsonString, true);
    //echo "<pre>";
    $date= $newjsonDecoded["responses"]["phoneNumberStats"][0]["date"];
    $numbers= $newjsonDecoded["responses"]["phoneNumberStats"][0]["elements"];
    $numarray=array();
    foreach(array_keys($numbers) as $number){
        $duration= $newjsonDecoded["responses"]["phoneNumberStats"][0]["elements"][$number];
        $minutes = $duration/60;
        if(strlen($number)<25){
            if(substr($number,0,4)==+254){
                $country = "KE";
            }
            elseif (substr($number,0,4)==+234) {
                $country = "NG";
            }
            else{
                $country = "UG";
            }
        }
        else{
            $lowercountry=substr($number,-25,2);
            $country= strtoupper($lowercountry);
        }       
        echo "<tr>";
        echo'<td align = "center">';
        echo $date;
        echo"</td>";
        echo'<td align = "center">';
        echo $user;
        echo"</td>";
        echo'<td align = "center">';
        echo $number;
        echo"</td>";
        echo'<td align = "center">';
        echo $country;
        echo"</td>";
        echo'<td align = "center">';
        echo $minutes;
        echo"</td>";
        echo "</tr>";
    }
    
    //$country = substr(array_keys($numbers), 0, 3);
    // foreach(array_keys($numbers) as $number){
    //     array_push($numarray,$number);
    // }
    //print_r($numbers);
    //echo "</pre>";
    }
echo"</table>";
?>