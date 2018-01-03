<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><label>Country Master</label></h3>
                        <a href="<?php echo site_url("admin/country") ?>" class="btn btn-primary pull-right">
                            <label class="fa fa-icon label-btn-icon"></label>
                            &nbsp;<label class="label-btn-fonts">View Records</label>
                        </a>
                    </div>
                    <div class="box-body">
                        <?php
                        if (isset($update_data)) {
                            ?>
                            <form role="form" name="countryfrm" method="POST" action="<?php echo site_url("admin/country/editp") ?>">
                                <!-- text input -->
                                <input type="hidden" class="form-control" name="country_id" value="<?php echo $update_data['country_id'] ?>">

                                <div class="form-group">
                                    <label>country name</label>
                                    <input type="text" class="form-control" name="country_name" value="<?php echo $update_data['country_name'] ?>">

                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">submit
                                    </button>
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <form role="form" name="countryfrm" method="POST" action="<?php echo site_url("admin/country/addp") ?>">
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
                </div>
            </div>
        </div>
    </section>
</div>

