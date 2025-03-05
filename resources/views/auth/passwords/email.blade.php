
<style>
    .reset-password-container {
        max-width: 600px;
        margin: auto;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .reset-password-header {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .reset-password-body {
        text-align: center;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .form-control {
        margin: 0 auto;
        width: 100%;
    }

    .btn-reset {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn-reset:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <div class="reset-password-container">
        <div class="reset-password-header">
            {{ __('Reset Password') }}
        </div>

        <div class="reset-password-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-reset">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</div>

