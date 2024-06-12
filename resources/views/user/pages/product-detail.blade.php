@extends('user.layout.main')
@section('title' , ' - ' . $product->nama)
@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Product Details</h2>
                  
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-6">
                        <div class="title-area-img">
                            <img alt="title-area-img" src="{{ asset('user/assets/img/title-area-img-1.jpg') }}">
                            <img alt="pata" class="pata" src="{{ asset('user/assets/img/pata.png') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="title-area-img two">
                            <img alt="title-area-img" src="{{ asset('user/assets/img/title-area-img-2.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap featured-dishes-product-detail-img">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="featured-dishes product-detail-img">
                    <div class="sale">
                        <h6>Sale</h6>
                    </div>
                    <div class="featured-dishes-img">
                        <img alt="featured-dishes" class="rounded-circle" src="{{ asset('img/product/' . basename($product->gambar)) }}">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                {{-- <div class="available">
                    <span>
                        <i class="fa-solid fa-check"></i>
                        available
                    </span>
                    <ul class="star">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                    <h6>( 1 Review )</h6>
                </div> --}}
                <div class="product-info ">
                    <h3>
                        {{ $product->nama}}
                    </h3>
                    <div class="variations_form">
                        <div class="deal-week mb-4 d-flex align-items-center">
                            <h2 class="m-0"><span>Rp. </span>{{ number_format($product->harga, 0, ',', '.') }}</h2>
                        </div>
                        {{-- <h5>What’s Included</h5>
                        <p>Sausage, three rashers of streaky bacon, two fried eggs</p> --}}
                        <div class="d-flex align-items-center mt-4">
                            <form action="/user/cart/store" method="post">
                                @csrf
                                <input type="hidden" name="id_product" value="{{ $product->id }}">
                                <input type="number" name="jumlah" class="input-text me-4" value="1" min="1">
                                <button type="submit" class="button">Add to Cart</button>
                            </form>
                        </div>
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
                        <ul class="product_meta">
                            <li><span class="theme-bg-clr">Kategori:</span>
                                <ul class="pd-tag">
                                    <li>
                                        {{ $product->kategori->nama }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <div class="about-chef">
        <div class="container">
            <h2 class="pb-3">Description</h2>
            <p>
                Nisl quam nestibulum ac quam nec odio elementu sceisu aucan ligula. Orci varius natoque pena tibus et magnis dis urient monte ulus mus nellent
                esque habitanum ac quam nec odio rbine. Nisl quam nestibulum ac quam nec odio elementu sceisu aucan ligula. toque pena tibus et magnis dis u
                rient monte nascete ridic ulus mus nellentesque habitanum ac quam nec odio rbine. Nisl quamu quam nec odio elementu sceisu aucan ligula. Orc
                i varius natoque pena tibus et magnis dis urient monte nascete ridic ulus mus a habitanum ac quam nec odio rbine. Nisl quam nestibulum ac qua
                m nec odio elementu sceisu aucan ligula. Orci varius natoque pe magnis dis urient monte nascete ridiculus mus nellentesque habitanum ac quam
                nec odio rbine. Nisl quam nestibulum ac quam ntoque pena tibus et magnis dis urient monte nascete ridic ulus mus nellentesque habitanum ac
                quam nec odio rbine. Nisl quam a quam nec odio elementu sceisu aucan ligula. Orci varius natoque pena tibus et magnis dis urient monte nascet
                e ridic ulus mus n habitanum ac quam nec odio rbine.<br><br>

                Nisl quam nestibulum ac quam nec odio elementu sceisu aucan ligula. Orci varius natoque pena tibus et magnis dis urient monte quam nec odio e
                lementu sceisu aucan ligula. Orci varius natoque pena tibus et magnis dis urient monte nascete ridic.</p>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="product-img">
                        <img alt="product-img" src="{{ asset('user/assets/img/product-2.jpg') }}">
</div>
</div>
<div class="col-lg-4 col-sm-6">
    <div class="product-img">
        <img alt="product-img" src="{{ asset('user/assets/img/product-3.jpg') }}">
    </div>
</div>
<div class="col-lg-4 col-sm-6">
    <div class="product-img">
        <img alt="product-img" src="{{ asset('user/assets/img/product-4.jpg') }}">
    </div>
</div>

</div>
</div>
</div>
<section>
    <div class="container">
        <div class="benefits">
            <div>
                <h2 class="pb-3">Benefits</h2>
                <ul class="quality-foods">
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>Quality foods natural gradient</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>A melting pot of cheese served with our Little Soul</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>Award-winning Restaurant</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>caramelised balsamic onions</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>Healthy Food 100% Organic Food</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>roasted on a skewer, hanging above a spicy chilli seafood</h6>
                    </li>
                    <li><img alt="img" src="{{ asset('user/assets/img/check.png') }}">
                        <h6>individually styled bedrooms</h6>
                    </li>
                </ul>
            </div>
            <div class="benefit-img">
                <img alt="benefit" src="{{ asset('user/assets/img/benefit.png') }}">
            </div>
        </div>
    </div>
</section>
<section class="gap no-top">
    <div class="container">
        <div class="review">
            <h3>Review</h3>
            <div class="single-comment">
                <img alt="img" src="{{ asset('user/assets/img/review.jpg') }}">
                <div class="ps-md-4">
                    <div class="d-flex align-items-center">
                        <h4>Smith Johnson</h4>
                        <span>Jun 07, 2023</span>
                    </div>
                    <p>Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin. Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin.</p>
                </div>
                <ul class="star">
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                </ul>
            </div>
            <div class="single-comment">
                <img alt="img" src="{{ asset('user/assets/img/review.jpg') }}">
                <div class="ps-md-4">
                    <div class="d-flex align-items-center">
                        <h4>Smith Johnson</h4>
                        <span>Jun 07, 2023</span>
                    </div>
                    <p>Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin. Integer sollicitudin ligula non enim sodales non lacinia commodo tempor mod licitudin.</p>
                </div>
                <ul class="star">
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                </ul>
            </div>
            <form class="add-review leave-comment">
                <div class="rating">
                    <h3>Add Review</h3>
                    <div class="d-flex align-items-center">
                        <span>Your Rating</span>
                        <div class="start d-flex align-items-center ps-md-4">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ps-lg-0">
                        <input type="text" name="name" placeholder="Complate Name">
                    </div>
                    <div class="col-lg-6 pe-lg-0">
                        <input type="text" name="Email" placeholder="Email Address">
                    </div>
                    <textarea placeholder="Add Review"></textarea>
                    <button class="button">
                        <span>Post Review</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section> --}}
@endsection
