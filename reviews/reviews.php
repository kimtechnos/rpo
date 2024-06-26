<?php
// Update the details below for the MySQL info
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'reviews_db';

try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);

} catch (PDOException $e) {
    // If there is an error with the connection
    exit('Failed to connect to the database!');
}

// Convert datetime to time elapsed string
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    
    return $full ? implode(', ', $string) . ' ago' : $string['s'] . ' ago';
}

if (isset($_GET['page_id'])) {
    if (isset($_POST['name'], $_POST['rating'], $_POST['content'])) {
        // Insert a new review when submitted review form
        $stmt = $pdo->prepare('INSERT INTO reviews (page_id, content, rating, submit_date) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$_GET['page_id'], $_POST['name'], $_POST['content'], $_POST['rating']]);
        
        // End the output below
        exit('Your review has been submitted!');
    }

    // If the limit variables exist
    $limit = isset($_GET['current_pagination_page'], $_GET['reviews_per_pagination_page']) ? 'LIMIT :current_pagination_page, :reviews_per_page' : '';
    
    // By default, order by the submit data (newest)
    $sort_by = 'ORDER BY submit_date DESC';

    if (isset($_GET['sort_by'])) {
        // When the user has changed the sort by
        $sort_by = ($_GET['sort_by'] == 'newest') ? 'ORDER BY submit_date DESC' : $sort_by;
        $sort_by = ($_GET['sort_by'] == 'oldest') ? 'ORDER BY submit_date ASC' : $sort_by;
        $sort_by = ($_GET['sort_by'] == 'rating_highest') ? 'ORDER BY rating DESC' : $sort_by;
        $sort_by = ($_GET['sort_by'] == 'rating_lowest') ? 'ORDER BY rating ASC' : $sort_by;

        // Secure our SQL
        $stmt = $pdo->prepare('SELECT * FROM reviews WHERE page_id = :page_id ' . $sort_by . ' ' . $limit);

        if ($limit) {
            // Let's determine which page the user is on
            $stmt->bindValue(':current_pagination_page', ((int)$_GET['current_pagination_page'] - 1) * (int)$_GET['reviews_per_pagination_page'], PDO::PARAM_INT);
            $stmt->bindValue(':reviews_per_page', (int)$_GET['reviews_per_pagination_page'], PDO::PARAM_INT);
        }

        $stmt->bindValue(':page_id', (int)$_GET['page_id'], PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get the total amount of reviews
        $stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) as total_reviews FROM reviews WHERE page_id = ?');
        $stmt->execute([$_GET['page_id']]);
        $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        exit('Please provide the page ID.');
    }
}
?>
<div class="overall_rating">
    <span class="num"><?= number_format($reviews_info['overall_rating'], 1) ?></span>
    <span class="stars"><?= str_repeat('&#9733;', round($reviews_info['overall_rating'])) ?></span>
    <span class="total"><?= $reviews_info['total_reviews'] ?></span>
</div>

<div class="con">
    <a href="write_review_btn">write Review</a>
    <span></span>
    <label for="sort_by">sort By</label>
    <select class="sort_by" id="sort_by">
        <option value="newest" <?= isset($_GET['sort_by']) && $_GET['sort_by'] == 'newest' ? 'selected' : '' ?>>Newest</option>
        <option value="oldest" <?= isset($_GET['sort_by']) && $_GET['sort_by'] == 'oldest' ? 'selected' : '' ?>>Oldest</option>
        <option value="rating_highest" <?= isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_highest' ? 'selected' : '' ?>>Rating - High to Low</option>
        <option value="rating_lowest" <?= isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_lowest' ? 'selected' : '' ?>>Rating - Low to High</option>
    </select>
</div>
<?php foreach ($reviews as $review): ?>
    <div class="review">
        <h3 class="name"><?= htmlspecialchars($review['name'], ENT_QUOTES) ?></h3>
        <div>
            <span class="rating"><?= str_repeat('&#9733;', $review['rating']) ?></span>
            <span class="date"><?= time_elapsed_string($review['submit_date']) ?></span>
        </div>
        <p class="content"><?= htmlspecialchars($review['content'], ENT_QUOTES) ?></p>
    </div>
<?php endforeach ?>

<?php if ($limit): ?>
    <div class="pagination">
        <?php if (isset($_GET['current_pagination_page']) && $_GET['current_pagination_page'] > 1): ?>
            <a href="#" data-pagination_page="<?= $_GET['current_pagination_page'] + 1 ?>" data-records_per_page="<?= $_GET['reviews_per_pagination_page'] ?>">Next</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
