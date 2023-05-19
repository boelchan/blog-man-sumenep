@extends('layouts.app')

@section('title', 'pamflet')
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('post.pamflet.update', [$pamflet->id, 'uuid' => $pamflet->uuid])" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($pamflet)
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="">Gambar</label>
                                            <img id="output" src="{{ $pamflet->gambar ? asset('storage/gambar/' . $pamflet->gambar) : '' }}" class="img-fluid rounded">
                                            <x-form-input name="gambar" id="gambar" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-textarea name="meta_keywords" label="Meta Keyword" class="mb-2 h-auto" rows="3" />
                                        <x-form-textarea name="meta_description" label="Meta Deskripsi" class="mb-2 h-auto" rows="3" />
                                        <x-form-textarea name="judul" label="Judul" class="mb-2 h-auto" rows="3" />

                                        <div x-data="{ open: {{ $pamflet->publish == 'ya' ? 'true' : 'false' }} }" class=" bg-secondary-lt p-3 mb-2">
                                            <x-form-group name="publish" label="Terbitkan pamflet" inline class="mb-2">
                                                <x-form-radio name="publish" value="ya" label="Ya" checked x-on:click="open = true" />
                                                <x-form-radio name="publish" value="tidak" label="Pending" x-on:click="open = false" />
                                            </x-form-group>
                                            <div x-show="open">
                                                <x-form-input name="published_at" label="Tanggal Publish" type="date" class="mb-2" />
                                            </div>
                                        </div>
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
