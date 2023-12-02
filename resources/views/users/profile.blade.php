@extends('layouts.dashboard')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            you have some errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-between pb-1">
        <h3 class="text-center mt-3"> My Profile</h3>
        {{-- @if ($user->image)
            <img src="/storage/{{ $user->image }}" width="50" height="50" class="rounded-circle " alt="img">
        @else
            <img src="{{ asset('assets/images/faces/13.jpg') }}" width="50" height="50" class="rounded-circle "
                alt="img">
        @endif --}}
    </div>
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-12">

            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form rounded border bg-blue-transparent p-3">
                    <div class="mb-3 ">
                        <label for="name" class="form-label fs-14 text-dark">Full name </label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-3 ">
                        <label for="email" class="form-label fs-14 text-dark"> Email </label>
                        <input type="email" name="email" class="form-control" id="form-text"
                            value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="mb-3 ">
                        <label for="username" class="form-label fs-14 text-dark"> username </label>
                        <input type="text" name="username" class="form-control" id="username"
                            value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="mb-3 ">
                        <label for="phone" class="form-label fs-14 text-dark"> phone</label>
                        <input type="text" name="phone" class="form-control" id="phone"
                            value="{{ old('phone', $user->phone) }} ">
                    </div>

                    <button class="btn btn-secondary mb-2" type="submit">Update <i class="ri-edit-line"></i> </button>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-12">
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form rounded border bg-blue-transparent p-3 d-flex flex-column align-items-center ">

                    <div class="mb-4 d-sm-flex align-items-center" id="personal-info">
                        <div class="mb-0 me-5 d-flex flex-column gap-1">
                            <span class="avatar avatar-xxl avatar-rounded ms-4">
                                @if ($user->image)
                                    <img id="profile-img" src="/storage/{{ $user->image }}" width="50" height="50" class="rounded-circle" alt="img">
                                @else
                                    <img id="profile-img" src="{{ asset('assets/images/faces/13.jpg') }}" alt="">
                                @endif
                                <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                    <input type="file" name="image" class="position-absolute w-100 h-100 op-0" id="profile-change">
                                    <i class="fe fe-camera"></i>
                                </a>
                            </span>
                            {{-- <div id="image-preview"></div> --}}
                        </div>


                    </div>


                    <button class="btn btn-secondary mb-2" type="submit">Update Image <i class="ri-edit-line"></i>
                    </button>
                </div>
            </form>
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form rounded border bg-blue-transparent p-3 mt-3 ">

                    <div class="mb-3">
                        <label for="password" class="form-label fs-14 text-dark"> Password</label>
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
                        <label for="confirmPassword" class="form-label fs-14 text-dark">Confirm Password </label>
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

                    <button class="btn btn-secondary mb-2" type="submit">Update Password <i class="ri-edit-line"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>


@endsection
