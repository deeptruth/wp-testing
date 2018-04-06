<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
    <div class="lite-form-style" style="margin-top: 50px">
        <div class="header">
            <h3>Are you sure you want to delete this event?</h3>
        </div>
        <?php
            if(isset($event)){
                ?>
                <input type="hidden" name="id" value="<?php echo $event->id ?>">
                <?php
            }
        ?>
        <div class="footer">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Go">
            <input type="submit" class="button button-cancel" value="Cancel" onclick="window.history.back(); return false;">
        </div>
    </div>
</form>