<?php
$form_rule = array(
    'cssSelector' => '#user_info',
    'rules' => array(
        'account' => array(
            'required' => true,
            'letters' => true,
            '_msg' => L('Account is required and must be letters'),
        ),
        'pwd' => array(
            'required' => true,
            'rangelength' => array(6, 32),
            'password' => true,
        ),
        'role' => array(
            'required' => true,
            'in' => get_user_roles_ids(),
        ),
        'phone' => array(
            'digits' => true,
        ),
        'avatar' => array(
            'optional' => true,
        ),
    ),
    'files' => array(
        'avatar' => array('jpg,gif,png', '1024,2048000'),
    ),
    'confirmDialog' => 'qwp_mbox',
    'formParentDialog' => 'dialog_user',
    'mbox' => array(
        'title' => L('Save user info confirmation'),
        'message' => L('Are you sure to save user info?'),
    ),
    'actionMessage' => L('User is being save, please wait...'),
    'actionHandler' => 'userOpsCallback',
);