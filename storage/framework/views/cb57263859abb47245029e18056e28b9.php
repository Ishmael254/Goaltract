<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/whatsapp.jpeg" type="image/x-icon">

    <!-- Dynamic SEO Metadata -->
    <title><?php echo e($seo['title'] ?? 'Goaltract.com'); ?></title>
    <meta name="description" content="<?php echo e($seo['description'] ?? 'Default description for the page.'); ?>">
    <meta name="keywords" content="<?php echo e($seo['keywords'] ?? 'default, keywords'); ?>">
    <link rel="canonical" href="<?php echo e($seo['canonical'] ?? url()->current()); ?>">

    <!-- Open Graph Metadata (for social media sharing) -->
    <meta property="og:title" content="<?php echo e($seo['title'] ?? 'Default Page Title'); ?>">
    <meta property="og:description" content="<?php echo e($seo['description'] ?? 'Default description for the page.'); ?>">
    <meta property="og:image" content="<?php echo e($seo['og_image'] ?? asset('/images/whatsapp.jpeg')); ?>">
    <meta property="og:url" content="<?php echo e($seo['canonical'] ?? url()->current()); ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seo['title'] ?? 'Default Page Title'); ?>">
    <meta name="twitter:description" content="<?php echo e($seo['description'] ?? 'Default description for the page.'); ?>">
    <meta name="twitter:image" content="<?php echo e($seo['twitter_image'] ?? asset('images/default-twitter-image.jpg')); ?>">

    <!-- Robots Meta Tag -->
    <meta name="robots" content="index, follow">

    <!-- Stylesheets and other resources -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
        }
         /* Search form styling */
         #searchForm {
            display: none;
            align-self: center;
            padding: 10px;
            background-color: #fff;
            position: absolute;
            top: 100%;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Sticky Navbar */
        .navbar {
            /* background-color: #28a745; */
            background-color: green;

            color: #fff;
            padding: 10px;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
            transition: color 0.3s ease;

        }
        .navbar-nav .nav-link:hover {
            color: #28a745;
        }
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-toggler-icon {
            background-color: #fff;
        }
        .hero-section {
            background-color: #28a745;
            color: #fff;
            padding: 30px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }
        .hero-section p {
            font-size: 1.2em;
        }
        
        /* Hover effect for the 'Add Group' button */
        .navbar-nav .btn-primary {
            background-color: #fff;
            color: #28a745;
            border-color: #007bff;
            transition: background-color 0.3s ease, color 0.3s ease;
            border: 2px solid #28a745;
            padding: 10px 20px;
            font-weight: bold;
        }

        .navbar-nav .btn-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .group-section {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .group-title {
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            background-color: #28a745;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .footer a {
            color: #fff;
            text-decoration: none;
        }
                
    </style>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8710537618632255"
     crossorigin="anonymous"></script>
     
     <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZRT5WH1212"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZRT5WH1212');
</script>

</head>
<body>

<!-- Sticky Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('/')); ?>"">GoalTract</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('/')); ?>">Home</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('groups')); ?>">Whatsapp Groups</a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('posts')); ?>">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('contact')); ?>">Contact</a>
                </li>
                

                <li class="nav-item">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(url('blogposts')); ?>">Add Group</a>
                </li class="nav-item">
            </ul>
        </div>
    </div> 
        
</nav>


<main class="py-0">
    <?php echo $__env->yieldContent('content'); ?>
</main>
<!-- Footer -->
<div class="footer mt-5" id="contact" style="background-color: #28a745; color: #fff; padding: 30px 0;">
    <div class="container">
        <div class="row">
            <!-- Logo and Description -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">GoalTract</h5>
                <p>Connecting you to the communities you care about through WhatsApp groups. Join us to find your tribe!</p>
            </div>
            <!-- Footer Links -->
            <div class="col-6 col-md-2 mb-3">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo e(route('/')); ?>" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">Add Group</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>" class="text-white">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <h6 class="fw-bold">About</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">About Us</a></li>
                    <li><a href="<?php echo e(route('blogposts')); ?>" class="text-white">Blog</a></li>
                    <li><a href="#" class="text-white">Terms & Conditions</a></li>
                </ul>
            </div>
            <!-- Social Links -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Stay Connected</h6>
                <p>Email : contact@goaltract.com</p>
                <p>WhatsApp : +254728880947</p>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        </div>
        <hr style="border-top: 1px solid #fff;">
        <p class="text-center mb-0">&copy; 2024 GoalTract.com | All rights reserved</p>
    </div>
</div>

<!-- Bootstrap and FontAwesome Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


</body>
</html>
<?php /**PATH C:\Users\Prince\Desktop\GoalTract\resources\views/layouts/mylayout.blade.php ENDPATH**/ ?>