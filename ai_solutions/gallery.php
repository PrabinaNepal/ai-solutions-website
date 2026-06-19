<?php
require_once 'includes/config.php';
$page_title = 'Gallery';
require_once 'includes/header.php';

// Gallery items with images
$all_gallery_items = [
    // Category 1: Events
    [
        'category' => 'Events',
        'title' => 'AI Summit 2026',
        'description' => 'Keynote speech by our CEO at the annual AI Summit in London',
        'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500&h=350&fit=crop',
        'date' => 'March 15, 2026',
        'location' => 'London, UK'
    ],
    [
        'category' => 'Events',
        'title' => 'Tech Conference 2026',
        'description' => 'Our team presenting AI innovations at Tech Conference',
        'image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500&h=350&fit=crop',
        'date' => 'February 10, 2026',
        'location' => 'Manchester, UK'
    ],
    [
        'category' => 'Events',
        'title' => 'Global AI Expo',
        'description' => 'Showcasing our AI solutions at the Global AI Expo',
        'image' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=500&h=350&fit=crop',
        'date' => 'January 20, 2026',
        'location' => 'Birmingham, UK'
    ],
    
    // Category 2: Team & Culture
    [
        'category' => 'Team & Culture',
        'title' => 'Team Building Workshop',
        'description' => 'Our developers collaborating on innovative AI solutions',
        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=350&fit=crop',
        'date' => 'December 5, 2025',
        'location' => 'Sunderland, UK'
    ],
    [
        'category' => 'Team & Culture',
        'title' => 'Celebrating Success',
        'description' => 'Team celebration after successful product launch',
        'image' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=500&h=350&fit=crop',
        'date' => 'November 18, 2025',
        'location' => 'Newcastle, UK'
    ],
    [
        'category' => 'Team & Culture',
        'title' => 'Morning Meeting',
        'description' => 'Daily standup with our AI development team',
        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=350&fit=crop',
        'date' => 'October 22, 2025',
        'location' => 'Sunderland, UK'
    ],
    
    // Category 3: Products & Launches
    [
        'category' => 'Products & Launches',
        'title' => 'Product Launch Event',
        'description' => 'Launch of our new AI Virtual Assistant platform',
        'image' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=500&h=350&fit=crop',
        'date' => 'September 30, 2025',
        'location' => 'London, UK'
    ],
    [
        'category' => 'Products & Launches',
        'title' => 'AI Assistant Demo',
        'description' => 'Live demonstration of our AI Virtual Assistant',
        'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&h=350&fit=crop',
        'date' => 'August 15, 2025',
        'location' => 'Manchester, UK'
    ],
    [
        'category' => 'Products & Launches',
        'title' => 'Prototyping Showcase',
        'description' => 'Showing our rapid prototyping capabilities',
        'image' => 'https://images.unsplash.com/photo-1581091226033-d5c48150dbaa?w=500&h=350&fit=crop',
        'date' => 'July 10, 2025',
        'location' => 'Birmingham, UK'
    ],
    
    // Category 4: Client Meetings
    [
        'category' => 'Client Meetings',
        'title' => 'Client Meet & Greet',
        'description' => 'Networking event with our valued clients',
        'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500&h=350&fit=crop',
        'date' => 'June 25, 2025',
        'location' => 'Sunderland, UK'
    ],
    [
        'category' => 'Client Meetings',
        'title' => 'Strategy Session',
        'description' => 'Discussing AI implementation strategies with clients',
        'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=500&h=350&fit=crop',
        'date' => 'May 18, 2025',
        'location' => 'London, UK'
    ],
    [
        'category' => 'Client Meetings',
        'title' => 'Feedback Session',
        'description' => 'Gathering valuable feedback from our clients',
        'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500&h=350&fit=crop',
        'date' => 'April 12, 2025',
        'location' => 'Manchester, UK'
    ],
    
    // Category 5: Awards & Recognition
    [
        'category' => 'Awards & Recognition',
        'title' => 'Award Ceremony',
        'description' => 'Receiving the Best AI Innovation Award',
        'image' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=500&h=350&fit=crop',
        'date' => 'March 8, 2025',
        'location' => 'London, UK'
    ],
    [
        'category' => 'Awards & Recognition',
        'title' => 'Industry Recognition',
        'description' => 'Recognized as Top AI Solution Provider',
        'image' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=500&h=350&fit=crop',
        'date' => 'February 20, 2025',
        'location' => 'Birmingham, UK'
    ],
    [
        'category' => 'Awards & Recognition',
        'title' => 'Certificate Ceremony',
        'description' => 'Team receiving certificates for excellence',
        'image' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=500&h=350&fit=crop',
        'date' => 'January 15, 2025',
        'location' => 'Sunderland, UK'
    ]
];

