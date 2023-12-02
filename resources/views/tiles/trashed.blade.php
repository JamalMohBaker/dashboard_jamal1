@extends('layouts.dashboard')
@section('content')
    <div class="d-flex m-2">

        <div class="ms-auto">
            <a href="{{ route('tiles.index')}}" class="btn btn-info"> <i class="bi bi-arrow-left-circle"></i> List Of Tiltes</a>
        </div>
    </div>
    <div class="table-responsive bg-blue-transparent">
        <table class="table text-nowrap table-bordered ">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Tiltes </th>
                    <th scope="col">Restore</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($tiles as $tile)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                #{{ $tile->id }}
                            </div>
                        </th>
                        <td>
                            {{ $tile->name }}
                        </td>

                        <td>
                            <form action="{{ route('tiles.restore', $tile->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger"> Restore <i
                                    class="las la-arrow-alt-circle-up"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
