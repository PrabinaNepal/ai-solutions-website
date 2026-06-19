<?php
require_once 'includes/config.php';
$page_title = 'Solutions';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="solutions-hero">
    <div class="hero-container-wide">
        <div class="hero-content-solutions">
            <h1>Our <span class="highlight">Solutions</span></h1>
            <p>AI-powered solutions tailored to your industry needs</p>
        </div>
    </div>
</section>

<!-- What We Offer Section -->
<section class="what-we-offer">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">What We Offer</span>
            <h2 class="section-title">Comprehensive <span class="highlight">AI Solutions</span></h2>
            <p class="section-subtitle">Discover how our AI solutions can transform your business</p>
        </div>
        
        <div class="offerings-grid">
            <div class="offering-card">
                <div class="offering-image">
                    <img src="https://images.unsplash.com/photo-1581091226033-d5c48150dbaa?w=600&h=350&fit=crop" alt="AI Automation">
                    <div class="offering-overlay">
                        <i class="fas fa-robot"></i>
                    </div>
                </div>
                <div class="offering-content">
                    <div class="offering-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>AI Automation</h3>
                    <p>Automate repetitive tasks and workflows with intelligent AI agents that learn and adapt to your business processes. Reduce operational costs and improve efficiency.</p>
                    <div class="offering-features">
                        <span><i class="fas fa-check-circle"></i> 24/7 Operation</span>
                        <span><i class="fas fa-check-circle"></i> 99.9% Accuracy</span>
                        <span><i class="fas fa-check-circle"></i> Real-time Analytics</span>
                    </div>
                    <<a href="solution-details.php?id=1" class="offering-btn">Learn More →</a>
                </div>
            </div>
            
            <div class="offering-card">
                <div class="offering-image">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=350&fit=crop" alt="Data Intelligence">
                    <div class="offering-overlay">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="offering-content">
                    <div class="offering-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Data Intelligence</h3>
                    <p>Transform raw data into actionable business insights with advanced analytics and real-time reporting. Make data-driven decisions with confidence.</p>
                    <div class="offering-features">
                        <span><i class="fas fa-check-circle"></i> Real-time Dashboards</span>
                        <span><i class="fas fa-check-circle"></i> Predictive Analytics</span>
                        <span><i class="fas fa-check-circle"></i> Custom Reports</span>
                    </div>
                    <<a href="solution-details.php?id=1" class="offering-btn">Learn More →</a>
                </div>
            </div>
            
            <div class="offering-card">
                <div class="offering-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=350&fit=crop" alt="Employee Experience">
                    <div class="offering-overlay">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="offering-content">
                    <div class="offering-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Employee Experience</h3>
                    <p>Enhance employee satisfaction and productivity with AI-powered tools and personalized experiences. Boost engagement and retention.</p>
                    <div class="offering-features">
                        <span><i class="fas fa-check-circle"></i> Personalized Insights</span>
                        <span><i class="fas fa-check-circle"></i> Engagement Metrics</span>
                        <span><i class="fas fa-check-circle"></i> Feedback Analysis</span>
                    </div>
                    <<a href="solution-details.php?id=1" class="offering-btn">Learn More →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industries We Serve Section with REAL IMAGES -->
<section class="industries-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Industries We Serve</span>
            <h2 class="section-title">Trusted by <span class="highlight">Leading Industries</span></h2>
            <p class="section-subtitle">We deliver AI solutions across multiple sectors</p>
        </div>
        
        <div class="industries-grid">
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=200&h=150&fit=crop" alt="Healthcare">
                </div>
                <div class="industry-icon"><i class="fas fa-heartbeat"></i></div>
                <h3>Healthcare</h3>
                <p>AI-powered diagnostics, patient care, and administrative automation for hospitals and clinics.</p>
                
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=200&h=150&fit=crop" alt="Finance">
                </div>
                <div class="industry-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Finance</h3>
                <p>Fraud detection, risk assessment, and automated trading systems for financial institutions.</p>
                
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=200&h=150&fit=crop" alt="Retail">
                </div>
                <div class="industry-icon"><i class="fas fa-shopping-cart"></i></div>
                <h3>Retail</h3>
                <p>Personalized recommendations, inventory management, and customer insights for retailers.</p>
              
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1581091226033-d5c48150dbaa?w=200&h=150&fit=crop" alt="Manufacturing">
                </div>
                <div class="industry-icon"><i class="fas fa-industry"></i></div>
                <h3>Manufacturing</h3>
                <p>Predictive maintenance, quality control, and supply chain optimization for factories.</p>
                
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1555255707-c07966088b7b?w=200&h=150&fit=crop" alt="Telecom">
                </div>
                <div class="industry-icon"><i class="fas fa-phone"></i></div>
                <h3>Telecom</h3>
                <p>Network optimization, customer service automation, and churn prediction for telecoms.</p>
               
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=200&h=150&fit=crop" alt="Education">
                </div>
                <div class="industry-icon"><i class="fas fa-graduation-cap"></i></div>
                <h3>Education</h3>
                <p>Personalized learning, automated grading, and student analytics for educational institutions.</p>
                
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=200&h=150&fit=crop" alt="Logistics">
                </div>
                <div class="industry-icon"><i class="fas fa-truck"></i></div>
                <h3>Logistics</h3>
                <p>Route optimization, demand forecasting, and warehouse automation for logistics companies.</p>
               
            </div>
            <div class="industry-card">
                <div class="industry-image">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=200&h=150&fit=crop" alt="Hospitality">
                </div>
                <div class="industry-icon"><i class="fas fa-hotel"></i></div>
                <h3>Hospitality</h3>
                <p>Chatbots for booking, personalized guest experiences, and revenue management for hotels.</p>
               
            </div>
        </div>
    </div>
