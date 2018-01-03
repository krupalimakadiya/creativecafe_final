<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content">
            <!-- Default box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><label>User Master</label></h3>
                    <p align="right">
                        <a href="<?php echo base_url(); ?>admin/user/add_user"><button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add records</button></a> &nbsp;
                        <a href="<?php echo base_url(); ?>admin/user/import"><button class="btn btn-primary"><i class="glyphicon glyphicon-import"></i>&nbsp;Imports</button></a> &nbsp;
                        <a href="<?php echo base_url(); ?>admin/user/export"><button class="btn btn-primary"><i class="glyphicon glyphicon-export"></i>&nbsp;Exports</button></a></p>
                    <?php
                    $message = $this->session->flashdata('message');
                    if (isset($message)) {

                        if ($message != ' ') {
                            ?>
                            <div class="alert alert-success">
                                <span class="semibold">Note:</span>&nbsp;&nbsp;
                                <?= $message ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="box-body">
                    <form name="frm" method="post" action="<?php echo base_url(); ?>admin/user/deletemultiple">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Check</th>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP
                                $cnt = 1;
                                foreach ($user_list as $user) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="user_id[]" value="<?php echo $user->user_id ?>"/></td>
                                        <td><?PHP echo $cnt++; ?> </td>
                                        <td><?PHP echo $user->first_name ?></td>
                                        <td><?PHP echo $user->last_name ?></td>
                                        <td><?PHP echo $user->email ?></td>
                                        <td><?PHP echo $user->city_name ?></td>
                                        <td><?php
                                            if ($user->status == '0') {
                                                ?>
                                                <i class="glyphicon glyphicon-remove" style="color:red"></i>
                                                <?php
                                            } else {
                                                ?>
                                                <i class="glyphicon glyphicon-ok" style="color:green" ></i>

                                                <?php
                                            }
                                            ?></td>
                                        <td> <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Action
                                                    <span class="caret"></span> <!-- caret -->
                                                </button>

                                                <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                                                    <li> <a onclick="openView(<?= $user->user_id ?>);"><i class="fa fa-search"></i><label>View</label></a> </li>                     
                                                    <li> <a href="<?php echo base_url(); ?>admin/user/edit_data/<?php echo $user->user_id; ?>" onclick="return confirm('you want to edit...........')"><i class="fa fa-edit"></i><label>Edit</label></a></li>
                                                    <li>    <a href="<?php echo base_url(); ?>admin/user/delete/<?php echo $user->user_id; ?>" onclick="return confirm('you want to delete...........')"><i class="fa fa-trash"></i><label>Delete</label></a></li>
                                                    <li><?php
                                                        if ($user->status == '0') {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>admin/user/update_status_active/<?php echo $user->user_id ?>"><i class="glyphicon glyphicon-ok" style="color:green"></i><label>Active</label></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>admin/user/update_status_deactive/<?php echo $user->user_id ?>"><i class="glyphicon glyphicon-remove" style="color:red"></i><label>Deactive</label></a>
                                                            <?php
                                                        }
                                                        ?></li>
                                                </ul>
                                            </div>
                                            <div id="myModal<?= $user->user_id ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"><label>User Data</label></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table  width="60%">
                                                                <tr>
                                                                    <td><label>First Name</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->first_name ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Last Name</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->last_name ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Country Name</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->country_name ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>State Name</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->state_name ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>City Name</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->city_name ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Pincode</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->pincode ?></td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td><label>Email</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->email ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Mobile</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->mobile ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Password</label></td>
                                                                    <td>:&nbsp;&nbsp;<?php echo $user->password ?></td>
                                                                </tr>     
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <?PHP
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Action</button>

                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span> <!-- caret -->
                                </button>

                                <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                                    <li>    <input type="submit" name="submit" value="Delete Selected" onclick="return confirm('Are You Sure You Want to Delete ?')"/></li>                     
                                    <li>    <input type="submit" name="submit1" value="Active All" onclick="return confirm('Are You Sure You Want to active all records ?')"/></li>                                                                
                                    <li>     <input type="submit" name="submit2" value="Deactive All" onclick="return confirm('Are You Sure You Want to Deactive all record ?')"/></li>                     

                                </ul>
                            </div>
                            <p align="right"><i class="glyphicon glyphicon-ok" style="color:green" ></i>&nbsp;&nbsp;&nbsp;&nbsp;<label>Indicates Activated</label>
                                <br/>
                                <i class="glyphicon glyphicon-remove" style="color:red" ></i>&nbsp;<label>Indicates Deactivated</label>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
        </section>
</div>
<script type="text/javascript">
    function openView(id) {
        $('#myModal' + id).modal('show');
    }
</script>
