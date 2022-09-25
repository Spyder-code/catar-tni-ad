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

                                <div class="card p-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">No Online</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->no_online }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}">
                                                            Masuk
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModal-{{ $item->id }}Label" aria-hidden="true">
                                                            <form action="{{ route('login.calon') }}" method="POST" class="modal-dialog">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal-{{ $item->id }}Label">Tanggal Lahir</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-6">
                                                                                <input id="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" min="2000-01-01" max="2005-12-31" required autocomplete="current-tgl_lahir">

                                                                                @error('tgl_lahir')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Masuk</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
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
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#tgl_lahir', {
            maxDate: 'today',
            altFormat: 'd/m/Y',
            altInput: true,
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

