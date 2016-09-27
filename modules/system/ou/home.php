<?php
if(!defined('QWP_ROOT')){exit('Invalid Request');}
qwp_ui_init_table();
$option = array(
    'where' => 'id<>1'
);
global $roles;
get_user_roles($roles);
qwp_ui_init_dialog();
qwp_create_dialog_with_form("dialog_user", array(
    'width' => '460px',
    'height' => '280px',
), 'user');
?>
<div class="user-div">
<div class="row well qwp-search hide">
    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <form class="form-inline" id="search_form" onsubmit="return false;">
        <div class="form-group">
            <input type="text" name="s[account]" class="form-control" placeholder="Account">
        </div>
        <div class="form-group">
            <input type="text" name="s[name]" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <input type="text" name="s[email]" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <select name="s[gender]" class="form-control">
                <option value="">All Gender</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="x">Unset</option>
                <option value="s">Is set</option>
            </select>
        </div>
        <div class="form-group">
            <select name="s[avatar]" class="form-control">
                <option value="">All</option>
                <option value="1">Has avatar</option>
                <option value="0">No avatar</option>
            </select>
        </div>
        <div class="form-group">
            <select name="s[role]" class="form-control">
                <option value=""><?php EL('All Roles');?></option>
                <?php foreach($roles as $role_item) {
                    echo(format('<option value="{0}">{1}</option>', $role_item['id'], L($role_item['name'])));
                }?>
            </select>
        </div>
        <button onclick="fetchUsersData()" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></button>
        <button type="reset" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-remove"></i></button>
    </form>
</div>
<div id="users-table" class="row qwp-table"></div>
</div>