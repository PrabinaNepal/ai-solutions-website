<?php
require_once 'includes/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Fetch solution from database
$stmt = $conn->prepare("SELECT * FROM solutions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$solution = $result->fetch_assoc();

if(!$solution) {
    header('Location: solutions.php');
    exit();
}

$page_title = $solution['title'] . ' | AI-Solutions';
require_once 'includes/header.php';
?>

<section class="detail-hero">
    <div class="container">
        <div class="hero-icon">
            <i class="<?php echo $solution['icon']; ?>"></i>
        </div>
        <h1><?php echo htmlspecialchars($solution['title']); ?></h1>
        <p><?php echo htmlspecialchars($solution['short_description']); ?></p>
    </div>
</section>

<section class="detail-content">
    <div class="container">
        <div class="detail-wrapper">
            <div class="detail-main">
                <img src="<?php echo $solution['image_url']; ?>" alt="<?php echo $solution['title']; ?>">
                <div class="detail-text">
                    <?php echo $solution['full_description']; ?>
                </div>
            </div>
            <div class="detail-sidebar">
                <div class="cta-box">
                    <h3>Ready to get started?</h3>
                    <p>Contact our team for a free consultation.</p>
                    <a href="/ai_solutions/contact.php" class="btn-primary">Request Demo →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.detail-hero {
    background: linear-gradient(135deg, #0a0a1a, #1a1a2e);
    padding: 80px 20px;
    text-align: center;
    color: white;
}
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.hero-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.hero-icon i { font-size: 2.5rem; color: #60a5fa; }
.detail-hero h1 { font-size: 2rem; margin-bottom: 15px; }
.detail-content { padding: 60px 20px; background: #f8fafc; }
.detail-wrapper { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
.detail-main { background: white; border-radius: 20px; overflow: hidden; }
.detail-main img { width: 100%; height: 300px; object-fit: cover; }
.detail-text { padding: 30px; }
.detail-text h3 { margin: 25px 0 15px; }
.detail-text ul { list-style: none; padding: 0; }
.detail-text ul li { padding: 8px 0 8px 25px; position: relative; }
.detail-text ul li:before { content: "✓"; color: #1a73e8; position: absolute; left: 0; }
.cta-box { background: linear-gradient(135deg, #1a73e8, #0d47a1); color: white; padding: 30px; border-radius: 20px; text-align: center; }
.btn-primary { display: inline-block; background: white; color: #1a73e8; padding: 12px 25px; border-radius: 8px; text-decoration: none; }
@media (max-width: 992px) { .detail-wrapper { grid-template-columns: 1fr; } }
</style>

<?php require_once 'includes/footer.php'; ?>