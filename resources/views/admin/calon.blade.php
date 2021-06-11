@extends('layouts.admin')
@section('page','Data Calon')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Data calon</a></li>
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
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Data calon</h3>
                    </div>
                    <div class="table-responsive">
                        <form action="{{ route('calon.export') }}" method="post">
                            @csrf
                            <table class="table no-wrap" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">No online</th>
                                        <th class="border-top-0">Nama</th>
                                        <th class="border-top-0">Tanggal lahir</th>
                                        <th class="border-top-0">Tempat lahir</th>
                                        <th class="border-top-0">Tanggal daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td><input type="checkbox" name="calon[]" value="{{ $item->id }}" style="height: 20px; width:20px" class="form-check"></td>
                                        <td class="txt-oflo">{{ $item->no_online }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="txt-oflo">{{ date('d F Y', strtotime($item->tgl_lahir)) }}</td>
                                        <td>{{ $item->tem_lahir }}</td>
                                        <td class="txt-oflo">{{ date('d F Y', strtotime($item->updated_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Export select data</button>
                        </form>
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
