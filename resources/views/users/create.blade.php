@extends('layouts.dashboard')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            you have some errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h3 class="text-center pb-1">Add New Of User</h3>

    <form action="{{ route('users.store') }}" id="user-form" method="POST">
        @csrf
        <div class="form  border bg-blue-transparent p-3">
            <div class="mb-3 ">
                <label for="UserName" class="form-label fs-14 text-dark"> UserName </label>
                <input type="text" class="form-control" name="username" id="UserName" placeholder="username">
            </div>
            <div class="mb-3 ">
                <label for="email" class="form-label fs-14 text-dark">E-mail Of User</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email@email.com">
            </div>
            <div class="mb-3">
                <div class="card-header">
                    <div class="card-titlte">
                        Tiles Permissions
                    </div>
                </div>
                <div class="card-body">
                    <select class="js-example-basic-multiple" id="user_tiles" name="user_tiles[]" multiple="multiple">
                        @foreach ($tiles as $tile)
                            <option value="{{ $tile->id }}">{{ $tile->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fs-14 text-dark"> Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="*****">
                    <button id="showPassword" class="btn btn-outline-secondary" type="button">
                        <i class="fe fe-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label fs-14 text-dark">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                        placeholder="*****">
                    <button id="showConfirmPassword" class="btn btn-outline-secondary" type="button">
                        <i class="fe fe-eye"></i>
                    </button>
                </div>
            </div>

            <button class="btn btn-secondary mb-2" id="add-user" type="button">Add User</button>
        </div>

    </form>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    {{-- <script>
        (function($) {
            $('#add-user').on('click', function(e) {
                // alert('ok')
                e.preventDefault();
                var form = $('#user-form');
                $.post(form.attr('action'), form.serialize(), function(response) {
                    alert(response.success)
                });
            })
        })(jQuery);
    </script>   --}}
    <script>
        (function($) {
            $('#add-user').on('click', function(e) {
                e.preventDefault();
                var form = $('#user-form');

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // You can also display a success message or perform other actions here
                        alert(response.success);
                        // Clear form fields after successful submission
                        form.trigger('reset');

                        $('#user_tiles').val([]);

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while processing your request.');
                    }
                });
            });
        })(jQuery);
    </script>
@endsection

{{-- start add user --}}

{{-- end add user --}}
