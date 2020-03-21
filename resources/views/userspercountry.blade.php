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
                    if ($Country == 'KE' && $phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            echo '<tr>'; 
                            if (strlen($phoneNumber) < 25) {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $countryval = 'KE';
                                    echo "<td>$Date</td>";
                                    echo "<td>$User</td>"; 
                                    echo "<td>$phoneNumber</td>";
                                    echo "<td>$countryval</td>";
                                    echo "<td>$phoneDurationMinutes</td>";
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $countryval = strtoupper($lowercountry);
                                if($countryval=='KE'){                                    
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>"; 
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$countryval</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                }
                            }                             
                                echo '</tr>';
                        
                    } elseif ($Country == 'NG' && $phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            echo '<tr>'; 
                            if (strlen($phoneNumber) < 25) {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                if (substr($phoneNumber, 0, 4) == +234) {
                                    $countryval = 'NG';
                                    echo "<td>$Date</td>";
                                    echo "<td>$User</td>"; 
                                    echo "<td>$phoneNumber</td>";
                                    echo "<td>$countryval</td>";
                                    echo "<td>$phoneDurationMinutes</td>";
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $countryval = strtoupper($lowercountry);
                                if($countryval=='NG'){                                    
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>"; 
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$countryval</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                }
                            }                             
                                echo '</tr>';
                        
                    } elseif ($Country == 'UG' && $phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            echo '<tr>'; 
                            if (strlen($phoneNumber) < 25) {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                if (substr($phoneNumber, 0, 4) == +256) {
                                    $countryval = 'UG';
                                    echo "<td>$Date</td>";
                                    echo "<td>$User</td>"; 
                                    echo "<td>$phoneNumber</td>";
                                    echo "<td>$countryval</td>";
                                    echo "<td>$phoneDurationMinutes</td>";
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $countryval = strtoupper($lowercountry);
                                if($countryval=='UG'){                                    
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>"; 
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$countryval</td>";
                                echo "<td>$phoneDurationMinutes</td>";
                                }
                            }                             
                                echo '</tr>';
                        
                    } elseif ($Country == 'MW' && $phoneDuration > 0) {
                            $phoneDurationMinutes = round($phoneDuration / 60, 2);
                            echo '<tr>';
                            if (strlen($phoneNumber) < 25) {
                                array_push($totalPhoneDuration, $phoneDurationMinutes);
                                if (substr($phoneNumber, 0, 4) == +254) {
                                    $Country = 'KE';
                                } elseif (substr($phoneNumber, 0, 4) == +234) {
                                    $Country = 'NG';
                                } elseif (substr($phoneNumber, 0, 4) == +256) {
                                    $Country = 'UG';
                                } else {
                                    $Country = 'MW';
                                    echo "<td>$Date</td>";
                                    echo "<td>$User</td>";
                                    echo "<td>$phoneNumber</td>";
                                    echo "<td>$Country</td>";
                                    echo "<td>$phoneDurationMinutes</td>";
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $Country = strtoupper($lowercountry);
                            if ($Country == 'MW') {
                                echo "<td>$Date</td>";
                                echo "<td>$User</td>";
                                echo "<td>$phoneNumber</td>";
                                echo "<td>$Country</td>";
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
                                    $Country = 'KE';
                                } elseif (substr($phoneNumber, 0, 4) == +234) {
                                    $Country = 'NG';
                                } elseif (substr($phoneNumber, 0, 4) == +256) {
                                    $Country = 'UG';
                                } else {
                                    $Country = 'MW';
                                }
                            } else {
                                $lowercountry = substr($phoneNumber, -25, 2);
                                $Country = strtoupper($lowercountry);
                            }
                            echo '<tr>';
                            echo "<td>$Date</td>";
                            echo "<td>$User</td>";
                            echo "<td>$phoneNumber</td>";
                            echo "<td>$Country</td>";
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