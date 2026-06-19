<?php
require_once 'includes/config.php';
$page_title = 'Insights';
require_once 'includes/header.php';

// Get case studies
$case_studies = $conn->query("SELECT * FROM case_studies ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

// Get blog posts
$blog_posts = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>

<!-- Hero Section -->
<section class="insights-hero">
    <div class="hero-container-wide">
        <div class="hero-content-insights">
            <h1>Insights</h1>
            <p>Case Studies & Blog - Latest news and success stories</p>
        </div>
    </div>
</section>

<!-- Case Studies Section -->
<section class="case-studies-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Success Stories</span>
            <h2 class="section-title">Featured <span class="highlight">Case Studies</span></h2>
            <p class="section-subtitle">Real success stories from our clients</p>
        </div>
        
        <div class="case-studies-grid">
            <?php foreach($case_studies as $case): ?>
            <div class="case-card">
                <div class="case-image">
                    <img src="<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['title']); ?>">
                    <div class="case-category"><?php echo htmlspecialchars($case['industry']); ?></div>
                </div>
                <div class="case-content">
                    <h3><?php echo htmlspecialchars($case['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($case['challenge'], 0, 120)) . '...'; ?></p>
                    <div class="case-stats">
                        <div class="case-stat">
                            <i class="fas fa-chart-line"></i>
                            <span>Success Rate: 98%</span>
                        </div>
                    </div>
                    <a href="case-study.php?id=<?php echo $case['id']; ?>" class="case-btn">Read Full Case Study →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="blog-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Latest Updates</span>
            <h2 class="section-title">Recent <span class="highlight">Blog Posts</span></h2>
            <p class="section-subtitle">Expert insights and industry updates</p>
        </div>
        
        <div class="blog-grid">
            <?php foreach($blog_posts as $blog): ?>
            <div class="blog-card">
                <div class="blog-image">
                    <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                    <div class="blog-category">Article</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($blog['author']); ?></span>
                        <span><i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($blog['created_at'])); ?></span>
                    </div>
                    <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr(strip_tags($blog['content']), 0, 100)) . '...'; ?></p>
                    <a href="blog.php?id=<?php echo $blog['id']; ?>" class="blog-btn">Read Full Article →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="newsletter-container">
        <div class="newsletter-content">
            <i class="fas fa-envelope-open-text"></i>
            <h2>Subscribe to Our Newsletter</h2>
            <p>Get the latest insights, case studies, and AI trends delivered to your inbox</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address">
                <button type="submit">Subscribe <i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-insights">
    <div class="cta-container-wide">
        <div class="cta-content">
            <h2>Want to Share Your Success Story?</h2>
            <p>Contact us to feature your business as a case study</p>
            <a href="/ai_solutions/contact.php" class="cta-btn-insights">Get in Touch →</a>
        </div>
    </div>
</section>

<style>
/* Insights Page Styles */
.insights-hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 100px 40px;
    text-align: center;
    color: white;
}

.insights-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.insights-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.container-wide {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-tag {
    display: inline-block;
    background: #e3f2fd;
    color: #1a73e8;
    padding: 6px 18px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.section-title {
    font-size: 2.5rem;
    color: #1e1e2e;
    margin-bottom: 15px;
}

.section-title .highlight {
    color: #1a73e8;
}

.section-subtitle {
    color: #666;
    max-width: 700px;
    margin: 0 auto;
    font-size: 1rem;
}

/* Case Studies Section */
.case-studies-section {
    padding: 100px 0;
    background: white;
}

.case-studies-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.case-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid #eef2f6;
}

.case-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border-color: #1a73e8;
}

.case-image {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.case-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.case-card:hover .case-image img {
    transform: scale(1.05);
}

.case-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #1a73e8;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.case-content {
    padding: 25px;
}

.case-content h3 {
    font-size: 1.3rem;
    margin-bottom: 12px;
    color: #1e1e2e;
    line-height: 1.4;
}

.case-content p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.case-stats {
    margin-bottom: 20px;
}

.case-stat {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e3f2fd;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    color: #1a73e8;
}

.case-btn {
    display: inline-block;
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s;
}

.case-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(26,115,232,0.3);
}

/* Blog Section */
.blog-section {
    padding: 100px 0;
    background: #f8fafc;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.blog-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid #eef2f6;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border-color: #1a73e8;
}

.blog-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.blog-card:hover .blog-image img {
    transform: scale(1.05);
}

.blog-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #28a745;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.blog-content {
    padding: 25px;
}

.blog-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 12px;
    font-size: 0.75rem;
    color: #888;
}

.blog-meta i {
    margin-right: 5px;
    color: #1a73e8;
}

.blog-content h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #1e1e2e;
    line-height: 1.4;
}

.blog-content p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.blog-btn {
    display: inline-block;
    color: #1a73e8;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
}

.blog-btn:hover {
    text-decoration: underline;
}

/* Newsletter Section */
.newsletter-section {
    padding: 80px 20px;
    background: linear-gradient(135deg, #1e1e2e, #16213e);
}

.newsletter-container {
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
}

.newsletter-content i {
    font-size: 3rem;
    color: #60a5fa;
    margin-bottom: 20px;
}

.newsletter-content h2 {
    font-size: 2rem;
    color: white;
    margin-bottom: 15px;
}

.newsletter-content p {
    color: #cbd5e1;
    margin-bottom: 30px;
}

.newsletter-form {
    display: flex;
    gap: 15px;
    max-width: 500px;
    margin: 0 auto;
}

.newsletter-form input {
    flex: 1;
    padding: 14px 20px;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
}

.newsletter-form input:focus {
    outline: none;
}

.newsletter-form button {
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.newsletter-form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(26,115,232,0.3);
}

/* CTA Section */
.cta-section-insights {
    background: linear-gradient(135deg, #1a73e8, #0d47a1);
    padding: 80px 40px;
    text-align: center;
}

.cta-container-wide {
    max-width: 800px;
    margin: 0 auto;
}

.cta-content h2 {
    font-size: 2.2rem;
    color: white;
    margin-bottom: 15px;
}

.cta-content p {
    color: #cbd5e1;
    margin-bottom: 30px;
    font-size: 1rem;
}

.cta-btn-insights {
    display: inline-block;
    background: white;
    color: #1a73e8;
    padding: 14px 35px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s;
}

.cta-btn-insights:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 30px;
    }
}

@media (max-width: 992px) {
    .case-studies-grid, .blog-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    
    .insights-hero {
        padding: 60px 20px;
    }
    
    .insights-hero h1 {
        font-size: 2rem;
    }
    
    .case-studies-grid, .blog-grid {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .newsletter-form {
        flex-direction: column;
    }
    
    .case-image, .blog-image {
        height: 200px;
    }
}
</style>

<?php require_once 'includes/footer.php'; ?>