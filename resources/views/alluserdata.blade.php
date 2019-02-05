@extends('layout')

@section('title')
    All users
@endsection

@section('content')
<section class="center" style="margin-left:25%">
    <div >
    <h1></h1>
        <table >
        <tr><th> Date </th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Country</th>
        <th>Duration In Minutes</th>
        </tr>
        @foreach($dates as $key => $value)
        <tr>
        <?php $date=$value['date'];
        $elements=$value['elements'];
        foreach ($elements as $key2 => $value2) {
            $curl = curl_init();
            curl_setopt_array(
                $curl, array(
                CURLOPT_URL => "http://134.213.238.76:8080/voice/$direction/success?granularity=day&startDate=$start&endDate=$end&metric=duration&currencyCode=KES&username=$key2",
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
                    $duration = $value4;
                    $minutes = $duration/60;
                    if (strlen($number) <25 ) {
                        if (substr($number, 0, 4) == +254) {
                            $country = "KE";
                        } elseif (substr($number, 0, 4)==+234) {
                            $country = "NG";
                        } else {
                            $country = "UG";
                        }
                    } else {
                        $lowercountry=substr($number, -25, 2);
                        $country= strtoupper($lowercountry);
                    }
                    echo "<td>$date</td>";
                    echo "<td>$key2</td>";
                    echo "<td>$number</td>";
                    echo "<td>$country</td>";
                    echo "<td>$duration</td>";
                    echo "</tr>";
                }
                
            }
        }
    
        ?>
        @endforeach
        </table>
    </div>
</section>
@endsection