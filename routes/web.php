<?php

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| PHP version 7.2.11-4+ubuntu18.04.1+deb.sury.org+1 (cli)
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::any(
    '/', function () {
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2018-08-01&endDate=2018-08-31&metric=duration&currencyCode=KES",
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
        $users=$jsonDecoded["responses"]["userStats"][0]["elements"];
        $date=$jsonDecoded["responses"]["userStats"][0]["date"];
        return view(
            'welcome', [
            'users' => $users,
            'date' => $date
            ]
        );
    }
);

Route::any(
    '/user', function () {
        // $userdata = array( 
        //     'username'      => $_REQUEST['username'], 
        //     'start'         => $_REQUEST['startDate'], 
        //     'end'           => $_REQUEST['endDate'],
        //     'direction'     => $_REQUEST['direction']
        // );
        $direction=$_REQUEST['direction'];
        $start=$_REQUEST['startDate'];
        $end=$_REQUEST['endDate'];
        $username=$_REQUEST["username"];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://134.213.238.76:8080/voice/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$username",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "ApiKey:5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd"
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
        $dates= $jsonDecoded["responses"]["phoneNumberStats"];
        $numbers= $jsonDecoded["responses"]["phoneNumberStats"][0]["elements"];
        return view(
            'user', [
            'dates' => $dates,
            'jsonDecoded' => $jsonDecoded,
            'numbers' => $numbers,
            'username' => $username
            ]
        );
    }
);

Route::any(
    '/inbound', function () {
        return view(
            'inbound'
        );
    }
);

Route::any(
    '/users', function () {
        $start     =$_GET['startDate'];
        $end     =$_GET['endDate'];
        $direction     =$_GET['direction'];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://134.213.238.76:8080/voice/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration",
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
        $users=$jsonDecoded["responses"]["userStats"][0]["elements"];
        return view(
            'users',  [
            'users'     => $users,
            'start'     => $start,
            'end'       => $end,
            'direction' => $direction
            ]
        );
    }
);

Route::any(
    '/outbound', function () {
        return view('outbound');
    }
);

Route::any(
    '/layout', function () {
        return view('layout');
    }
);

Route::any(
    '/laratest', function () {
        return view('laratest');
    }
);