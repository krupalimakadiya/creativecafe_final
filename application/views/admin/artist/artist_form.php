<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border box-primary" >
                <h3 class="box-title"><label>Artist Master</label></h3>
                <a href="<?php echo base_url(); ?>admin/artist" class="btn btn-primary pull-right">
                    <label class="fa fa-plus label-btn-icon"></label>
                    &nbsp;<label class="label-btn-fonts">View Records</label>
                </a>
            </div>
            <div class="box-body">
                <?php
                if (isset($update_data)) {
                    ?>

                    <form name="artistfrm" method="POST" action="<?php echo base_url(); ?>admin/artist/editp" role="form" >
                        <input type="hidden" name="artist_id" value="<?php echo $update_data['artist_id'] ?>" />
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $update_data['first_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $update_data['last_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Art category id</label>
                            <input type="text" class="form-control" name="art_category_id" value="<?php echo $update_data['art_category_id'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo $update_data['mobile'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $update_data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $update_data['password'] ?>">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label>Country_name</label>                                     
                            <select name="country_id" id="country_id" class="form-control">
                                <?php
                                foreach ($country_list as $country) {
                                    if ($country->country_id == $update_data['country_id']) {
                                        ?>
                                        <option selected value="<?php echo $country->country_id ?>"><?php echo $country->country_name ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $country->country_id ?>"><?php echo $country->country_name ?></option>
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
                                                                                                                                                                                                                    <!-- <option selected value="<?//php echo $state->state_id ?>"> <?php //echo $state->state_name                                       ?></option>-->
                                        <option value="<?php echo $state->state_id; ?>"selected="selected"><?php echo $state->state_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>City Name</label>
                            <select name="city_id" id="city_id" class="form-control">

                                <?php
                                foreach ($city_list as $city) {
                                    if ($city->city_id == $update_data['city_id']) {
                                        ?>
                                        <option value="<?php echo $city->city_id; ?>"selected="selected"><?php echo $city->city_name; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="pincode" value="<?php echo $update_data['pincode'] ?>">
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                        </div>
                    </form>
                    <?php
                } else {
                    ?>

                    <form name="userfrm" method="POST" action="<?php echo base_url(); ?>admin/artist/addp" role="form" >
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter your first name...">
                        </div>
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Enter your last name...">
                        </div>
                        <div class="form-group">
                            <label>Art Category Id</label>
                            <input type="text" class="form-control" name="art_category_id" placeholder="Enter your art category">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile number...">
                        </div>
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email...">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password...">
                        </div>
                        <div class="form-group">
                            <label>Select Country_name</label>
                            <select name="country_id" class="form-control" id="country_id">
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
                            <select name="state_id" id="state_id" class="form-control">
                                <option></option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>City Name</label>
                            <select name="city_id" id="city_id" class="form-control"><option></option></select>
                        </div>

                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="pincode" placeholder="Enter your pincode...">
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
                url: "<?php echo base_url(); ?>admin/user/drop_state",
                type: "POST",
                data: {country_id: id},
                success: function (result) {
                    //alert(result);
                    $("#state_id").html(result);
                }

            });
        });

    });
    $("document").ready(function () {
        // $("#state").hide();
        $("#state_id").change(function () {
            $("#city_id").show();
            var id = $(this).val();

            $.ajax({
                url: "<?php echo base_url(); ?>admin/user/drop_city",
                type: "POST",
                data: {state_id: id},
                success: function (result) {
                    //alert(result);
                    $("#city_id").html(result);
                }

            });
        });

    });
</script>