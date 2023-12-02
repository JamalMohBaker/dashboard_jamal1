@extends('layouts.dashboard')
@section('content')
    <h3 class="text-center pb-1">Edit Tiltes #{{ $tile->id }}</h3>

    <form action="{{ route('tiles.update', $tile->id)}} " method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="form  border bg-blue-transparent p-3">
            <div class="mb-3 ">
                <label for="form-text" class="form-label fs-14 text-dark">Edit Name Of Tiltes</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="form-text" value="{{$tile->name}}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="form-text" class="form-label fs-14 text-dark">Edit Color Of Tiltes</label>
                <input type="color" class="form-control" id="form-text" name="color" value="{{$tile->color}}">
            </div>
            <div class="mb-3 ">
                <label for="formFile" class="form-label">Change Logo</label>
                <div class="d-flex ">
                    <input class="form-control @error('logo') is-invalid @enderror" type="file" name="logo" id="formFile">
                    @if($tile->logo)
                    <img src="/storage/{{$tile->logo}}" width="50" height="50" class="rounded-circle "
                        alt="img">
                    @else
                    <img src="/storage/uploads/images/images.png" width="50" height="50" class="rounded-circle "
                    alt="img">
                    @endif
                </div>
                @error('logo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-secondary mb-2" type="submit">Update <i class="ri-edit-line"></i> </button>
        </div>

    </form>
@endsection
