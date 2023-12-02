@extends('layouts.dashboard')
@section('content')
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xxl-5 col-xl-12">
            <div class="row">
                <!-- Statrt Tiltes -->

                    @if(is_null($tiles) || count($tiles) === 0)
                        <p class="bg-outline-danger text-center p-2 fs-18">Sorry, You can’t add now </p>
                    @endif


                @if (Auth::user()->type == 'admin')
                    @foreach ($tiles as $tile)
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card custom-card hrm-main-card " style="border-color: {{ $tile->color }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-top">
                                        <div class="me-3">
                                            <span class="avatar avatar-rounded mt-3">

                                                <a href="{{ route('links.index1', $tile->id) }}">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        @if ($tile->logo)
                                                            <img id="profile-img" src="/storage/{{ $tile->logo }}">
                                                        @else
                                                            <img src="{{ asset('assets/images/web.jpg') }}"
                                                                class="rounded-circle" width="80" height="80"
                                                                alt="">
                                                        @endif
                                                    </span>
                                                </a>

                                            </span>
                                        </div>
                                        <div class="flex-fill mt-2" style="margin-left: 20px">
                                            <span class="fw-semibold text-muted d-block mb-2"> {{ $my_n_acc[$tile->id] }}
                                                acc</span>
                                            <h5 style="color: {{ $tile->color }} !important; " class="fw-semibold mb-2">{{ $tile->name }} </h5>

                                        </div>
                                        <div class="mt-3">
                                            <span class="fs-14 fw-semibold ">
                                                @if (in_array(Auth::user()->type, ['admin', 'user_management']))
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editTiles{{ $tile->id }}"
                                                        title="edit {{ $tile->name }}"
                                                        class="btn btn-sm btn-icon btn-info-light rounded-pill"><i
                                                            class="ri-edit-line"></i>
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Start Modal for edit tiles --}}
                        <div class="modal fade" id="editTiles{{ $tile->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1> --}}
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    {{-- @if (session()->has('success'))
                                    <div id="success-message" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif --}}
                                    <div id="js-success-message" class="alert alert-success d-none">
                                    </div>

                                    <div class="modal-body">
                                        <h3 class="text-center pb-1">Edit Tiles #{{ $tile->id }}
                                        </h3>

                                        <form id="add-tile-form" action="{{ route('tiles.update', $tile->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <div class="form  border bg-blue-transparent p-3">
                                                <div class="mb-3 ">
                                                    <label for="form-text" class="form-label fs-14 text-dark"> Name Of
                                                        Tiles</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" id="form-text" placeholder="Name Of Tiles"
                                                        value="{{ $tile->name }}">
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 ">
                                                    <label for="form-text" class="form-label fs-14 text-dark"> Color Of
                                                        Tiles</label>
                                                    <input type="color" class="form-control" name="color" id="form-text"
                                                        value="{{ $tile->color }}">
                                                </div>
                                                <div class="mb-3 ">
                                                    <label for="link" class="form-label fs-14 text-dark"> Link Of
                                                        Tiles</label>
                                                    <input type="url" class="form-control" name="link" id="link"
                                                        value="{{ $tile->link }}">
                                                </div>

                                                <div class="mb-4 d-sm-flex align-items-center">
                                                    <div class="mb-0 me-5 d-flex flex-column gap-1">
                                                        <span class="avatar avatar-xxl avatar-rounded">
                                                            @if ($tile->logo)
                                                                <img id="profile-img" src="/storage/{{ $tile->logo }}"
                                                                    class="rounded-circle" alt="img">
                                                            @else
                                                                <img id="profile-img"
                                                                    src="{{ asset('assets/images/web.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                            <a href="javascript:void(0);"
                                                                class="badge rounded-pill bg-primary avatar-badge">
                                                                <input type="file" name="logo"
                                                                    class="position-absolute w-100 h-100 op-0"
                                                                    id="logo">
                                                                <i class="fe fe-camera"></i>
                                                            </a>
                                                        </span>
                                                        <div id="image-preview"></div>
                                                    </div>


                                                </div>
                                                <button class="btn btn-secondary mb-2" type="submit"
                                                    id="add-tile-button">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger "
                                            data-bs-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-info">Send message</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Modal for edit tiles --}}
                    @endforeach
                @else
                    @foreach ($tiles as $tile)

                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card custom-card hrm-main-card " style="border-color: {{ $tile->color }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-top">
                                        <div class="me-3">
                                            <span class="avatar avatar-rounded mt-3">

                                                <a href="{{ route('links.index1', $tile->id) }}">
                                                    <span class="avatar avatar-xl avatar-rounded">
                                                        @if ($tile->logo)
                                                            <img id="profile-img" src="/storage/{{ $tile->logo }}">
                                                        @else
                                                            <img src="{{ asset('assets/images/web.jpg') }}"
                                                                class="rounded-circle" width="80" height="80"
                                                                alt="">
                                                        @endif
                                                    </span>
                                                </a>

                                            </span>
                                        </div>
                                        <div class="flex-fill mt-2" style="margin-left: 20px">
                                            <span class="fw-semibold text-muted d-block mb-2">
                                                {{ $my_n_acc[$tile->id] }} acc</span>
                                            <h5 class="fw-semibold mb-2">{{ $tile->name }} </h5>

                                        </div>
                                        <div class="mt-3">
                                            <span class="fs-14 fw-semibold ">
                                                @if (in_array(Auth::user()->type, ['admin', 'user_management']))
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editTiles{{ $tile->tile->id }}"
                                                        title="edit {{ $tile->tile->name }}"
                                                        class="btn btn-sm btn-icon btn-info-light rounded-pill"><i
                                                            class="ri-edit-line"></i>
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Start Modal for edit tiles --}}
                        <div class="modal fade" id="editTiles{{ $tile->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1> --}}
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    {{-- @if (session()->has('success'))
                                    <div id="success-message" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif --}}
                                    <div id="js-success-message" class="alert alert-success d-none">
                                    </div>

                                    <div class="modal-body">
                                        <h3 class="text-center pb-1">Edit Tiles #{{ $tile->id }}
                                        </h3>

                                        <form id="add-tile-form" action="{{ route('tiles.update', $tile->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <div class="form  border bg-blue-transparent p-3">
                                                <div class="mb-3 ">
                                                    <label for="form-text" class="form-label fs-14 text-dark"> Name Of
                                                        Tiles</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" id="form-text" placeholder="Name Of Tiles"
                                                        value="{{ $tile->name }}">
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 ">
                                                    <label for="form-text" class="form-label fs-14 text-dark"> Color Of
                                                        Tiles</label>
                                                    <input type="color" class="form-control" name="color"
                                                        id="form-text" value="{{ $tile->color }}">
                                                </div>

                                                <div class="mb-4 d-sm-flex align-items-center">
                                                    <div class="mb-0 me-5 d-flex flex-column gap-1">
                                                        <span class="avatar avatar-xxl avatar-rounded">
                                                            @if ($tile->logo)
                                                                <img id="profile-img"
                                                                    src="/storage/{{ $tile->logo }}"
                                                                    class="rounded-circle" alt="img">
                                                            @else
                                                                <img id="profile-img"
                                                                    src="{{ asset('assets/images/web.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                            <a href="javascript:void(0);"
                                                                class="badge rounded-pill bg-primary avatar-badge">
                                                                <input type="file" name="logo"
                                                                    class="position-absolute w-100 h-100 op-0"
                                                                    id="logo">
                                                                <i class="fe fe-camera"></i>
                                                            </a>
                                                        </span>
                                                        <div id="image-preview"></div>
                                                    </div>


                                                </div>
                                                <button class="btn btn-secondary mb-2" type="submit"
                                                    id="add-tile-button">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger "
                                            data-bs-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-info">Send message</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Modal for edit tiles --}}
                    @endforeach
                @endif
            </div> <!-- End Tiltes -->
        </div>

    </div>

    {{ $tiles->links() }}




@endsection
