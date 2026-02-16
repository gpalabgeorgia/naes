<?php
    use App\Models\Product;
?>
@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
		<li class="active"><a href="{{ url('/orders') }}">შეკვეთები</a></li>
    </ul>
	<h3># {{ $orderDetails['id'] }} შეკვეთის დეტალები</h3>
	<hr class="soft"/>
    <div class="row">
        <div class="span4">
            <table class="table table-striped table-bordered">
                <tr>
                    <td colspan="2"><strong>შეკვეთის დეტალები</strong></td>
                </tr>
                <tr>
                    <td><strong>შეკვეთის თარიღი</strong></td>
                    <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                </tr>
                <tr>
                    <td><strong>შეკვეთის სტატუსი</strong></td>
                    <td>{{ $orderDetails['order_status'] }}</td>
                </tr>
                @if(!empty($orderDetails['courier_name']))
                <tr>
                    <td><strong>კურიერის სახელი</strong></td>
                    <td>{{ $orderDetails['courier_name'] }}</td>
                </tr>
                @endif
                @if(!empty($orderDetails['tracking_number']))
                <tr>
                    <td><strong>გზავნილის ნომერი</strong></td>
                    <td>{{ $orderDetails['tracking_number'] }}</td>
                </tr>
                @endif
                <tr>
                    <td><strong>შეკვეთის ჯამი</strong></td>
                    <td>{{ $orderDetails['grand_total'] }} ₾.</td>
                </tr>
                <tr>
                    <td><strong>გაგზავნის ფასი</strong></td>
                    <td>{{ $orderDetails['shipping_charges'] }} ₾.</td>
                </tr>
{{--                <tr>--}}
{{--                    <td><strong>კუპონის კოდი</strong></td>--}}
{{--                    <td>{{ $orderDetails['coupon_code'] }}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><strong>კუპონით ფასდაკლება</strong></td>--}}
{{--                    <td>{{ $orderDetails['coupon_amount'] }}</td>--}}
{{--                </tr>--}}
                <tr>
                    <td><strong>გადახდის მეთოდი</strong></td>
                    <td>{{ $orderDetails['payment_method'] }}</td>
                </tr>
            </table>
        </div>
        <div class="span4">
            <table class="table table-striped table-bordered">
                <tr>
                    <td colspan="2"><strong>მიწოდების მისამართი</strong></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>სახელი / გვარი</td>
                    <td>{{ $orderDetails['name'] }}</td>
                </tr>
                <tr>
                    <td>მისამართი</td>
                    <td>{{ $orderDetails['address'] }}</td>
                </tr>
                <tr>
                    <td>ქალაქი</td>
                    <td>{{ $orderDetails['city'] }}</td>
                </tr>
                <tr>
                    <td>რეგიონი</td>
                    <td>{{ $orderDetails['state'] }}</td>
                </tr>
                <tr>
                    <td>ქვეყანა</td>
                    <td>{{ $orderDetails['country'] }}</td>
                </tr>
                <tr>
                    <td>პინკოდი</td>
                    <td>{{ $orderDetails['pincode'] }}</td>
                </tr>
                <tr>
                    <td>ტელეფონი</td>
                    <td>{{ $orderDetails['mobile'] }}</td>
                </tr>
            </table>
        </div>
    </div>
	<div class="row">
		<div class="span8">
            <table class="table table-striped table-bordered">
                <tr>
                    <th style="text-align: center;">პროდუქტის ფოტო</th>
                    <th style="text-align: center;">პროდუქტის კოდი</th>
                    <th style="text-align: center;">პროდუქტის სახელი</th>
                    <th style="text-align: center;">პროდუქტის ზომა</th>
                    <th style="text-align: center;">პროდუქტის ფერი</th>
                    <th style="text-align: center;">რაოდენობა</th>
                </tr>
                @foreach($orderDetails['orders_products'] as $product)
                    <tr>
                        <td style="text-align: center;"><?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                            <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width: 150px;" src="{{ asset('images/product_images/small/'.$getProductImage) }}" alt=""></a>
                        </td>
                        <td style="text-align: center">{{ $product['product_code'] }}</td>
                        <td style="text-align: center">{{ $product['product_name'] }}</td>
                        <td style="text-align: center">{{ $product['product_size'] }}</td>
                        <td style="text-align: center">{{ $product['product_color'] }}</td>
                        <td style="text-align: center">{{ $product['product_qty'] }}</td>
                    </tr>
                @endforeach
            </table>
		</div>
	</div>
</div>
@endsection
