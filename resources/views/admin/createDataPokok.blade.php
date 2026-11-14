@extends('layouts.admin')
@section('page', 'Data Pokok')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard</a></li>
    <li><a href="{{ route('pokok') }}" class="breadcrumb-item nav-link">/ Data Pokok</a></li>
    <li class="breadcrumb-item active">/ Tambah</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title mb-3">Tambah Data Pokok</h3>
                    <form action="{{ route('pokok.store') }}" method="post">
                        @csrf
                        @include('admin.partials.pokokFields')
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