// Pagination settings
$items_per_page = 9;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';

// Filter by category
if($category_filter != 'all') {
    $filtered_items = array_filter($all_gallery_items, function($item) use ($category_filter) {
        return $item['category'] == $category_filter;
    });
} else {
    $filtered_items = $all_gallery_items;
}

$total_items = count($filtered_items);
$total_pages = ceil($total_items / $items_per_page);
$current_page = max(1, min($current_page, $total_pages ?: 1));
$offset = ($current_page - 1) * $items_per_page;
$gallery_items = array_slice($filtered_items, $offset, $items_per_page);

// Get unique categories
$categories = array_unique(array_column($all_gallery_items, 'category'));
?>

<!-- Hero Section -->
<section class="gallery-hero">
    <div class="hero-container-wide">
        <div class="hero-content-gallery">
            <h1>Gallery</h1>
            <p>Moments from our events and company highlights</p>
        </div>
    </div>
</section>

<!-- Category Filters -->
<section class="filters-section">
    <div class="container-wide">
        <div class="category-filters">
            <a href="?category=all&page=1" class="filter-btn <?php echo $category_filter == 'all' ? 'active' : ''; ?>">All Photos</a>
            <?php foreach($categories as $cat): ?>
            <a href="?category=<?php echo urlencode($cat); ?>&page=1" class="filter-btn <?php echo $category_filter == $cat ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-section">
    <div class="container-wide">
        <?php if(empty($gallery_items)): ?>
            <div class="no-results">
                <i class="fas fa-camera"></i>
                <p>No images found in this category.</p>
            </div>
        <?php else: ?>
            <div class="gallery-grid">
                <?php foreach($gallery_items as $item): ?>
                <div class="gallery-item" data-category="<?php echo $item['category']; ?>">
                    <div class="gallery-image">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                            <span>View Gallery</span>
                        </div>
                    </div>
                    <div class="gallery-caption">
                        <div class="gallery-category-badge"><?php echo $item['category']; ?></div>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="gallery-meta">
                            <span><i class="fas fa-calendar"></i> <?php echo $item['date']; ?></span>
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo $item['location']; ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if($total_pages > 1): ?>
            <div class="pagination">
                <?php if($current_page > 1): ?>
                    <a href="?category=<?php echo urlencode($category_filter); ?>&page=<?php echo $current_page - 1; ?>" class="page-btn prev">
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
                            <a href="?category=<?php echo urlencode($category_filter); ?>&page=<?php echo $i; ?>" class="page-number"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                
                <?php if($current_page < $total_pages): ?>
                    <a href="?category=<?php echo urlencode($category_filter); ?>&page=<?php echo $current_page + 1; ?>" class="page-btn next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="page-btn disabled">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <span class="close-lightbox">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div class="lightbox-caption" id="lightbox-caption"></div>
</div>

