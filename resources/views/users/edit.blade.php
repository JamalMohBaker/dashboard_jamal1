@extends('layouts.dashboard')
@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        you have some errors:
        <ul>
            @foreach($errors->all() as $error)
            <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h3 class="text-center pb-1">Edit User #{{$user->id}}</h3>

    <form action="{{ route('users.update' , $user->id)  }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="form  border bg-blue-transparent p-3">
            <div class="mb-3 ">
                <label for="email" class="form-label fs-14 text-dark">Edit Email Of User</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="form-text" value="{{ old('email', $user->email) }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            @if(Auth::user()->type == 'admin')
                <div class="mb-3 ">
                    <label for="type" class="form-label fs-14 text-dark">Edit Type Of User</label>
                    <div>
                        <select class="form-select form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option></option>
                            @foreach ($typesOptions as $type)
                            <option @selected($type ==  old('type',$user->type)) value="{{ $type }}">
                                {{ $type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            @endif
                    
            <div class="mb-3">
                <div class="card-header">
                    <div class="card-titlte">
                        Tiles Permissions
                    </div>
                </div>
                <div class="card-body">
                    <select class="js-example-basic-multiple" name="user_tiles[]" multiple="multiple">
                        @foreach ($tiles as $tile)
                            <option value="{{ $tile->id }}" {{ in_array($tile->id, $selectedTiles) ? 'selected' : '' }}>{{ $tile->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <button class="btn btn-secondary mb-2" type="submit">Update <i class="ri-edit-line"></i> </button>
        </div>

    </form>
@endsection
