@extends('layout')
@section('title')
All users
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
                CURLOPT_URL => "http://crunch.voice.at-internal.com/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&username=$User",
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