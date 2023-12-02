@extends('layouts.dashboard')
@section('content')
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"> --}}
    <div class=" pb-1">
        <!-- <h3 class="text-center mt-3">Edit My Link that belongs to name of tiles</h3> -->
        <h3 class="text-center mt-3"> Link belongs to {{ $link->name }} </h3>
    </div>
    <div class="row">
        <div class="col-lg-8 col-12">
            <form action="{{ route('links.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="tile_id" value="{{ $link->tile_id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <div class="form  border border-info p-3">
                    {{-- <div class="row">
                        <div class="col-lg-12 col-12"> --}}
                    {{-- <div class="mb-3 ">
                        <label for="name" class="form-label fs-14 text-dark"> name of link</label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $link->name }}">
                    </div> --}}
                    <div class="mb-3">
                        <label for="username" class="form-label"> username / email</label>
                        <input class="form-control " type="text" name="username" id="username"
                            value="{{ $link->username }}"">
                    </div>
                    {{-- <div class="mb-3 ">
                        <label for="link" class="form-label fs-14 text-dark"> Link of website</label>
                        <input type="url" name="link" class="form-control" id="link"
                            value="{{ $link->link }}"">
                    </div> --}}

                    <div class="card custom-card mb-3">
                        <div class="card-header">
                            <div class="card-titlte">
                                Users Permissions
                            </div>
                        </div>
                        <div class="card-body">
                            <select class="js-example-basic-multiple" name="user_permissions[]" multiple="multiple">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id, $user_permissions->pluck('user_permissions')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- <div class="d-flex">
                        <div class="mb-3 d-sm-flex align-items-center" id="personal-info">
                            <div class="mb-0 me-5 d-flex flex-column gap-1">
                                <label for="profile-change" class="form-label fs-14 text-dark ms-2"> Logo </label>
                                <span class="avatar avatar-xxl avatar-rounded ms-4">
                                    @if($link->logo)
                                    <img id="profile-img" src="{{ asset('storage/' . $link->logo) }}" class="me-5"
                                        alt="">
                                    @else
                                    <img id="profile-img" src="{{ asset('assets/images/faces/15.jpg') }}" class="me-5"
                                        alt="">
                                    @endif
                                    <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge me-3">
                                        <input type="file" name="logo" class="position-absolute w-100 h-100 op-0"
                                            id="profile-change">
                                        <i class="fe fe-camera"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 w-100 ">
                            <label for="color" class="form-label fs-14 text-dark"> color </label>
                            <input type="color" name="color" class="form-control mt-4" id="color"
                                value="{{ $link->color }}"">
                        </div>
                    </div> --}}

                    {{-- </div>

                    </div> --}}
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mb-2 text-center" type="submit">Update <i
                                class="ms-1 ri-edit-line"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-12 ">
            <form action="{{ route('links.update', $link->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="tile_id" value="{{ $link->tile_id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="form  border border-info p-3">
                    {{-- <div class="mb-3">
                        <label for="key" class="form-label fs-14 text-dark">Key</label>
                        <input type="text" class="form-control" id="key" placeholder="key for increption and decreption">
                    </div> --}}

                    <div class="mb-3">
                        <label for="password" class="form-label fs-14 text-dark"> Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password" placeholder="*****">
                            <button id="showPassword" class="btn btn-outline-secondary" type="button">
                                <i class="fe fe-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label fs-14 text-dark">Confirm Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                                placeholder="*****">
                            <button id="showConfirmPassword" class="btn btn-outline-secondary" type="button">
                                <i class="fe fe-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mb-2 text-center" type="submit">Update Password<i
                                class="ms-1 ri-edit-line"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Select2 Cdn -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}



    <!-- Internal Select-2.js -->
    {{-- <script src="../assets/js/select2.js"></script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script> --}}
@endsection
