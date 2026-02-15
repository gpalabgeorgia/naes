<?php

use App\Models\Product;
use Illuminate\Support\Facades\Session;

?>
@extends('layouts.front_layout.front_layout')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
            <li class="active"> გადახდა</li>
        </ul>
        <h3> კალათი [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> პროდუქტი(ები) </small>]<a
                href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> კალათა </a>
        </h3>
        <hr class="soft"/>
        @if(Session::has('success_message'))
            <div class="alert alert-success" role="alert" style="margin-top: 10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php Session::forget('success_message'); ?>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php Session::forget('error_message'); ?>
        @endif
        <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
            <table class="table table-bordered">
                <tr>
                    <th><strong>მისამართი</strong> | <a href="{{ url('add-edit-delivery-address') }}">მისამართის დამატება</a></th>
                </tr>
                @foreach($deliveryAddresses as $address)
                    <tr>
                        <td>
                            <div style="float: left; margin-right: 5px;" class="control-group">
                                <input type="radio" id="address{{ $address['id'] }}" name="address_id"
                                       value="{{ $address['id'] }}">
                            </div>
                            <div class="control-group">
                                <label class="control-label">&nbsp; {{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }}-{{{ $address['pincode'] }}}, {{ $address['city'] }}, {{ $address['country'] }}, (Tel: {{ $address['mobile'] }})</label>
                            </div>
                        </td>
                        <td><a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}">რედაქტირება</a> | <a href="{{ url('/delete-delivery-address/'.$address['id']) }}" class="addressDelete">წაშლა</a></td>
                    </tr>
                @endforeach
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>პროდუქტი</th>
                    <th colspan="2">აღწერა</th>
                    <th>რაოდენობა</th>
                    <th>ფასი ც.</th>
                    <th>კატეგორიის/პროდუქტის <br> ფასდაკლება</th>
                    <th>ფასი</th>
                </tr>
                </thead>
                <tbody>
                <?php $total_price = 0; ?>
                @foreach($userCartItems as $item)
                        <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']); ?>
                    <tr>
                        <td><img width="60" src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}"
                                 alt=""/></td>
                        <td colspan="2">
                            {{ $item['product']['product_name'] }} ({{ $item['product']['product_code'] }})<br/>
                            ფერი: {{ $item['product']['product_color'] }} <br>
                            ზომა: {{ $item['size'] }}
                        </td>
                        <td style="text-align: center;">{{ $item['quantity'] }}</td>
                        <td>{{ $attrPrice['product_price'] }} ₾.</td>
                        <td>{{ $attrPrice['discount'] }} ₾.</td>
                        <td>{{ $attrPrice['final_price'] * $item['quantity'] }} ₾.</td>
                    </tr>
                        <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
                @endforeach
                <tr>
                    <td colspan="6" style="text-align:right">ფასი:</td>
                    <td>{{ $total_price }} ₾.</td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:right"><strong>სულ ({{ $total_price }} ₾. - <strong class="couponAmount">0 ₾.</strong>) =</strong></td>
                    <td class="label label-important" style="display:block">
                        <strong class="grand_total">
                            {{ $grand_total = $total_price }} ₾.
                            <?php Session::put('grand_total', $grand_total); ?>
                        </strong></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>
                        <div class="control-group">
                            <label class="control-label"><strong> გადახდის მეთოდები: </strong> </label>
                            <div class="controls">
                                <span>
                                    <input type="radio" name="payment_gateway" id="COD" value="COD"><strong> COD</strong>&nbsp;&nbsp;
                                    <input type="radio" name="payment_gateway" id="Paypal" value="Paypal"><strong> Paypal</strong>
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
            <!-- <table class="table table-bordered">
             <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
             <tr>
             <td>
                <form class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label" for="inputCountry">Country </label>
                    <div class="controls">
                      <input type="text" id="inputCountry" placeholder="Country">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputPost">Post Code/ Zipcode </label>
                    <div class="controls">
                      <input type="text" id="inputPost" placeholder="Postcode">
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" class="btn">ESTIMATE </button>
                    </div>
                  </div>
                </form>
              </td>
              </tr>
            </table> -->
            <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> კალათა </a>
            <button type="submit" class="btn btn-large pull-right">შეკვეთა <i class="icon-arrow-right"></i></button>
        </form>
    </div>
@endsection
