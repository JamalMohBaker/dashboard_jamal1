@extends('layouts.dashboard')
@section('content')
    <h3 class="text-center pb-1">Add New Of Tiltes</h3>

    <form action="{{ route('tiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form  border bg-blue-transparent p-3">
            <div class="mb-3 ">
                <label for="form-text" class="form-label fs-14 text-dark">Enter Name Of Tiltes</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="form-text"
                    placeholder="Name Of Tiltes">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="form-text" class="form-label fs-14 text-dark">Enter Color Of Tiltes</label>
                <input type="color" class="form-control" name="color" id="form-text">
            </div>
            <div class="mb-3 ">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file"
                    id="formFile">
                @error('logo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-secondary mb-2" type="submit">Add</button>
        </div>

    </form>
@endsection
