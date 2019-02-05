@extends('layout')
@section('title')
users
@endsection
@section('content')
<section class="center" style="margin-left:5%;margin-right:5%;margin-top:5%;">
   <div class="center"style=" background-color: #007848; border-radius: 10px;">
      <form action="/user">
         <input type="hidden" id="startDate" name="startDate" value="<?php echo $start?>">
         <input type="hidden" id="endDate" name="endDate" value="<?php echo $end?>">
         <input type="hidden" id="direction" name="direction" value="<?php echo $direction?>">
         <select name="username" required>
            <option value="">Please selest username</option>
            @foreach($users as $userval)
            <option value="<?php echo $userval?>">{{ $userval }}</option>
            @endforeach
         </select>
         <input type="submit" value="Go"/>
      </form>
      <form action="/alluserdata">
         <input type="hidden" id="startDate" name="startDate" value="<?php echo $start?>">
         <input type="hidden" id="endDate" name="endDate" value="<?php echo $end?>">
         <input type="hidden" id="direction" name="direction" value="<?php echo $direction?>">
         <input type="submit" value="All Users"/>
      </form>
   </div>
</section>
@endsection