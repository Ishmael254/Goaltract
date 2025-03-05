<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use DOMDocument;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Contact; // Import the Contact model
use Carbon\Carbon;
use App\Models\PostCategories;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function homepage()
    {
        return view('home');
    }

    private function generateToc($htmlContent)
    {
        $toc = [];
        $dom = new DOMDocument();

        // Load the HTML content while suppressing errors due to HTML5 tags
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8')); // Ensure proper encoding
        libxml_clear_errors();

        // Get all heading tags (e.g., h2, h3, h4)
        foreach (['h2', 'h3', 'h4'] as $tag) {
            $headings = $dom->getElementsByTagName($tag);

            foreach ($headings as $heading) {
                // Create an ID for each heading if it doesn't have one
                if (!$heading->getAttribute('id')) {
                    $id = Str::slug($heading->textContent);
                    $heading->setAttribute('id', $id); // Assign the ID to the heading
                } else {
                    $id = $heading->getAttribute('id'); // Use existing ID
                }

                // Add the heading text and id to the TOC array
                $toc[] = [
                    'level' => $tag,
                    'text' => $heading->textContent,
                    'id' => $id,
                ];
            }
        }

        // Save modified HTML back to the content variable
        $htmlContent = $dom->saveHTML(); // Get modified HTML
        return [$toc, $htmlContent]; // Return both TOC and modified HTML
    }    


    // public function welcome1($pageName = 'welcome')
    // {
    //     $seo = [
    //         'title' => '20,000+ Active Whatsapp Groups to join and Share 2024 - GoalTract.com',
    //         'description' => 'GoalTract.com has listed over 20,000 Whatsapp groups to join and connect with communities that share your goals and interests.',
    //         'keywords' => 'goaltract.com, goaltract whatsapp groups, whatsapp groups, whatsapp group links,communities, GoalTract, join groups, connect, collaborate',
    //         'canonical' => url()->current(),
    //         'og_image' => asset('images/whatsapp.jpeg'),
    //         'twitter_image' => asset('images/whatsapp.jpeg')
    //     ];

    //     $content = Content::where('page_name', $pageName)->first();
    //      // Generate TOC from content
    //     list($toc, $updatedContent) = $this->generateToc($content->content); // Unpack TOC and updated content

    //     // Save the modified content back to the content variable
    //     $content->content = $updatedContent; 

    //      // Organization Schema
    //      $organizationSchema = [
    //         "@context" => "https://schema.org",
    //         "@type" => "Organization",
    //         "name" => "GoalTract",
    //         "url" => url('/'),
    //         "logo" => asset('images/logo.png'),
    //         "sameAs" => [
    //             "https://www.facebook.com/goaltract",
    //             "https://twitter.com/goaltract",
    //             "https://instagram.com/goaltract"
    //         ]
    //     ];


    // return view('welcome', compact('content', 'toc','seo','organizationSchema'));
    // }
    

    // public function welcome2($pageName = 'welcome')
    // {
    //     $seo = [
    //         'title' => '20,000+ Active Whatsapp Groups to join and Share 2024 - GoalTract.com',
    //         'description' => 'GoalTract.com has listed over 20,000 Whatsapp groups to join and connect with communities that share your goals and interests.',
    //         'keywords' => 'goaltract.com, goaltract whatsapp groups, whatsapp groups, whatsapp group links, communities, GoalTract, join groups, connect, collaborate',
    //         'canonical' => url()->current(),
    //         'og_image' => asset('images/whatsapp.jpeg'),
    //         'twitter_image' => asset('images/whatsapp.jpeg')
    //     ];
    
    //     // Define a cache key based on the page name
    //     $cacheKey = 'content_' . $pageName;
        
    //      $cacheDuration = config('cache.default_cache_duration');
    
    //     // Attempt to retrieve the cached content
    //     $content = Cache::remember($cacheKey, $cacheDuration, function () use ($pageName) {
    //         return Content::where('page_name', $pageName)->first();
    //     });
    
    //     // Generate TOC from content only if the content is found
    //     if ($content) {
    //         list($toc, $updatedContent) = $this->generateToc($content->content); // Unpack TOC and updated content
    
    //         // Save the modified content back to the content variable
    //         $content->content = $updatedContent; 
    //     } else {
    //         // Handle the case where content is not found, e.g., throw an exception or return a 404 page
    //         abort(404, 'Content not found');
    //     }
    
    //     // Organization Schema
    //     $organizationSchema = [
    //         "@context" => "https://schema.org",
    //         "@type" => "Organization",
    //         "name" => "GoalTract",
    //         "url" => url('/'),
    //         "logo" => asset('images/logo.png'),
    //         "sameAs" => [
    //             "https://www.facebook.com/goaltract",
    //             "https://twitter.com/goaltract",
    //             "https://instagram.com/goaltract"
    //         ]
    //     ];
    
    //     return view('welcome', compact('content', 'toc', 'seo', 'organizationSchema'));
    // }
    
     public function welcome($pageName = 'welcome')
    {
        // SEO settings
        $seo = [
            'title' => '20,000+ Active Whatsapp Groups to join and Share 2024 - GoalTract.com',
            'description' => 'GoalTract.com has listed over 20,000 Whatsapp groups to join and connect. You can find different Whatsapp group links here like Pubg, Girls, Aunty, Desi Bhabhi, Funny, Indian, 18+ Adult.',
            'keywords' => 'goaltract.com, goaltract whatsapp groups, whatsapp groups, whatsapp group links, communities, GoalTract, join groups, connect, collaborate',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];

        // Cache key for content
        $cacheKey = 'content_' . $pageName;

        // Attempt to retrieve the cached content
        $content = Cache::remember($cacheKey, 24 * 60 * 60, function () use ($pageName) {
            return Content::where('page_name', $pageName)->first();
        });

        if ($content) {
            list($toc, $updatedContent) = $this->generateToc($content->content);
            $content->content = $updatedContent; 
        } else {
            abort(404, 'Content not found');
        }

        // Organization Schema
        $organizationSchema = [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "GoalTract",
            "url" => url('/'),
            "logo" => asset('images/logo.png'),
            "sameAs" => [
                "https://www.facebook.com/goaltract",
                "https://twitter.com/goaltract",
                "https://instagram.com/goaltract"
            ]
        ];

        // Cache the rendered Blade view
        $viewCacheKey = 'view_' . $pageName;
        $view = Cache::remember($viewCacheKey, 60, function () use ($content, $toc, $seo, $organizationSchema) {
            return view('welcome', compact('content', 'toc', 'seo', 'organizationSchema'))->render();
        });

        return response($view);
    }
    

   public function groups()
    {
        // Define a dynamic cache key based on the current page
        $page = request()->get('page', 1);
        $cacheKey = 'groups_content_page_' . $page;
    
        // Attempt to retrieve the cached groups for the current page, or fetch from the database if not cached
        $groups = Cache::remember($cacheKey, 24 * 60 * 60, function () {
            return Content::where('type', 'group')->orderBy('id', 'desc')->paginate(15);
        });
    
        // SEO data for the groups page
        $seo = [
            'title' => 'Explore and Join Whatsapp Groups on GoalTract.com - Connect with Like-Minded Communities',
            'description' => 'Browse Whatsapp groups on GoalTract to connect with communities that share your interests and goals.',
            'keywords' => 'GoalTract groups, communities, connect, social groups, interests, goals',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),  // Adjust to the correct image path
            'twitter_image' => asset('images/whatsapp.jpeg') // Adjust to the correct image path
        ];
    
        return view('groups', compact('groups', 'seo'));
    }


    // app/Http/Controllers/AdminController.php

    public function searchContent(Request $request)
    {
        $query = $request->input('searchQuery');

        // Perform the search query on the Content model
        $results = Content::where('type','group')->where('content', 'LIKE', '%' . $query . '%')
                        ->orWhere('page_name', 'LIKE', '%' . $query . '%')->where('type','group')
                        ->paginate(12);
         // SEO data for the groups page
        $seo = [
            'title' => 'Search Results for ' . $query . ' on Goaltract.com',
            'description' => 'Browse Whatsapp groups on GoalTract to connect with communities that share your interests and goals.',
            'keywords' => 'GoalTract groups, communities, connect, social groups, interests, goals',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),  // Adjust to the correct image path
            'twitter_image' => asset('images/whatsapp.jpeg') // Adjust to the correct image path
        ];                

        // Pass the results to a view
        return view('search-results', compact('results', 'query','seo'));
    }    

   public function viewgroup($groupslug)
    {
         // Fetch the `page_name` associated with the provided `slug`
        $pageName = Content::where('slug', $groupslug)->value('page_name');
        
        
        // Check if `page_name` exists
        if (!$pageName) {
            return "Page not found for slug: $groupslug";
        }
    
        // Create a unique cache key based on the `page_name`
        $cacheKey = 'content_' . $pageName;

        //$cacheKey = 'group_content_' . $groupslug;
    
        // Attempt to retrieve content from the cache
        $content = Cache::remember($cacheKey, 24 *60 * 60, function () use ($pageName) {
            // Fetch content from the database
            $content = Content::where('page_name', $pageName)->firstOrFail();
    
            // Generate TOC from content
            list($toc, $updatedContent) = $this->generateToc($content->content);
    
            // Save the modified content back to the content variable
            $content->content = $updatedContent; 
    
            // Include the TOC in the cached data for the view
            return [
                'content' => $content,
                'toc' => $toc,
            ];
        });
    
        // SEO settings
        $seo = [
            'title' => $content['content']->page_name . ' - GoalTract.com',
            'description' => Str::limit($content['content']->content, 150),
            'keywords' => 'GoalTract, group details, Whatsapp groups, community',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];
    
        // Return the view with cached content and SEO data
        return view('viewgroup', [
            'content' => $content['content'],
            'toc' => $content['toc'],
            'seo' => $seo
        ]);
    }


    public function getcategories()
    {
        // Define a cache key for the groups
        $cacheKeyGroups = 'group_categories';
    
        // Define the cache duration
        $cacheDuration = config('cache.default_cache_duration');
    
        // Fetch groups from cache or database
        $groups = Cache::remember($cacheKeyGroups, $cacheDuration, function () {
            return Content::where('type', 'group')->orderBy('id', 'desc')->paginate(12);
        });
    
        // Set up SEO metadata
        $seo = [
            'title' => 'Group Categories - GoalTract',
            'description' => 'Explore categories of Whatsapp groups and find communities tailored to your interests on GoalTract.',
            'keywords' => 'GoalTract, group categories, connect, social groups',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];
    
        return view('groups', compact('groups', 'seo'));
    }

   public function blogposts()
    {
        // Get the current page number from the request
        $page = request()->get('page', 1);
    
        // Define dynamic cache keys for posts and categories based on the page number
        $postsCacheKey = 'blog_posts_page_' . $page;
        $categoriesCacheKey = 'blog_categories';
    
        // Cache posts with a unique cache key per page to avoid pagination issues
        $posts = Cache::remember($postsCacheKey, 24 * 60 * 60, function () {
            return Posts::latest()->paginate(6);
        });
    
        // Cache categories (no need to cache by page since categories likely don't change per page)
        $categories = Cache::remember($categoriesCacheKey, 24 * 60 * 60, function () {
            return PostCategories::orderBy('id', 'desc')->get();
        });
    
        // SEO data for the blog posts page
        $seo = [
            'title' => 'GoalTract Blog - Insights, Tips, and Updates',
            'description' => 'Discover the latest blog posts on GoalTract covering topics like community, goals, and social connections.',
            'keywords' => 'GoalTract blog, articles, insights, tips, community',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];
    
        return view('blog.index', compact('posts', 'seo', 'categories'));
    }


     public function showblogposts($postslug)
    {
        // Define cache keys for the post and related posts
        $cacheKeyPost = 'post_' . $postslug;
        $cacheKeyRelatedPosts = 'related_posts_' . $postslug;
    
        // Define the cache duration
        $cacheDuration = config('cache.default_cache_duration');
    
        // Fetch post from cache or database
        $post = Cache::remember($cacheKeyPost, $cacheDuration, function () use ($postslug) {
            return Posts::where('slug', $postslug)->firstOrFail();
        });
    
        // Fetch related posts from cache or database
        $relatedPosts = Cache::remember($cacheKeyRelatedPosts, $cacheDuration, function () use ($post) {
            return Posts::where('slug', '!=', $post->slug)
                ->where('category_id', $post->category_id)
                ->take(3)
                ->get();
        });
    
        // Set up SEO metadata
        $seo = [
            'title' => $post->title,
            'description' => Str::limit($post->content, 150),
            'keywords' => 'GoalTract blog, article, ' . $post->title,
            'canonical' => url()->current(),
            'og_image' => asset('images/' . ($post->image ?? 'images/whatsapp.jpeg')),
            'twitter_image' => asset('images/' . ($post->image ?? 'images/whatsapp.jpeg'))
        ];
    
        // Article Schema
        $articleSchema = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $post->title,
            "author" => [
                "@type" => "Person",
                "name" => 'Goaltract'
            ],
            "datePublished" => $post->created_at->toIso8601String(),
            "dateModified" => $post->updated_at->toIso8601String(),
            "image" => asset('images/posts/' . $post->image_url),
            "mainEntityOfPage" => url()->current(),
            "publisher" => [
                "@type" => "Organization",
                "name" => "GoalTract",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('images/logo.png')
                ]
            ]
        ];
    
        return view('blog.blog_show', compact('post', 'relatedPosts', 'seo', 'articleSchema'));
    }

      public function filterPosts(Request $request)
    {
        //$posts = Posts::latest()->paginate(6); // Pagination for blog index
        // Validate the request
            $request->validate([
                'category' => 'required|exists:categories,id', // Ensure category exists
            ]);
        
            // Get posts by selected category
            $catid = $request->category;
            $categorynamex = PostCategories::where('id',$catid)->pluck('name');
            foreach($categorynamex as $categoryname);
            $categories = PostCategories::orderBy('id','desc')->get();

            $posts = Posts::where('category_id', $request->category)->paginate(60); // Adjust the column name if needed

        
        $seo = [
            'title' => $categoryname . ' Posts on GoalTract.com - Insights, Tips, and Updates',
            'description' => 'Discover the latest blog posts on ' . $categoryname . ' covering topics like community, goals, and social connections.',
            'keywords' => 'GoalTract blog, articles, insights, tips, community',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];

        return view('blog.index', compact('posts','seo','categories'));
    }
    
  public function postsByCategory($name)
    {
        // Define cache keys for posts and categories
        $cacheKeyPosts = 'posts_category_' . $name;
        $cacheKeyCategories = 'post_categories';
    
        // Define the cache duration
        $cacheDuration = config('cache.default_cache_duration');
    
        // Fetch the category ID for the given name from cache or database
        $categoryId = Cache::remember('category_id_' . $name, $cacheDuration, function () use ($name) {
            return PostCategories::where('name', $name)->pluck('id')->first();
        });
    
        // Check if the category exists, if not throw a 404 error
        if (!$categoryId) {
            abort(404, 'Category not found');
        }
    
        // Fetch posts in the category from cache or database
        $posts = Cache::remember($cacheKeyPosts, $cacheDuration, function () use ($categoryId) {
            return Posts::where('category_id', $categoryId)->paginate(60);
        });
    
        // Fetch categories from cache or database
        $categories = Cache::remember($cacheKeyCategories, $cacheDuration, function () {
            return PostCategories::orderBy('id', 'desc')->get();
        });
    
        // SEO metadata
        $seo = [
            'title' => $name . ' Posts on GoalTract.com - Insights, Tips, and Updates',
            'description' => 'Discover the latest blog posts on ' . $name . ' covering topics like community, goals, and social connections.',
            'keywords' => 'GoalTract blog, articles, insights, tips, community',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];
    
        return view('blog.index', compact('posts', 'seo', 'categories'));
    }

    
  
      // Store a comment
      public function storeComment(Request $request, $postId)
      {
          $request->validate([
              'user_name' => 'required|string|max:255',
              'content' => 'required|string|max:2000',
          ]);
  
          Comments::create([
              'posts_id' => $postId,
              'user_name' => $request->user_name,
              'content' => $request->content,
          ]);
  
          return redirect()->route('blog.show', $postId)->with('success', 'Comment posted successfully!');
      }


    public function getmenuitems()
    {
        $menus = Menu::orderBy('order')->get();
        return view('mylayout', compact('menus'));
    }

     // Show the contact form
     public function contact()
     {
        $seo = [
            'title' => 'Contact Us - GoalTract',
            'description' => 'Get in touch with the GoalTract team. We are here to help you connect with communities and achieve your goals.',
            'keywords' => 'GoalTract contact, get in touch, support, help',
            'canonical' => url()->current(),
            'og_image' => asset('images/whatsapp.jpeg'),
            'twitter_image' => asset('images/whatsapp.jpeg')
        ];

        return view('contact', compact('seo'));
     }


     public function submitContactForm(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        // Get the user's IP address
        $userIp = $request->ip();
    
        // Check if the user has sent more than 2 messages today
        $messageCountToday = Contact::where('user_ip', $userIp)
                                    ->whereDate('created_at', Carbon::today())
                                    ->count();
    
        if ($messageCountToday >= 2) {
                    return redirect()->back()->with('error', 'You have exhausted your message limits for today. Try again tomorrow.!');
            
        }
    
        // Sanitize the message
        $data = $request->only('name', 'email', 'message');
        $data['message'] = strip_tags($data['message']); // Remove HTML tags
    
        // Check for JavaScript or other harmful content
        if (preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $data['message']) ||
            preg_match('/(onerror|onclick|onload|alert|javascript:)/i', $data['message'])) {
            return redirect()->back()->withErrors(['message' => 'Message contains disallowed content.']);
        }
    
        // Add IP address
        $data['user_ip'] = $userIp;
    
        // Debugging: Log the data including the IP address
        \Log::info('Contact form data with IP:', $data);
    
        // Save the message
        Contact::create($data);
    
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }


    










}
