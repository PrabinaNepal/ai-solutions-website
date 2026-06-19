<?php
require_once 'includes/config.php';
$page_title = 'Home';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-container">
        <div class="hero-content">
            <h1>AI-Powered Solutions for a<br><span class="highlight">Better Workplace</span></h1>
            <p>We help businesses improve productivity through smart AI technologies, automation, and digital transformation solutions tailored for modern workplaces.</p>
            <div class="hero-buttons">
                <a href="/ai_solutions/solutions.php" class="btn-primary">Explore Solutions →</a>
                <a href="/ai_solutions/contact.php" class="btn-outline">Contact Us</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Projects Delivered</span>
                </div>
                <div class="stat">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Client Satisfaction</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Support Available</span>
                </div>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=500&fit=crop" alt="AI Technology">
            
        </div>
    </div>
</section>

<!-- Trusted By -->
<section class="trusted-section">
    <div class="container-wide">
        <p class="trusted-label">TRUSTED BY INNOVATIVE COMPANIES WORLDWIDE</p>
        <div class="trusted-logos">
            <div class="logo-item"><img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google"> Google</div>
            <div class="logo-item"><img src="https://cdn-icons-png.flaticon.com/512/732/732221.png" alt="Microsoft"> Microsoft</div>
            <div class="logo-item"><img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="Amazon"> Amazon</div>
            <div class="logo-item"><img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Apple"> Apple</div>
            <div class="logo-item"><img src="https://cdn-icons-png.flaticon.com/512/5968/5968880.png" alt="Salesforce"> Salesforce</div>
        </div>
    </div>
</section>

<!-- Mission -->
<section class="mission">
    <div class="container-wide">
        <div class="mission-wrapper">
            <div class="mission-icon">
                <i class="fas fa-bullseye"></i>
            </div>
            <div class="mission-text">
                <h2>Our Mission</h2>
                <p>To innovate, promote, and deliver the future of the digital employee experience — making AI-powered solutions accessible, affordable, and impactful for businesses worldwide.</p>
            </div>
            <div class="mission-icon">
                <i class="fas fa-globe"></i>
            </div>
        </div>
    </div>
</section>

<!-- What Makes Us Different -->
<section class="features">
    <div class="container-wide">
        <div class="section-header">
            <span class="tag">Why Choose Us</span>
            <h2>What Makes Us <span class="highlight">Different?</span></h2>
            <p>We combine cutting-edge AI technology with deep industry expertise to deliver solutions that truly make a difference.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-img">
                    <img src="https://images.unsplash.com/photo-1531746790731-6c087fecd65a?w=500&h=280&fit=crop" alt="AI Virtual Assistant">
                </div>
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3>AI-Powered Virtual Assistant</h3>
                <p>Our intelligent virtual assistant responds to user inquiries, automates repetitive tasks, and seamlessly transfers complex cases to human staff.</p>
                <a href="/ai_solutions/solutions.php">Learn more →</a>
            </div>
            <div class="feature-card">
                <div class="feature-img">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&h=280&fit=crop" alt="Rapid Prototyping">
                </div>
                <div class="feature-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3>Rapid Prototyping</h3>
                <p>We turn your ideas into working prototypes quickly and affordably, helping you test concepts and accelerate time-to-market.</p>
                <a href="/ai_solutions/solutions.php">Learn more →</a>
            </div>
            <div class="feature-card">
                <div class="feature-img">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=280&fit=crop" alt="Employee Experience">
                </div>
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Employee Experience Focus</h3>
                <p>Every solution we build is designed around people — improving productivity, satisfaction, and engagement across your entire workforce.</p>
                <a href="/ai_solutions/solutions.php">Learn more →</a>
            </div>
        </div>
    </div>
</section>

