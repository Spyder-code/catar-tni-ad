@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>{{ $setting->lp_heading }}</h1>
            <hr>
            <h3>Pilih pilihan pendaftaran:</h3>
            <ul class="list-group">
                <a href="https://ajenrem082.spydercode.my.id/home" class="list-group-item">
                    <h5>{{ $setting->lp_title_reguler }}</h5>
                </a>
                <a href="https://ajenrem082agama.spydercode.my.id/home" class="list-group-item">
                    <h5>{{ $setting->lp_title_santri }}</h5>
                </a>
            </ul>
        </div>
    </div>
</div>
@endsection