</section>

<!-- Training Section -->
<section class="training-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Training Programs</span>
            <h2 class="section-title">AI <span class="highlight">Training</span> We Offer</h2>
            <p class="section-subtitle">Empower your team with cutting-edge AI knowledge</p>
        </div>
        
        <div class="training-grid">
            <div class="training-card">
                <div class="training-image">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500&h=250&fit=crop" alt="AI Fundamentals">
                </div>
                <div class="training-content">
                    <span class="training-level beginner">Beginner</span>
                    <h3>AI Fundamentals</h3>
                    <p>Learn the basics of artificial intelligence and machine learning concepts. Perfect for beginners.</p>
                    <div class="training-meta">
                        <span><i class="fas fa-clock"></i> 2 Days</span>
                        <span><i class="fas fa-users"></i> Up to 20</span>
                        <span><i class="fas fa-certificate"></i> Certificate</span>
                    </div>
                    <a href="training-details.php?id=1" class="training-btn">View Details →</a>
                </div>
            </div>
            <div class="training-card">
                <div class="training-image">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=250&fit=crop" alt="Advanced AI">
                </div>
                <div class="training-content">
                    <span class="training-level advanced">Advanced</span>
                    <h3>Advanced AI & ML</h3>
                    <p>Deep dive into neural networks, deep learning, and advanced algorithms for professionals.</p>
                    <div class="training-meta">
                        <span><i class="fas fa-clock"></i> 5 Days</span>
                        <span><i class="fas fa-users"></i> Up to 15</span>
                        <span><i class="fas fa-certificate"></i> Certificate</span>
                    </div>
                    <a href="training-details.php?id=1" class="training-btn">View Details →</a>
                </div>
            </div>
            <div class="training-card">
                <div class="training-image">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=250&fit=crop" alt="AI for Business">
                </div>
                <div class="training-content">
                    <span class="training-level business">Business</span>
                    <h3>AI for Business Leaders</h3>
                    <p>Strategic implementation of AI for executives and decision makers. Focus on ROI and strategy.</p>
                    <div class="training-meta">
                        <span><i class="fas fa-clock"></i> 3 Days</span>
                        <span><i class="fas fa-users"></i> Up to 25</span>
                        <span><i class="fas fa-certificate"></i> Certificate</span>
                    </div>
                    <a href="training-details.php?id=1" class="training-btn">View Details →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Future Events Section -->
<section class="events-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">Upcoming Events</span>
            <h2 class="section-title">Future <span class="highlight">Events</span></h2>
            <p class="section-subtitle">Join us at upcoming AI conferences and workshops</p>
        </div>
        
        <div class="events-grid">
            <div class="event-card">
                <div class="event-date">
                    <span class="event-day">15</span>
                    <span class="event-month">JUN</span>
                </div>
                <div class="event-image">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500&h=200&fit=crop" alt="AI Summit">
                </div>
                <div class="event-content">
                    <h3>Global AI Summit 2026</h3>
                    <p><i class="fas fa-map-marker-alt"></i> London, UK</p>
                    <p>Join industry leaders discussing the future of AI in business, emerging trends, and real-world applications.</p>
                    <a href="/ai_solutions/contact.php" class="event-btn">Register Now →</a>
                </div>
            </div>
            <div class="event-card">
                <div class="event-date">
                    <span class="event-day">22</span>
                    <span class="event-month">JUL</span>
                </div>
                <div class="event-image">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=500&h=200&fit=crop" alt="Workshop">
                </div>
                <div class="event-content">
                    <h3>AI Workshop: Practical Implementation</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Manchester, UK</p>
                    <p>Hands-on workshop for implementing AI solutions in your organization with real case studies.</p>
                    <a href="/ai_solutions/contact.php" class="event-btn">Register Now →</a>
                </div>
            </div>
            <div class="event-card">
                <div class="event-date">
                    <span class="event-day">10</span>
                    <span class="event-month">SEP</span>
                </div>
                <div class="event-image">
                    <img src="https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500&h=200&fit=crop" alt="Conference">
                </div>
                <div class="event-content">
                    <h3>Tech Innovators Conference</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Birmingham, UK</p>
                    <p>Networking event with top AI innovators, entrepreneurs, and thought leaders in the industry.</p>
                    <a href="/ai_solutions/contact.php" class="event-btn">Register Now →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-solutions">
    <div class="cta-container-wide">
        <div class="cta-content">
            <h2>Ready to Transform Your Business with AI?</h2>
            <p>Get in touch with our team to discuss your specific requirements.</p>
            <a href="/ai_solutions/contact.php" class="cta-btn-solutions">Contact Us Today →</a>
        </div>
    </div>
