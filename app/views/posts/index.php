<?php require_once APPROOT ."/views/inc/header.php" ?>
    <?php flash("post_message"); ?>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
            <a href="<?php echo URLROOT;?>/posts/add" class="btn blue">
            <i class="fas fa-pencil-alt"></i> Add Post
            </a>
        </div>
    </div>
    <?php foreach ($data["posts"] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title py-0 mb-0"><?php echo $post->title; ?>
            <span id="author" class="float-right text-muted blockquote m-0">by <?php echo $post->name; ?></span>
            </h4>
            <p class="text-muted m-0">Created on <?php echo $post->postCreated; ?></p>
            <p class="card-text mt-3"><?php echo substr($post->body, 0, 300); ?></p>
            <a id="moreButton" href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postID; ?>" class="btn btn-outline-primary">
            More...</a>
        </div>
    <?php endforeach; ?>
<?php require_once APPROOT ."/views/inc/footer.php" ?>
