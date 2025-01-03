@extends('layouts.admin')
@section('page','Data Administrasi')
@section('breadcrumb')
    <li><a href="#" class="breadcrumb-item nav-link">Pendaftaran </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Formulir</a></li>
@endsection
@section('style')
    {{-- cdn flatpickr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.css">
@endsection
@section('content')
<style>
    label{
        margin-top: 5px;
    }
</style>
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
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong>Penting!</strong>
                    <ol>
                        <li>Harap lengkapi semua data</li>
                        <li>Jika data terkait tidak ada maka isi kolom dengan tanda (-)</li>
                        <li>Setelah mengisi kolom, jangan lupa klik tombol simpan data pada bagian bawah form</li>
                        <li>Anda dapat mengubah data berkali-kali dengan klik tombol simpan</li>
                        <li>Harap simpan pdf setelah mengisi formulir</li>
                    </ol>
                </div>
                <div class="white-box">
                    @if ($status==1)
                        <div class="alert alert-success" role="alert">
                            Terakhir di edit {{ date('d/m/Y H:i', strtotime($calon->updated_at)) }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <strong class="text-danger">Silahkan cek data kembali, pastikan data sesuai !</strong>
                        </div>
                    @endif
                    <form action="{{ route('calon.form.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="pokok_id" value="{{ Auth::guard('calon')->user()->id }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="calon_id" value="{{ $calon!=null?$calon->id:0 }}">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Data diri
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        @include('calon.component.data_diri',['dik'=>$setting->dik,'calon'=>$calon])
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Pendidikan
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        @include('calon.component.pendidikan',['pendidikan'=>$pendidikan,'calon'=>$calon])
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Orang tua / wali
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        @include('calon.component.wali', ['wali'=>$wali,'calon'=>$calon])
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    Lain -lain
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                                    <div class="accordion-body">
                                        @include('calon.component.lain', ['calon'=>$calon])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="mx-2 btn btn-success my-3"><i class="fas fa-save"></i> {{ $status==0?'Simpan':'Update' }} data</button>
                            {{-- @if ($status==1)
                                <a href="{{ route('calon.pdf') }}" class="mx-2 btn btn-info my-3"><i class="fas fa-save"></i> PDF</a>
                            @endif --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($pendidikan==null)
        <script>
            var val = {!! json_encode(old('pendidikan.l_sma')) !!}
            if (val==null) {
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }else{
                val = parseInt(val);
                if (val<=2019) {
                    console.log('sa');
                    $('input[name="nilai2019[ind]"]').prop('required',true);
                    $('#tg-HMKiy').show();
                    $('#2019').show();
                } else if(val>=2020) {
                    $('#2019').hide();
                    $('#tg-HMKiy').show();
                }else{
                    $('#tg-HMKiy').hide();
                    $('#2019').hide();
                }
            }
        </script>
    @else
        <script>
            var val = {!! json_encode($pendidikan->l_sma) !!}
            val = parseInt(val);
            if (val<=2019) {
                $('input[name="nilai2019[ind]"]').prop('required',true);
                $('#tg-HMKiy').show();
                $('#2019').show();
            } else if(val>=2020) {
                $('#2019').hide();
                $('#tg-HMKiy').show();
            }else{
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }
        </script>
    @endif
@endsection

@section('script')
{{-- cdn flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('js/umur1.js') }}"></script>
    <script>
        // flatpickr init
        flatpickr('#lhr', {
            dateFormat: 'Y-m-d',
            defaultDate: '{{ $calon!=null?$calon->tgl_lahir:old("calon.tgl_lahir") }}',
            maxDate: 'today',
            altFormat: 'd/m/Y',
            // altInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                var lhr = selectedDates[0];
                // var tgl_lahir = new Date(tgl);
                // var tgl_sekarang = new Date();
                // var umur = tgl_sekarang.getFullYear() - tgl_lahir.getFullYear();
                // $('#umur').val(umur);
                // var lhr = $(this).val();
                // console.log(dateStr);
                // console.log(lhr);
                var dik = {!! json_encode($setting->dik) !!};
                var result = ageCalculator(lhr,dik);
                $('#umr').val(result[0]);
                var date = result[1];
                var termuda = {!! json_encode($setting->termuda) !!};
                var tertua = {!! json_encode($setting->tertua) !!};
                const now = new Date(dateStr).getTime();
                const min = new Date(tertua).getTime();
                const max = new Date(termuda).getTime();
                // var a = ageValidation(date);
                if(now>=min && now<=max){
                    var a = 'Umur memenuhi persyaratan';
                }else{
                    var a = 'Umur tidak memenuhi persyaratan';
                }
                $('#ket-umr').val(a);
                $('#u_thn').val(date.years);
                $('#u_bln').val(date.months);
                $('#u_hri').val(date.days);
            }
        });

        $('input').focusout(function() {
        // Uppercase-ize contents
            this.value = this.value.toLocaleUpperCase();
        });
        $('#lulus').change(function (e) {
            $('#tg-HMKiy').hide();
            $('#2019').hide();
            var val = $(this).val();
            val = parseInt(val);
            if (val<=2019 && val>0) {
                $('#tg-HMKiy').show();
                $('#2019').show();
                $('input[name="nilai2019[ind]"]').prop('required',true);
                $('input[name="nilai2019[ing]"]').prop('required',true);
                $('input[name="nilai2019[mtk]"]').prop('required',true);
            } else if(val>=2020) {
                $('#2019').hide();
                $('#tg-HMKiy').show();
                $('input[name="nilai2019[ind]"]').prop('required',false);
                $('input[name="nilai2019[ing]"]').prop('required',false);
                $('input[name="nilai2019[mtk]"]').prop('required',false);
            }else{
                console.log('nil');
                $('#tg-HMKiy').hide();
                $('#2019').hide();
            }
        });

        // $('#lhr').change(function (e) {
        //     var lhr = $(this).val();
        //     var dik = $('#dik').val();
        //     var result = ageCalculator(lhr,dik);
        //     $('#umr').val(result[0]);
        //     var date = result[1];
        //     var a = ageValidation(date);
        //     $('#ket-umr').val(a);
        //     console.log(date.years);
        //     $('#u_thn').val(date.years);
        //     $('#u_bln').val(date.months);
        //     $('#u_hri').val(date.days);
        // });

        $('#jab_a').hide();
        $('#jab_i').hide();
        $('#jab_wa').hide();
        $('#jab_wi').hide();

        $('input[name=jab_a]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_a').show();
            }else{
                $('#jab_a').hide();
            }
        });
        $('input[name=jab_wa]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_wa').show();
            }else{
                $('#jab_wa').hide();
            }
        });
        $('input[name=jab_i]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_i').show();
            }else{
                $('#jab_i').hide();
            }
        });
        $('input[name=jab_wi]').change(function () {
            var val = $(this).val();
            if(val=='true'){
                $('#jab_wi').show();
            }else{
                $('#jab_wi').hide();
            }
        });

        // $('#kerja').hide();
        $(".pernah_kerja").change(function (e) {
            let val = $(".pernah_kerja:checked").val();
            if(val.toLowerCase()=='ya'){
                $('#kerja').show();
            }else{
                $('#kerja').hide();
            }
        });

        function kerja(){
            let val = $(".pernah_kerja:checked").val();
            if(val.toLowerCase()=='ya'){
                $('#kerja').show();
            }else{
                $('#kerja').hide();
            }
        }

        kerja();
    </script>

@endsection

