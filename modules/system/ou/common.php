<?php
if(!defined('QWP_ROOT')){exit('Invalid Request');}
function get_user_roles(&$roles) {
    $where = 'id<>1';
    qwp_db_get_data('sys_role', $roles, 'id,name', $where);
}
function get_user_roles_ids() {
    $options = array(
        'where' => 'id<>1',
        'flat' => true,
    );
    qwp_db_get_data('sys_role', $roles, 'id', $options);
    return $roles;
}
function get_user_data_modal(&$modal) {
    $modal = array(
        array(
            'table' => 'u',
            array('account', 'Account', 100, true),
            array('name', 'Name', 100, true),
            'id,create_time,role',
            'last_login_time,pwd',
        ),
        array(
            'table' => 'r',
            array('name', 'Role', 100, true),
        ),
        array(
            'table' => 'u',
            'group' => array('group', L('Grouped Fields')),
            array('phone', 'Phone', 100, true),
            array('online', 'Online', 60, true),
        ),
        'alias' => array(
            'r.name' => 'role_name',
        ),
        array('', 'Operation', 100),
    );
}