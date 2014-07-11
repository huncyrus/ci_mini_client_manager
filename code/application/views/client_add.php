<div class="container-fluid">
    <h1>Client Management - Add new</h1>

            <?php
            if(isset($message_error) && $message_error){
                echo '<p class="errormsg bg-danger text-center"><strong>Oh snap!</strong> Change a few things up and try submitting again.</p>';
            }
            if (isset($error_msg)) {
                echo '<p> <pre>';
                print_r($error_msg);
                print '</pre></p>';
            }
        ?>

    <div class="container-fluid" id="clientadd">
        <?php
            $attributes = array('class' => 'form-signin');
            echo form_open_multipart('admin/save_client', $attributes);
            ?>
                <h1 class="form-signin-heading text-muted">Add client</h1>

                <div class="input-group" data-validate="length" data-length="1">
                    <?php echo form_input('name', '', 'placeholder="Name" required="" autofocus="" class="form-control"'); ?>
                    <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                </div>

                <div class="input-group" data-validate="email">
                    <?php echo form_input('email', '', 'placeholder="Email Address" required="" class="form-control"'); ?>
                    <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                </div>

                <div class="input-group input-group-full">
                    <?php echo form_input('phone', '', 'placeholder="Phone Number" class="form-control"'); ?>
                </div>

                <div class="input-group input-group-full">
                    <?php echo form_input('birth', '', 'placeholder="Birthdate" class="form-control" id="datepicker"'); ?>
                </div>

                <div class="input-group input-group-full">
                    <input type="file" name="photo_url" placeholder="Photo" class="form-control" />
                </div>

                <div class="input-group input-group-full">
                    <?php echo form_input('other', '', 'placeholder="Other Info" class="form-control"'); ?>
                </div>

                <?php echo form_submit('submit', 'Save Client', 'class="btn btn-lg btn-primary btn-block"'); ?>
            </form>
            <p class="text-center">*required both, min 3 char, max 200 char, aA-zZ0-9, no joker char.</p> <br />
            <br /> &nbsp; <br /> &nbsp; <br />
    </div>
</div>