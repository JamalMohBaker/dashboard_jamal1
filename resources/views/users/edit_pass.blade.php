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
    <h3 class="text-center pb-1">Edit User #{{$user->id}}</h3>

    <form action="{{ route('users.update' , $user->id)  }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="put">

            <div class="mb-3">
                <label for="password" class="form-label fs-14 text-dark">Edit Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="*****">
                    <button id="showPassword" class="btn btn-outline-secondary" type="button">
                        <i class="fe fe-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label fs-14 text-dark">Confirm Password edited</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="*****">
                    <button id="showConfirmPassword" class="btn btn-outline-secondary" type="button">
                        <i class="fe fe-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <button class="btn btn-secondary mb-2" type="submit">Update <i class="ri-edit-line"></i> </button>
        </div>

    </form>
@endsection