<!-- Our Solutions -->
<section class="solutions">
    <div class="container-wide">
        <div class="section-header">
            <span class="tag">Our Solutions</span>
            <h2>Comprehensive <span class="highlight">AI Solutions</span></h2>
            <p>Discover how our AI solutions can transform your business</p>
        </div>
        <div class="solutions-grid">
            <div class="solution-card">
                <img src="https://images.unsplash.com/photo-1581091226033-d5c48150dbaa?w=500&h=280&fit=crop" alt="AI Automation">
                <h3>AI Automation</h3>
                <p>Automate repetitive tasks and workflows with intelligent AI agents that learn and adapt.</p>
                <div class="solution-features">
                    <span>✓ 24/7 Operation</span>
                    <span>✓ 99.9% Accuracy</span>
                    <span>✓ Real-time Analytics</span>
                </div>
                <a href="/ai_solutions/solution-details.php?id=1" class="solution-btn">Get Started →</a>
            </div>
            <div class="solution-card">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&h=280&fit=crop" alt="Data Intelligence">
                <h3>Data Intelligence</h3>
                <p>Transform raw data into actionable business insights with advanced analytics.</p>
                <div class="solution-features">
                    <span>✓ Real-time Dashboards</span>
                    <span>✓ Predictive Analytics</span>
                    <span>✓ Custom Reports</span>
                </div>
                <a href="/ai_solutions/solution-details.php?id=2" class="solution-btn">Get Started →</a>
            </div>
            <div class="solution-card">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=280&fit=crop" alt="Employee Experience">
                <h3>Employee Experience</h3>
                <p>Enhance employee satisfaction and productivity with AI-powered tools.</p>
                <div class="solution-features">
                    <span>✓ Personalized Insights</span>
                    <span>✓ Engagement Metrics</span>
                    <span>✓ Feedback Analysis</span>
                </div>
                <a href="/ai_solutions/solution-details.php?id=3" class="solution-btn">Get Started →</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="cta-container-wide">
        <div class="cta-content">
            <h2>Ready to Transform Your Digital Workplace?</h2>
            <p>Let's build intelligent solutions that drive your business forward.</p>
            <div class="cta-buttons">
                <a href="/ai_solutions/contact.php" class="btn-white">Get in Touch →</a>
                <a href="/ai_solutions/solutions.php" class="btn-transparent">View Solutions →</a>
            </div>
        </div>
        <div class="cta-image">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=350&fit=crop" alt="Team Collaboration">
        </div>
    </div>
</section>

<style>
/* ============================================
   HOMEPAGE STYLES - FULL WIDTH (1400px)
============================================ */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #1a1a2e;
    line-height: 1.6;
}

/* FULL WIDTH CONTAINER - Same as Solutions Page */
.container-wide {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 100px 40px;
    color: white;
}

.hero-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.hero-content h1 {
    font-size: 3rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
}

.hero-content .highlight {
    color: #60a5fa;
}

