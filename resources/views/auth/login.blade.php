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

