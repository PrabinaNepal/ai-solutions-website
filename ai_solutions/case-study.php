<?php
require_once 'includes/config.php';
$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM case_studies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$case = $result->fetch_assoc();

if(!$case) {
    header('Location: insights.php');
    exit();
}

$page_title = $case['title'];
require_once 'includes/header.php';
?>

<div class="page-header" style="background: linear-gradient(135deg, #1e1e2e 0%, #1a3a6e 100%); color: white; padding: 60px 20px; text-align: center;">
    <h1><?php echo htmlspecialchars($case['title']); ?></h1>
    <p>Industry: <?php echo htmlspecialchars($case['industry']); ?></p>
</div>

<section style="padding: 60px 20px;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <?php if($case['image']): ?>
            <img src="<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['title']); ?>" style="width: 100%; border-radius: 15px; margin-bottom: 30px;">
        <?php endif; ?>
        
        <div style="margin-bottom: 40px;">
            <h2 style="color: #1e1e2e; margin-bottom: 15px;">The Challenge</h2>
            <p style="color: #666; line-height: 1.8;"><?php echo nl2br(htmlspecialchars($case['challenge'])); ?></p>
        </div>
        
        <div style="margin-bottom: 40px;">
            <h2 style="color: #1e1e2e; margin-bottom: 15px;">Our Solution</h2>
            <p style="color: #666; line-height: 1.8;"><?php echo nl2br(htmlspecialchars($case['solution'])); ?></p>
        </div>
        
        <div style="margin-bottom: 40px; background: #e3f2fd; padding: 30px; border-radius: 15px;">
            <h2 style="color: #1e1e2e; margin-bottom: 15px;">The Results</h2>
            <p style="color: #666; line-height: 1.8; white-space: pre-line;"><?php echo nl2br(htmlspecialchars($case['result'])); ?></p>
        </div>
        
        <div style="text-align: center;">
            <a href="insights.php" style="background: #1a73e8; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block;">← Back to Insights</a>
            <a href="contact.php" style="background: #28a745; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block; margin-left: 15px;">Request Similar Solution</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>