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
                                       
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- /.box -->

                      <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><label>Country Master</label></h3>
                            <a href="<?php echo site_url("country/view_country") ?>" class="btn btn-primary pull-right">
                                <label class="fa fa-icon label-btn-icon"></label>
                                &nbsp;<label class="label-btn-fonts">View Records</label>
                            </a>
                        </div>
                                  <!-- /.box-header -->
                                  
                                    <div class="box-body">
                            <?php
                            if(isset($update_data))
                            {
                           ?>
                            <form role="form" name="countryfrm" method="POST" action="<?php echo site_url("country/editp")?>">
                                <!-- text input -->
                                <input type="hidden" class="form-control" name="country_id" value="<?php echo $update_data['country_id']?>">
                                
                                <div class="form-group">
                                    <label>country name</label>
                                    <input type="text" class="form-control" name="country_name" value="<?php echo $update_data['country_name']?>">
                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">submit
                                    </button>
                                </div>
                            </form>
                            <?php
                            }
                            else
                            {
                            ?>
                            <form role="form" name="countryfrm" method="POST" action="<?php echo site_url("country/addp")?>">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>country name</label>
                                    <input type="text" class="form-control" name="country_name" placeholder="Enter your country name...">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">submit
                                    </button>
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
