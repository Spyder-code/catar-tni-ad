@php
    $fields = [
        'no_animo' => 'No Animo',
        'no_online' => 'No Validasi (No Online)',
        'nama' => 'Nama',
        'nik' => 'NIK',
        'tem_lahir' => 'Tempat Lahir',
        'tgl_lahir' => 'Tanggal Lahir',
        'agama' => 'Agama',
        'suku' => 'Suku',
        'alamat_c' => 'Alamat',
        'tb' => 'Tinggi Badan',
        'bb' => 'Berat Badan',
        'ortu1' => 'Nama Orang Tua',
        'kerja' => 'Pekerjaan Orang Tua',
        'no_hp_ortu' => 'No HP Orang Tua',
        'jenis_sekolah' => 'Pendidikan Terakhir',
        'nama_sekolah' => 'Nama Sekolah',
        'jur' => 'Jurusan',
        'th_lulus' => 'Tahun Lulus',
        'no_telp_wa' => 'No Telp / WA',
        'email' => 'Email',
        'jenis_pendaftaran' => 'Jenis Pendaftaran',
        'jalur_pendaftaran' => 'Jalur Pendaftaran',
        'kdpanda' => 'Panda',
        'kodam' => 'Kodam',
        'kodim' => 'Kodim',
        'koramil' => 'Koramil',
        'babinsa' => 'Babinsa',
        'status' => 'Status',
        'tanggal_validasi' => 'Tanggal Validasi',
    ];
@endphp

@foreach (array_chunk($fields, 2, true) as $pair)
    <div class="form-group row">
        @foreach ($pair as $name => $label)
            <div class="col-md-6 mb-3">
                <label for="{{ $name }}">{{ $label }}</label>
                @if ($name === 'alamat_c')
                    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" rows="2">{{ old($name, $pokok->{$name} ?? '') }}</textarea>
                @else
                    <input type="{{ $name === 'email' ? 'email' : 'text' }}"
                        name="{{ $name }}" id="{{ $name }}"
                        value="{{ old($name, $pokok->{$name} ?? '') }}"
                        class="form-control @error($name) is-invalid @enderror"
                        @if ($name === 'tgl_lahir') placeholder="dd-mm-yyyy" @endif
                        @if (in_array($name, ['no_animo', 'nama', 'tgl_lahir'])) required @endif>
                @endif
                @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        @endforeach
    </div>
@endforeach
