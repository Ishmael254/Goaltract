

<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-success btn-lg">Add New Group</a>


    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Whatsapp Group List</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($group->id); ?></strong></td>
                            <td><strong><?php echo e($group->page_name); ?></strong></td>

                            <td><?php echo Str::limit($group->content, 100); ?></td> <!-- Display a preview of the content -->

                            <td>
                                <a href="<?php echo e(route('admin.editgroup', $group->id)); ?>"
                                    class="btn rounded-pill btn-outline-primary">Edit</a>
                                <a href="<?php echo e(route('admin.group.delete', $group->id)); ?>"
                                    class="btn rounded-pill btn-outline-danger">Delete</a>
                                    

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


        </div>
        <!--/ Basic Bootstrap Table -->
    </div>


    <!-- Add new group Modal -->
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.content.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="groupname">Group Name</label>
                            <input type="text" name="groupname" id="groupname" class="form-control"
                                placeholder="Enter group name" required>
                            <?php $__errorArgs = ['groupname'];
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

                         <!-- Select Category -->
                        <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">Select a category</option>
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
                                placeholder="Enter group description" required></textarea>
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


                        <button type="submit" class="btn btn-primary">Save Group</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home6/bloggerc/goaltract.com/resources/views/admin/groupslist.blade.php ENDPATH**/ ?>