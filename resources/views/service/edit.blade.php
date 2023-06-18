@extends('layouts.app')

@section('title', $title)
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
                        <x-form :action="route('service.update', [$service->id, 'uuid' => $service->uuid])" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($service)
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">icon</label>
                                            <img id="output" src="{{ $service->icon_url }}" class="img-fluid rounded">
                                            <x-form-input name="icon" id="icon" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-textarea name="nama" label="Nama Layanan" class="mb-2 h-auto" rows="3" />

                                        <div class="bg-secondary-lt p-3 mb-2 rounded-2">
                                            <x-form-textarea name="meta_keywords" label="Meta Keyword" class="mb-2 h-auto" rows="3" />
                                            <x-form-textarea name="meta_description" label="Meta Deskripsi" class="mb-2 h-auto" rows="3" />
                                        </div>
                                        
                                        <div class="bg-secondary-lt p-3 mb-2 rounded-2">
                                            <x-form-group name="publish" label="Publish" inline class="mb-2">
                                                <x-form-radio name="publish" value="ya" label="Ya" />
                                                <x-form-radio name="publish" value="tidak" label="Pending" />
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
