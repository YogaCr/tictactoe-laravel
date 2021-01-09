<x-guest-layout>
    
    <div id="card">
        <div id="card-content">
          <img src="https://images-na.ssl-images-amazon.com/images/I/41Yj12sPTtL.png" class="card-img-top" alt="logo" />
          <div id="card-title">
            <h2>Register</h2>
            <div class="underline-title"></div>
          </div>
          <x-jet-validation-errors class="mb-4" />
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-jet-label for="username" class="form-label" style="color:white" value="{{ __('Username') }}" />
                <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
            </div>
            <div class="mb-3">
                <x-jet-label for="email" class="form-label" style="color:white" value="{{ __('Email Address') }}" />
                <x-jet-input id="email" class="form-control" type="email" style="color:black" name="email" :value="old('email')" required autofocus autocomplete="email" />
            </div>
            <div class="mb-3">
                <x-jet-label for="password" class="form-label" style="color:white" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control" style="color:black" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mb-3">
                <x-jet-label for="password_confirmation" class="form-label" style="color:white" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" style="color:black" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            
            <div class="underline-title"></div>
    
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </form>
        </div>
      </div>
      </form>
      </div>
</x-guest-layout>
