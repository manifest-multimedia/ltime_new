<x-auth-layout page="Login" pagetitle="Sign In | L-Time Properties"> 

    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="form">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div id="username-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <input id="email" name="email" type="email" class="form-control" placeholder="Email">
            </div>

            <div id="password-field" class="field-wrapper input mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper toggle-pass">
                    <p class="d-inline-block">{{__("Show Password")}}</p>
                    <label class="switch s-primary">
                        <input type="checkbox" id="toggle-password" class="d-none">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="field-wrapper">
                    <x-button class="ml-4 btn btn-primary">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                
            </div>

            <div class="field-wrapper text-center keep-logged-in">
                <div class="n-chk new-checkbox checkbox-outline-primary">
                    <label class="new-control new-checkbox checkbox-outline-primary">
                    <input type="checkbox" class="new-control-input" id="remember_me">
                    <span class="new-control-indicator"></span>{{__("Keep me logged in")}}
                    </label>
                </div>
            </div>

            <div class="field-wrapper">
                {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-pass-link">{{__("Forgot Password?")}}</a>
                @endif --}}
            </div>
        </form>
    </div>

</x-auth-layout>