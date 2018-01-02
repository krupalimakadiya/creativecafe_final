<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function is_post() {
    if (!(filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')) {
        exit('Invalid Access');
    }
}

function check_admin_authenticated() {
    if (!is_admin_authenticated()) {
        header("Location:" . base_url() . "admin/login");
    }
}

function check_admin_session() {
    if (!is_admin_authenticated()) {
        return 'no_session';
    }
    return '';
}

function is_admin_authenticated() {
    $CI = & get_instance();
    $user_id = $CI->session->userdata('user_id');
    if (is_null($user_id) || $user_id == '') {
        return false;
    }
    return true;
}

/**
 * Fetch the value from SESSION
 * @param type $key
 * @return type
 */
function get_from_session($key) {
    $CI = & get_instance();
    $value = $CI->session->userdata($key);
    return $value;
}

/**
 * Fetch the value from POST. Will be trim() by default.
 * @param type $key - key to fetch from POST
 * @param type $trim - Optional. Default is TRUE
 * @return type
 */
function get_from_post($key, $trim = TRUE) {
    $CI = & get_instance();
    return $trim ? trim($CI->input->post($key)) : $CI->input->post($key);
}

/**
 * check the login user is super admin or admin
 * @return type
 */
function is_super_admin() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('user_type');
    return $user_type == SUPER_ADMIN;
}

/**
 * EOF: ./application/helpers/request_helper.php
 */