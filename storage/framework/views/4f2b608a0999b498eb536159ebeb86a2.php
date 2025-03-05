
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

    /* Login Card Container */
    .login-card-container {
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
    .login-card-header {
        background-color: #28a745;
        color: white;
        padding: 1.5rem;
        font-size: 1.8rem;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* Form Styling */
    .login-form {
        padding-top: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #007bff;
        margin-bottom: 0.5rem;
    }

    /* Enhanced Input Styling */
    .form-control {
        border-radius: 10px;
        border: 2px solid #007bff;
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
        border-color: #0056b3;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    /* Login Button */
    .btn-login {
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

    .btn-login:hover {
        background-color: #0056b3;
    }

    /* Link Styling */
    .login-footer {
        padding: 1rem;
        font-size: 0.9rem;
        color: #007bff;
        background-color: #f3f8f3;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .login-card-container {
            margin: 1.5rem;
            padding: 1.5rem;
        }

        .btn-login {
            font-size: 1rem;
            padding: 0.7rem;
        }

        .form-label,
        .login-footer {
            font-size: 0.9rem;
        }
    }
</style>

<div class="login-card-container">
    <!-- Card Header -->
    <div class="login-card-header">
        <?php echo e(__('Login to Your Account')); ?>

    </div>

    <!-- Form -->
    <div class="login-form">
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" required autocomplete="email" placeholder="Enter your email">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Enter your password">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-group">
                <div class="form-check text-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                <?php echo e(__('Login')); ?>

            </button>
        </form>
    </div>

    <!-- Password Reset Link -->
    <div class="login-footer">
        <p><a href="<?php echo e(route('password.request')); ?>" style="color: #007bff; text-decoration: none;"><?php echo e(__('Forgot Your Password?')); ?></a></p>
        <p>Don't have an account? <a href="<?php echo e(route('register')); ?>" style="color: #007bff; text-decoration: none;">Register here</a></p>
    </div>
</div>

<?php /**PATH /home6/bloggerc/goaltract.com/resources/views/auth/login.blade.php ENDPATH**/ ?>