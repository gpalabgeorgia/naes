@extends('layouts.front_layout.front_layout')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
            <li class="active"> მადლობას გიხდით!</li>
        </ul>
        <h3>მადლობას გიხდით ნდობისთვის!</h3>
        <hr class="soft"/>
        <div style="text-align: center">
            <h3>თქვენი შეკვეთა წარმატებით განთავსდა!</h3>
            <p>თქვენი შეკვეთის ნომერია {{ Session::get('order_id') }} და ჯამურად შეადგენს ლარში {{ Session::get('grand_total') }} ₾.-ს</p>
        </div>
    </div>
@endsection
<?php
use Illuminate\Support\Facades\Session;
    Session::forget('grand_total');
    Session::forget('order_id');
?>
