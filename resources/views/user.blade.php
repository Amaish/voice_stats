@extends('layout')

@section('title')
    users
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
            $number = $key2;
            $duration = $value2;
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
            echo "<td>$username</td>";
            echo "<td>$number</td>";
            echo "<td>$country</td>";
            echo "<td>$minutes</td>";
            echo "</tr>";
        }
        ?>
        @endforeach
        </table>
    </div>
</section>
@endsection