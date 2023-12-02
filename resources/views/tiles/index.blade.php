@extends('layouts.dashboard')
@section('content')
@if (session()->has('success'))
<div id="success-message" class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card ">
                <div class="container d-flex m-2 mt-3">
                    <h3>All Of Tiles</h3>
                    <div class="ms-auto me-3">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addtiles"
                            data-bs-whatever="@mdo"> <strong> + </strong> Add New Of Tiles</button>
                        {{-- <a href="{{ route('tiles.trashed') }}" class="btn btn-danger ">
                            View Trash <i class="ri-delete-bin-5-line"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-basic" class="table table-bordered text-nowrap table-striped mt-2"
                        style="width:100%">
                        <thead class="bg-teal-gradient">
                            <tr>
                                <th scope="col">Tiles </th>
                                <th scope="col">Logo</th>
                                <th scope="col">Color</th>
                                <th scope="col">Status</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tiles != '[]' or $tiles == null)
                                @foreach ($tiles as $tile)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                {{ $tile->name }}
                                            </div>
                                        </th>
                                        <td>
                                            @if ($tile->logo)
                                                <img src="{{ asset('storage/' . $tile->logo) }}" width="50" height="50"
                                                    class="rounded-circle " alt="img">
                                            @else
                                                <img src="/storage/uploads/images/images.png" width="50" height="50"
                                                    class="rounded-circle " alt="img">
                                            @endif
                                        </td>
                                        <td>
                                            <input type="color" value="{{ $tile->color }}" name="color" id="">
                                        </td>
                                        <td>
                                            @if ($tile->deleted_at)
                                                <span class="badge bg-danger text-dark">Inactive</span>
                                            @else
                                                <span class="badge bg-success-transparent">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$tile->deleted_at)
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editTiles{{ $tile->id }}"
                                                    title="edit {{ $tile->name }}"
                                                    class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                        class="ri-edit-line"></i>
                                                </button>
                                                <form id="deleteform{{ $tile->id }}" action="{{ route('tiles.destroy', $tile->id) }}"
                                                    method="post" style="display: none">
                                                    @csrf
                                                    @method('delete')
                                                    {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> --}}
                                                </form>
                                                <a href="{{ route('tiles.destroy', $tile->id) }} "
                                                    title="delete {{ $tile->name }}"
                                                    onclick="event.preventDefault(); document.getElementById('deleteform{{ $tile->id }}').submit();"
                                                    class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1"><i
                                                        class="ri-delete-bin-line"></i>
                                                </a>
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
                                                            @if (session()->has('success'))
                                                                <div id="success-message" class="alert alert-success">
                                                                    {{ session('success') }}
                                                                </div>
                                                            @endif
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
                                                                            <label for="form-text"
                                                                                class="form-label fs-14 text-dark"> Name Of
                                                                                Tiles</label>
                                                                            <input type="text"
                                                                                class="form-control @error('name') is-invalid @enderror"
                                                                                name="name" id="form-text"
                                                                                placeholder="Name Of Tiles"
                                                                                value="{{ $tile->name }}">
                                                                            @error('name')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3 ">
                                                                            <label for="form-text"
                                                                                class="form-label fs-14 text-dark"> Color Of
                                                                                Tiles</label>
                                                                            <input type="color" class="form-control"
                                                                                name="color" id="form-text"
                                                                                value="{{ $tile->color }}">
                                                                        </div>

                                                                        <div class="mb-4 d-sm-flex align-items-center">
                                                                            <div class="mb-0 me-5 d-flex flex-column gap-1">
                                                                                <span class="avatar avatar-xxl avatar-rounded">
                                                                                    @if ($tile->logo)
                                                                                        <img id="profile-img" src="/storage/{{ $tile->logo }}" width="50" height="50" class="rounded-circle" alt="img">
                                                                                    @else
                                                                                        <img id="profile-img" src="{{ asset('assets/images/web.jpg') }}" alt="">
                                                                                    @endif
                                                                                    <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                                                                        <input type="file" name="logo" class="position-absolute w-100 h-100 op-0" id="logo">
                                                                                        <i class="fe fe-camera"></i>
                                                                                    </a>
                                                                                </span>
                                                                                {{-- <div id="image-preview"></div> --}}
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
                                            @else
                                                <form action="{{ route('tiles.restore', $tile->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-danger"> Restore as Active <i
                                                            class="las la-arrow-alt-circle-up"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('tiles.edit', $tile->id) }}" class="btn btn-info fs-14 lh-1">Edit <i
                                                    class="ri-edit-line"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('tiles.destroy', $tile->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger "> Delete <i class="ri-delete-bin-5-line"></i></button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable modal -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Internal Datatables JS -->
    <script src="../assets/js/datatables.js"></script>


@endsection
{{-- <script src="{{ asset('assets/js/ajax-custom.js') }}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <script>
    $(document).ready(function () {
    // Attach a click event handler to the delete button
    $('.delete-tile').on('click', function () {
        var tile = $(this).data('tile-id');

        // Confirm deletion (optional)
        // if (confirm('Are you sure you want to delete this tile?')) {
            // Send an AJAX request to delete the tile
            $.ajax({
                type: 'DELETE',
                // url: '/tiles.destroy/' + tileId,
                // url: "{{ route('tiles.destroy') }}"+'/'+tile,
                3 url: "{{ route('tiles.destroy', ['tile' => '']) }}/" + tile,
               //Replace with your actual route
                data: {
                    "_token": "wSgP2tRZJrAV89AM3cm92WUyMY1hxlXHrb9b0IoP"
                },
                success: function (data) {
                    // Handle success, e.g., remove the row from the table
                    if (data.success) {
                        // Assuming you have a table with an ID 'tiles-table'
                        $('#tiles-table').DataTable().row($(this).closest('tr')).remove().draw();

                        // Show a success message
                        $('#success-message').removeClass('d-none').text(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        // }
    });
});
</script> --}}
