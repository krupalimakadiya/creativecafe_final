<!DOCTYPE html>
<html>
    <head>
        <?php
        include('admin/header_include.php');
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <?php
                include('admin/header_body.php');
                ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <?php
                include('admin/header_body_aside.php');
                ?>
            </aside>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><label>State Master</label></h3>
                            <a href="<?php echo site_url("state/view_state") ?>" class="btn btn-primary pull-right">
                                <label class="fa fa-plus label-btn-icon"></label>
                                &nbsp;<label class="label-btn-fonts">View Records</label>
                            </a>
                        </div>

                        <div class="box-body">
                            <?php
                            if (isset($update_data)) {
                                ?>

                                <form name="statefrm" method="POST" action="<?php echo site_url("state/editp") ?>" role="form" >
                                    <input type="hidden" name="state_id" value="<?php echo $update_data['state_id'] ?>" />

                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Country_name</label>                                     
                                        <select name="country_id" id="country_id" class="form-control">
                                            <?php
                                            foreach ($country_list as $country) {
                                                if ($country->country_id == $update_data['country_id']) {
                                                    ?>
                                                    <option selected value="<?php echo $update_data['country_id'] ?>"><?php echo $country->country_name ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $update_data['country_id'] ?>"><?php echo $country->country_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>State Name</label>
                                        <input type="text" class="form-control"name="state_name" value="<?php echo $update_data['state_name'] ?>" >

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>

                                <form name="statefrm" method="POST" action="<?php echo site_url("state/addp") ?>" role="form" >

                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Select Country_name</label>
                                        <select name="country_id" class="form-control">
                                            <option >--select--</option>
                                            <?php
                                            foreach ($country_list as $country) {
                                                ?>
                                                <option value="<?php echo $country->country_id ?>" ><?php echo $country->country_name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>State_name</label>
                                        <input type="text" class="form-control"name="state_name"  placeholder="Enter State Name....">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </section>

                <!-- Main content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <?php
                include('admin/footer_body.php');
                ?>
            </footer>


            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php
        include('admin/footer_include.php');
        ?>
    </body>
</html>
