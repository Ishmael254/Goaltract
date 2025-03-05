@extends('layouts.mylayout')
@section('content')

<style>
    /* General styling */
    body {
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #ffffff;
    }

    /* Hero section styling */
    .hero-section {
        background: url('images/pexels-catiamatos-1072179.jpg') no-repeat center center/cover;
        padding: 30px 0;
        color: white;
        text-align: center;
        position: relative;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(40, 167, 69, 0.7);
        /* Green overlay */
        z-index: 1;
    }

    .hero-section h1 {
        font-size: 3rem;
        z-index: 2;
        position: relative;
    }

    .hero-section p {
        z-index: 2;
        position: relative;
        font-size: 1.2rem;
    }

    /* Search and filter section */
    .filter-section {
        background-color: #28a745;
        padding: 20px;
        border-radius: 8px;
        color: white;
        text-align: center;
        margin-top: -50px;
        z-index: 2;
        position: relative;
    }

    /* Group card styling */
    .group-card {
        border: 1px solid #28a745;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        height: 100%;
    }

    .group-card:hover {
        transform: scale(1.03);
    }

    .group-card h5 {
        color: #28a745;
    }

    /* Pagination styling */
    .pagination {
        justify-content: center;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section p {
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <h1>Search results for {{$query}}</h1>
    <!-- <p>Find and join communities that match your interests!</p> -->
</div>

@include('inc.searchandfilter')


<!-- Group Listings -->
<!--<div class="container my-5">-->
<!--<center>-->
<!--  <div class="row g-4">-->
<!--    @if ($results->isEmpty())-->
<!--        <div class="col-12">-->
<!--            <p class="text-center">Nothing found.</p>-->
<!--        </div>-->
<!--    @else-->
<!--        @foreach ($results as $data)-->
<!--            <div class="col-md-4">-->
<!--                <div class="group-card">-->
<!--                    <h5>{{ $data->page_name }}</h5>-->
                    <!-- <p>Brief description of the group. Connect with like-minded people.</p> -->
<!--                    <p>{!! Str::limit($data->content, 140) !!}</p>-->

<!--                    <a href="{{ route('viewgroup', $data->slug) }}" class="btn btn-success btn-sm">Join Group</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        @endforeach-->
<!--    @endif-->

<!--    </div>-->
<!--  </center>-->

<div class="container my-5">
  <center>
    <div class="row g-4">
         @if ($results->isEmpty())
        <div class="col-12">
            <p class="text-center">Nothing found.</p>
        </div>
        @else
          @foreach ($results as $index => $data)
            <div class="col-sm-6 col-md-4">
              <div class="group-card">
                <h5>{{ $data->page_name }}</h5>
                <p>{{ Str::limit(html_entity_decode(strip_tags($data->content)), 150) }}</p>
                <a href="{{ route('viewgroup', $data->slug) }}" class="btn btn-success btn-md">Join Groups Now</a>
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
    </div>
  </center>
</div>

  
    <!-- Pagination -->
    <center>
  <div class="mt-4">
                {{ $results->links() }}
            </div>
            <style>
                .w-5 {
                    display: none;
                }
            </style>
  </center>
</div>


@endsection