<a href="javascript:void(0);" class="header-link dropdown-toggle " data-bs-toggle="dropdown" data-bs-auto-close="outside"
    id="messageDropdown" aria-expanded="false">
    <i class="bx bx-bell header-link-icon"></i>
    <span class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
        id="notification-icon-badge">{{ $unread }}</span>
</a>

<!-- End::header-link|dropdown-toggle -->
<!-- Start::main-header-dropdown -->
<div class="main-header-dropdown dropdown-menu dropdown-menu-end " data-popper-placement="none">
    <div class="p-3">
        <div class="d-flex align-items-center justify-content-between">
            <p class="mb-0 fs-17 fw-semibold">Notifications</p>
            <span class="badge bg-secondary-transparent" id="notifiation-data">{{ $unread }} Unread</span>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <ul class="list-unstyled mb-0 " id="header-notification-scroll">
        @foreach ($notifications as $notification)
            <li class="dropdown-item">
                <div class="d-flex align-items-start">
                    <div class="pe-2">
                        <a href="{{ $notification->data['ink'] }}?nid={{ $notification->id }} " class="avatar avatar-md bg-info-transparent avatar-rounded" ><i
                                class="{{ $notification->data['icon'] }}"></i></a>
                    </div>
                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mt-2 fw-semibold"><a href="{{ $notification->data['ink'] }}?nid={{ $notification->id }} ">
                            <span style="white-space: normal;word-wrap: break-word;" class="text-muted fw-semibold header-notification-text">{{$notification->data['body']}} </span>
                            </a></p>

                        </div>
                        <span class="float-right text-muted text-sm mt-0 mb-0"> {{ $notification->created_at->diffForHumans(null, true, true) }}</span>
                        {{-- <div>
                            <a href="{{ $notification->data['link'] }}"
                                class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                    class="ti ti-x fs-16"></i></a>
                        </div> --}}
                    </div>
                </div>
            </li>
        @endforeach


    </ul>
    <div class="p-3 empty-header-item1 border-top">
        <div class="d-grid">
            <a href="{{route('notifications')}}" class="btn btn-info">View All</a>
        </div>
    </div>
    <div class="p-5 empty-item1 d-none">
        <div class="text-center">
            <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                <i class="ri-notification-off-line fs-2"></i>
            </span>
            <h6 class="fw-semibold mt-3">No New Notifications</h6>
        </div>
    </div>
</div>
