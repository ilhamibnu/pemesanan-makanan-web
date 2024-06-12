@extends('user.layout.main')
@section('title' , ' - Shop Cart')
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
<section class="gap">
    <div class="container">
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
        <form action="/user/cart/update" method="POST" class="woocommerce-cart-form">
            @csrf
            <div style="overflow-x:auto;overflow-y: hidden;">
                <table class="shop_table table-responsive">
                    <thead>
                        <tr>
                            <th class="product-name">Product</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                        <tr>
                            <td class="product-name">
                                <img alt="img" src="{{ asset('img/product/' . basename($item->product->gambar)) }}" height="100px" class="rounded-circle">
                                <div>
                                    <a href="#">{{ $item->product->nama }}</a>
                                    <span>{{ $item->product->deskripsi }}</span>
                                </div>
                            </td>
                            <td class="product-quantity">
                                <input type="number" name="items[{{ $item->id }}][jumlah]" class="input-text" value="{{ $item->jumlah }}">
                            </td>
                            <td class="product-subtotal">
                                <span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol">Rp.</span> {{ number_format($item->jumlah * $item->product->harga) }}</bdi></span>
                            </td>
                            <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                            <td>
                                <button type="button" class="btn btn-danger delete-button" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="coupon">
                            <td colspan="4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="submit" class="update-cart" value="Update cart" aria-disabled="true">Update Cart</button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row mt-5">
                <div class="col-lg-8">
                    <div class="cart_totals">
                        <h4>Cart Totals</h4>
                        <div class="shop_table-boder">
                            <table class="shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Sub total:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">Rp.</span> {{ number_format($sum_cart) }}
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Shipping:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount amount">
                                                free
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Total:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                                <bdi>
                                                    <span>Rp.</span>{{ number_format($sum_cart) }}
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="wc-proceed-to-checkout">
                            {{-- <form action="/user/checkout" method="post"> --}}
                            @csrf
                            <button type="button" id="btn-checkout" class="button">Proceed to Checkout</button>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')

<script>
    document.getElementById('btn-checkout').addEventListener('click', function() {
        var form = document.createElement('form');
        form.action = '/user/checkout';
        form.method = 'POST';

        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        document.body.appendChild(form);
        form.submit();
    });

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-id');
                var form = document.createElement('form');
                form.action = '/user/cart/delete/' + itemId;
                form.method = 'POST';

                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            });
        });
    });

</script>
@endsection
