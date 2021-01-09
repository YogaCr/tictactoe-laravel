<x-guest-layout>
    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}
    <div id="card">
        <div id="card-content">
          <img src="https://images-na.ssl-images-amazon.com/images/I/41Yj12sPTtL.png" class="card-img-top" alt="logo" />
          <div id="card-title">
            <h2>Login</h2>
            <div class="underline-title"></div>
          </div>
          <x-jet-validation-errors class="mb-4" />
          <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <x-jet-label for="email" class="form-label" style="color:white" value="{{ __('Email Address') }}" />
                <x-jet-input id="email" class="form-control" style="color:black" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            </div>
            <div class="mb-3">
                <x-jet-label for="password" class="form-label" style="color:white" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control" style="color:black" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="underline-title"></div>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:0">Login</button>
            
          </form>
          <p style="color:white;text-align:center">Belum punya akun? <a href="{{route('register')}}" style="font-weight: bold">Daftar di sini</a></p>
        </div>
      </div>
      </form>
    </div>
</x-guest-layout>
