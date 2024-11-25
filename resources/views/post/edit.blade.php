@extends('layouts.app')

@section('title', 'Post')
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('post.update', [$post->id, 'uuid' => $post->uuid])" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($post)
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Gambar</label>
                                            <img id="output" src="{{ $post->gambar_url }}" class="img-fluid rounded">
                                            <x-form-input name="gambar" id="gambar" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-select name="kategori_id" label="Kategori" :options="$kategoriOption" class="mb-2" />
                                        <x-form-textarea name="judul" label="Judul" class="mb-2 h-auto" rows="3" />

                                        <div class=" bg-secondary-lt p-3 mb-2 rounded-2">
                                            <x-form-textarea name="meta_keywords" label="Meta Keyword" class="mb-2 h-auto" rows="3" />
                                            <x-form-textarea name="meta_description" label="Meta Deskripsi" class="mb-2 h-auto" rows="3" />
                                        </div>

                                        <div x-data="{ open: {{ $post->publish == 'ya' ? 'true' : 'false' }} }" class=" bg-secondary-lt p-3 mb-2 rounded-2">
                                            <x-form-group name="publish" label="Publish" inline class="mb-2">
                                                <x-form-radio name="publish" value="ya" label="Ya" checked x-on:click="open = ! open" />
                                                <x-form-radio name="publish" value="pending" label="Pending" x-on:click="open = ! open" />
                                            </x-form-group>
                                            <div x-show="open">
                                                <x-form-input name="publish_at" label="Tanggal Publish" type="datetime-local" class="mb-2" />
                                                <x-form-group name="tampil_banner" label="Tampilkan di Banner" inline>
                                                    <x-form-radio name="tampil_banner" value="ya" label="Ya" checked />
                                                    <x-form-radio name="tampil_banner" value="tidak" label="Tidak" />
                                                </x-form-group>
                                            </div>
                                            <x-form-group name="add_to_submenu" label="Tampilkan di Submenu" inline class="mb-2">
                                                <x-form-radio name="add_to_submenu" value="ya" label="Ya" />
                                                <x-form-radio name="add_to_submenu" value="tidak" label="Tidak"/>
                                            </x-form-group>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="">Konten</label>
                                        <x-form-textarea name="konten" floating class="mb-2 h-auto summernote" />
                                    </div>
                                @endbind
                                <x-form-submit class="mt-3">Simpan</x-form-submit>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
