@extends('layout')
@section('title')
test
@endsection
@section('content')
<div class="leftcol">
   <?php
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-01&endDate=2019-01-31&metric=duration&currencyCode=KES",
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
      echo "<pre>";
      echo "<h2>Left Side</h2>";
      echo "<table>";
      echo "<tr><th>Date</th><th>Regular</th><th>Sip Phone</th></tr>";
      foreach ($jsonDecoded as $responses => $value) {
          $numberTypeStats = $value["numberTypeStats"];
          $totalRegular = array();
          $totalSipPhone = array();
          $length = count($numberTypeStats); 
          for ($i=0; $i<$length; $i++) {
              $date=$numberTypeStats[$i]['date'];
              $RegularRaw = $numberTypeStats[$i]['elements']['Regular'];
              $SipPhoneRaw = $numberTypeStats[$i]['elements']['SIPPhone'];
              $Regular = round($RegularRaw/60, 2);
              $SipPhone = round($SipPhoneRaw/60, 2);
              array_push($totalRegular, $Regular);
              array_push($totalSipPhone, $SipPhone);
              echo"<tr>";
              echo "<td>$date</td>";
              echo "<td>$Regular</td>";
              echo "<td>$SipPhone</td>";
              echo"</tr>";
          }
          $regularSum = array_sum($totalRegular);
          $sipPhoneSum = array_sum($totalSipPhone);
          echo "<tr>";
          echo "<td><b>Total</b></td>";
          echo "<td><b>$regularSum</b></td>";
          echo "<td><b>$sipPhoneSum</b></td>";
          echo"</tr>";
      }
      echo "</table>";
      echo "</pre>";
      ?>
      <?php
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-01&endDate=2019-01-31&metric=duration&currencyCode=KES",
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
            $jsonDecodedAllUser = json_decode($jsonString, true);
            echo "<pre>";
            echo "<table>";
            echo "<tr><th>Username</th><th>Date</th><th>Phone Number</th><th>Duration</th></tr>";
            $userData = array();
            foreach ($jsonDecodedAllUser as $responseUser => $valueUser) {
                $AlluserStats = $value["userStats"];
                $lengthAllUser = count($AlluserStats);
                $totalDurationAll = array();
                for ($i=0; $i<$lengthAllUser; $i++) {
                    $date=$AlluserStats[$i]['date'];
                    $Allusers=$AlluserStats[$i]['elements'];
                    foreach ($Allusers as $username => $duration) {
                        if (!in_array($username, $userData)) {
                            array_push($userData, $username);
                        }
                    }
            }
            foreach ($userData as $User) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-01&endDate=2019-01-31&metric=duration&username=$User",
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
                $jsonDecodedAll = json_decode($jsonString, true);
                $phoneNumberStats=$jsonDecodedAll['responses']['phoneNumberStats'];
                $lengthArray = count($phoneNumberStats);
                for ($i=0; $i<$lengthArray; $i++) {
                    $Date = $phoneNumberStats[$i]['date'];
                    $number = $phoneNumberStats[$i]['elements'];
                    foreach ($number as $phoneNumber => $phoneDuration) {
                        if ($phoneDuration>0) {
                            echo "<tr>";
                            echo "<td>$User</td>";
                            echo "<td>$Date</td>";  
                            echo "<td>$phoneNumber</td>";
                            echo "<td>$phoneDuration</td>";
                            echo "</tr>";
                        }
                    }
                }
            }
            echo "</table>";
        }
        echo "</pre>";
      ?>
</div>
<div class="rightcol">
   <?php
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://134.213.238.76:8080/voice/outbound/success?granularity=day&startDate=2019-01-01&endDate=2019-01-02&metric=duration&currencyCode=KES",
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
      $jsonDecodedUser = json_decode($jsonString, true);
      echo "<pre>";
      echo "<h2>Right Side</h2>";
      echo "<table>";
      echo "<tr><th>Date</th><th>Username</th><th>Duration</th></tr>";
      foreach ($jsonDecodedUser as $responseUser => $valueUser) {
          $userStats = $value["userStats"];
          $lengthUser = count($userStats);
          $totalDuration = array();
          for ($i=0; $i<$lengthUser; $i++) {
              $date=$userStats[$i]['date'];
              $users=$userStats[$i]['elements'];
              foreach ($users as $username => $duration) {
                  $durationMinutes = round($duration/60, 2);
                  array_push($totalDuration, $durationMinutes);
                  if ($durationMinutes>0) {
                      echo"<tr>";
                      echo "<td>$date</td>";
                      echo "<td>$username</td>";
                      echo "<td>$durationMinutes</td>";
                      echo"</tr>";
                  }
              }
          }
          $durationSum = array_sum($totalDuration);
          echo "<tr>";
          echo "<td><b>Total</b></td>";
          echo "<td></td>";
          echo "<td><b>$durationSum</b></td>";
          echo"</tr>";
      }
      echo "</pre>";
      ?>
</div>
@endsection