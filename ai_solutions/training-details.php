<?php
require_once 'includes/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$stmt = $conn->prepare("SELECT * FROM trainings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$training = $result->fetch_assoc();

if(!$training) {
    header('Location: solutions.php');
    exit();
}

$page_title = $training['title'] . ' | AI-Solutions';
require_once 'includes/header.php';
?>

<section class="detail-hero">
    <div class="container">
        <div class="hero-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1><?php echo htmlspecialchars($training['title']); ?></h1>
        <div class="training-badge"><?php echo $training['level']; ?> Level</div>
        <p><?php echo htmlspecialchars($training['description']); ?></p>
    </div>
</section>

<section class="detail-content">
    <div class="container">
        <div class="detail-wrapper">
            <div class="detail-main">
                <img src="<?php echo $training['image_url']; ?>" alt="<?php echo $training['title']; ?>">
                <div class="detail-text">
                    <?php echo $training['full_description']; ?>
                </div>
            </div>
            <div class="detail-sidebar">
                <div class="info-box">
                    <h3>Course Details</h3>
                    <ul>
                        <li><i class="fas fa-clock"></i> Duration: <?php echo $training['duration']; ?></li>
                        <li><i class="fas fa-users"></i> Max Students: <?php echo $training['max_students']; ?></li>
                        <li><i class="fas fa-tag"></i> Price: <?php echo $training['price']; ?></li>
                        <li><i class="fas fa-certificate"></i> Certificate Included</li>
                    </ul>
                    <a href="/ai_solutions/contact.php" class="btn-primary">Enroll Now →</a>
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
.training-badge {
    display: inline-block;
    background: #1a73e8;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-bottom: 15px;
}
.detail-content { padding: 60px 20px; background: #f8fafc; }
.detail-wrapper { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
.detail-main { background: white; border-radius: 20px; overflow: hidden; }
.detail-main img { width: 100%; height: 300px; object-fit: cover; }
.detail-text { padding: 30px; }
.info-box { background: white; padding: 25px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
.info-box ul { list-style: none; padding: 0; margin: 20px 0; }
.info-box ul li { padding: 10px 0; border-bottom: 1px solid #eee; }
.info-box ul li i { color: #1a73e8; width: 25px; }
.btn-primary { display: inline-block; background: #1a73e8; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; width: 100%; text-align: center; }
@media (max-width: 992px) { .detail-wrapper { grid-template-columns: 1fr; } }
</style>

<?php require_once 'includes/footer.php'; ?>