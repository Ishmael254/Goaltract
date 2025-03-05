<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Models\Content; // Assuming you have a Group model
use App\Models\Posts;  // Assuming you have a Post model
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function generate()
    {
        $urls = [
            [
                'loc' => URL::route('/'), 
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '1.0',
            ],            
            [
                'loc' => URL::route('groups'),
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '0.8',
            ],
            [
                'loc' => URL::route('contact'),
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '0.7',
            ],
            [
                'loc' => URL::route('blogposts'),
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '0.8',
            ],
            [
                'loc' => URL::route('privacy'),
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '0.6',
            ],
        ];

        // Dynamic URLs for Groups
        $groups = Content::where('page_name', '!=', 'welcome')->get();
        // Make sure Group is imported at the top
        foreach ($groups as $group) {
            $urls[] = [
                'loc' => URL::route('viewgroup', ['groupslug' => $group->slug]),
                'lastmod' => $group->updated_at->toAtomString(),
                'priority' => '0.7',
            ];
        }

        // Dynamic URLs for Blog Posts
        $posts = Posts::all(); // Make sure Post is imported at the top
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => URL::route('blog.show', ['postslug' => $post->slug]),
                'lastmod' => $post->updated_at->toAtomString(),
                'priority' => '0.8',
            ];
        }

        // Generate XML
        $xml = view('sitemap', compact('urls'));

        return response($xml)->header('Content-Type', 'application/xml');
    }
}
