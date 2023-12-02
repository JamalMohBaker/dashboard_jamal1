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
                    <h3>All Of Users</h3>

                    <div class="ms-auto me-3">
                        <a href="{{ route('users.create') }}" class="btn btn-info">
                            <strong> + </strong> Add New Of User</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-basic" class="table table-bordered text-nowrap table-striped mt-2"
                        style="width:100%">
                        <thead class="bg-teal-gradient">
                            <tr>
                                <th>ID | UserName</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Operations</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <input type="hidden" name="" id="user-id" value="{{ $user->id }} ">
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            #{{ $user->id }} | {{ $user->username }}| {{ $user->key }}
                                        </div>
                                    </th>
                                    <td>
                                        @if ($user->image)
                                            <img src="/storage/{{ $user->image }}" width="50" height="50"
                                                class="rounded-circle " alt="img">
                                        @else
                                            <img src="../assets/images/faces/13.jpg" width="50" height="50"
                                                class="rounded-circle " alt="img">
                                        @endif

                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->type }}
                                    </td>
                                    <td>
                                        @if ($user->deleted_at)
                                            <span class="badge bg-danger text-dark">Inactive</span>
                                        @else
                                            <span class="badge bg-success-transparent">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if (!$user->deleted_at)

                                            <a href="{{ route('users.edit', $user->id) }}" title="edit {{ $user->name }}" 
                                                class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                    class="ri-edit-line"></i>
                                            </a>
                                            <form id="deleteform{{ $user->id}}" class="deleteform"
                                                action="{{ route('users.destroy', $user->id) }}" method="post"
                                                style="display: none">
                                                @csrf
                                                @method('delete')
                                                {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> --}}
                                            </form>
                                            <a type="button" id="delete-user{{ $user->id }}" data-user-id="{{ $user->id }}"
                                                title="delete {{ $user->id }}"
                                                {{-- onclick="event.preventDefault();" --}}
                                                class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1 delete-user"><i
                                                    class="ri-delete-bin-line"></i>
                                            </a>
                                            {{-- Start Modal for edit users --}}
                                            <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1> --}}
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div id="js-success-message" class="alert alert-success d-none">
                                                        </div>

                                                        <div class="modal-body">
                                                            <h3 class="text-center pb-1">Edit user #{{ $user->id }}
                                                            </h3>
                                                            <form action="{{ route('users.update', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="put">
                                                                <div class="form  border bg-blue-transparent p-3">
                                                                    <div class="mb-3 ">
                                                                        <label for="email"
                                                                            class="form-label fs-14 text-dark">Edit Email Of
                                                                            User</label>
                                                                        <input type="email" name="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            id="form-text"
                                                                            value="{{ old('email', $user->email) }}">
                                                                        @error('email')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    @if (Auth::user()->type == 'admin')
                                                                        <div class="mb-3 ">
                                                                            <label for="type"
                                                                                class="form-label fs-14 text-dark">Edit Type
                                                                                Of User</label>
                                                                            <div>
                                                                                <select
                                                                                    class="form-select form-control @error('type') is-invalid @enderror"
                                                                                    id="type" name="type">
                                                                                    <option></option>
                                                                                    @foreach ($typesOptions as $type)
                                                                                        <option @selected($type == old('type', $user->type))
                                                                                            value="{{ $type }}">
                                                                                            {{ $type }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('type')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                    @endif



                                                                    <button class="btn btn-secondary mb-2"
                                                                        type="submit">Update <i class="ri-edit-line"></i>
                                                                    </button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger "
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                </div>
                {{-- End Modal for edit users --}}
            @else
                <form action="{{ route('users.restore', $user->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill">  <i
                            class="las la-arrow-alt-circle-up"></i></button>
                </form>
                
                </td>
                @endif
                </td>


                </tr>
                @endforeach



                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="mt-3">
    {{ $users->links() }}
</div> --}}

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
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
   
    <script>
       
        (function($) {
            // var user_id = document.getElementById('user-id');
            $('.delete-user').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                // alert('user-id: '+userId)
                var form = $('#deleteform'+userId);
                $.post(form.attr('action'), form.serialize(), function(response) {
                    alert(response.success)
                });
            })
        })(jQuery);
    </script>
@endsection
