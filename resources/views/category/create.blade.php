@extends('layouts.app')

@section('title', 'Category')
@section('sub-title', 'Tambah')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('category.store')">
                            <div class="row">
                                <x-form-input name="nama" label="Nama" class="mb-2 h-auto" rows="3" />
                                <x-form-group name="add_to_header_menu" label="Add To Header Menu" inline class="mb-2">
                                    <x-form-radio name="add_to_header_menu" value="ya" label="Ya" />
                                    <x-form-radio name="add_to_header_menu" value="tidak" label="Tidak" checked/>
                                </x-form-group>
                                <x-form-group name="add_to_footer_menu" label="Add To Footer Menu" inline class="mb-2">
                                    <x-form-radio name="add_to_footer_menu" value="ya" label="Ya" />
                                    <x-form-radio name="add_to_footer_menu" value="tidak" label="Tidak" checked/>
                                </x-form-group>
                                <x-form-group name="add_to_sidebar_menu" label="Add To Sidebar Menu" inline class="mb-2">
                                    <x-form-radio name="add_to_sidebar_menu" value="ya" label="Ya" />
                                    <x-form-radio name="add_to_sidebar_menu" value="tidak" label="Tidak" checked/>
                                </x-form-group>
                                <x-form-submit class="mt-3">Simpan</x-form-submit>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
