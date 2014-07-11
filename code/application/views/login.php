<!DOCTYPE html>
<html lang="en">
    <head>
       <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta name="description" content="This is a little app targeting the client management.">
       <meta name="keywords" content="CodeIgniter Mini Client Manager">
       <meta name="author" content="Gyork 'huncyrus' Bakonyi">
    
       <title>CI Mini Client Manager - By Györk 'huncyrus' Bakonyi @2014</title>
    
       <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
       <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
       <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
    </head>
    <body>
        <div id="fullscreen_bg" class="fullscreen_bg" />
            <div class="container" id="loginform">
                <?php
                $attributes = array('class' => 'form-signin');
                echo form_open('admin/do_login', $attributes);
                ?>
                    <h1 class="form-signin-heading text-muted">Sign In</h1>
                    <div class="input-group">
                        <?php echo form_input('user_name', '', 'placeholder="Username" required="" autofocus="" class="form-control"'); ?>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                    </div>
                    <div class="input-group">
                        <?php echo form_password('pass', '', 'placeholder="Password" required="" class="form-control"'); ?>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                    </div>
                    
                    <?php echo form_submit('submit', 'Login', 'class="btn btn-lg btn-primary btn-block"'); ?>
                </form>
                <p class="text-center">*required both, min 3 char, max 200 char, aA-zZ0-9, no joker char.</p> <br />
                <?php
                if(isset($message_error) && $message_error){
                    echo '<p class="errormsg bg-danger text-center"><strong>Oh snap!</strong> Change a few things up and try submitting again.</p>';
                }
                ?>
            </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
    </body>
</html>