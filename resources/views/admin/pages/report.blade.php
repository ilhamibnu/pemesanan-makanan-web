@extends('admin.layout.main')
@section('title', 'Data Report - ')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Report</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Report</li>
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
                    {{-- // filter date and status --}}
                    <form action="/admin/report/filter" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date1" class="form-control" id="date">
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date2" class="form-control" id="date">
                        </div>


                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Pilih Status</option>
                                <option value="Belum Pilih Pembayaran">Belum Pilih Pembayaran</option>
                                <option value="pending">Pending</option>
                                <option value="expire">Expire</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-4">Filter</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- // end filter date and status --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Report</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Report</li>
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
                        <table class="display" id="test">
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

                                        @elseif($data->status_pembayaran == 'expire')
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
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Rekap Pendapatan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Report</li>
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
                        <table class="display" id="test2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($total as $index => $data2)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($data2->date)) }}</td>
                                    <td>
                                        <span>Rp. {{ number_format($data2->total_revenue) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Rekap Transaksi Per Menu / Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Report</li>
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
                        <table class="display" id="test3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['total_sold'] }}</td>
                                    <td>
                                        <span>Rp. {{ number_format($data['total_revenue']) }}</span>
                                    </td>
                                </tr>
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

@section('script')
<script>
    $('#test').DataTable({
        autoWidth: true,
        // "lengthMenu": [
        //     [16, 32, 64, -1],
        //     [16, 32, 64, "All"]
        // ]
        dom: 'Bfrtip',


        lengthMenu: [
            [10, 25, 50, -1]
            , ['10 rows', '25 rows', '50 rows', 'Show all']
        ],

        buttons: [{
                extend: 'colvis'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Column Visibility',
                // columns: ':gt(0)'


            },

            {

                extend: 'pageLength'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Page Length',
                // columns: ':gt(0)'
            },


            // 'colvis', 'pageLength',

            {
                extend: 'excel'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // {
            //     extend: 'csv',
            //     className: 'btn btn-primary btn-sm',
            //     exportOptions: {
            //         columns: [0, ':visible']
            //     }
            // },
            {
                extend: 'pdf'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            {
                extend: 'print'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // 'pageLength', 'colvis',
            // 'copy', 'csv', 'excel', 'print'

        ]
    , });

</script>
<script>
    $('#test2').DataTable({
        autoWidth: true,
        // "lengthMenu": [
        //     [16, 32, 64, -1],
        //     [16, 32, 64, "All"]
        // ]
        dom: 'Bfrtip',


        lengthMenu: [
            [10, 25, 50, -1]
            , ['10 rows', '25 rows', '50 rows', 'Show all']
        ],

        buttons: [{
                extend: 'colvis'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Column Visibility',
                // columns: ':gt(0)'


            },

            {

                extend: 'pageLength'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Page Length',
                // columns: ':gt(0)'
            },


            // 'colvis', 'pageLength',

            {
                extend: 'excel'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // {
            //     extend: 'csv',
            //     className: 'btn btn-primary btn-sm',
            //     exportOptions: {
            //         columns: [0, ':visible']
            //     }
            // },
            {
                extend: 'pdf'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            {
                extend: 'print'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // 'pageLength', 'colvis',
            // 'copy', 'csv', 'excel', 'print'

        ]
    , });

</script>
<script>
    $('#test3').DataTable({
        autoWidth: true,
        // "lengthMenu": [
        //     [16, 32, 64, -1],
        //     [16, 32, 64, "All"]
        // ]
        dom: 'Bfrtip',


        lengthMenu: [
            [10, 25, 50, -1]
            , ['10 rows', '25 rows', '50 rows', 'Show all']
        ],

        buttons: [{
                extend: 'colvis'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Column Visibility',
                // columns: ':gt(0)'


            },

            {

                extend: 'pageLength'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , text: 'Page Length',
                // columns: ':gt(0)'
            },


            // 'colvis', 'pageLength',

            {
                extend: 'excel'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // {
            //     extend: 'csv',
            //     className: 'btn btn-primary btn-sm',
            //     exportOptions: {
            //         columns: [0, ':visible']
            //     }
            // },
            {
                extend: 'pdf'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            {
                extend: 'print'
                , className: 'btn btn-primary shadow btn-xs sharp mr-1'
                , exportOptions: {
                    columns: [0, ':visible']
                }
            },

            // 'pageLength', 'colvis',
            // 'copy', 'csv', 'excel', 'print'

        ]
    , });

</script>
@endsection
