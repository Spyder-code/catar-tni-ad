@extends('layouts.app')

@section('content')
<style>

    .tni-logo{
        height: 250px;
        border: none !important;
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
            <div class="col-md-6 col-sm-12 text-center">
                <img src="{{ asset('images/tni-logo.png') }}" class="img-fluid tni-logo">
            </div>
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
                                <form method="POST" action="{{ route('login.takeUser') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="no_animo" class="col-md-4 col-form-label text-md-right">No Animo</label>

                                        <div class="col-md-6">
                                            <input id="no_animo" type="text" class="form-control @error('no_animo') is-invalid @enderror" name="no_animo" value="{{ old('no_animo') }}" required autocomplete="off" autofocus>

                                            @error('no_animo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Masuk') }}
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

