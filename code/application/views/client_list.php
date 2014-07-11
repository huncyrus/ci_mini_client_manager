                        <h1>Client Management</h1>
                        <br />
                        <h3 class="text-center"><a href="<?php echo base_url('/admin/addclient') ?>">Add new</a></h3>
                        <?php
                        
                        if (isset($success) && $success != '') {
                            if ($success == 'del_success') {
                                ?> <p class="bg-success">Client deleted successfully!</p> <?php
                            }
                        }
                        
                        if (isset($error) && $error != '') {
                            ?>
                            <p class="bg-danger text-danger">
                                Error:
                                <?php
                                switch($error) {
                                    case 'error_d1':
                                        ?> Incorrect Id or client doesn't exists. <?php
                                        break;
                                    case 'error_d2':
                                        ?> Invalid Id or client. <?php
                                        break;
                                }
                                ?>
                            </p>
                            <?php
                        }
                        
                        if ($client_list == false) {
                            ?>
                            <p class="bg-info">Sorry, there isn't any client in the database.</p>
                            <?php
                        } else {
                            ?>
                            <div class="table-responsive filterable">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                </div>
                                <table id="mytable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Photo Link</th>
                                            <th>Birth</th>
                                            <th>Created</th>
                                            <th>Other</th>
                                            <th>Option</th>
                                        </tr>
                                        <tr class="filters">
                                            <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Phone" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Photo Link" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Birth" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Created" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Other" disabled></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($client_list); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $client_list[$i]['name']; ?></td>
                                                <td><?php echo $client_list[$i]['phone']; ?></td>
                                                <td><?php echo $client_list[$i]['email']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($client_list[$i]['photo_url'] == '' || $client_list[$i]['photo_url'] == 'nophotohere') {
                                                            echo 'n/a';
                                                        } else {
                                                            ?>
                                                            <a href="<?php echo base_url($client_list[$i]['photo_url']); ?>" target="_blank">link</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $client_list[$i]['birth']; ?></td>
                                                <td><?php echo $client_list[$i]['crdate']; ?></td>
                                                <td><?php echo $client_list[$i]['other']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/updateclient/' . md5($client_list[$i]['id']) ); ?>">Edit</a>
                                                    |
                                                    <a href="<?php echo base_url('admin/delclient/' . md5($client_list[$i]['id']) ); ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        // for end
                                        
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <?php
                        }
                        ?>