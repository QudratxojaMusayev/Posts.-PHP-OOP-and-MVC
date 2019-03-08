<?php require_once APPROOT ."/views/inc/header.php" ?>
    <h1><?php echo $data["post"]->title ?></h1>
    <div class="blue lighten-1 text-white p-2 mb-3">
        Written by <?php echo $data["user"]->name; ?> on <?php echo $data["post"]->created_at; ?>
    </div>
    <p><?php echo $data["post"]->body; ?></p>

<?php if($data["post"]->user_id == $_SESSION["user_id"]) : ?>
    <hr>
    <div class="row justify-content-between">
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data["post"]->id; ?>" class="btn btn-success ml-3">Edit</a>
    <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data["post"]->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger mr-3">
    </form>
    </div>
<?php endif; ?>
<?php require_once APPROOT ."/views/inc/footer.php" ?>
