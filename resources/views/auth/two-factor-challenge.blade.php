<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <div class="card-body">
            <div class="title">
                <h3>Two Factor Challenge</h3>
                <p>You must enter 2FA code.</p>
            </div>
        </div>
        @if ($errors->has('code'))
            <div>
                {{ $errors->first('code') }}
            </div>
        @endif
        <div>
            <x-input-label for="code" :value="__('2FA Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>
        <h1 class="text-center mt-3">-----OR-----</h1>
        <div>
            <x-input-label for="recovery_code" :value="__('Recovery code')" />
            <x-text-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" :value="old('recovery_code')"
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
        </div>




        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
 
</x-guest-layout>
