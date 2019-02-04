@extends('layout')

@section('title')
    users
@endsection

@section('content')
<section class="center" style="margin-left:25%">
    <form action="/user">
        <input type="hidden" id="startDate" name="startDate" value="<?=$start?>">
        <input type="hidden" id="endDate" name="endDate" value="<?=$end?>">
        <input type="hidden" id="direction" name="direction" value="<?=$direction?>">
        <select name="username" required style="background-color: #007830;color: white;border: 1px #007830;">
            <option value="">Please select username</option>
            @foreach(array_keys($users) as $userval)
                <option value="<?=$userval?>">{{ $userval }}</option>
            @endforeach
        </select>

        <input style= "background-color: #007830;color: white;border: 1px #007830;" type="submit" value="Go"/>

    </form>
    </section>
@endsection