

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="text-success mb-4">Contact Us</h2>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('contact.submit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
        </div>
        <br>
                 <!-- reCAPTCHA -->
            <?php echo $__env->make('inc.captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <br>
        
        <button type="submit" class="btn btn-success">Send Message</button>
    </form>
</div>
<!-- reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mylayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home6/bloggerc/goaltract.com/resources/views/contact.blade.php ENDPATH**/ ?>