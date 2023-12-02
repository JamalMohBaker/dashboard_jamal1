@extends('layouts.dashboard')
@section('content')
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('links.createLink', $tileId) }}" class="btn btn-info">Add new Account</a>
        @if ($links == '[]')
            <div class="bg-secondary-transparent p-2 mt-2">
                You Don,t have an account in {{ $tilename }} .... <br>
                Create your account now

            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xxl-5 col-xl-12">
            <div class="row">


                @foreach ($links as $link)
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="card custom-card hrm-main-card " style="border-top-color: {{ $link->tile->color }}">
                            <div class="card-body">

                                <div class="d-flex align-items-top">
                                    <div class="me-3">
                                        <span class="avatar avatar-rounded mt-3">
                                            <a href="{{ $link->tile->link }}" target="_blank">
                                                <span class="avatar avatar-xl avatar-rounded">
                                                    @if ($link->tile->logo)
                                                        <img id="profile-img" src="/storage/{{ $link->tile->logo }}">
                                                    @else
                                                        <img id="profile-img"
                                                            src="{{ asset('assets/images/faces/15.jpg') }}">
                                                    @endif
                                                </span>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="flex-fill " style="margin-left: 20px">
                                        <span style="color: {{ $link->color }} !important; "
                                            class="fw-semibold text-muted d-block mb-2" >{{ $link->tile->name }}</span>
                                        <a href="{{ $link->link }}" target="_blanck" class="fs-10">
                                            <span class=" text-muted d-block mb-2">{{ $link->tile->link }}</span>
                                        </a>
                                        <p class="mb-0">
                                            <span class="badge bg-secondary-transparent">****
                                                <i title="copy password" style="cursor: pointer;"
                                                    class="ti ti-files fs-18 mt-2 ms-2 copy-button copy-password"
                                                    data-clipboard-text="{{ $link->password }}"></i>
                                                <span class="copy-pass fs-18 d-none"><i
                                                        class="bi bi-check2-circle"></i></span>
                                                <span class="password d-none" id="password">{{ $link->password }}</span>
                                            </span>
                                            <span class="fw-semibold mb-2 ms-1 badge bg-secondary-transparent"
                                                style="font-weight: bold; max-width: 80px; " title="username">
                                                @if (strlen($link->username) > 4)
                                                    {{ substr($link->username, 0, 4) . '...' }}
                                                @else
                                                    {{ $link->username }}
                                                @endif

                                                <i title="copy username" style="cursor: pointer;"
                                                    class="ti ti-files fs-18 mt-2 ms-2 copy-button copy-username"
                                                    data-clipboard-text="{{ $link->username }}"></i>
                                                <span class="copy-username fs-18 d-none"><i class="bi bi-check2-circle"></i>
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="d-flex flex-column gap-3">
                                        <span class="fs-14 fw-semibold text-success">{{ $userPermissionCounts[$link->id] }}
                                            user</span>
                                        <div class="mt-3">
                                            @if (!$link->deleted_at)
                                                <a href="{{ route('links.edit', $link->id) }}"
                                                    class="btn btn-sm btn-icon btn-info-light rounded-pill"><i
                                                        class="ri-edit-line"></i></a>

                                                <form id="deleteform{{ $link->id }}"
                                                    action="{{ route('links.destroy', $link->id) }}" method="post"
                                                    style="display: none">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i> Delete</button>
                                                </form>
                                                <i class="el el-search"></i>
                                                <a href="{{ route('tiles.destroy', $link->id) }} "
                                                    title="delete {{ $link->name }}"
                                                    onclick="event.preventDefault(); document.getElementById('deleteform{{ $link->id }}').submit();"
                                                    class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1"><i
                                                        class="ri-delete-bin-line"></i>
                                                </a>
                                            @else
                                                <form action="{{ route('links.restore', $link->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button title="Recovery"
                                                        class="btn btn-sm btn-icon btn-danger-light rounded-pill">
                                                        <i class="bi bi-arrow-up-circle-fill"></i>
                                                    </button>

                                                </form>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- <script>
            $(document).ready(function () {
                // Handle click event for the copy username button
                $('#copy_user').click(function () {
                    var $this = $(this);
                    var copyStatus = $this.siblings('.copy-status');
                    var username = $this.attr('data-clipboard-text');

                    // Copy to clipboard
                    var tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(username).select();
                    document.execCommand('copy');
                    tempInput.remove();

                    // Show "Copied!" and hide the copy button for 2 seconds
                    copyStatus.removeClass('d-none');
                    $this.addClass('d-none');
                    setTimeout(function () {
                        copyStatus.addClass('d-none');
                        $this.removeClass('d-none');
                    }, 2000);
                });

                // Handle click event for the copy password button
                $('#copy_pass').click(function () {
                    var $this = $(this);
                    var copyPass = $this.siblings('.copy-pass');
                    var password = $this.attr('data-clipboard-text');

                    // Copy to clipboard
                    var tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(password).select();
                    document.execCommand('copy');
                    tempInput.remove();

                    // Show "Copied!" and hide the copy button for 2 seconds
                    copyPass.removeClass('d-none');
                    $this.addClass('d-none');
                    setTimeout(function () {
                        copyPass.addClass('d-none');
                        $this.removeClass('d-none');
                    }, 2000);
                });
            });
        </script> --}}
    <script>
        $(document).ready(function() {
            // Handle click event for the copy username button
            $('.copy-username').click(function() {
                var $this = $(this);
                var copyStatus = $this.siblings('.copy-username');
                var username = $this.attr('data-clipboard-text');

                // Copy to clipboard
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(username).select();
                document.execCommand('copy');
                tempInput.remove();

                // Show "Copied!" and hide the copy button for 2 seconds
                copyStatus.removeClass('d-none');
                $this.addClass('d-none');
                setTimeout(function() {
                    copyStatus.addClass('d-none');
                    $this.removeClass('d-none');
                }, 2000);
            });

            // Handle click event for the copy password button
            $('.copy-password').click(function() {
                var $this = $(this);
                var copyPass = $this.siblings('.copy-pass');
                var password = $this.attr('data-clipboard-text');

                // Copy to clipboard
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(password).select();
                document.execCommand('copy');
                tempInput.remove();

                // Show "Copied!" and hide the copy button for 2 seconds
                copyPass.removeClass('d-none');
                $this.addClass('d-none');
                setTimeout(function() {
                    copyPass.addClass('d-none');
                    $this.removeClass('d-none');
                }, 2000);
            });
        });
    </script>
