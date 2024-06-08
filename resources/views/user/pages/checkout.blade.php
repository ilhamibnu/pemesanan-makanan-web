@extends('user.layout.main')

@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Cart Checkout</h2>
                    <p>A magical combination that sent aromas to the taste buds</p>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
                    <li class="breadcrumb-item active" aria-current="page">Cart Checkout</li>
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
        <form class="checkout-meta donate-page">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="pb-3">Billing details</h3>
                    <div class="col-lg-12">
                        <input type="text" class="input-text " value="{{ Auth::user()->name }}" name="billing_name" placeholder="Complete Name">
                        <input type="email" class="input-text " value="{{ Auth::user()->email }}" name="billing_email" placeholder="Email address">

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart_totals-checkout" style="background-image: url({{ asset('user/assets/img/patron.jpg') }})">
                        <div class="cart_totals cart-Total">
                            <h4>Cart Total</h4>
                            <table class="shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($transaksi->total_harga, 0, ',', '.') }}
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
                                    <tr>
                                        <th>Product:</th>
                                        <td>
                                            @foreach ($transaksi->detailTransaksi as $item)
                                            <span>{{ $item->product->nama }} x {{ $item->jumlah }}</span><br>
                                            <span>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</span><br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Total:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                                <bdi>
                                                    <span>Rp. </span>{{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if ($transaksi->status_pembayaran == 'Belum Pilih Pembayaran')
                        <div class="checkout-side">
                            <h3>Payment Method</h3>
                            <ul>
                                <li>
                                    <input type="radio" id="Bank_Payment" name="Bank_Payment" value="Bank_Payment">
                                    <label for="Bank_Payment">
                                        Bank Payment
                                    </label>
                                </li>
                            </ul>
                            <button id="pay-button" class="button"><span>Pay</span></button>
                        </div>
                        @else
                        <div class="checkout-side">
                            <h3>Payment</h3>
                            <ul>
                                <li>
                                    Status Pembayaran : {{ $transaksi->status_pembayaran }} <br>
                                    Bank : {{ $transaksi->bank }} <br>
                                    No Rekening : {{ $transaksi->no_va }} <br>
                                    Expired : {{ $transaksi->expired_at }}
                                </li>
                            </ul>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-T7tGstPTu1xNiEG7"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}');
    };

</script>
