
@extends('fontend.layout.master')
@section('title','Login')
@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Reset Password</h2>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('reset',$user->id) }}" method="post">
                            @csrf

                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="pass" name="new_password" placeholder="New password">

                                @if($errors->has('new_password'))
                                    <div class="alert alert-warning mt-2" role="alert">
                                        {{ $errors->first('new_password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="group-input">
                                <label for="pass">Confirm password *</label>
                                <input type="password" id="pass" name="confirm_password" placeholder="Confirm new password">

                                @if($errors->has('confirm_password'))
                                    <div class="alert alert-warning mt-2" role="alert">
                                        {{ $errors->first('confirm_password') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="site-btn login-btn">Confirm</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{ route('login.show') }}" class="or-login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection
