<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><label> Art Category Master</label></h3>
                        <a href="<?php echo base_url(); ?>admin/category" class="btn btn-primary pull-right">
                            <label class="fa fa-icon label-btn-icon"></label>
                            &nbsp;<label class="label-btn-fonts">View Records</label>
                        </a>
                    </div>
                    <?php
                    echo $this->session->flashdata('message');
                    ?>
                    <div class="box-body">
                        <?php
                        if (isset($update_data)) {
                            ?>
                            <form role="form" name="categoryfrm" method="POST" action="<?php echo base_url(); ?>admin/category/editp">
                                <!-- text input -->
                                <input type="hidden" class="form-control" name="art_category_id" value="<?php echo $update_data['art_category_id'] ?>">

                                <div class="form-group">
                                    <label>country name</label>
                                    <input type="text" class="form-control" name="art_category_name" value="<?php echo $update_data['art_category_name'] ?>">

                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">submit
                                    </button>
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <form role="form" name="categoryfrm" method="POST" action="<?php echo base_url(); ?>admin/category/addp">
                                <!-- text input -->
                                <div class="form-group">
                                    <label> Art category name</label>
                                    <input type="text" class="form-control" name="art_category_name" placeholder="Enter your art  name...">
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
            </div>
        </div>
    </section>
</div>
