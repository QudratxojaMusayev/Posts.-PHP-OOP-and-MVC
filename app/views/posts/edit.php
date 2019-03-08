<?php require_once APPROOT ."/views/inc/header.php" ?>
<div id="blog-form" class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Edit post</h4>
        </div>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data["id"]; ?>" method="post">
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fas fa-edit prefix grey-text"></i>
                    <input type="text" name="title" value="<?php echo $data["title"]; ?>" class="form-control <?php echo (!empty($data["title_err"])) ? 'is-invalid': ''; ?>">
                    <label for="title">Title</label>
                    <span class="invalid-feedback"><?php echo $data["title_err"]; ?></span>                        
                </div>
                <div class="md-form">
                    <i class="fas fa-pencil-alt prefix grey-text"></i>
                    <textarea id="form107" name="body" class="md-textarea form-control <?php echo (!empty($data["body_err"])) ? 'is-invalid': ''; ?>" rows="7"><?php echo $data["body"]; ?></textarea>
                    <label for="form107">Write your post here...</label>
                    <span class="invalid-feedback"><?php echo $data["body_err"]; ?></span>   
                </div>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center mb-3">
                    <input type="submit" class="btn blue" value="Edit">
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once APPROOT ."/views/inc/footer.php" ?>