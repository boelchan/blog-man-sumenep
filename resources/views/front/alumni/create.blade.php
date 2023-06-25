@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="col-md-12 mb-30">
                        <h3 class="fw-normal">Formulir Data Alumni</h3>
                        <div class="blog-post blog-classic blog-horizontal p-4">
                            <x-form :action="route('front.alumni.store')" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Foto *</label>
                                            <img id="output" src="{{ asset('static/sampel.jpg') }}" class="img-fluid rounded">
                                            <x-form-input name="foto" id="foto" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-select name="tahun_lulus" label="Tahun Lulus *" :options="tahunOption()" required class="mb-2 h-auto"/>
                                        <x-form-select name="jurusan" label="Jurusan *" :options="['ipa' => 'IPA', 'ips' => 'IPS', 'bahasa' => 'Bahasa']" required class="mb-2 h-auto"/>
                                        <x-form-input name="nama" label="Nama lengkap *" class="mb-2 h-auto" />
                                        <x-form-textarea name="domisili" label="Alamat Domisili *" class="mb-2 h-auto" />
                                        <x-form-input name="pekerjaan" label="Pekerjaan" class="mb-2 h-auto" />
                                        <x-form-input name="no_hp" label="No HP/WA" class="mb-2 h-auto" />
                                        <x-form-input type="email" name="email" label="Email" class="mb-2 h-auto" />
                                        @form_hidden('approved', 'yes')
                                    </div>
                                    <x-form-submit class="mt-3">Simpan</x-form-submit>
                                </div>
                            </x-form>

                        </div>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
