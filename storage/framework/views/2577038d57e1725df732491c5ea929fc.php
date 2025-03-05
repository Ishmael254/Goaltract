


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Welcome Page Content</h1>


    <!-- Displaying All Validation Errors -->
    <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

    <form action="<?php echo e(route('admin.content.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>        
        <br>          

           
            <!-- Group Description -->
            <div class="mb-3">
                <label for="groupDescription">Description</label>
                <textarea required name="content" id="content" class="form-control" rows="4"
                    placeholder="Enter group description" required><?php echo $content->content ?? 'No content available'; ?></textarea>
                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('content', {
                        on: {
                            instanceReady: function(ev) {
                                // Adds content-table class to all tables upon paste or save
                                ev.editor.dataProcessor.htmlFilter.addRules({
                                    elements: {
                                        table: function(element) {
                                            element.addClass('content-table');
                                        }
                                    }
                                });
                            }
                        }
                    });
                </script>

                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <br>

        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>
    


   
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home6/bloggerc/goaltract.com/resources/views/admin/edit-content.blade.php ENDPATH**/ ?>