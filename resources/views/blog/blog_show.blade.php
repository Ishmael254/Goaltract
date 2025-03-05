@extends('layouts.mylayout')

@section('content')
<script type="application/ld+json">
        {!! json_encode($articleSchema) !!}
    </script>
    
<div class="container py-5">
    <a href="{{ route('blogposts') }}" class="text-success" style="font-weight: bold;">
        <i class="fas fa-arrow-left"></i> Back to Blog
    </a><br><br>
    
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="text-center mb-4">
                <h1 class="display-4 text-success" style="font-weight: bold;">{{ $post->title }}</h1>
                <p class="text-muted">Published on {{ $post->created_at->format('M d, Y') }}</p>
            </div>
            
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
                 crossorigin="anonymous"></script>
            <ins class="adsbygoogle"
                 style="display:block; text-align:center;"
                 data-ad-layout="in-article"
                 data-ad-format="fluid"
                 data-ad-client="ca-pub-8710537618632255"
                 data-ad-slot="3543061432"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            
            <div class="mb-4" style="overflow: hidden;"><center>
                <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="width:80%; height: 300px; object-fit: cover;"></center>
            </div>
            
            
            <style>
                .rounded {
                    border-radius: 15px;
                }
                .related-posts {
                    margin-top: 40px;
                }
                .related-post {
                    margin-bottom: 20px;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    padding: 10px;
                    transition: box-shadow 0.3s;
                }
                .related-post:hover {
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                }
                .related-post img {
                    max-height: 150px;
                    object-fit: cover;
                    border-radius: 10px;
                }
            </style>

            <!--<div class="post-content" style="font-size: 1.00rem; color: #333;">-->
            <!--    {!! $post->content ?? 'No content available' !!}-->
            <!--</div>-->
            
            @php
                // Get the content from the post
                $contentString = $post->content ?? 'No content available';
            
                // Define your AdSense ad code
                $adsenseAd = '<div class="adsense-ad">
                                  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
                                         crossorigin="anonymous"></script>
                                    <ins class="adsbygoogle"
                                         style="display:block; text-align:center;"
                                         data-ad-layout="in-article"
                                         data-ad-format="fluid"
                                         data-ad-client="ca-pub-8710537618632255"
                                         data-ad-slot="3543061432"></ins>
                                    <script>
                                         (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                              </div>';
            
                // Split content into paragraphs
                $paragraphs = explode('</p>', $contentString);
                $modifiedContent = '';
            
                foreach ($paragraphs as $index => $paragraph) {
                    $modifiedContent .= $paragraph . '</p>'; // Re-adding the closing paragraph tag
                    
                    // Insert the AdSense ad after every 4 paragraphs
                    if (($index + 1) % 4 == 0) {
                        $modifiedContent .= $adsenseAd; // Append the ad after every 4 paragraphs
                    }
                }
            @endphp
            
            <div class="post-content" style="font-size: 1.00rem; color: #333;">
                {!! $modifiedContent !!}
            </div>

            
            <div class="mt-5">
                <h4 class="text-success">Share this article:</h4>
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" class="btn btn-outline-success rounded-circle mr-2" title="Share on WhatsApp" onclick="shareOnWhatsApp()">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary rounded-circle ml-2" title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-info rounded-circle ml-2" title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}&summary={{ urlencode(Str::limit($post->content, 150)) }}" target="_blank" class="btn btn-outline-success rounded-circle ml-2" title="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <script>
                function shareOnWhatsApp() {
                    const currentUrl = '{{ request()->fullUrl() }}';
                    const text = encodeURIComponent("Check out this article: " + currentUrl);
                    window.open('https://api.whatsapp.com/send?text=' + text, '_blank');
                }
            </script>

                 <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
                 crossorigin="anonymous"></script>
            <ins class="adsbygoogle"
                 style="display:block; text-align:center;"
                 data-ad-layout="in-article"
                 data-ad-format="fluid"
                 data-ad-client="ca-pub-8710537618632255"
                 data-ad-slot="3543061432"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <!-- Related Posts Section -->
            <div class="related-posts">
                <h3 class="text-success" style="font-weight: bold;">Related Posts</h3>
                @if($relatedPosts->count() > 0)
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-4">
                                <div class="related-post">
                                    <img src="{{ asset($relatedPost->image_url) }}" alt="{{ $relatedPost->title }}" class="img-fluid">
                                    <h5 class="mt-2">{{ $relatedPost->title }}</h5>
                                    <div class="card-footer bg-transparent text-center">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="btn btn-success btn-block" style="width: 80%; font-weight: bold; color: white; background-color: #32CD32; border-radius: 25px;">Read More</a>
                                    </div>
                                    <!--<p class="text-muted">Published on {{ $relatedPost->created_at->format('M d, Y') }}</p>-->
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No related posts for now.</p>
                @endif
            </div>

            <!-- Comments Section -->
            <div class="mt-5">
                <h3 class="text-success" style="font-weight: bold;">Comments</h3>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="user_name" class="form-control mb-3" placeholder="Your Name" required>
                                <textarea class="form-control" name="content" rows="4" placeholder="Leave a comment..." required></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success" style="border-radius: 20px;">Submit Comment</button>
                        </form>
                    </div>
                </div>

                @foreach($post->comments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 style="font-weight: bold; color: #2F4F4F;">{{ $comment->user_name }}</h5>
                            <p>{{ $comment->content }}</p>
                            <p class="text-muted"><small>Posted on {{ $comment->created_at->format('M d, Y') }}</small></p>
                        </div>
                    </div>
                @endforeach
            </div>           

        </div>
    </div>
</div>
@endsection
