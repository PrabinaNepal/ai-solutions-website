<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | AI-Solutions' : 'AI-Solutions'; ?></title>
    <link rel="stylesheet" href="/ai_solutions/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <a href="/ai_solutions/index.php" class="nav-logo">
            <div class="logo-circle">
                <span>AI</span>
            </div>
            <span class="logo-text">AI-Solutions</span>
        </a>

        <button class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="nav-links">
            <li><a href="/ai_solutions/index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="/ai_solutions/solutions.php" class="<?php echo $current_page == 'solutions.php' ? 'active' : ''; ?>">Solutions</a></li>
            <li><a href="/ai_solutions/insights.php" class="<?php echo $current_page == 'insights.php' ? 'active' : ''; ?>">Insights</a></li>
            <li><a href="/ai_solutions/testimonials.php" class="<?php echo $current_page == 'testimonials.php' ? 'active' : ''; ?>">Testimonials</a></li>
            <li><a href="/ai_solutions/gallery.php" class="<?php echo $current_page == 'gallery.php' ? 'active' : ''; ?>">Gallery</a></li>
            <li><a href="/ai_solutions/contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact Us</a></li>
        </ul>
    </div>
</nav>