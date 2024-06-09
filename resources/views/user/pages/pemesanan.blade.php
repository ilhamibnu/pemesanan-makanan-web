@extends('user.layout.main')
@section('title' , ' - Pemesanan')
@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Shop Cart</h2>
                    <p>A magical combination that sent aromas to the taste buds</p>
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
<section class="gap">
    <div class="container">
        <form class="woocommerce-cart-form">
            <div style="overflow-x:auto;overflow-y: hidden;">
                <table class="shop_table table-responsive">
                    <thead>
                        <tr>
                            <th class="product-name">Date</th>
                            <th class="product-name">Status Pembayarans</th>
                            <th class="product-quantity">Product</th>
                            <th class="product-subtotal">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item )
                        <tr>
                            <td class="product-name">
                                <img alt="img" src="{{ asset('user/assets/img/product-1.png') }}">
                                <div>
                                    <a href="#">{{ $item->created_at }}</a>
                                </div>
                            </td>
                            <td>
                                {{-- <span>{{ $item->status_pembayaran }}</span> --}}
                                @if($item->status_pembayaran == 'Belum Pilih Pembayaran')
                                <span>Belum Pilh Pembayaran</span>
                                @elseif($item->status_pembayaran == 'pending')
                                <span>Menunggu Pembayaran</span>
                                @elseif($item->status_pembayaran == 'expire')
                                <span>Pembayaran Kadaluarsa</span>
                                @else
                                <span>Pembayaran Berhasil</span>
                                @endif
                            </td>
                            <td class="product-quantity">
                                @foreach ($item->detailTransaksi as $detail)
                                <span>{{ $detail->product->nama }} x {{ $detail->jumlah }}</span><br>
                                <span>Rp. {{ number_format($detail->total_harga) }}</span><br>
                                @endforeach
                            </td>
                            <td class="product-subtotal">
                                <a href="/user/checkout/{{ $item->id }}" class="button">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </form>
    </div>
</section>
@endsection
