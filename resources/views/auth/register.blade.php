
<style>
    /* Full-screen background */
    body {
        background: linear-gradient(135deg, #e0f4e3, #d4eed6);
        font-family: Arial, sans-serif;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    /* Register Card Container */
    .register-card-container {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 500px;
        padding: 2rem;
        margin: 1rem;
        text-align: center; /* Center text in the card */
    }

    /* Card Header */
    .register-card-header {
        background-color: #28a745;
        color: white;
        padding: 1.5rem;
        font-size: 1.8rem;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* Form Styling */
    .register-form {
        padding-top: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #28a745;
        margin-bottom: 0.5rem;
    }

    /* Enhanced Input Styling */
    .form-control {
        border-radius: 10px;
        border: 2px solid #28a745;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        color: #333;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #f8fdf9;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 100%; /* Full width */
        text-align: center; /* Center text inside inputs */
    }

    .form-control:focus {
        border-color: #218838;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
        outline: none;
    }

    /* Register Button */
    .btn-register {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 0.75rem;
        width: 100%;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        border: none;
        margin-top: 1rem; /* Add margin for spacing */
    }

    .btn-register:hover {
        background-color: #218838;
    }

    /* Link Styling */
    .register-footer {
        padding: 1rem;
        font-size: 0.9rem;
        color: #28a745;
        background-color: #f3f8f3;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .register-card-container {
            margin: 1.5rem;
            padding: 1.5rem;
        }

        .btn-register {
            font-size: 1rem;
            padding: 0.7rem;
        }

        .form-label,
        .register-footer {
            font-size: 0.9rem;
        }
    }
</style>

<div class="register-card-container">
    <!-- Card Header -->
    <div class="register-card-header">
        {{ __('Create Your Account') }}
    </div>

    <!-- Form -->
    <div class="register-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-register">
                {{ __('Register') }}
            </button>
        </form>
    </div>

    <!-- Login Link -->
    <div class="register-footer">
        <p>Already have an account? <a href="{{ route('login') }}" class="register-link" style="color: #28a745; font-weight: bold; text-decoration: none;">Log in</a></p>
    </div>
</div>

