@extends('layout')

@section('title')
    home
@endsection

@section('content')
<section style="margin-left:20%;margin-right:20%;margin-top:10%;color: white;">
    <div class="center"style=" background-color: #007848; border-radius: 10px;">
        <form action="/users" style="padding-left:3%;">
            <input type="date" name="startDate" min="2012-01-01" required>  Start Date<br>
            <br><input type="date" name="endDate" required> End Date<br>
            <br><b><span >Direction</span></b><br>
            <input type="radio" name="direction" value="inbound" checked> Inbound<br>
            <input type="radio" name="direction" value="outbound" checked> Outbound<br>
            <br><input type="submit" id="done">
        </form>
    </div>
</section>
@endsection