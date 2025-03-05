<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Categories;
use Storage;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Posts;
use App\Models\PostCategories;
use App\Models\Contact;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    //
        public function __construct()
        {
            $this->middleware('auth');
        }


    public function cacheContent($pageName = 'welcome')
    {
        // Fetch content from the database
        $content = Content::where('page_name', $pageName)->first();
    
        if ($content) {
            // Store the content in the cache
            Cache::put('content_' . $pageName, $content, 60 * 60); // Cache for 1 hour
            return response()->json(['message' => 'Content cached successfully.']);
        }
    
        return response()->json(['message' => 'Content not found.'], 404);
    }


     // Fetch content by page name
     public function index()
     {
          // Fetch the current welcome page content
          $content = Content::where('page_name', 'welcome')->first();
          return view('admin.index', compact('content'));
     }

     public function editContent()
     {
         // Fetch the current welcome page content
         $content = Content::where('page_name', 'welcome')->first();
         return view('admin.edit-content', compact('content'));
     }
 
     
 
     // Update content in the admin dashboard
     public function updateContent(Request $request)
     {
         // Validate the input
         $request->validate([
             'content' => 'required'
         ]);

        //  $content = $request->content;
        //  dd($content);
 
         // Find or create the welcome page content
         $content = Content::firstOrCreate(['page_name' => 'welcome']);
         $content->content = $request->content;
         $content->save();
         
        Cache::forget('content_' . $content->page_name); // Invalidate the cache for this page

 
         return redirect()->route('admin.content.edit')->with('success', 'Content updated successfully.');
     }


     public function grouplist()
     {
        $groups = Content::where('type', 'group')->orderBy('id','desc')->get();
        $categories = Categories::orderBy('id','desc')->get();

        return view('admin.groupslist', compact('groups','categories'));
     }


     public function storegroups(Request $request)
    {
        // Validate the request
        $request->validate([
            'groupname' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);

        // Generate the initial slug from the group name
        $slug = Str::slug($request->input('groupname'), '-');

        // Check for existing slugs and make it unique
        $originalSlug = $slug;
        $i = 1;

        while (Content::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i; // Append a number to the slug
            $i++;
        }

        // Store the data in the Content model
        $content = new Content();
        $content->page_name = $request->input('groupname');
        $content->slug = $slug; // Save the unique slug
        $content->content = $request->input('content');
        $content->type = 'group'; // Set type to 'group'
        $content->category_id = $request->input('category_id');
        $content->save();
        
            Cache::forget('groups_content');


        return redirect()->route('admin.groups.list')->with('success', 'Content saved successfully');
        }


    public function editgroup($id)
    {
        // Find the group content by ID
        $group = Content::findOrFail($id);
        $categories = Categories::orderBy('id','desc')->get();

        // Return the edit view with the group data
        return view('admin.editgroup', compact('group','categories'));
    }


    public function updategroup(Request $request, $id)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);

        // Find the group content by ID and update it
        $group = Content::findOrFail($id);
        $group->page_name = $request->page_name;
        $group->content = $request->content;
        $group->category_id = $request->category_id;
        $group->save();

        return redirect()->route('admin.groups.list')->with('success', 'Group content updated successfully.');
    }
    public function deletegroup($id)
    {
        // Find the group content by ID and delete it
        $group = Content::findOrFail($id);
        $group->delete();

        return redirect()->route('admin.groups.list')->with('success', 'Group deleted successfully.');
    }

    public function categories()
    {
       $categories = Categories::orderBy('id','desc')->get();
       return view('admin.categories', compact('categories'));
    }

    public function storecategories(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        // Store the data in the Content model
        $content = new Categories();
        $content->name = $request->input('name');       
        $content->save();

        return redirect()->route('admin.categories.list')->with('success', 'category saved successfully');
    }

    public function postcategories()
    {
       $categories = PostCategories::orderBy('id','desc')->get();
       return view('admin.blog.categories', compact('categories'));
    }

    public function storepostcategories(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        // Store the data in the Content model
        $content = new PostCategories();
        $content->name = $request->input('name');       
        $content->save();

        return redirect()->route('admin.postcategories.list')->with('success', 'category saved successfully');
    }

    public function deletepostcategory($id)
    {
        // Find the group content by ID and delete it
        $data = PostCategories::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.postcategories.list')->with('success', 'category deleted successfully.');
    }


    public function deletecategory($id)
    {
        // Find the group content by ID and delete it
        $data = Categories::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.categories')->with('success', 'category deleted successfully.');
    }

     // Display menu items
     public function listmenuitems()
     {
         $menus = Menu::orderBy('order')->get();
         return view('admin.menu', compact('menus'));
     }
 
     // Store or update menu items
     public function storemenuitems(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'url' => 'required|string',
             'order' => 'required|integer',
         ]);
 
         Menu::create($request->only(['title', 'url', 'order']));
 
         return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully.');
     }

     public function blogposts()
    {
        // Fetch posts to display in the admin panel
        $posts = Posts::orderby('id','desc')->get();
        $categories = PostCategories::orderBy('id','desc')->get();

        return view('admin.blog.index', compact('posts','categories'));
    }

    public function storeblogposts(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:post_categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image
        ]);

        // Initialize the image_url variable
        $imageUrl = null;

        // Handle image upload if an image was provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique name for the image
            $image->move(public_path('blog'), $imageName); // Move the image to public/blog
            $imageUrl = 'blog/' . $imageName; // Set the image URL
        }
         // Generate a slug from the title
        $slug = Str::slug($request->title);

        // Ensure the slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Posts::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count; // Append number to the slug
            $count++;
        }


        // Create a new post
        Posts::create([
            'title' => $request->title,
            'category_id' => $request->category_id, // Save selected category
            'content' => $request->content,
            'image_url' => $imageUrl, // Include the image URL in the creation
            'slug' => $slug, // Save the generated slug

        ]);

        // Redirect back with success message
        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully!');
    }

    public function listcontactmessages()
    {
        $msgs = Contact::orderBy('id','desc')->get();
        return view('admin.contact', compact('msgs'));
    }


    public function editBlogPost($id)
    {
        $post = Posts::findOrFail($id); // Find the post by ID
        $categories = PostCategories::orderBy('id','desc')->get();

        return view('admin.blog.editBlogPost', compact('post','categories')); // Return a view with the post data
    }

    public function updateBlogPost(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Posts::findOrFail($id); // Find the post to update
        $post->title = $request->title;
        $post->category_id = $request->category_id; // Save selected category

        $post->content = $request->content;

        // Handle image upload if a new image was provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image_url) {
                File::delete(public_path($post->image_url));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('blog'), $imageName);
            $post->image_url = 'blog/' . $imageName; // Update the image URL
        }

        $post->save(); // Save the updated post

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully!');
    }

    public function deleteBlogPost($id)
    {
        $post = Posts::findOrFail($id);
        
        // Delete the image file if it exists
        if ($post->image_url) {
            File::delete(public_path($post->image_url));
        }
        
        $post->delete(); // Delete the post

        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully!');
    }




     
     


}