<style>
/* Gallery Page Styles */
.gallery-hero {
    background: linear-gradient(135deg, #0a0a1a 0%, #1a1a2e 50%, #16213e 100%);
    padding: 100px 40px;
    text-align: center;
    color: white;
}

.gallery-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.gallery-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.container-wide {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

/* Filters Section */
.filters-section {
    padding: 40px 0;
    background: white;
    border-bottom: 1px solid #eef2f6;
}

.category-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}

.filter-btn {
    padding: 10px 24px;
    background: #f0f2f5;
    color: #333;
    text-decoration: none;
    border-radius: 40px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s;
}

.filter-btn:hover {
    background: #1a73e8;
    color: white;
}

.filter-btn.active {
    background: #1a73e8;
    color: white;
}

/* Gallery Section */
.gallery-section {
    padding: 60px 0 100px;
    background: #f8fafc;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.gallery-item {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.gallery-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.gallery-image {
    position: relative;
    height: 240px;
    overflow: hidden;
    cursor: pointer;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.gallery-item:hover .gallery-image img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(26, 115, 232, 0.9);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s;
    color: white;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    font-size: 2.5rem;
}

.gallery-overlay span {
    font-size: 0.9rem;
    font-weight: 500;
}

.gallery-caption {
    padding: 20px;
}

.gallery-category-badge {
    display: inline-block;
    background: #e3f2fd;
    color: #1a73e8;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-bottom: 12px;
}

.gallery-caption h3 {
    font-size: 1.2rem;
    margin-bottom: 8px;
    color: #1e1e2e;
}

.gallery-caption p {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 12px;
    line-height: 1.5;
}

.gallery-meta {
    display: flex;
    gap: 15px;
    font-size: 0.7rem;
    color: #888;
}

.gallery-meta i {
    margin-right: 4px;
    color: #1a73e8;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 80px;
    background: white;
    border-radius: 20px;
}

.no-results i {
    font-size: 4rem;
    color: #ccc;
    margin-bottom: 15px;
}

.no-results p {
    color: #666;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 50px;
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
    border-radius: 10px;
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
    width: 42px;
    height: 42px;
    background: white;
    color: #333;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.page-number:hover {
    background: #1a73e8;
    color: white;
}

.page-number.active {
    background: #1a73e8;
    color: white;
}

/* Lightbox */
.lightbox {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.95);
    cursor: pointer;
}

.lightbox-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
}

.close-lightbox {
    position: absolute;
    top: 20px;
    right: 40px;
    color: white;
    font-size: 50px;
    font-weight: bold;
    cursor: pointer;
}

.close-lightbox:hover {
    color: #1a73e8;
}

.lightbox-caption {
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    text-align: center;
    color: white;
    padding: 15px;
    background: rgba(0,0,0,0.6);
}

/* Responsive */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 30px;
    }
    
    .gallery-grid {
        gap: 25px;
    }
}

@media (max-width: 992px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .container-wide {
        padding: 0 20px;
    }
    
    .gallery-hero {
        padding: 60px 20px;
    }
    
    .gallery-hero h1 {
        font-size: 2.2rem;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .category-filters {
        gap: 10px;
    }
    
    .filter-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    .gallery-image {
        height: 220px;
    }
    
    .pagination {
        gap: 10px;
    }
    
    .page-btn {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .page-number {
        width: 36px;
        height: 36px;
    }
}
</style>

<script>
// Lightbox functionality
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const closeLightbox = document.querySelector('.close-lightbox');
    
    // Add click event to all gallery images
    document.querySelectorAll('.gallery-image').forEach(function(imageContainer) {
        imageContainer.addEventListener('click', function() {
            const img = this.querySelector('img');
            const caption = this.closest('.gallery-item').querySelector('.gallery-caption h3').innerText;
            lightboxImg.src = img.src;
            lightboxCaption.innerHTML = caption;
            lightbox.style.display = 'block';
        });
    });
    
    // Close lightbox
    if(closeLightbox) {
        closeLightbox.addEventListener('click', function() {
            lightbox.style.display = 'none';
        });
    }
    
    // Close when clicking outside image
    lightbox.addEventListener('click', function(e) {
        if(e.target === lightbox) {
            lightbox.style.display = 'none';
        }
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>