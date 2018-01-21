
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
                                        <h3 class="box-title"><label>State Master</label></h3>
                                    </div>
                                    <!-- /.box-header -->

                                    <div class="box-body">

                                        <form role="form" method="post" action="<?php echo base_url()?>admin/state/importp"  enctype="multipart/form-data">
                                            <!-- text input-->
                                            <div class="form-group">
                                                <label>Upload File</label>
                                                <input type="file" class="form-control"  name="upload">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-primary">Upload
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->

                                </section>

                                <!-- Main content -->
                            </div>
                            <!-- /.content-wrapper -->

