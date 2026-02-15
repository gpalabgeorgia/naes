@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
		<li class="active">შეკვეთები</li>
    </ul>
	<h3>შეკვეთები</h3>
	<hr class="soft"/>
	<div class="row">
		<div class="span8">
            <table class="table table-striped table-bordered">
                <tr>
                    <th style="text-align: center;">შეკვეთის ID</th>
                    <th style="text-align: center;">შეკვეთილი პროდუქტი</th>
                    <th style="text-align: center;">გადახდის მეთოდი</th>
                    <th style="text-align: center;">ჯამური თანხა</th>
                    <th style="text-align: center;">შექმნის თარიღი</th>
                    <th style="text-align: center;">დეტალურად</th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td style="text-align: center;"><a style="text-decoration: underline;" href="{{ url('orders/'.$order['id']) }}"># </a>{{ $order['id'] }}</td>
                        <td>
                            @foreach($order['orders_products'] as $pro)
                                {{ $pro['product_code'] }}<br>
                            @endforeach
                        </td>
                        <td style="text-align: center;">{{ $order['payment_method'] }}</td>
                        <td style="text-align: center;">{{ $order['grand_total'] }} ₾.</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                        <td><a href="{{ url('orders/'.$order['id']) }}">დეტალურად</a></td>
                    </tr>
                @endforeach
            </table>
		</div>
	</div>
</div>
@endsection
