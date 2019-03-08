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
    
    <!-- Button trigger modal-->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete">Delete</button>
    </div>
    
    <!--Modal: modalConfirmDelete-->
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center">
                    <p class="heading">Are you sure?</p>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <i class="fas fa-times fa-4x animated rotateIn"></i>

                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data["post"]->id; ?>" method="post">
                    <input type="submit" value="Yes" class="btn btn-outline-danger">
                </form>
                    <a type="button" class="btn btn-danger" data-dismiss="modal">No</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalConfirmDelete-->
<?php endif; ?>
<?php require_once APPROOT ."/views/inc/footer.php" ?>
