<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home ()
    {
    	return view(
            'welcome'
        );
    }

    public function login ()
    {
    	return view(
            'login'
        );
    }

    public function trial ()
    {
    	return view(
            'trial'
        );
    }

    public function user ()
    {
    	$direction = $_REQUEST['direction'];
        $start = $_REQUEST['startDate'];
        $end = $_REQUEST['endDate'];
        $username = $_REQUEST['username'];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://crunch.voice.at-internal.com/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$username",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'ApiKey:5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd',
            ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo 'cURL Error #:'.$err;
        }
        $jsonString = $response;
        $jsonDecoded = json_decode($jsonString, true);
        $dates = $jsonDecoded['responses']['phoneNumberStats'];
        $numbers = $jsonDecoded['responses']['phoneNumberStats'][0]['elements'];

        return view(
            'user', [
            'dates' => $dates,
            'jsonDecoded' => $jsonDecoded,
            'numbers' => $numbers,
            'username' => $username,
            'direction' => $direction,
            'error' => $err,
            ]
        );
    }

    public function alluserdata ()
    {
        $start = $_REQUEST['startDate'];
        $end = $_REQUEST['endDate'];
        $direction = $_REQUEST['direction'];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://crunch.voice.at-internal.com/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd',
            ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo 'cURL Error #:'.$err;
        }
        $jsonString = $response;
        $jsonDecodedAllUser = json_decode($jsonString, true);
        $userData = array();
        foreach ($jsonDecodedAllUser as $responseUser => $valueUser) {
            $AlluserStats = $valueUser['userStats'];
            $lengthAllUser = count($AlluserStats);
            $totalDurationAll = array();
            for ($i = 0; $i < $lengthAllUser; ++$i) {
                $date = $AlluserStats[$i]['date'];
                $Allusers = $AlluserStats[$i]['elements'];
                foreach ($Allusers as $username => $duration) {
                    if (!in_array($username, $userData)) {
                        array_push($userData, $username);
                    }
                }
            }
        }
        $totalPhoneDuration = array();

        return view(
            'alluserdata', [
                'direction' => $direction,
                'start' => $start,
                'end' => $end,
                'totalPhoneDuration' => $totalPhoneDuration,
                'userData' => $userData,
                'error' => $err,
            ]
        );
    }

    public function userspercountry()
    {
        $start = $_REQUEST['startDate'];
        $end = $_REQUEST['endDate'];
        $direction = $_REQUEST['direction'];
        $Country = $_REQUEST['country'];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://crunch.voice.at-internal.com/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd',
            ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo 'cURL Error #:'.$err;
        }
        $jsonString = $response;
        $jsonDecodedAllUser = json_decode($jsonString, true);
        $userData = array();
        foreach ($jsonDecodedAllUser as $responseUser => $valueUser) {
            $AlluserStats = $valueUser['userStats'];
            $lengthAllUser = count($AlluserStats);
            $totalDurationAll = array();
            for ($i = 0; $i < $lengthAllUser; ++$i) {
                $date = $AlluserStats[$i]['date'];
                $Allusers = $AlluserStats[$i]['elements'];
                foreach ($Allusers as $username => $duration) {
                    if (!in_array($username, $userData)) {
                        array_push($userData, $username);
                    }
                }
            }
        }
        $totalPhoneDuration = array();

        return view(
            'userspercountry', [
                'direction' => $direction,
                'start' => $start,
                'end' => $end,
                'totalPhoneDuration' => $totalPhoneDuration,
                'userData' => $userData,
                'Country' => $Country,
                'error' => $err,
            ]
        );
    }

    public function inbound ()
    {
    	return view(
            'inbound'
        );
    }

    public function users ()
    {
    	$start = $_REQUEST['startDate'];
        $end = $_REQUEST['endDate'];
        $direction = $_REQUEST['direction'];
        $curl = curl_init();
        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => "http://crunch.voice.at-internal.com/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'ApiKey: 5afe31f1daa3de899c690f0172a719cee1f59e0a3251ec432f021c81b4d87ffd',
            ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo 'cURL Error #:'.$err;
        }
        $jsonString = $response;
        $jsonDecoded = json_decode($jsonString, true);
        $userdata = $jsonDecoded['responses']['userStats'];
        $users = array();
        foreach ($userdata as $key => $value) {
            $elements = $value['elements'];
            foreach ($elements as $key2 => $value2) {
                if (in_array($key2, $users)) {
                    $users = $users;
                } else {
                    array_push($users, $key2);
                }
            }
        }

        return view(
            'users', [
            'users' => $users,
            'start' => $start,
            'end' => $end,
            'direction' => $direction,
            'error' => $err,
            ]
        );
    }

    public function outbound ()
    {
    	return view(
    		'outbound'
    	);
    }

        public function layout ()
    {
    	return view( 
    		'layout'
    	);
    }

    public function laratest ()
    {
    	return view( 
    		'laratest'
    	);
    }
}
