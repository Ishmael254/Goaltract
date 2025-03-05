@extends('layouts.mylayout')
@section('content')

<style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #fff;
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
            background: rgba(40, 167, 69, 0.7); /* Green overlay */
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
    <h1>Explore WhatsApp Groups</h1>
    <p>Find and join WhatsApp Groups that match your interests!</p>
</div>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
     crossorigin="anonymous"></script>
<!-- header -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8710537618632255"
     data-ad-slot="4928047871"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

@include('inc.searchandfilter')

<!--<div class="container my-5">-->
<!--  <center>-->
<!--    <div class="row g-4">-->
<!--      @foreach ($groups as $data)-->
<!--        <div class="col-sm-6 col-md-4">-->
<!--          <div class="group-card">-->
<!--            <h5>{{ $data->page_name }}</h5>-->
            <!-- <p>{!! Str::limit($data->content, 150) !!}</p> -->

<!--            <p>{{ Str::limit(html_entity_decode(strip_tags($data->content)), 150) }}</p>-->
<!--            <a href="{{ route('viewgroup', $data->slug) }}" class="btn btn-success btn-md">Join Groups Now</a>-->
<!--          </div>-->
<!--        </div>-->
<!--      @endforeach-->
<!--    </div>-->
<!--  </center>-->

<div class="container my-5">
  <center>
    <div class="row g-4">
      @foreach ($groups as $index => $data)
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
    </div>
  </center>
</div>



  <center>
    <div class="mt-4">
      {{ $groups->links() }}
    </div>
    <style>
      .w-5 {
        display: none;
      }
    </style>
  </center>
</div>


@endsection