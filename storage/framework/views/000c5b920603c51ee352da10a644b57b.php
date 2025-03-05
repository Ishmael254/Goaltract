


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Page Content</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
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

    <form action="<?php echo e(route('admin.group.update', $group->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="page_name">Group Name</label>
            <input type="text" name="page_name" class="form-control" value="<?php echo e($group->page_name); ?>" required>
        </div>

        <!-- Select Category -->
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <!-- Display the current category name as the selected option -->
                <?php if($group->category): ?>
                    <option value="<?php echo e($group->category->id); ?>" selected><?php echo e($group->category->name); ?></option>
                <?php else: ?>
                    <option value="" disabled>Select a category</option>

                <?php endif; ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
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



        <!-- Group Description -->
        <div class="mb-3">
            <label for="groupDescription">Description</label>
            <textarea required name="content" id="content" class="form-control" rows="4"
                placeholder="Enter group description"
                required><?php echo $group->content ?? 'No content available'; ?></textarea>
            <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('content', {
                    on: {
                        instanceReady: function (ev) {
                            // Adds content-table class to all tables upon paste or save
                            ev.editor.dataProcessor.htmlFilter.addRules({
                                elements: {
                                    table: function (element) {
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

        <button type="submit" class="btn btn-primary">Update Group</button>
    </form>






</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home6/bloggerc/goaltract.com/resources/views/admin/editgroup.blade.php ENDPATH**/ ?>