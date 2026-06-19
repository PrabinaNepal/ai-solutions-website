<?php
require_once 'includes/config.php';
$page_title = 'Contact Us';
$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name   = trim($_POST['full_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $company     = trim($_POST['company'] ?? '');
    $country     = trim($_POST['country'] ?? '');
    $job_title   = trim($_POST['job_title'] ?? '');
    $job_details = trim($_POST['job_details'] ?? '');

    if (empty($full_name) || empty($email) || empty($phone) || empty($company) || empty($country) || empty($job_title) || empty($job_details)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $full_name = $conn->real_escape_string($full_name);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);
        $company = $conn->real_escape_string($company);
        $country = $conn->real_escape_string($country);
        $job_title = $conn->real_escape_string($job_title);
        $job_details = $conn->real_escape_string($job_details);
        
        $sql = "INSERT INTO inquiries (full_name, email, phone, company_name, country, job_title, job_details) 
                VALUES ('$full_name', '$email', '$phone', '$company', '$country', '$job_title', '$job_details')";
        
        if ($conn->query($sql)) {
            $success = 'Thank you, ' . htmlspecialchars($full_name) . '! Your inquiry has been submitted. We will contact you within 24 hours.';
            $_POST = array();
        } else {
            $error = 'Database error: ' . $conn->error;
        }
    }
}
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="hero-container-wide">
        <div class="hero-content-contact">
            <h1>Let's Talk</h1>
            <p>We'd love to hear about your project and how we can help</p>
            <div class="hero-stats-contact">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Projects Completed</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Client Satisfaction</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Support Available</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-main">
    <div class="container-wide">
        
        <?php if ($success): ?>
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                <div>
                    <strong>Success!</strong> <?php echo $success; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Error!</strong> <?php echo $error; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="contact-grid">
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <div class="form-header">
                    <h2>Send us a Message</h2>
                    <p>Fill out the form below and our team will get back to you within 24 hours.</p>
                </div>
                
                <form method="POST" action="" class="modern-form">
                    <div class="form-row">
                        <div class="input-group">
                            <label>Full Name <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" name="full_name" required value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" placeholder="John Doe">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Email Address <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="john@example.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="input-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-phone"></i>
                                <input type="tel" name="phone" required value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" placeholder="+44 123 456 7890">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Company Name <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-building"></i>
                                <input type="text" name="company" required value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>" placeholder="Your Company Ltd">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="input-group">
                            <label>Country <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-globe"></i>
                                <select name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="United Kingdom" <?php echo (($_POST['country'] ?? '') == 'United Kingdom') ? 'selected' : ''; ?>>🇬🇧 United Kingdom</option>
                                    <option value="United States" <?php echo (($_POST['country'] ?? '') == 'United States') ? 'selected' : ''; ?>>🇺🇸 United States</option>
                                    <option value="Canada" <?php echo (($_POST['country'] ?? '') == 'Canada') ? 'selected' : ''; ?>>🇨🇦 Canada</option>
                                    <option value="Australia" <?php echo (($_POST['country'] ?? '') == 'Australia') ? 'selected' : ''; ?>>🇦🇺 Australia</option>
                                    <option value="India" <?php echo (($_POST['country'] ?? '') == 'India') ? 'selected' : ''; ?>>🇮🇳 India</option>
                                    <option value="Germany" <?php echo (($_POST['country'] ?? '') == 'Germany') ? 'selected' : ''; ?>>🇩🇪 Germany</option>
                                    <option value="France" <?php echo (($_POST['country'] ?? '') == 'France') ? 'selected' : ''; ?>>🇫🇷 France</option>
                                    <option value="Japan" <?php echo (($_POST['country'] ?? '') == 'Japan') ? 'selected' : ''; ?>>🇯🇵 Japan</option>
                                    <option value="China" <?php echo (($_POST['country'] ?? '') == 'China') ? 'selected' : ''; ?>>🇨🇳 China</option>
                                    <option value="Singapore" <?php echo (($_POST['country'] ?? '') == 'Singapore') ? 'selected' : ''; ?>>🇸🇬 Singapore</option>
                                    <option value="UAE" <?php echo (($_POST['country'] ?? '') == 'UAE') ? 'selected' : ''; ?>>🇦🇪 UAE</option>
                                    <option value="Other" <?php echo (($_POST['country'] ?? '') == 'Other') ? 'selected' : ''; ?>>🌍 Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Job Title <span class="required">*</span></label>
                            <div class="input-icon">
                                <i class="fas fa-briefcase"></i>
                                <input type="text" name="job_title" required value="<?php echo htmlspecialchars($_POST['job_title'] ?? ''); ?>" placeholder="Chief Technology Officer">
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group full-width">
                        <label>Job Details <span class="required">*</span></label>
                        <div class="textarea-icon">
                            <i class="fas fa-file-alt"></i>
                            <textarea name="job_details" rows="5" required placeholder="Please describe your requirements, project details, or questions in detail..."><?php echo htmlspecialchars($_POST['job_details'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <span>Send Message</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info-wrapper">
                <div class="info-header">
                    <h2>Get in Touch</h2>
                    <p>Reach out through any of these channels</p>
                </div>
                
                <div class="info-cards">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Visit Us</h3>
                            <p>AI-Solutions Headquarters<br>Sunderland, United Kingdom<br>SR1 3SD</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Call Us</h3>
                            <p>UK: +44 (123) 456-7890<br>US: +1 (555) 123-4567<br>Support: +44 (123) 456-7891</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h3>Email Us</h3>
                            <p>General: info@ai-solution.com<br>Sales: sales@ai-solution.com<br>Support: support@ai-solution.com</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h3>Business Hours</h3>
                            <p>Mon-Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 2:00 PM<br>Sun: Closed</p>
                        </div>
                    </div>
                </div>
                
                <!-- Working Google Map -->
                <div class="map-card">
                    <div class="map-header">
                        <i class="fas fa-map"></i>
                        <h3>Find Us on Map</h3>
                    </div>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14645.123456789!2d-1.459789!3d54.912658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487e1b5d1e6c9c8d%3A0x2b8e5c8f5a6c9e8d!2sSunderland%2C%20UK!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" 
                            width="100%" 
                            height="250" 
                            style="border:0; border-radius: 16px;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    <div class="map-footer">
                        <i class="fas fa-location-dot"></i> AI-Solutions Headquarters, Sunderland, UK
                    </div>
                </div>
                
                <!-- Social Links -->
                <div class="social-card">
                    <h3>Connect With Us</h3>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container-wide">
        <div class="section-header">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Frequently Asked <span class="highlight">Questions</span></h2>
            <p class="section-subtitle">Find quick answers to common questions</p>
        </div>
        
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question">
                    <i class="fas fa-question-circle"></i>
                    <span>How quickly can I expect a response?</span>
                </div>
                <div class="faq-answer">We aim to respond to all inquiries within 24 hours during business days.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <i class="fas fa-question-circle"></i>
                    <span>Do you offer free consultations?</span>
                </div>
                <div class="faq-answer">Yes, we offer a free initial consultation to understand your requirements.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <i class="fas fa-question-circle"></i>
                    <span>What industries do you serve?</span>
                </div>
                <div class="faq-answer">We serve healthcare, finance, retail, manufacturing, telecom, education, and more.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <i class="fas fa-question-circle"></i>
                    <span>Do you provide ongoing support?</span>
                </div>
                <div class="faq-answer">Yes, we offer 24/7 support and maintenance packages for all our solutions.</div>
            </div>
        </div>
    </div>
</section>

<style>
/* Contact Page Styles */
.contact-hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 80px 40px;
    text-align: center;
    color: white;
}

.contact-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.contact-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 40px;
}

