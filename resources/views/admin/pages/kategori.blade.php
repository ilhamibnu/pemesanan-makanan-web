@extends('admin.layout.main')
@section('title', 'Data Kategori - ')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Kategori</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>

                    <li class="breadcrumb-item active">Kategori</li>
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

                {{-- btn add --}}
                <div class="card-header pb-0">
                    <a href="" data-bs-toggle="modal" data-bs-target="#Add" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="advance-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $data )


                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#Edit{{ $data->id }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#Delete{{ $data->id }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Edit Modal --}}
                                <div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/admin/kategori/update/{{ $data->id }}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Name</label>
                                                        <input class="form-control" name="nama" id="recipient-name" type="text" value="{{ $data->nama }}" />
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-primary" type="submit">
                                                        Ok
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal --}}
                                {{-- Delete Modal --}}
                                <div class="modal fade" id="Delete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda Yakin Akan Menghapus {{ $data->name }} ?</p>

                                            </div>
                                            <div class="modal-footer">
                                                <form action="/admin/kategori/delete/{{ $data->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-primary" type="submit">
                                                        Ok
                                                    </button>
                                                </form>
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
                {{-- Add Modal --}}
                <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/admin/kategori/store" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="col-form-label" for="recipient-name">Name</label>
                                        <input class="form-control" name="nama" id="recipient-name" type="text" value="" />
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        Ok
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Modal --}}
            </div>
        </div>
        <!-- DOM / jQuery  Ends-->
    </div>
</div>
@endsection