@endsection
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Initialize Clipboard.js for both copy buttons
    var copyButtons = document.querySelectorAll('.copy-button');
    copyButtons.forEach(function (button) {
        new ClipboardJS(button);
    });

    // Handle copy success event for both buttons
    copyButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            var copyInput = e.target.getAttribute('data-clipboard-text');
            var tempInput = document.createElement('input');
            tempInput.value = copyInput;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            var copyStatus = e.target.nextElementSibling;
            copyStatus.classList.remove('d-none');
            setTimeout(function () {
                copyStatus.classList.add('d-none');
            }, 2000);
        });
    });
    });

</script> --}}
{{--
    @foreach ($links as $link)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="card custom-card hrm-main-card " style="border-top-color: {{ $link->color }}">
                            <div class="card-body">
                                <div class="d-flex align-items-top">
                                    <div class="me-3">
                                        <span class="avatar avatar-rounded mt-3">
                                            <a href="{{ $link->link }}" target="_blank">
                                                <span class="avatar avatar-xl avatar-rounded">
                                                    @if ($link->logo)
                                                        <img id="profile-img" src="/storage/{{ $link->logo }}">
                                                    @else
                                                        <img id="profile-img"
                                                            src="{{ asset('assets/images/faces/15.jpg') }}">
                                                    @endif
                                                </span>
                                        </span>
                                        </a>
                                        </span>
                                    </div>
                                    <div class="flex-fill ms-1">
                                        <p class="mb-0">
                                            <span
                                                class="fw-semibold badge bg-secondary-transparent mb-2 mt-2">
                                                {{ $link->username }}
                                                <i title="copy username"
                                                    class="ti ti-files fs-18 mt-2 ms-4 copy-button copy-username"
                                                    data-clipboard-text="{{ $link->username }}"
                                                    style="cursor: pointer;"></i>


                                                <span class="copy-status fs-18 d-none"><i
                                                        class="bi bi-check2-circle"></i></span>
                                            </span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="badge bg-secondary-transparent">************ <i
                                                    title="copy password" style="cursor: pointer;"
                                                    class="ti ti-files fs-18 mt-2 ms-2 copy-button copy-password"
                                                    data-clipboard-text="{{ $link->password }}"></i>
                                                <span class="copy-pass fs-18 d-none"><i
                                                        class="bi bi-check2-circle"></i></span>
                                                <span class="password d-none" id="password">{{ $link->password }}</span>
                                            </span>
                                        </p>
                                    </div>

                                    <div class="d-flex flex-column gap-3">
                                        <span
                                            class="fs-14 fw-semibold text-info mt-1 ">{{ $userPermissionCounts[$link->id] }}
                                            acc </span>
                                        <div>
                                            @if (!$link->deleted_at)
                                                <a href="{{ route('links.edit', $link->id) }}"
                                                    class="btn btn-sm btn-icon btn-info-light rounded-pill"><i
                                                        class="ri-edit-line"></i></a>
                                                <a href="{{ route('tiles.destroy', $link->id) }} "
                                                    title="delete {{ $link->name }}"
                                                    onclick="event.preventDefault(); document.getElementById('deleteform{{ $link->id }}').submit();"
                                                    class="btn btn-sm btn-icon btn-danger-light rounded-pill"> <i
                                                        class="ri-delete-bin-line"></i> </a>
                                                <form id="deleteform{{ $link->id }}"
                                                    action="{{ route('links.destroy', $link->id) }}" method="post"
                                                    style="display: none">
                                                    @csrf
                                                    @method('delete')
                                                    {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                                <i class="el el-search"></i>
                                            @else
                                                <form action="{{ route('links.restore', $link->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button title="Recovery"
                                                        class="btn btn-sm btn-icon btn-danger-light rounded-pill">
                                                        <i class="bi bi-arrow-up-circle-fill"></i>
                                                    </button>

                                                </form>
                                            @endif
                                            <a href="{{ route('tiles.destroy', $tile->id) }} "
                                                    title="delete {{ $link->name }}"
                                                    onclick="event.preventDefault(); document.getElementById('deleteform{{ $link->id }}').submit();"
                                                    class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1"><i
                                                        class="ri-delete-bin-line"></i>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

    --}}
