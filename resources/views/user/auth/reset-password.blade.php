@extends('user.layout.main')
@section('title' , ' - Reset Password')
@section('content')
<section class="banner" style="background-image:url(assets/img/background.png)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Reset Password</h2>
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
                    <h3>Reset Password</h3>
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
                    <form action="/user/reset-password" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Username or email address" required>
                        <button type="submit" class="button">Send Reset</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
