@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
		<li class="active">შესვლა / რეგისტრაცია</li>
    </ul>
	<h3>ჩემი აქაუნთი</h3>	
	<hr class="soft"/>
    @if(Session::has('success_message'))
        <div class="alert alert-success" role="alert" style="margin-top: 10px;">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('error_message')) 
      <div class="alert alert-danger" role="alert">
          {{ Session::get('error_message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
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
			<h5>საკონტაქტო ინფორმაცია</h5><br/>
            შეიყვანეთ საკონტაქტო ინფორმაცია<br/><br/>
			<form id="accountForm" action="{{ url('/account') }}" method="post">@csrf
                <div class="control-group">
                    <label class="control-label" for="name">სახელი / გვარი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="name" name="name" placeholder="სახელი / გვარი" value="{{ $userDetails['name'] }}" required="" pattern="[A-Za-z]+">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="address">მისამართი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="address" name="address" placeholder="მისამართი" value="{{ $userDetails['address'] }}">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="city">ქალაქი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="city" name="city" placeholder="ქალაქი" value="{{ $userDetails['city'] }}">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="state">რეგიონი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="state" name="state" placeholder="რეგიონი" value="{{ $userDetails['state'] }}">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="country">ქვეყანა</label> 
                    <div class="controls">
                        <select class="span3" id="country" name="country">
                            <option value="">აირჩიეთ ქვეყანა</option>
                            @foreach($countries as $country)
                                <option value="{{ $country['country_name'] }}" @if($country['country_name']==$userDetails['country']) selected="" @endif>{{ $country['country_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="control-group"><br><br>
                    <label class="control-label" for="pincode">Pin კოდი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="pincode" name="pincode" placeholder="Pin კოდი" value="{{ $userDetails['pincode'] }}">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="mobile">ტელ. ნომერი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="mobile" name="mobile" placeholder="ტელ. ნომერი" value="{{ $userDetails['mobile'] }}">
                    </div>
                </div> 
                <br><br>
                <div class="control-group">
                    <label class="control-label" for="email">ელ.ფოსტა</label>
                    <div class="controls">
                        <input class="span3" readonly="" value="{{ $userDetails['email'] }}">
                    </div>
                </div><br><br>
                <div class="controls">
                    <button type="submit" class="btn block">გაახლება</button>
                </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>პაროლის გაახლება</h5>
			<form id="passwordForm" action="{{ url('/update-user-pwd') }}" method="post">@csrf
                <div class="control-group">
                    <label class="control-label" for="current_pwd">მიმდინარე პაროლი</label>
                    <div class="controls">
                        <input class="span3"  type="password" id="current_pwd" name="current_pwd" placeholder="მიმდინარე პაროლი"><br>
                        <span id="chkPwd"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="new_pwd">ახალი პაროლი</label>
                    <div class="controls">
                        <input class="span3"  type="password" id="new_pwd" name="new_pwd" placeholder="ახალი პაროლი">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="confirm_pwd">გაიმეორეთ ახალი პაროლი</label>
                    <div class="controls">
                        <input class="span3"  type="password" id="confirm_pwd" name="confirm_pwd" placeholder="გაიმეორეთ ახალი პაროლი">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                    <button type="submit" class="btn">გაახლება</button> 
                    </div>
                </div>
			</form>
		</div>
		</div>
	</div>	
</div>
@endsection