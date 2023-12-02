
@extends('layouts.dashboard')
@section('content')
@if (session()->has('success'))
<div id="success-message" class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    {{-- <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Data Tables</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
            </ol>
        </nav>
    </div>
</div> --}}
    <!-- Page Header Close -->

    {{-- <div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
    We Placed <strong class="text-fixed-black">Datatables</strong> only in this page by using <strong class="text-fixed-black">jquery</strong> cdn link.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
</div> --}}
    <!-- Start:: row-5 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">

                <div class="card-body">
                    <div class="deleted-table table-responsive">
                        <div class="text-center">
                            <button id="button" class="btn btn-primary mb-2 data-table-btn">Hidden selected row</button>
                        </div>
                        <table id="delete-datatable" class="table table-bordered text-nowrap mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Tiltes </th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    {{-- <td>$320,800</td> --}}
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    {{-- <td>$170,750</td> --}}
                                </tr>

                                @foreach ($tiles as $tile)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                {{ $tile->name }}
                                            </div>
                                        </th>
                                        <td>
                                            @if ($tile->logo)
                                                <img src="/storage/{{ $tile->logo }}" width="50" height="50"
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
                                            <a href="{{ route('tiles.edit', $tile->id) }}"
                                                class="btn btn-info fs-14 lh-1">Edit <i class="ri-edit-line"></i></a>
                                        </td>
                                        <td>

                                                <button class="btn btn-danger delete-tile"> Delete <i
                                                        class="ri-delete-bin-5-line"></i></button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <script>
    // Add a click event listener to the delete buttons
    document.querySelectorAll('.delete-tile').forEach(button => {
        button.addEventListener('click', function () {
            const tileId = this.parentElement.getAttribute('data-tile-id');

            // Send an AJAX request to delete the tile
            axios.delete(`/tiles/${tileId}`)
                .then(response => {
                    if (response.status === 200) {
                        // Remove the row from the table on success
                        document.getElementById(`delete-form-${tileId}`).remove();

                        // Show a success message
                        const successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.textContent = response.data.success;
                            successMessage.style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script> --}}
{{-- <script>
    $(document).ready(function () {
        // Attach a click event handler to the delete button
        $('.delete-tile').on('click', function () {
            var tileId = $(this).data('tile-id');

            // Confirm deletion (optional)
            if (confirm('Are you sure you want to delete this tile?')) {
                // Send an AJAX request to delete the tile
                $.ajax({
                    type: 'DELETE',
                    url: '/tiles.destroy/' + tileId,
                   //Replace with your actual route
                    data: {
                        "_token": "{{ csrf_token() }}"
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
            }
        });
    });
</script> --}}
<script src="{{ asset('assets/js/ajax-custom.js') }}"></script>
