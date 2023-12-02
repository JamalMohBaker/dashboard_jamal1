@extends('layouts.dashboard')
@section('content')
    <div class="d-flex m-2">

        <div class="ms-auto">
            <a href="{{ route('users.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left-circle"></i> List Of
                Users</a>
        </div>
    </div>
    <div class="table-responsive bg-blue-transparent">
        <table class="table text-nowrap table-bordered ">
            <thead>
                <tr>
                    <th scope="col">#ID | userName </th>
                    <th scope="col">Email </th>
                    <th scope="col">Type </th>
                    <th scope="col">Restore</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                #{{$user->id}} | {{$user->username}}
                            </div>
                        </th>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->type}}
                        </td>
                        <td>
                            <form action="{{ route('users.restore', $user->id) }}" method="post">
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
