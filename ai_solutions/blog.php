<?php
require_once 'includes/config.php';
$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if(!$blog) {
    header('Location: insights.php');
    exit();
}

// Increment views
$update = "UPDATE blog_posts SET views = views + 1 WHERE id = ?";
$stmt2 = $conn->prepare($update);
$stmt2->bind_param("i", $id);
$stmt2->execute();

$page_title = $blog['title'];
require_once 'includes/header.php';
?>

<div class="page-header" style="background: linear-gradient(135deg, #1e1e2e 0%, #1a3a6e 100%); color: white; padding: 60px 20px; text-align: center;">
    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
    <p>By <?php echo htmlspecialchars($blog['author']); ?> | <?php echo date('F d, Y', strtotime($blog['created_at'])); ?></p>
</div>

<section style="padding: 60px 20px;">
    <div style="max-width: 900px; margin: 0 auto;">
        <?php if($blog['image']): ?>
            <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width: 100%; border-radius: 15px; margin-bottom: 30px;">
        <?php endif; ?>
        
        <div style="color: #666; line-height: 1.8; font-size: 1.1rem;">
            <?php echo $blog['content']; ?>
        </div>
        
        <hr style="margin: 40px 0;">
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="insights.php" style="background: #1a73e8; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none;">← Back to Insights</a>
            <div style="color: #666;">
                <i class="fas fa-eye"></i> <?php echo $blog['views']; ?> views
            </div>
        </div>
        
        <div style="margin-top: 40px; background: #f5f7fa; padding: 30px; border-radius: 15px; text-align: center;">
            <h3>Enjoyed this article?</h3>
            <p style="margin-bottom: 20px;">Subscribe to our newsletter for more insights</p>
            <div class="newsletter-form" style="max-width: 400px; margin: 0 auto;">
                <input type="email" placeholder="Enter your email" style="flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                <button style="background: #1a73e8; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer;">Subscribe</button>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>