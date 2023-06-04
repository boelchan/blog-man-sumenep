@extends('layouts.app')

@section('title', 'Category')
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
                        <x-form :action="route('category.update', $category->id)" method="PATCH">
                            <div class="row">
                                @bind($category)
                                    <x-form-input name="nama" label="Nama" class="mb-2 h-auto" rows="3" />
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
