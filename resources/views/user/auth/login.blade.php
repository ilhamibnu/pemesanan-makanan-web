@extends('user.layout.main')
@section('title' , ' - Login')
@section('content')
<section class="banner" style="background-image:url(assets/img/background.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Login</h2>
                    <p>A magical combination that sent aromas to the taste buds</p>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">login</li>
                </ol>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-6">
                        <div class="title-area-img">
                            <img alt="title-area-img" src="assets/img/title-area-img-1.jpg">
                            <img alt="pata" class="pata" src="assets/img/pata.png">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="title-area-img two">
                            <img alt="title-area-img" src="assets/img/title-area-img-2.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box login">
                    <h3>Log In Your Account</h3>
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-2">



                        <?php

                            $nomer = 1;

                            ?>

                        @foreach($errors->all() as $error)
                        <li>{{ $nomer++ }}. {{ $error }}</li>
                        @endforeach
                    </div>
                    @endif

                    <form action="/user/login" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Username or email address" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <div class="remember">
                            {{-- <div class="first">
                                <input type="checkbox" name="checkbox" id="checkbox">
                                <label for="checkbox">Remember me</label>
                            </div> --}}
                            <div class="second">
                                <a href="/user/reset-password">Forget a Password?</a>
                            </div>
                        </div>
                        <button type="submit" class="button">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box register">
                    <div class="parallax" style="background-color: #d2691e;"></div>
                    <h3>Log In Your Account</h3>
                    <form action="/user/register" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Complete Name" required>
                        <input type="email" name="email" placeholder="Username or email address" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="repassword" placeholder="Password" required>
                        <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                        <button type="submit" class="button">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
