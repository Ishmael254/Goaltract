<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\File;
use App\Http\Middleware\Admin;

Auth::routes();
Route::get('/clear-caches', function () {
    // Clear application cache
    Artisan::call('cache:clear');
    // Clear route cache
    Artisan::call('route:clear');
    // Clear config cache
    Artisan::call('config:clear');
    // Clear view cache
    Artisan::call('view:clear');

    return 'All caches cleared now!';
})->name('clear-cache');

// Specific routes first
Route::get('/', [HomeController::class, 'welcome'])->name('/');
Route::get('home', [HomeController::class, 'homepage'])->name('homepage');
Route::get('groups', [HomeController::class, 'groups'])->name('groups');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('posts', [HomeController::class, 'blogposts'])->name('blogposts');
Route::get('sitemap.xml', [SitemapController::class, 'generate'])->name('sitemap');
// Dynamic routes should come after specific routes
Route::get('{groupslug}', [HomeController::class, 'viewgroup'])->name('viewgroup');
Route::get('blog/{postslug}', [HomeController::class, 'showblogposts'])->name('blog.show');//not working
// Other routes
Route::post('{postId}/comments', [HomeController::class, 'storeComment'])->name('comments.store');
Route::post('contact/submit', [HomeController::class, 'submitContactForm'])->name('contact.submit');
Route::get('groups/search', [HomeController::class, 'searchContent'])->name('groups.search');
Route::post('/filter-posts', [HomeController::class, 'filterPosts'])->name('filter.posts');
Route::get('/category/{name}', [HomeController::class, 'postsByCategory'])->name('posts.byCategory');

Route::get('privacy-policy', action: [HomeController::class, 'blogposts'])->name('privacy');


Route::middleware([Admin::class])->group(function () {
    //admin
    Route::get('admin/dashboard', action: [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('admin/content', [AdminController::class, 'editContent'])->name('admin.content.edit');
    Route::post('admin/content/update', [AdminController::class, 'updateContent'])->name('admin.content.update');
    Route::get('admin/groupslist', [AdminController::class, 'grouplist'])->name('admin.groups.list');
    Route::post('admin/content/store', [AdminController::class, 'storegroups'])->name('admin.content.store');
    Route::get('admin/editgroup/{id}', [AdminController::class, 'editgroup'])->name('admin.editgroup'); // Delete a group
    Route::post('admin/groups/update/{id}', [AdminController::class, 'updategroup'])->name('admin.group.update');
    Route::get('admin/groups/delete/{id}', [AdminController::class, 'deletegroup'])->name('admin.group.delete');
    Route::get('admin/categories', [AdminController::class, 'categories'])->name('admin.categories.list');
    Route::post('admin/categories/store', [AdminController::class, 'storecategories'])->name('admin.categories.store');
    Route::get('admin/categories/delete/{id}', [AdminController::class, 'deletecategory'])->name('admin.categories.delete');
    Route::get('admin/postcategories', [AdminController::class, 'postcategories'])->name('admin.postcategories.list');
    Route::post('admin/postcategories/store', [AdminController::class, 'storepostcategories'])->name('admin.postcategories.store');
    Route::get('admin/postcategories/delete/{id}', [AdminController::class, 'deletepostcategory'])->name('admin.postcategories.delete');
    Route::get('admin/menu', [AdminController::class, 'listmenuitems'])->name('admin.menu.index');
    Route::post('admin/menu', [AdminController::class, 'storemenuitems'])->name('admin.menu.store');
    Route::get('admin/blog', [AdminController::class, 'blogposts'])->name('admin.blog.index');
    Route::post('admin/storeposts', [AdminController::class, 'storeblogposts'])->name('admin.posts.store');
    Route::get('admin/contacts', [AdminController::class, 'listcontactmessages'])->name('admin.contact.index');
    Route::get('admin/blog/{id}/edit', [AdminController::class, 'editBlogPost'])->name('admin.editblogpost');
    Route::post('admin/blog/{id}', [AdminController::class, 'updateBlogPost'])->name('admin.posts.update');

    Route::delete('admin/blog/delete/{id}', [AdminController::class, 'deleteBlogPost'])->name('admin.blogpost.delete');
});


Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});

Route::get('/clear-caches', function () {
    // Clear application cache
    Artisan::call('cache:clear');
    // Clear route cache
    Artisan::call('route:clear');
    // Clear config cache
    Artisan::call('config:clear');
    // Clear view cache
    Artisan::call('view:clear');

    return 'All caches cleared now!';
})->name('clear-cache');
