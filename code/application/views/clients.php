<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="This is a little app targeting the client management.">
   <meta name="keywords" content="CodeIgniter Mini Client Manager">
   <meta name="author" content="Gyork 'huncyrus' Bakonyi">

   <title>Client Manager | CI Mini Client Manager - By Györk 'huncyrus' Bakonyi @2014</title>

   <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
</head>
<body>
    <div id="navbar-example" class="navbar navbar-inverse navbar-static navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CI Mini Client Manager</a>
            </div>
            <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url('/logout');?>">Logout</a></li>
                    <li><a href="<?php echo base_url('/admin/clients');?>">Clients</a></li>
                    <li><a href="<?php echo base_url('/admin/emails');?>">Emails</a></li>
                    <li><p class="navbar-text">Example App with CI + Bootstrap + jQuery</p></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div id="mycontent" class="container-fluid">
        <div class="row">
            <h1>Client Manager Modul</h1>
            <p>This modul handle the clients datas. You can add/remove/modify them.</p>

        <?php
            if (!isset($section)) {
                $section = 'clients_list';
            }

            switch($section) {
                case 'clients_list':
                    $this->load->view('client_list');
                    break;
                case 'add_clients':
                    $this->load->view('client_add');
                    break;
                case 'update_client':
                    $this->load->view('client_update');
                    break;
            }
        ?>
        </div>
    </div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.tablesorter.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
</body>
</html>
