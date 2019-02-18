@extends('layout')
@section('title')
<?php 
if ($Country == 'KE') {
    echo "Kenya";
} elseif ($Country == 'NG') {
    echo "Nigeria";
} elseif ($Country == 'UG') {
    echo "Uganda";
} elseif ($Country == 'MW') {
    echo "Malawi";
} else {
    echo 'Error title';
}

?>
@endsection
@section('content')
<div >
    <h1></h1>
    <table >
        <tr>
        <th>Date</th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Country</th>
        <th>Duration In Minutes</th>
        </tr>
        @foreach($userData as $User)
        <?php 
            $curl = curl_init();
            curl_setopt_array(
                $curl, array(
                CURLOPT_URL => "http://134.213.238.76:8080/voice/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$User",
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
            $jsonDecodedAll = json_decode($jsonString, true);
            $phoneNumberStats = $jsonDecodedAll['responses']['phoneNumberStats'];
            $lengthArray = count($phoneNumberStats);
            for ($i = 0; $i < $lengthArray; ++$i) {
                $Date = $phoneNumberStats[$i]['date'];
                $number = $phoneNumberStats[$i]['elements'];
                foreach ($number as $phoneNumber => $phoneDuration) {
                    if ($Country == 'KE') {
                        if ($phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            if (strlen($phoneNumber) < 25) {
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $country = 'KE';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $country = strtoupper($lowercountry);
                            }
                            if ($country == 'KE') {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                echo '<tr>';
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>";
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$country</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                echo '</tr>';
                            }
                        }
                    } elseif ($Country == 'NG') {
                        if ($phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            if (strlen($phoneNumber) < 25) {
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $country = 'NG';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $country = strtoupper($lowercountry);
                            }
                            if ($country == 'NG') {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                echo '<tr>';
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>";
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$country</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                echo '</tr>';
                            }
                        }
                    } elseif ($Country == 'UG') {
                        if ($phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            if (strlen($phoneNumber) < 25) {
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $country = 'UG';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $country = strtoupper($lowercountry);
                            }
                            if ($country == 'UG') {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                echo '<tr>';
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>";
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$country</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                echo '</tr>';
                            }
                        }
                    } elseif ($Country == 'MW') {
                        if ($phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            if (strlen($phoneNumber) < 25) {
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $country = 'KE';
                                } elseif (substr($phoneNumber, 0, 4) == +234) {
                                    $country = 'NG';
                                } elseif (substr($phoneNumber, 0, 4) == +256) {
                                    $country = 'UG';
                                } else {
                                    $country = 'MW';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $country = strtoupper($lowercountry);
                            }
                            if ($country == 'MW') {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                echo '<tr>';
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>";
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$country</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                echo '</tr>';
                            }
                        }
                    } else {
                        if ($phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            array_push($totalPhoneDuration, $phoneDurationMinutes);
                            if (strlen($phoneNumber) < 25) {
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $country = 'KE';
                                } elseif (substr($phoneNumber, 0, 4) == +234) {
                                    $country = 'NG';
                                } elseif (substr($phoneNumber, 0, 4) == +256) {
                                    $country = 'UG';
                                } else {
                                    $country = 'MW';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $country = strtoupper($lowercountry);
                            }
                            echo '<tr>';
                            echo "<td>$Date</td>";
                            echo "<td>$User</td>";
                            echo "<td>$phoneNumber</td>";
                            echo "<td>$country</td>";
                            echo "<td>$phoneDurationMinutes</td>";
                            echo '</tr>';
                        }
                    }
                }
            }
            ?>
        @endforeach
        <tr>
        <?php 
        $grandTotal = array_sum($totalPhoneDuration);
        echo '<td><b>Grand Total</b></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td></td>';
        echo "<td><b>$grandTotal</b></td>";
        ?>
        </tr>
    </table>
</div>
@endsection