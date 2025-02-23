<x-guest-layout>
    <x-slot name="title">
       Login
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <p class=" text-white h2">Dashboard Management</p>
            <p class="white mb-0">
                Please use your credentials to login.
                <br>If you are not a member, please
            <a href="#" class="white">register</a> in Mobile app.
            </p>
        </x-slot>
        <a href="{{route('dashboard')}}">
            <span class="logo-single"></span>
        </a>
        <h6 class="mb-4">Login</h6>
          <!-- Session Status -->
          <x-auth-session-status class="mb-3" :status="session('status')" />
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-3" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="form-group has-float-label mb-4">
                {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                <x-label for="email" :value="__('Email')" />
            </label>

            <label class="form-group has-float-label mb-4">
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-label for="password" :value="__('Password')" />
            </label>
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <x-checkbox id="remember_me" name="remember" />
                    <label class="form-check-label" for="remember_me">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <x-button>
                    {{ __('Log in') }}
                </x-button>
                {{-- <button class="btn btn-primary btn-lg btn-shadow" type="submit"> {{ __('Log in') }}</button> --}}
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
