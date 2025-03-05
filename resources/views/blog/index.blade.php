{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.mylayout')

@section('content')
<div class="container py-2">
    <div class="text-center mb-3">
        <h2 class="display-4" style="color: #32CD32; font-weight: bold;">Our Blog</h2>
        <p class="lead" style="color: #555;">Discover our latest articles, insights, and resources</p>
    </div>
   
     <!--filter categories section-->
 <div class="container filter-section1 mt-3">
 <form action="{{ route('filter.posts') }}" method="POST" class="row g-3">
    @csrf <!-- Include CSRF token -->
    <div class="col-md-4">
        <select class="form-select custom-select" name="category" aria-label="Select Category" required>
            <option value="" selected disabled>All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-custom1 w-100">Filter</button>
    </div>
</form>

</div>

<style>
    .filter-section1 {
    background-color: #ffffff; /* White background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.custom-select1 {
    border: 2px solid #28a745; /* Green border */
    border-radius: 5px;
    transition: border-color 0.3s;
}

.custom-select1:focus {
    border-color: #218838; /* Darker green on focus */
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Green glow */
}

.btn-custom1 {
    background-color: #28a745; /* Green button */
    color: white; /* White text */
    border: none;
    border-radius: 5px;
    padding: 10px;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-custom1:hover {
    background-color: #218838; /* Darker green on hover */
    transform: translateY(-2px); /* Slight lift effect */
}

.btn-custom1:focus {
    outline: none; /* Remove default focus outline */
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Green glow on focus */
}

</style>

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
    <center>
    <div class="row">
         @if($posts->isEmpty())
         <br><br>
        <p>No posts found for this category.</p>
        @else
        @foreach ($posts as $index => $post)

        
        <div class="col-md-4 mt-3">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 15px;">
                    <div class="card-img-top" style="height: 200px;">
                        <img src="{{ $post->image_url ? asset($post->image_url) : 'https://via.placeholder.com/300x200' }}" class="img-fluid w-100" style="height: 100%; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;" alt="Image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="color: #2F4F2F; font-weight: bold;">{{ $post->title }}</h5>
                        <!-- <p class="card-text" style="color: #555;">{!! Str::limit($post->content, 100) !!}</p> -->
                        <p class="card-text" style="color: #555;">{{ Str::limit(html_entity_decode(strip_tags($post->content)), 150) }}</p>
                             <a href="{{ route('posts.byCategory', $post->category->name) }}" style="color: #32CD32; text-decoration: underline;">
                                Category : {{ $post->category->name ?? 'Uncategorized' }}
                            </a>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-success btn-block" style="width: 80%; font-weight: bold; color: white; background-color: #32CD32; border-radius: 25px;">Read More</a>

                    </div>
                </div>
            </div> 
               <!-- Show an AdSense ad after every 3 items -->
        @if (($index + 1) % 3 == 0)
          <div class="col-12 my-4">
            <!-- AdSense Ad Code -->
            <div class="adsense-ad">
              <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
                      crossorigin="anonymous"></script>
              <!-- Insert your AdSense ad here -->
              <ins class="adsbygoogle"
                   style="display:block"
                   data-ad-client="ca-pub-8710537618632255"
                   data-ad-slot="4928047871"
                   data-ad-format="auto"
                   data-full-width-responsive="true"></ins>
              <script>
                   (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
            </div>
          </div>
        @endif
            
          
            
        @endforeach
         @endif
    </div> </center>

    <div class="d-flex justify-content-center mt-5">
         <style>
      .w-5 {
        display: none;
      }
    </style>
        {{ $posts->links() }}
 
    </div>
</div>
@endsection
