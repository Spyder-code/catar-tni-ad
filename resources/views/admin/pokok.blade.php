@extends('layouts.admin')
@section('page','Data Pokok')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Data pokok</a></li>
@endsection
@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                <div class="my-3 d-flex justify-content-between">
                    <div class="d-flex">
                        <form action="{{ route('pokok.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" onchange="submit()" id="file" hidden>
                            <label for="file">
                                <span class="btn mx-2 btn-primary"><i class="fas fa-upload"></i> Import excel</span>
                            </label>
                        </form>
                        <form action="{{ route('pokok.destroy') }}" method="post">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn mx-2 btn-danger  text-white"><i class="fas fa-trash-alt"></i> Delete all data</button>
                        </form>
                    </div>
                    <a href="{{ route('pokok.create') }}" class="btn btn-success text-white"><i class="fas fa-plus"></i> Tambah Data Pokok</a>
                </div>
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Data pokok</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">No online</th>
                                    <th class="border-top-0">Nama</th>
                                    <th class="border-top-0">Tanggal lahir</th>
                                    <th class="border-top-0">Tempat lahir</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="txt-oflo">{{ $item->no_online }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="txt-oflo">{{ date('d F Y', strtotime($item->tgl_lahir)) }}</td>
                                    <td>{{ $item->tem_lahir }}</td>
                                    <td class="btn-group">
                                        <a href="{{ route('pokok.edit', $item) }}" class="btn text-white btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('pokok.delete', $item) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn text-white btn-sm btn-danger">Delete</button>
                                        </form>
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
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
