@extends('layouts.app')

@section('content')
<style>

    .tni-logo{
        height: 250px;
    }
    @media (min-width:769px) {
        main{
            margin-top: 100px;
        }
        .tni-logo{
            height: 500px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.css">

<main>
    <div class="container-fluid">
        <div class="row align-items-center">
            <a href="{{ url('/') }}" class="col-md-6 col-sm-12 text-center">
                <img src="{{ asset('images/tni-logo.png') }}" class="img-fluid tni-logo">
            </a>
            <div class="col-md-6 col-sm-12">
                <div class="row align-items-center">
                    <div class="col text-primary">
                        <div class="cards" id="login-card">
                            <div class="card-body">
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
                                <form method="POST" action="{{ route('login.calon') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="no_online" class="col-md-4 col-form-label text-md-right">No online</label>

                                        <div class="col-md-6">
                                            <input id="no_online" type="text" class="form-control @error('no_online') is-invalid @enderror" name="no_online" value="{{ old('no_online') }}" required autocomplete="no_online" autofocus>

                                            @error('no_online')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tgl_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal lahir') }}</label>

                                        <div class="col-md-6">
                                            <input id="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" min="2000-01-01" max="2005-12-31" required autocomplete="current-tgl_lahir">

                                            @error('tgl_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#tgl_lahir', {
            dateFormat: 'Y-m-d',
            maxDate: 'today',
            altFormat: 'd/m/Y',
            // altInput: true,
            maxDate: '2005-12-30',
            minDate: '1999-01-01',
        });

    $('#no_online').keyup(function (e) {
        var val = $(this).val();
        var len = val.length;
        if(len > 9){
            $(this).val(val.substr(0,9));
        }
    });
</script>
@endsection

