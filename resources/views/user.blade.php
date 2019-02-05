@extends('layout')

@section('title')
    <?php echo $username ?>
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
        $total = array();
        foreach ($elements as $key2 => $value2) {
            $number = $key2;
            $duration = $value2;
            $minutes = $duration/60;
            array_push($total, $minutes);
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
        $totalMinutes = array_sum($total);
        echo "<tr><td><b>Total</b><td></td><td></td><td></td><td><b>$totalMinutes</b></td></tr>";
        ?>
        @endforeach
        </table>
    </div>
</section>
@endsection