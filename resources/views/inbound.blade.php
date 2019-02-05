<?php
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-20&endDate=2019-01-22&metric=duration",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd"
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
    $userdata= $jsonDecoded["responses"]["userStats"];
    $numdata= $jsonDecoded["responses"];
    foreach ($userdata as $user) {
        $elements = $user['elements'];
        foreach ($elements as $key2 => $value2) {
            $curl = curl_init();
            curl_setopt_array(
                $curl, array(
                CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-29&endDate=2019-01-29&metric=duration&currencyCode=KES&username=$key2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd"
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
            $numbers = $newjsonDecoded['responses']['phoneNumberStats'];
            foreach ($numbers as $key3 => $value3) {
                $elements2 = $value3['elements'];
                foreach ($elements2 as $key4 => $value4) {
                    $number = $key4;
                    print_r($number);
                }
                
            }            
        }
        
    }
    echo "</pre>";
    ?>