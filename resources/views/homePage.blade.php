@extends('layouts.dashboard')
@section('content')
@if($links == '[]')
<div class="ms-auto me-3">
    <a href="{{ route('addlinks')}}" class="btn btn-info">
        <strong> + </strong> Add Your Acc</a>
</div>
@endif
{{-- {{ dd($links);}} --}}
    <div class="row">
        <div class="col-xxl-5 col-xl-12">
            <div class="row">

                @foreach ($links as $link)
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="card custom-card hrm-main-card " style="border-top-color: {{ $link->tile?->color }}">
                            <div class="card-body">

                                <div class="d-flex align-items-top">
                                    <div class="me-3">
                                        <span class="avatar avatar-rounded mt-4">
                                            <a href="{{ $link->tile->link }}" target="_blank" class="">
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
                                        <span style="color: {{ $link->tile?->color }} !important; "
                                            class="fw-semibold mt-2 text-muted d-block mb-2">{{ $link->tile->name }}</span>
                                        <a href="{{ $link->link }}" target="_blanck" class="fs-10">
                                            <span class=" text-muted d-block mb-2">{{ $link->tile->link }}</span>
                                        </a>
                                        <p class="mb-0 mt-3">
                                            <span class="badge bg-secondary-transparent ">***
                                                <i title="copy password" style="cursor: pointer;"
                                                    class="ti ti-files fs-18 mt-2 ms-2 copy-button copy-password"
                                                    data-clipboard-text="{{ $link->PasswordHash }}">
                                                </i>

                                                <span class="copy-pass fs-18 d-none"><i class="bi bi-check2-circle"></i>
                                                </span>

                                                <span class="password d-none" id="password">
                                                    {{ $link->password }}
                                                </span>

                                            </span>
                                            <span class="fw-semibold mb-2  ms-2 badge bg-secondary-transparent"
                                                style="font-weight: bold; max-width: 80px; " title="usernaem">
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
                                        <span class="fs-14 fw-semibold text-success">{{ $link->link_permissions_count }}
                                            user</span>

                                        <div class="" style="margin-top: 30px">

                                                <a href="{{ route('links.edit', $link->id) }}" title="change default"
                                                    class="btn btn-sm btn-icon btn-info-light rounded-pill ">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span class="fs-14 fw-semibold text-success">
                                            <div class="card-body">

                                            </div>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


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
