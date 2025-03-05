@extends('layouts.mylayout')
@section('content')

<style>
    .group-detail-section {
        background-color: #f9f9f9;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .group-detail-header {
        color: #ffffff;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 20px;
    }
    .group-description {
        color: #555;
        font-size: 1.2rem;
        line-height: 1.6;
    }
    .join-button {
        display: inline-block;
        background-color: #28a745;
        color: #fff;
        padding: 12px 24px;
        border-radius: 8px;
        transition: box-shadow 0.3s;
    }
    .join-button:hover {
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.6);
    }
    .content-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            min-width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content-table th, .content-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .content-table th {
            background-color: #28a745; /* Example: green header */
            color: white;
            font-weight: bold;
        }

        .content-table tr:nth-child(even) {
            background-color: #f3f3f3;
        }
        /* Button-like link style */
        .button-link {
            display: inline-block;
            background-color: #28a745; /* Green background */
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .button-link:hover {
            background-color: #218838; /* Darker green on hover */
        }
       /* Target SVG emojis specifically within table cells */
        td img[src*="s.w.org/images/core/emoji"] {
            width: 20px; /* Adjust the width to your preference */
            height: 20px; /* Ensure they are square */
            max-width: 100%; /* Makes it responsive */
        }
        .toc-container {
            max-width: 100%;
            margin: 10px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .toc-title {
            background-color: green;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toc-content {
            background-color: #f5f5f5;
            padding: 10px 15px;
        }

        .toc-item {
            list-style: none;
            margin-left: 10px;
        }

        .toc-item a {
            text-decoration: none;
            color: #333;
            display: inline-block;
            padding: 5px;
        }

        .toc-item a:hover {
            text-decoration: underline;
        }

        html {
            scroll-behavior: smooth;
        }
        h2, h3, h4 {
        background-color: green; /* Green background color */
        color: white;            /* White text color */
        padding: 10px;          /* Optional: add some padding for better appearance */
        border-radius: 5px;     /* Optional: rounded corners */
        }

        /* Optional: Add some margin to separate the headings from surrounding content */
        h2 {
            margin-top: 20px; /* Adjust as needed */
        }

        h3 {
            margin-top: 15px; /* Adjust as needed */
        }

        h4 {
            margin-top: 10px; /* Adjust as needed */
        }


</style>

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


<div class="container mt-5 group-detail-section">

    <h2 class="group-detail-header">{{ $content->page_name }}</h2>

    <script>
    function toggleToc() {
        const tocContent = document.getElementById("toc-content");
        const tocToggleIcon = document.getElementById("toc-toggle-icon");

        if (tocContent.style.display === "none") {
            tocContent.style.display = "block";
            tocToggleIcon.textContent = "−"; // Change to minus sign when open
        } else {
            tocContent.style.display = "none";
            tocToggleIcon.textContent = "+"; // Change to plus sign when closed
        }
    }
</script>
        <br>
        <div class="toc-container">
    <div class="toc-title" onclick="toggleToc()">
        <span>Table of Contents</span>
        <span id="toc-toggle-icon">+</span>
    </div>
    <div id="toc-content" class="toc-content" style="display: none;">
        <ul>
            <!-- This will be dynamically populated based on your TOC array -->
            @foreach($toc as $item)
                <li class="toc-item toc-{{ $item['level'] }}">
                    <a href="#{{ $item['id'] }}">{{ $item['text'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"-->
<!--     crossorigin="anonymous"></script>-->
<!--<ins class="adsbygoogle"-->
<!--     style="display:block; text-align:center;"-->
<!--     data-ad-layout="in-article"-->
<!--     data-ad-format="fluid"-->
<!--     data-ad-client="ca-pub-8710537618632255"-->
<!--     data-ad-slot="3543061432"></ins>-->
<!--<script>-->
<!--     (adsbygoogle = window.adsbygoogle || []).push({});-->
<!--</script>-->

<!--<div class="content">-->
<!--    {!! $content->content !!}-->
<!--</div>-->

 @php
            // Assuming $content->content is a string of content
            $contentString = $content->content ?? 'No content available';
            
            // Define your AdSense ad code
            $adsenseAd = '<div class="adsense-ad"> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
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
            </script> </div>';
            
            // Regular expression to find headers (h1, h2, h3, etc.)
            $headerRegex = '/(<h[1-6][^>]*>.*?<\/h[1-6]>)/i';
        
            // Initialize variables to control ad frequency
            $adFrequency = 1; // Show an ad after every 4 headers
            $headerCount = 0;
        
            // Use preg_replace_callback to insert the AdSense ad after the specified number of headers
            $modifiedContent = preg_replace_callback($headerRegex, function($matches) use ($adsenseAd, &$headerCount, $adFrequency) {
                $headerCount++;
                
                // Add the ad after the specified number of headers
                $result = $matches[0]; // Keep the header
        
                if ($headerCount % $adFrequency == 0) {
                    $result .= $adsenseAd; // Add ad after the header
                }
        
                return $result;
            }, $contentString);
        @endphp
        
        {!! $modifiedContent !!}



<script>
function toggleToc() {
    const tocContent = document.getElementById('toc-content');
    tocContent.style.display = tocContent.style.display === 'none' ? 'block' : 'none';
}
</script>

        
       
</div>

@endsection
