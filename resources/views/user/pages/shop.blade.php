@extends('user.layout.main')
@section('title' , ' - Shop')
@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Shop Cart</h2>
                  
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
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
{{-- <section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="featured-dishes">
                    <div class="featured-dishes-img">
                        <img alt="featured-dishes" src="{{ asset('user/assets/img/featured-dishes-1.png') }}">
</div>
<ul class="star">
    <li><i class="fa-solid fa-star"></i></li>
    <li><i class="fa-solid fa-star"></i></li>
    <li><i class="fa-solid fa-star"></i></li>
    <li><i class="fa-solid fa-star"></i></li>
    <li><i class="fa-solid fa-star"></i></li>
</ul>
<a href="product-details.html">
    <h5>Brown Sandwich</h5>
</a>
<p><span>$</span>10.85</p>
<a href="#">
    <i><svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"></path>
            </g>
        </svg></i></a>
</div>
</div>
</div>
</div>
</section> --}}
<section class="gap section-discover-menu">
    <div class="container">
        <div class="heading-two">
            <h2>Discover Menu</h2>
            <div class="line"></div>
        </div>
        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @foreach ($kategori as $item)
            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="v-pills-{{ $item->nama }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $item->nama }}" type="button" role="tab" aria-controls="v-pills-{{ $item->nama }}" aria-selected="true">
                {{ $item->nama }}</button>
            @endforeach
        </div>
        <div class="tab-content" id="v-pills-tabContent">
            @foreach ($kategori as $item)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="v-pills-{{ $item->nama }}" role="tabpanel" aria-labelledby="v-pills-{{ $item->nama }}-tab">
                <div class="row align-items-center discover-menu">
                    @foreach ($item->product as $data)
                    <div class="col-xl-4 col-md-6">
                        <div class="featured-dishes">
                            <div class="featured-dishes-img">
                                <img alt="featured-dishes" src="{{ asset('user/assets/img/featured-dishes-1.png') }}">
                            </div>
                            <ul class="star">
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <a href="/user/product/{{ $data->id }}">
                                <h5>{{ $data->nama }}</h5>
                            </a>
                            <p><span>Rp. </span>{{ number_format($data->harga, 0, ',', '.') }}</p>
                            <a href="/user/product/{{ $data->id }}">
                                <i><svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"></path>
                                        </g>
                                    </svg></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
