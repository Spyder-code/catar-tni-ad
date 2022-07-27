@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>SELAMAT DATANG DI PENDAFTARAN TNI AD TAHUN {{ date('Y') }}</h1>
            <hr>
            <h3>Pilih pilihan pendaftaran:</h3>
            <ul class="list-group">
                <a href="https://ajenrem082.spydercode.my.id/home" class="list-group-item">
                    <h5>CABA REGULER PRIA</h5>
                </a>
                <a href="https://ajenrem082agama.spydercode.my.id/home" class="list-group-item">
                    <h5>CABA SUMBER SANTRI DAN LINTAS AGAMA</h5>
                </a>
            </ul>
        </div>
    </div>
</div>
@endsection
