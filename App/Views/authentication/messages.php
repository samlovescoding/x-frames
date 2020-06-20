<?php
    if(session()->has("validationError")):
        foreach (session()->flash("validationError") as $error):
        ?>
            <div class="alert alert-danger">
                <?=ucfirst($error->getMessage());?>
            </div>
        <?php
        endforeach;
    endif;
?>