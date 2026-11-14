@extends('layouts.admin')
@section('page', 'Data Pokok')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard</a></li>
    <li><a href="{{ route('pokok') }}" class="breadcrumb-item nav-link">/ Data Pokok</a></li>
    <li class="breadcrumb-item active">/ Edit</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title mb-3">Edit Data Pokok #{{ $pokok->id }}</h3>
                    <form action="{{ route('pokok.update', $pokok) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('admin.partials.pokokFields')
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
