@extends('layouts.mylayout')

@section('content')

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

<script type="application/ld+json">
        {!! json_encode($organizationSchema) !!}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Discover Active WhatsApp Group Links for All Interests",
  "description": "WhatsApp is one of the most popular apps for chatting and sharing media. Joining WhatsApp groups is simple and a great way to stay connected with people who share your interests.",
  "author": {
    "@type": "Person",
    "name": "Goaltract"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Goaltract.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://example.com/logo.png"
    }
  },
  "datePublished": "2024-11-01",
  "dateModified": "2024-11-01",
  "image": "https://example.com/your-image.jpg",
  "articleBody": "Joining a WhatsApp group is simple and a great way to stay connected. Many people use WhatsApp group links to quickly join groups about different topics, hobbies, or communities. ...",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{route('/')}}"
  }
}
</script>


    <div class="container">
        <style>
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
                /* Apply styling to all tables */
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

        /* .toc {
        background: #f8f9fa;
        padding: 1em;
        margin-bottom: 2em;
        border-radius: 8px;
        }
        .toc-item {
            margin-left: 1em;
        }
        .toc-h2 { font-weight: bold; }
        .toc-h3 { margin-left: 1em; }
        .toc-h4 { margin-left: 2em; } */


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
        <br>

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
            $adFrequency = 3; // Show an ad after every 4 headers
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
        
        <div class="modified-content">
            {!! $modifiedContent !!}
        </div>
        



                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Select all links in the content
                        const links = document.querySelectorAll('.modified-content a');
                        
                        // Loop through each link
                        links.forEach(link => {
                            // Check if the link's text starts with "Click here for more"
                            if (link.textContent.trim().startsWith("Click")) {
                                // Add the "button-link" class to the link
                                link.classList.add("button-link");
                            }
                        });
                    });
                </script> 


    </div>

@endsection
