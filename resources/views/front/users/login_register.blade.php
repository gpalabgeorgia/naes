@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">მთავარი</a> <span class="divider">/</span></li>
		<li class="active">შესვლა / რეგისტრაცია</li>
    </ul>
	<h3> შესვლა / რეგისტრაცია</h3>	
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
	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>შექმენით ანგარიში</h5><br/>
            შეიყვანეთ სახელი და ელ.ფოსტა ანგარიშის შესაქმნელად<br/><br/>
			<form id="registerForm" action="{{ url('/register') }}" method="post">@csrf
                <div class="control-group">
                    <label class="control-label" for="name">სახელი / გვარი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="name" name="name" placeholder="სახელი / გვარი">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="mobile">ტელ. ნომერი</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="mobile" name="mobile" placeholder="ტელ. ნომერი">
                    </div>
                </div> 
                <br><br>
                <div class="control-group">
                    <label class="control-label" for="email">ელ.ფოსტა</label>
                    <div class="controls">
                        <input class="span3"  type="text" id="email" name="email" placeholder="ელ.ფოსტა">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">პაროლი</label>
                    <div class="controls">
                        <input class="span3"  type="password" id="password" name="password" placeholder="პაროლი">
                    </div>
                </div>
                <div class="controls">
                <button type="submit" class="btn block">ანგარიშის შექმნა</button>
                </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ხართ დარეგისტრირებული?</h5>
			<form id="loginForm" action="{{ url('/login') }}" method="post">@csrf
        <div class="control-group">
          <label class="control-label" for="email">ელ.ფოსტა</label>
          <div class="controls">
              <input class="span3"  type="text" id="email" name="email" placeholder="ელ.ფოსტა">
          </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">პაროლი</label>
            <div class="controls">
                <input class="span3"  type="password" id="password" name="password" placeholder="პაროლი">
            </div>
        </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">შესვლა</button> 
                  <a href="{{ url('forgot-password') }}">დაგავიწყდა პაროლი?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
</div>
@endsection