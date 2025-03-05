<!-- Search and Filter Section -->
<div class="container filter-section mt-3">
    <form action="<?php echo e(route('groups.search')); ?>" method="GET" class="row g-3">
        <div class="col-md-4">
            <input type="text" required name="searchQuery" class="form-control" placeholder="Search groups...">
        </div>
        
        <div class="col-md-4">
            <button type="submit" class="btn btn-light w-100">Search</button>
        </div>
    </form>
</div>



<!-- Search and Filter Section -->
<!-- <div class="container filter-section mt-3">
    <form class="row g-3">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search groups...">
        </div>
        <div class="col-md-4">
            <select class="form-select">
                <option selected>All Categories</option>
                <option value="1">Study Groups</option>
                <option value="2">Fitness</option>
                <option value="3">Travel</option>
                <option value="4">Hobbies</option>
           
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-light w-100">Filter</button>
        </div>
    </form>
</div> -->
<?php /**PATH /home6/bloggerc/goaltract.com/resources/views/inc/searchandfilter.blade.php ENDPATH**/ ?>