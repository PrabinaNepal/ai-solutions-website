<?php
require_once 'includes/config.php';
$page_title = 'Testimonials';
require_once 'includes/header.php';

// Pagination settings
$items_per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Testimonials data with images
$all_testimonials = [
    [
        'name' => 'Sarah Johnson',
        'role' => 'CTO, TechCorp',
        'rating' => 5,
        'text' => 'AI-Solution transformed our customer service operations. The AI virtual assistant has reduced response times by 80% and our customers love it! The implementation was smooth and the team was incredibly supportive throughout.',
        'avatar' => 'https://randomuser.me/api/portraits/women/1.jpg',
        'company' => 'TechCorp'
    ],
    [
        'name' => 'Michael Chen',
        'role' => 'Product Manager, InnovateLtd',
        'rating' => 5,
        'text' => 'Helped us launch our product 3 months ahead of schedule! The prototyping solutions are amazing and the team really understands our needs. Highly recommended for any business looking to innovate quickly.',
        'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg',
        'company' => 'InnovateLtd'
    ],
    [
        'name' => 'Emma Williams',
        'role' => 'Operations Director, GlobalTech',
        'rating' => 5,
        'text' => 'Excellent support and innovative solutions. The team delivered beyond our expectations. Our workflow efficiency has improved dramatically and our employees are more productive than ever.',
        'avatar' => 'https://randomuser.me/api/portraits/women/3.jpg',
        'company' => 'GlobalTech'
    ],
    [
        'name' => 'David Kumar',
        'role' => 'CEO, DataWorks',
        'rating' => 5,
        'text' => 'Best decision we made for our digital transformation journey. The ROI has been outstanding. The AI solutions provided have helped us scale our business and serve customers better.',
        'avatar' => 'https://randomuser.me/api/portraits/men/4.jpg',
        'company' => 'DataWorks'
    ],
    [
        'name' => 'Lisa Martinez',
        'role' => 'IT Director, FinanceHub',
        'rating' => 5,
        'text' => 'The team at AI-Solution is professional, responsive, and truly experts in their field. Our security has improved and our operations are more efficient. Could not be happier!',
        'avatar' => 'https://randomuser.me/api/portraits/women/5.jpg',
        'company' => 'FinanceHub'
    ],
    [
        'name' => 'James Wilson',
        'role' => 'COO, RetailPlus',
        'rating' => 4,
        'text' => 'Great experience working with AI-Solution. They delivered a custom solution that perfectly fits our unique business needs. The support team is always available when we need them.',
        'avatar' => 'https://randomuser.me/api/portraits/men/6.jpg',
        'company' => 'RetailPlus'
    ],
    [
        'name' => 'Aisha Patel',
        'role' => 'Head of Innovation, TechForward',
        'rating' => 5,
        'text' => 'The AI Virtual Assistant has revolutionized how we handle customer support. Our team can now focus on complex issues while the AI handles routine queries efficiently.',
        'avatar' => 'https://randomuser.me/api/portraits/women/7.jpg',
        'company' => 'TechForward'
    ],
    [
        'name' => 'Robert Taylor',
        'role' => 'VP of Engineering, CloudNine',
        'rating' => 5,
        'text' => 'The rapid prototyping service helped us validate our ideas quickly and cost-effectively. We saved months of development time and launched successfully.',
        'avatar' => 'https://randomuser.me/api/portraits/men/8.jpg',
        'company' => 'CloudNine'
    ]
];

// Pagination calculation
$total_items = count($all_testimonials);
$total_pages = ceil($total_items / $items_per_page);
$current_page = max(1, min($current_page, $total_pages));
$offset = ($current_page - 1) * $items_per_page;
$testimonials = array_slice($all_testimonials, $offset, $items_per_page);
?>

