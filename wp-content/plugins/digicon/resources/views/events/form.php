<style type="text/css">
    .required{
        color: red;
    }
    .lite-form-style {
        max-width: 500px;
        width: 100%;
    }
    h1,h2,h3,h4 {
        margin: 0;
    }
    .lite-lbl {
        display: block;
    }
    .form-lite-group {
        padding: 5px;
        margin-bottom: 5px;
    }
    .form-lite-group textarea {
        height: 100px !important;
        resize: none;
    }
    .form-lite-group input[type=text], input[type=number], select, textarea {
        box-sizing : border-box;
        display: block;
        width: 100%;
        font-size: 13px;
        padding: 5px;
    }
    .form-lite-group input {
        display: inline-block;
    }
</style>

<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
    <div class="lite-form-style" style="margin-top: 50px">
        <div class="header">
            <h3>Create Event</h3>
        </div>
        <?php
            if(isset($event)){
                ?>
                <input type="hidden" name="id" value="<?php echo $event->id ?>">
                <?php
            }
        ?>
        <div class="content">
            <div class="form-lite-group">
                <label for="" class="lite-lbl"><small>Code <span class="required">*</span></small></label>
                <input type="text" class="form-control" name="code" value="<?php echo isset($event) ? $event->code : '' ?>">
            </div>
        </div>
        <div class="content">
            <div class="form-lite-group">
                <label for="" class="lite-lbl"><small>Title <span class="required">*</span></small></label>
                <input type="text" class="form-control" name="title" value="<?php echo isset($event) ? $event->title : '' ?>">
            </div>
        </div>
        <div class="footer">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
        </div>
    </div>
</form>