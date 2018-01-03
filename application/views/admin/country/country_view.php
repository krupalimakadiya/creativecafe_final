<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><label>Country Master</label></h3>
                <p align="right">
                    <a href="<?php echo base_url(); ?>admin/country/add_country"><button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add records</button></a> &nbsp;
                    <a href="<?php echo base_url(); ?>admin/country/import"><button class="btn btn-primary"><i class="glyphicon glyphicon-import"></i>&nbsp;Imports</button></a> &nbsp;
                    <a href="<?php echo base_url(); ?>admin/country/export"><button class="btn btn-primary"><i class="glyphicon glyphicon-export"></i>&nbsp;Exports</button></a></p>
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                    if ($message != ' ') {
                        ?>
                        <div class="alert alert-success">       <!--green model-->
                            <span class="semibold">Note:</span>&nbsp;&nbsp;
                            <?= $message ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="box-body">
                <form name="frm" method="post" action="<?php echo base_url(); ?>admin/country/deletemultiple">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Check</th>
                                <th>Sr No.</th>
                                <th>Country Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                            $cnt = 1;

                            foreach ($country_list as $country) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="country_id[]"  value="<?php echo $country->country_id; ?>" /></td>
                                    <td><?PHP echo $cnt++; ?> </td>
                                    <td><?PHP echo $country->country_name ?></td>
                                    <td><?php
                                        if ($country->status == '0') {
                                            ?>
                                            <i class="glyphicon glyphicon-remove" style="color:red"></i>
                                            <?php
                                        } else {
                                            ?>
                                            <i class="glyphicon glyphicon-ok" style="color:green" ></i>

                                            <?php
                                        }
                                        ?></td>
                                    <td> 
                                        <div class="dropdown">

                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Action
                                                <span class="caret"></span> <!-- caret -->
                                            </button>

                                            <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                                                <li> <a onclick="openView(<?= $country->country_id ?>);"><i class="fa fa-search"></i><label>View</label></a> </li>                     
                                                <li>    <a href="<?php echo base_url(); ?>admin/country/edit_data/<?php echo $country->country_id ?>" onclick="return confirm('you want to edit...........')"><i class="fa fa-edit"></i><label>Edit</label></a></li>
                                                <li>    <a href="<?php echo base_url(); ?>admin/country/delete/<?php echo $country->country_id ?>" onclick="return confirm('you want to delete...........')"><i class="fa fa-trash"></i><label>Delete</label></a></li>
                                                <li><?php
                                                    if ($country->status == '0') {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/country/update_status_active/<?php echo $country->country_id ?>"><i class="glyphicon glyphicon-ok" style="color:green"></i><label>Active</label></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/country/update_status_deactive/<?php echo $country->country_id ?>"><i class="glyphicon glyphicon-remove" style="color:red"></i><label>Deactive</label></a>
                                                        <?php
                                                    }
                                                    ?></li>
                                            </ul>
                                        </div>

                                        <div id="myModal<?= $country->country_id ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><label>Country Data</label></h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <table  width="40%">
                                                            <tr>
                                                                <td><label>Country ID</label></td>
                                                                <td>:&nbsp;&nbsp;<?php echo $country->country_id ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Country Name</label></td>
                                                                <td>:&nbsp;&nbsp;<?php echo $country->country_name ?></td>
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

                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <p align="right"><i class="glyphicon glyphicon-ok" style="color:green" ></i>&nbsp;&nbsp;&nbsp;&nbsp;<label>Indicates Activated</label>
                    <br/>
                    <i class="glyphicon glyphicon-remove" style="color:red" ></i>&nbsp;<label>Indicates Deactivated</label>
                </p>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    function openView(id) {
        $('#myModal' + id).modal('show');
    }
</script>
