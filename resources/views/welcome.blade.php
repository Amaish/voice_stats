@extends('layout')

@section('title')
    home
@endsection

@section('content')
        <form action="/users">
            Start Date: <input type="date" name="startDate" required><br>
            End   Date: <input type="date" name="endDate" required><br>
            <b><span style="padding:1%;" >Direction</span></b><br>
            <input type="radio" name="direction" value="inbound" checked> Inbound<br>
            <input type="radio" name="direction" value="outbound" checked> Outbound<br>
            <input type="submit">
        </form>
        </div>
@endsection