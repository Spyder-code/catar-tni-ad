@extends('layouts.admin')
@section('page','Blank page')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>
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
                    <form action="{{ route('setting.update') }}" method="post">
                        @method('PUT')
                        @csrf
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <td width="10%">Heading 1 :</td>
                                    <td width="70%"><input type="text" value="{{ $data->heading_1 }}" name="heading_1" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Heading 2 :</td>
                                    <td><input type="text" value="{{ $data->heading_2 }}" name="heading_2" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Content</td>
                                    <td><textarea name="content" id="example">{{ $data->content }}</textarea></td>
                                </tr>
                                <tr>
                                    <td>DIK</td>
                                    <td><input type="date" name="dik" value="{{ $data->dik }}" class="form-control"></td>
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
        var editor = new FroalaEditor('#example',{
            toolbarButtons: {
            'moreText': {
                'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
            },
            'moreParagraph': {
                'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
            },
            'moreRich': {
                'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']
            },
            'moreMisc': {
                'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help']
            }
        },
        toolbarSticky: true,
        tabSpaces: 4
            // // Change buttons for XS screen.
            // toolbarButtonsXS: [['undo', 'redo'], ['bold', 'italic', 'underline']]
        });
    </script>
@endsection
