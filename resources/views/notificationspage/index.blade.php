@extends('layouts.dashboard')
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Notifications</h1>
    <span class="badge bg-secondary-transparent" id="notifiation-data">{{ $unread }} Unread</span>
</div>
<!-- Page Header Close -->

<div class="container-lg">
    <!-- Start::row-1 -->
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <ul class="list-unstyled mb-0 notification-container">
                @foreach ($notifications as $notification)
                    <li>
                        <div class="card custom-card un-read0" style="border-inline-start: 0.25rem solid rgb(73, 182, 245)">
                            <div class="card-body p-3">
                                <a href="{{ $notification->data['ink'] }}?nid={{ $notification->id }} ">
                                    <div class="d-flex align-items-top mt-0 flex-wrap">
                                        <div class="pe-2">
                                            <a href="{{ $notification->data['ink'] }}?nid={{ $notification->id }} "
                                                class="avatar avatar-md bg-info-transparent avatar-rounded"><i
                                                    class="{{ $notification->data['icon'] }}"></i></a>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="d-flex align-items-center mt-1">
                                                <div class="mt-sm-0 mt-2">

                                                    <p class="mb-0 ">
                                                        {{$notification->data['body']}}
                                                    </p>
                                                    <span class="mb-0 d-block text-muted fs-12">{{ $notification->created_at->diffForHumans(null, true, true) }}
                                                        </span>
                                                </div>
                                                <div class="flex-fill"></div>
                                                <div class="ms-auto">
                                                    <span class="float-end badge bg-light text-muted">
                                                        {{ $notification->created_at->format('d, M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach

                {{ $notifications->links() }}
            </ul>
        </div>
    </div>
    <!--End::row-1 -->
</div>
@endsection
