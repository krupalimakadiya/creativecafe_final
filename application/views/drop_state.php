<option >--select--</option> 
<?php
foreach ($update_data as $state) {
    ?>
    <option value="<?php echo $state->state_id ?>"><?php echo $state->state_name ?></option>
    <?php
}

