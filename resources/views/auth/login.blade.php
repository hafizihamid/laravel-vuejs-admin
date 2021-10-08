@extends('layouts.app')

@section('content')
@component('components.full-page-section')



@component('components.card')
@slot('title')
<span class="icon"><i class="mdi mdi-lock"></i></span>
<span>{{ __('Login') }}</span>
@endslot

<form method="POST" action="{{ route('auth.login') }}">
    @csrf

    <div class="field">
        <label class="label" for="email">{{ __('Username') }}</label>
        <div class="control">
            <input id="username" type="text" class="input @error('errorUsername') is-danger @enderror" name="username"
                value="{{ old('username') }}" required autocomplete="email" autofocus>
        </div>
        @error('errorUsername')
        <p class="help is-danger" role="alert">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="field">
        <label class="label" for="password">{{ __('Password') }}</label>
        <div class="control">
            <input id="password" type="password" class="input @error('password') is-danger @enderror" name="password"
                required autocomplete="current-password" autofocus>
        </div>
        @error('error')
        <p class="help is-danger" role="alert">
            {{ $message }}
        </p>
        @enderror
    </div>

    <hr>

    <div class="field is-form-action-buttons">
        <button type="submit" class="button is-black">
            {{ __('Login') }}
        </button>

        @if (Route::has('reset'))
        <a class="button is-black is-outlined" href="{{ route('reset') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </div>
</form>
@endcomponent
@endcomponent
@endsection