<!-- Hero Section -->
<section class="testimonials-hero">
    <div class="hero-container-wide">
        <div class="hero-content-testimonials">
            <h1>Testimonials</h1>
            <p>What our clients say about AI-Solution</p>
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="testimonials-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Client Success Stories</span>
            <h2 class="section-title">What Our <span class="highlight">Clients Say</span></h2>
            <p class="section-subtitle">Trusted by businesses worldwide</p>
        </div>
        
        <div class="testimonials-grid">
            <?php foreach($testimonials as $t): ?>
            <div class="testimonial-card">
                <div class="testimonial-quote">
                    <i class="fas fa-quote-left"></i>
                </div>
                <div class="testimonial-text">
                    <p>"<?php echo htmlspecialchars($t['text']); ?>"</p>
                </div>
                <div class="testimonial-rating">
                    <?php echo str_repeat('★', $t['rating']) . str_repeat('☆', 5 - $t['rating']); ?>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="<?php echo $t['avatar']; ?>" alt="<?php echo $t['name']; ?>">
                    </div>
                    <div class="author-info">
                        <h4><?php echo $t['name']; ?></h4>
                        <p><?php echo $t['role']; ?></p>
                    </div>
                </div>
                <div class="testimonial-company">
                    <i class="fas fa-building"></i>
                    <span><?php echo $t['company']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <div class="pagination">
            <?php if($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>" class="page-btn prev">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php else: ?>
                <span class="page-btn disabled">
                    <i class="fas fa-chevron-left"></i> Previous
                </span>
            <?php endif; ?>
            
            <div class="page-numbers">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if($i == $current_page): ?>
                        <span class="page-number active"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>" class="page-number"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            
            <?php if($current_page < $total_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>" class="page-btn next">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <span class="page-btn disabled">
                    Next <i class="fas fa-chevron-right"></i>
                </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container-wide">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Available</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-testimonials">
    <div class="cta-container-wide">
        <div class="cta-content">
            <h2>Ready to Join Our Happy Clients?</h2>
            <p>Let us help you transform your business with AI solutions</p>
            <a href="/ai_solutions/contact.php" class="cta-btn-testimonials">Get Started Today →</a>
        </div>
    </div>
</section>

<style>
/* Testimonials Page Styles */
.testimonials-hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 100px 40px;
    text-align: center;
    color: white;
}

.testimonials-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.testimonials-hero p {
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

/* Testimonials Grid */
.testimonials-section {
    padding: 100px 0;
    background: white;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
}

.testimonial-card {
    background: white;
    border-radius: 24px;
    padding: 35px;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid #eef2f6;
    position: relative;
}

.testimonial-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border-color: #1a73e8;
}

.testimonial-quote {
    position: absolute;
    top: 25px;
    right: 25px;
}

.testimonial-quote i {
    font-size: 2.5rem;
    color: #e3f2fd;
}

.testimonial-text {
    margin-bottom: 20px;
    min-height: 120px;
}

.testimonial-text p {
    color: #444;
    line-height: 1.7;
    font-size: 0.95rem;
    font-style: italic;
}

.testimonial-rating {
    margin-bottom: 20px;
    color: #f59e0b;
    font-size: 1rem;
    letter-spacing: 2px;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #1a73e8;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info h4 {
    font-size: 1.1rem;
    margin-bottom: 3px;
    color: #1e1e2e;
}

.author-info p {
    font-size: 0.8rem;
    color: #666;
}

.testimonial-company {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8fafc;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    color: #1a73e8;
}

/* Stats Section */
.stats-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #1a73e8, #0d47a1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    text-align: center;
}

.stat-item {
    color: white;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 60px;
    flex-wrap: wrap;
}

.page-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #1a73e8;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
}

.page-btn:hover {
    background: #1557b0;
    transform: translateY(-2px);
}

.page-btn.disabled {
    background: #ccc;
    cursor: not-allowed;
    pointer-events: none;
}

.page-numbers {
    display: flex;
    gap: 8px;
}

.page-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #f0f2f5;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
}

.page-number:hover {
    background: #1a73e8;
    color: white;
}

.page-number.active {
    background: #1a73e8;
    color: white;
}

/* CTA Section */
.cta-section-testimonials {
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

.cta-btn-testimonials {
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

.cta-btn-testimonials:hover {
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
    .testimonials-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    
    .testimonials-hero {
        padding: 60px 20px;
    }
    
    .testimonials-hero h1 {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .stat-number {
        font-size: 1.8rem;
    }
    
    .testimonial-card {
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .pagination {
        gap: 10px;
    }
    
    .page-btn {
        padding: 8px 15px;
        font-size: 13px;
    }
    
    .page-number {
        width: 35px;
        height: 35px;
    }
}
</style>

<?php require_once 'includes/footer.php'; ?>