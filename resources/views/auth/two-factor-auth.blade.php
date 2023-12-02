{{-- @extends('layouts.dashboard')
@section('content') --}}
<x-guest-layout>
<div class="d-flex justify-content-center align-items-center text-center mt-5">
    <div class="all">
        <form method="POST" action="{{ route('two-factor.enable') }}">
        @csrf
        <div class="card-body">
            <div class="title flex items-center justify-center">
                <h3>Two Factor Authentication</h3>
            </div>
        </div>

        <div class="flex items-center justify-center mt-4">
            @if(! $user->two_factor_secret)
            <x-primary-button class="ml-3 mt-3 " >
                {{ __('Enable') }}
            </x-primary-button>
            {{-- <button type="submit" class="ms-auto btn btn-info">Enable</button> --}}
            {{-- @else
                    {!! $user->twoFactorQrCodeSvg() !!} --}}
            @endif
    @if( ($user->two_factor_secret) && !($user->scan))    </div>
    </form>
        <form action="{{ route('updatescan2fa',$user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="put">

            <div class="flex items-center justify-center">
                {!! $user->twoFactorQrCodeSvg() !!}
            </div>
            <input type="hidden" name="scan" id="scan" value="1">
            <x-primary-button class="ml-3 mt-3 " >
                {{ __('Scan Done') }}
            </x-primary-button>

        </form>
        @endif
        @if( ($user->two_factor_secret) && ($user->scan))
        <x-primary-button class="ml-3 mt-3">
            <a href="{{route('/')}}">Go home</a>
        </x-primary-button>
        @endif
    </div>

</div>

{{-- @endsection --}}
</x-guest-layout>
