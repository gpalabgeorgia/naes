@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
		<li class="active">მიწოდების მისამართები</li>
    </ul>
	<h3>{{ $title }}</h3>
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
    @if($errors->any())
        <div class="alert alert-danger" style="margin-top: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<div class="row">
		<div class="span4">
			<div class="well">
            შეიყვანეთ მიწოდების მისამართი<br/><br/>
			<form id="deliveryAddressForm" @if(empty($address['id'])) action="{{ url('/add-edit-delivery-address') }}" @else action="{{ url('/add-edit-delivery-address/'.$address['id']) }}" @endif method="post">@csrf
                <div class="control-group">
                    <label class="control-label" for="name">სახელი / გვარი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="name" name="name" placeholder="სახელი / გვარი" @if(isset($address['name'])) value="{{ $address['name'] }}" @else value="{{ old('name') }}" @endif required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="address">მისამართი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="address" name="address" placeholder="მისამართი" @if(isset($address['address'])) value="{{ $address['address'] }}" @else value="{{ old('address') }}" @endif>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="city">ქალაქი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="city" name="city" placeholder="ქალაქი" @if(isset($address['city'])) value="{{ $address['city'] }}" @else value="{{ old('city') }}" @endif>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="state">რეგიონი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="state" name="state" placeholder="რეგიონი" @if(isset($address['state'])) value="{{ $address['state'] }}" @else value="{{ old('state') }}" @endif>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="country">ქვეყანა</label>
                    <div class="controls">
                        <select class="span3" id="country" name="country">
                            <option value="">აირჩიეთ ქვეყანა</option>
                            @foreach($countries as $country)
                                <option value="{{ $country['country_name'] }}" @if($country['country_name']==$address['country']) selected="" @elseif($country['country_name']==old('country')) selected="" @endif>{{ $country['country_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group"><br><br>
                    <label class="control-label" for="pincode">Pin კოდი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="pincode" name="pincode" placeholder="Pin კოდი" @if(isset($address['pincode'])) value="{{ $address['pincode'] }}" @else value="{{ old('pincode') }}" @endif>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="mobile">ტელ. ნომერი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="mobile" name="mobile" placeholder="ტელ. ნომერი" @if(isset($address['mobile'])) value="{{ $address['mobile'] }}" @else value="{{ old('mobile') }}" @endif>
                    </div>
                </div>
                <br><br>
                <br><br>
                <div class="controls">
                    <button type="submit" class="btn block">დადასტურება</button>
                    <a style="float: right;" class="btn block" href="{{ url('checkout') }}">უკან</a>
                </div>
			</form>
		</div>
		</div>
	</div>
</div>
@endsection
