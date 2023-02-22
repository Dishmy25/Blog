<?php
include 'partials/header.php';

//fetch featured posts from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

//fetch 8 posts from posts table
$query = "SELECT * FROM posts ORDER BY  date_time DESC LIMIT 8";
$posts = mysqli_query($connection, $query);
?>

<?php if(mysqli_num_rows($featured_result)==1) : ?>
<section class="featured">
    <div class="container featured_container">
    <div class="post_thumbnail">
        <img src="./images/<?= $featured['thumbnail'] ?>">
    </div>
    <div class="post_info">
        <?php
        $category_id = $featured['category_id'];
        $category_query = "SELECT * FROM categories WHERE id=$category_id";
        $category_result=mysqli_query($connection,$category_query);
        $category = mysqli_fetch_assoc($category_result);
         ?>
        <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>"
         class="category_button"><?= $category['title'] ?></a>
        <h2 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
        <p class="post_body">
            <?= substr($featured['body'],0, 200)?>... 
        </p>
        <div class="post_author">
            <?php 
            $author_id = $featured['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post_author-avatar">
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
<div class="post_author-info">
    <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
    <small>
        <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
    </small>
</div>
        </div>
    </div>
    </div>
</section>
<?php endif ?>


<!---- post ------->


<section class="posts <?= $featured ? '' : 'section_extra-margin' ?>">
    <div class="container posts_container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post_thumbnail">
                <img src="./images/<?= $post['thumbnail'] ?>">
            </div>
            <div class="post_info">
            <?php
        $category_id = $post['category_id'];
        $category_query = "SELECT * FROM categories WHERE id=$category_id";
        $category_result=mysqli_query($connection,$category_query);
        $category = mysqli_fetch_assoc($category_result);
         ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>"
                 class="category_button"><?= $category['title'] ?></a>
                <h3 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?> </a></h3>
                <p class="post_body">
                Despite difficulties, we have managed to maintain our active engagement from the community level to national
                 policy platforms, provision of public information services,and help communities and partners to cope with
                  the unprecedented situation within limited resources.
                    </p>
                    <div class="post_author">
                    <?php 
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
                        <div class="post_author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
            <div class="post_author-info">
            <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
            <small>
        <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
    </small>
            </div>
                    </div>
            </div>
        </article> 
        <?php endwhile ?>
    </div>
</section>




<?php
include 'partials/footer.php';
?>