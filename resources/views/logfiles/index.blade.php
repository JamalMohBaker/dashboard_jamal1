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
                    <h3>All Of Operaions are in Log files</h3>

                </div>
                <div class="card-body">
                    <table id="datatable-basic" class="table table-bordered text-nowrap table-striped mt-2"
                        style="width:100%">
                        <thead class="bg-teal-gradient">
                            <tr>
                                <th>ID </th>
                                <th>User Id</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Operations</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logfiles as $logfile)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            #{{ $logfile->id }}
                                        </div>
                                    </th>
                                    <td>
                                        {{ $logfile->user_id }}
                                    </td>
                                    <td>
                                        {{ $logfile->type }}
                                    </td>
                                    <td style="max-width: 250px;">
                                        <div style=" white-space: normal;">
                                            {{ strip_tags($logfile->description) }}
                                        </div>


                                    </td>
                                    <td dir="rtl" class="text-center">
                                        {{$logfile->created_at}}
                                    </td>
                                    <td>
                                        <form id="deleteform{{ $logfile->id }}"
                                            action="{{ route('logfiles.destroy', $logfile->id) }}" method="post"
                                            style="display: none">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> --}}
                                        </form>
                                        <a href="{{ route('logfiles.destroy', $logfile->id) }} "
                                            title="delete {{ $logfile->id }}"
                                            onclick="event.preventDefault(); document.getElementById('deleteform{{ $logfile->id }}').submit();"
                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1"><i
                                                class="ri-delete-bin-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach               {{-- Start Modal for edit users --}}
                        </tbody>
                    </table>
                </div>


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
@endsection
