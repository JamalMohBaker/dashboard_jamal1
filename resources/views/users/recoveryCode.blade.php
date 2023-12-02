@extends('layouts.dashboard')
@section('content')
    @if (session()->has('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class=" d-flex  p-2 m-2 mt-3 bg-light">
        <h3>Recovery code </h3>
    </div>
   <div class="container row mt-3">
        <div class="alert alert-info ms-2">
            In case you lose your phone or are unable to receive the code from the authentication app, you can use these codes to regain access to your account. Please keep them in a secure place.
            You can use each code only once.
        </div>
        <div class="col-lg-6 col-md-6  col-12 d-flex justify-content-center align-item-center mt-3">
            <ul class="list-group mb-3">
                @foreach($user->recoveryCodes() as $code)
                    <li class="list-group-item ">
                        {{ $code }}
                    </li>

                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center align-item-center mt-5 mb-3 pt-5">
            {!! $user->twoFactorQrCodeSvg() !!}
        </div>

   </div>


@endsection
