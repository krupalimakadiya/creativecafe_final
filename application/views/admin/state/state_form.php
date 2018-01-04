<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><label>State Master</label></h3>
                <a href="<?php echo base_url(); ?>admin/state" class="btn btn-primary pull-right">
                    <label class="fa fa-plus label-btn-icon"></label>
                    &nbsp;<label class="label-btn-fonts">View Records</label>
                </a>
            </div>

            <div class="box-body">
                <?php
                if (isset($update_data)) {
                    ?>

                    <form name="statefrm" method="POST" action="<?php echo base_url(); ?>admin/state/editp" role="form" >
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

                    <form name="statefrm" method="POST" action="<?php echo base_url(); ?>admin/state/addp" role="form" >
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
        </div>
    </section>
</div>
