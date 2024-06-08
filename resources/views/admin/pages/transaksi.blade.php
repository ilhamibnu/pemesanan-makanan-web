@extends('admin.layout.main')
@section('title', 'Data Transaksi - ')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Transaksi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Transaksi</li>
                </ol>
            </div>
            <div class="col-lg-6">
                <!-- Bookmark Start-->
                <div class="bookmark">

                </div>
                <!-- Bookmark Ends-->
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-2">



                        <?php

                                $nomer = 1;

                                ?>

                        @foreach ($errors->all() as $error)
                        <li>{{ $nomer++ }}. {{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="display" id="advance-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status Pembayaran</th>
                                    <th>Product</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>
                                        @if ($data->status_pembayaran == 'Belum Pilih Pembayaran')
                                        <span class="badge badge-danger">{{ $data->status_pembayaran }}</span>
                                        @elseif($data->status_pembayaran == 'pending')
                                        <span class="badge badge-warning">{{ $data->status_pembayaran }}</span>

                                        @elseif($data->status_pembayaran == 'expired')
                                        <span class="badge badge-danger">{{ $data->status_pembayaran }}</span>

                                        @elseif($data->status_pembayaran == 'paid')
                                        <span class="badge badge-success">{{ $data->status_pembayaran }}</span>

                                        @endif
                                    </td>

                                    <td>
                                        @foreach ($data->detailTransaksi as $item)
                                        <span>{{ $item->product->nama }} x {{ $item->jumlah }}</span><br>
                                        <span>Rp. {{ number_format($item->total_harga) }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span>Rp. {{ number_format($data->total_harga) }}</span>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#detailbayar{{ $data->id }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>

                                </tr>

                                {{-- Edit Status Modal --}}
                                <div class="modal fade" id="detailbayar{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Pembayaran</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <ul>
                                                        <li>Bank : {{ $data->bank }} </li>
                                                        <li>No Virtual : {{ $data->no_va }} </li>
                                                        <li>Expired : {{ $data->expired_at }}
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal --}}

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
