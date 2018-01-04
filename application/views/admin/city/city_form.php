<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><label>City Master</label></h3>
                <a href="<?php echo base_url() ?>admin/city" class="btn btn-primary pull-right">
                    <label class="fa fa-plus label-btn-icon"></label>
                    &nbsp;<label class="label-btn-fonts">View Records</label>
                </a>
            </div>
            <div class="box-body">
                <?php
                if (isset($update_data)) {
                    ?>
                    <form name="cityfrm" method="POST" action="<?php echo base_url() ?>admin/city/editp" role="form">
                        <input type="hidden" name="city_id" value="<?php echo $update_data['city_id'] ?>" />
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
                            <select name="state_id" id="state_id" class="form-control">

                                <?php
                                foreach ($state_list as $state) {
                                    if ($state->state_id == $update_data['state_id']) {
                                        ?>
                                        <option selected value="<?php echo $state->state_id ?>"> <?php echo $state->state_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>City Name</label>
                            <input type="text" class="form-control"name="city_name" value="<?php echo $update_data['city_name'] ?>" >

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                        </div>
                    </form>
                    <?php
                } else {
                    ?>

                    <form name="cityfrm" method="POST" action="<?php echo base_url(); ?>admin/city/addp" role="form" >

                        <!-- text input -->
                        <div class="form-group">
                            <label>Select Country_name</label>
                            <select name="country_id" id="country_id" class="form-control">
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
                            <label>Select State Name</label>
                            <td><select name="state_id" id="state_id" class="form-control">
                                    <option></option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label>City Name</label>
                            <input type="text" class="form-control" name="city_name"  placeholder="Enter City Name....">
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

<script>
    $("document").ready(function () {
        // $("#state").hide();
        $("#country_id").change(function () {
            $("#state_id").show();
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/city/drop_state",
                type: "POST",
                data: {country_id: id},
                success: function (result) {
                    //alert(result);
                    $("#state_id").html(result);
                }

            });
        });

    });
</script>