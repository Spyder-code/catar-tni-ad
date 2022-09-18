@extends('layouts.admin')
@section('page','Blank page')
@section('style')
    <script src="https://cdn.tiny.cloud/1/ip0rkeafploig1u7xvh8y8bb0c7qg3gz1kesdzcwab09fnzx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Dashboard </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Setting</a></li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form action="{{ route('landing-page.update', $landingPage) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <td width="10%">Landing Page Heading :</td>
                                    <td width="70%"><input type="text" value="{{ $landingPage->lp_heading }}" name="lp_heading" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Judul Pilihan Santri :</td>
                                    <td width="70%"><input type="text" value="{{ $landingPage->lp_title_santri }}" name="lp_title_santri" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Judul Pilihan Reguler :</td>
                                    <td width="70%"><input type="text" value="{{ $landingPage->lp_title_reguler }}" name="lp_title_reguler" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Pendaftaran :</td>
                                    <td width="70%"><input type="text" value="{{ $landingPage->pendaftaran }}" name="pendaftaran" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Heading 1 :</td>
                                    <td width="70%"><input type="text" value="{{ $landingPage->heading_1 }}" name="heading_1" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Heading 2 :</td>
                                    <td><input type="text" value="{{ $landingPage->heading_2 }}" name="heading_2" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Content</td>
                                    <td><textarea name="content" id="example" rows="20">{{ $landingPage->content }}</textarea></td>
                                </tr>
                                <tr>
                                    <td>TGL TERMUDA</td>
                                    <td><input type="date" name="termuda" value="{{ $landingPage->termuda }}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>TGL TERTUA</td>
                                    <td><input type="date" name="tertua" value="{{ $landingPage->tertua }}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>DIK</td>
                                    <td><input type="date" name="dik" value="{{ $landingPage->dik }}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>KET UMUR</td>
                                    <td>
                                        <label for="perlihatkan">
                                            <input type="radio" class="custom-control-input" name="lihat_umur" value="1" id="perlihatkan" {{ $landingPage->lihat_umur==1?'checked':'' }}/> Perlihatkan
                                        </label>
                                        <label for="sembunyikan">
                                            <input type="radio" class="custom-control-input" name="lihat_umur" value="0" id="sembunyikan" {{ $landingPage->lihat_umur==0?'checked':'' }}/> Sembunyikan
                                        </label>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
    </script>
@endsection