</section>

<style>
/* Solutions Page Styles */
.solutions-hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 100px 40px;
    text-align: center;
    color: white;
}

.solutions-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.solutions-hero .highlight {
    color: #60a5fa;
}

.solutions-hero p {
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

/* What We Offer Section */
.what-we-offer {
    padding: 100px 0;
    background: white;
}

.offerings-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.offering-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid #eef2f6;
}

.offering-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
    border-color: #1a73e8;
}

.offering-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.offering-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.offering-card:hover .offering-image img {
    transform: scale(1.05);
}

.offering-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(26,115,232,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.offering-card:hover .offering-overlay {
    opacity: 1;
}

.offering-overlay i {
    font-size: 3rem;
    color: white;
}

.offering-content {
    padding: 25px;
    position: relative;
}

.offering-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #e3f2fd, #bbdef5);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: -45px auto 15px;
    position: relative;
    z-index: 2;
}

.offering-icon i {
    font-size: 1.8rem;
    color: #1a73e8;
}

.offering-content h3 {
    font-size: 1.4rem;
    text-align: center;
    margin-bottom: 12px;
    color: #1e1e2e;
}

.offering-content p {
    color: #666;
    line-height: 1.7;
    margin-bottom: 18px;
    text-align: center;
}

.offering-features {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.offering-features span {
    font-size: 0.75rem;
    color: #555;
    background: #f8fafc;
    padding: 5px 12px;
    border-radius: 50px;
}

.offering-features i {
    color: #1a73e8;
    margin-right: 5px;
}

.offering-btn {
    display: block;
    text-align: center;
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.offering-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(26,115,232,0.3);
}

/* Industries Section */
.industries-section {
    padding: 100px 0;
    background: #f8fafc;
}

.industries-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.industry-card {
    background: white;
    padding: 30px 20px;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s;
    border: 1px solid #eef2f6;
}

.industry-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    border-color: #1a73e8;
}

.industry-icon {
    width: 70px;
    height: 70px;
    background: #e3f2fd;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.industry-icon i {
    font-size: 2rem;
    color: #1a73e8;
}

.industry-card h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.industry-card p {
    color: #666;
    font-size: 0.85rem;
    line-height: 1.5;
}

/* Training Section */
.training-section {
    padding: 100px 0;
    background: white;
}

.training-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.training-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid #eef2f6;
}

.training-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

.training-image {
    height: 200px;
    overflow: hidden;
}

.training-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.training-content {
    padding: 25px;
}

.training-level {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-bottom: 12px;
}

.training-level.beginner {
    background: #e3f2fd;
    color: #1a73e8;
}

.training-level.advanced {
    background: #fce4ec;
    color: #e91e63;
}

.training-level.business {
    background: #e8f5e9;
    color: #4caf50;
}

.training-card h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.training-card p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.training-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    font-size: 0.75rem;
    color: #888;
}

.training-meta i {
    margin-right: 5px;
}

.training-btn {
    display: inline-block;
    color: #1a73e8;
    text-decoration: none;
    font-weight: 600;
}

/* Events Section */
.events-section {
    padding: 100px 0;
    background: #f8fafc;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.event-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    position: relative;
}

.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

.event-date {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #1a73e8;
    color: white;
    text-align: center;
    border-radius: 12px;
    padding: 8px 15px;
    z-index: 2;
}

.event-day {
    display: block;
    font-size: 1.2rem;
    font-weight: 700;
}

.event-month {
    font-size: 0.7rem;
}

.event-image {
    height: 180px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-content {
    padding: 25px;
}

.event-content h3 {
    font-size: 1.2rem;
    margin-bottom: 8px;
}

.event-content p {
    color: #666;
    font-size: 0.85rem;
    margin-bottom: 5px;
}

.event-btn {
    display: inline-block;
    margin-top: 12px;
    color: #1a73e8;
    text-decoration: none;
    font-weight: 600;
}

/* CTA Section */
.cta-section-solutions {
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

.cta-btn-solutions {
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

.cta-btn-solutions:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 30px;
    }
    
    .industries-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .offerings-grid, .training-grid, .events-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .industries-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    
    .solutions-hero {
        padding: 60px 20px;
    }
    
    .solutions-hero h1 {
        font-size: 2rem;
    }
    
    .offerings-grid, .training-grid, .events-grid, .industries-grid {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .offering-features {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<?php require_once 'includes/footer.php'; ?>