.hero-content p {
    font-size: 1.1rem;
    color: #cbd5e1;
    margin-bottom: 30px;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.btn-primary {
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(26,115,232,0.3);
}

.btn-outline {
    background: transparent;
    border: 2px solid #1a73e8;
    color: white;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-outline:hover {
    background: rgba(26,115,232,0.1);
}

.hero-stats {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.stat {
    text-align: left;
}

.stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 700;
    color: #60a5fa;
}

.stat-label {
    font-size: 0.85rem;
    color: #94a3b8;
}

.hero-image {
    position: relative;
}

.hero-image img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.floating-card {
    position: absolute;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid rgba(255,255,255,0.2);
    font-size: 0.8rem;
}

.float-1 { top: 20px; left: -20px; }
.float-2 { bottom: 60px; right: -20px; }
.float-3 { bottom: -20px; left: 50px; }

/* Trusted Section */
.trusted-section {
    padding: 50px 0;
    background: white;
    border-bottom: 1px solid #eef2f6;
}

.trusted-label {
    text-align: center;
    color: #888;
    font-size: 0.8rem;
    letter-spacing: 2px;
    margin-bottom: 25px;
}

.trusted-logos {
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
    align-items: center;
}

.logo-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #666;
    font-weight: 500;
    font-size: 1rem;
}

.logo-item img {
    width: 35px;
    height: 35px;
}

/* Mission Section */
.mission {
    padding: 80px 0;
    background: #f8fafc;
}

.mission-wrapper {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 30px;
    text-align: center;
    flex-wrap: wrap;
}

.mission-icon {
    width: 80px;
    height: 80px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #1a73e8;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.mission-text {
    max-width: 500px;
}

.mission-text h2 {
    font-size: 1.8rem;
    margin-bottom: 15px;
}

.mission-text p {
    color: #666;
    line-height: 1.7;
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.tag {
    display: inline-block;
    background: #e3f2fd;
    color: #1a73e8;
    padding: 5px 15px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.section-header h2 {
    font-size: 2rem;
    margin-bottom: 15px;
}

.section-header .highlight {
    color: #1a73e8;
}

.section-header p {
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

/* Features Grid */
.features {
    padding: 80px 0;
    background: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.feature-card {
    background: white;
    border: 1px solid #eef2f6;
    border-radius: 20px;
    overflow: hidden;
    transition: 0.3s;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border-color: #1a73e8;
}

.feature-img {
    height: 200px;
    overflow: hidden;
}

.feature-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s;
}

.feature-card:hover .feature-img img {
    transform: scale(1.05);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #e3f2fd, #bbdef5);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: -30px auto 20px;
    position: relative;
}

.feature-icon i {
    font-size: 1.8rem;
    color: #1a73e8;
}

.feature-card h3 {
    text-align: center;
    margin-bottom: 12px;
    padding: 0 20px;
}

.feature-card p {
    color: #666;
    text-align: center;
    margin-bottom: 20px;
    padding: 0 20px;
    font-size: 0.9rem;
    line-height: 1.6;
}

.feature-card a {
    display: block;
    text-align: center;
    color: #1a73e8;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 25px;
}

/* Solutions Grid */
.solutions {
    padding: 80px 0;
    background: #f8fafc;
}

.solutions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.solution-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.solution-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1);
}

.solution-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.solution-card h3 {
    padding: 20px 20px 10px;
    font-size: 1.2rem;
}

.solution-card p {
    padding: 0 20px 10px;
    color: #666;
    font-size: 0.9rem;
}

.solution-features {
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.solution-features span {
    font-size: 0.7rem;
    color: #1a73e8;
    background: #e3f2fd;
    padding: 3px 10px;
    border-radius: 20px;
}

.solution-btn {
    display: block;
    margin: 0 20px 20px;
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    text-align: center;
    padding: 10px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: 0.3s;
}

.solution-btn:hover {
    transform: translateY(-2px);
}

/* CTA Section */
.cta {
    background: linear-gradient(135deg, #1a73e8, #0d47a1);
    padding: 80px 40px;
}

.cta-container-wide {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.cta-content h2 {
    font-size: 2rem;
    color: white;
    margin-bottom: 15px;
}

.cta-content p {
    color: #cbd5e1;
    margin-bottom: 30px;
}

.cta-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-white {
    background: white;
    color: #1a73e8;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.btn-transparent {
    background: transparent;
    border: 2px solid white;
    color: white;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-transparent:hover {
    background: rgba(255,255,255,0.1);
}

.cta-image img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 30px;
    }
}

@media (max-width: 992px) {
    .hero-container {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 50px;
    }
    .hero-stats {
        justify-content: center;
    }
    .hero-buttons {
        justify-content: center;
    }
    .features-grid,
    .solutions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .cta-container-wide {
        grid-template-columns: 1fr;
        text-align: center;
    }
    .cta-buttons {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    .hero {
        padding: 60px 20px;
    }
    .hero-content h1 {
        font-size: 2rem;
    }
    .features-grid,
    .solutions-grid {
        grid-template-columns: 1fr;
    }
    .floating-card {
        display: none;
    }
    .hero-stats {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    .stat {
        text-align: center;
    }
    .mission-wrapper {
        flex-direction: column;
    }
}
</style>

<?php require_once 'includes/footer.php'; ?>