.hero-stats-contact {
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}

.hero-stats-contact .stat-item {
    text-align: center;
}

.hero-stats-contact .stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #60a5fa;
}

.hero-stats-contact .stat-label {
    font-size: 0.85rem;
    opacity: 0.8;
}

.container-wide {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

/* Contact Main */
.contact-main {
    padding: 80px 0;
    background: #f8fafc;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 0.9fr;
    gap: 50px;
}

/* Alert Messages */
.alert-success, .alert-error {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 25px;
    border-radius: 16px;
    margin-bottom: 30px;
}

.alert-success {
    background: #d4edda;
    border-left: 4px solid #28a745;
    color: #155724;
}

.alert-error {
    background: #f8d7da;
    border-left: 4px solid #dc3545;
    color: #721c24;
}

.alert-success i, .alert-error i {
    font-size: 1.5rem;
}

/* Contact Form */
.contact-form-wrapper {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.form-header {
    margin-bottom: 30px;
}

.form-header h2 {
    font-size: 1.8rem;
    color: #1e1e2e;
    margin-bottom: 10px;
}

.form-header p {
    color: #666;
}

.modern-form {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.input-group.full-width {
    grid-column: span 2;
}

.input-group label {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.required {
    color: #dc3545;
}

.input-icon, .textarea-icon {
    position: relative;
}

.input-icon i, .textarea-icon i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #1a73e8;
    font-size: 1rem;
}

.textarea-icon i {
    top: 20px;
    transform: none;
}

.input-icon input, .input-icon select {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
    background: white;
}

.textarea-icon textarea {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    font-family: inherit;
    resize: vertical;
}

.input-icon input:focus, .input-icon select:focus, .textarea-icon textarea:focus {
    outline: none;
    border-color: #1a73e8;
    box-shadow: 0 0 0 3px rgba(26,115,232,0.1);
}

.submit-btn {
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    padding: 16px 32px;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: all 0.3s;
    width: 100%;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(26,115,232,0.3);
}

/* Contact Info */
.contact-info-wrapper {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.info-header {
    margin-bottom: 5px;
}

.info-header h2 {
    font-size: 1.8rem;
    color: #1e1e2e;
    margin-bottom: 10px;
}

.info-header p {
    color: #666;
}

.info-cards {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-card {
    background: white;
    border-radius: 20px;
    padding: 22px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    transition: all 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.info-card:hover {
    transform: translateX(5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.info-icon {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #e3f2fd, #bbdef5);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-icon i {
    font-size: 1.5rem;
    color: #1a73e8;
}

.info-content h3 {
    font-size: 1.1rem;
    margin-bottom: 8px;
    color: #1e1e2e;
}

.info-content p {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Map Card */
.map-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.map-header {
    padding: 20px 20px 0 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.map-header i {
    font-size: 1.2rem;
    color: #1a73e8;
}

.map-header h3 {
    font-size: 1.1rem;
    color: #1e1e2e;
}

.map-container {
    padding: 15px;
}

.map-container iframe {
    width: 100%;
    height: 250px;
    border-radius: 16px;
}

.map-footer {
    padding: 12px 20px;
    background: #f8fafc;
    text-align: center;
    font-size: 0.85rem;
    color: #666;
    border-top: 1px solid #eef2f6;
}

.map-footer i {
    color: #dc3545;
    margin-right: 5px;
}

/* Social Card */
.social-card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.social-card h3 {
    margin-bottom: 20px;
    color: #1e1e2e;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-link {
    width: 45px;
    height: 45px;
    background: #f0f2f5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a73e8;
    text-decoration: none;
    transition: all 0.3s;
}

.social-link:hover {
    background: #1a73e8;
    color: white;
    transform: translateY(-3px);
}

/* FAQ Section */
.faq-section {
    padding: 80px 0;
    background: white;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
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
    font-size: 2.2rem;
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
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    max-width: 1000px;
    margin: 0 auto;
}

.faq-item {
    background: #f8fafc;
    padding: 25px;
    border-radius: 16px;
    transition: all 0.3s;
}

.faq-item:hover {
    background: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.faq-question {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    color: #1e1e2e;
    margin-bottom: 12px;
}

.faq-question i {
    color: #1a73e8;
    font-size: 1.2rem;
}

.faq-answer {
    color: #666;
    line-height: 1.6;
    padding-left: 32px;
}

/* Responsive */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 30px;
    }
}

@media (max-width: 992px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .input-group.full-width {
        grid-column: span 1;
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    
    .contact-hero {
        padding: 60px 20px;
    }
    
    .contact-hero h1 {
        font-size: 2.2rem;
    }
    
    .hero-stats-contact {
        gap: 30px;
    }
    
    .hero-stats-contact .stat-number {
        font-size: 1.5rem;
    }
    
    .contact-form-wrapper {
        padding: 25px;
    }
    
    .faq-grid {
        grid-template-columns: 1fr;
    }
    
    .info-card {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
}
</style>

<?php require_once 'includes/footer.php'; ?>