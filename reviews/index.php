<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav class="navtop">
        <div>
            <h1>Reviews system in PHP MySQL database</h1>
        </div>
    </nav>
    <div class="content home">
        <h2>Add Review To your Website.</h2>
        <p>Check out the below reviews for your website</p>
        <div class="reviews">
            <?php include 'reviews.php'; ?>
        </div>
        <script src="reviews.js"></script>
        <script>
            new Reviews({
                page_id: 1,
                container: document.querySelector(".reviews")
            });
        </script>
    </div>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav class="navtop">
        <div>
            <h1>Reviews system in PHP MySQL database</h1>
        </div>
    </nav>
    <div class="content home">
        <h2>Add Review To your Website.</h2>
        <p>Check out the below reviews for your website</p>
        <div class="reviews"></div>
        <script src="reviews.js"></script>
        <script>
            new Reviews({
                page_id: 1,
                container: document.querySelector(".reviews")
            });
        </script>
    </div>
</body>
</html> -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="reviews.css">

</head>
<body>
    <nav class="navtop">
        <div>
            <h1>Reviews system in php MYSQL database</h1>
        </div>
    </nav>
    <div class="content home">
        <h2>Add Review To your Website.</h2>
        <p>check out the below reviews for your website</p>
        <div class="reviews"></div>
        <script src="reviews.js"></script>

        <script>
            new reviews({
                page_id:1,
                reviews_per_pagination_page:5,
                current_pagnation_page:1
            });

        </script>

    </div>
    
</body>
</html> -->