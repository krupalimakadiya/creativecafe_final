<option >--select--</option>
<?php
foreach ($update_data as $city) {
    ?>
    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
    <?php
}
?>