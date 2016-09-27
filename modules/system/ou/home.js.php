<?php
if(!defined('QWP_ROOT')){exit('Invalid Request');}
get_user_data_modal($user_modal);
qwp_db_get_table_header_from_modal($user_modal, $users_header);
?>
<script>
var needReset = false, tableName = 'users', loadingNotes = {success: $L('Users data is loading...'), failed: $L('Failed to load user data')};
function userOpsCallback(res, data, params) {
    if (params.ops == 'add') {
        if (res.ret) {
            needReset = true;
            qwp.table.load(tableName);
        } else {
            needReset = false;
        }
    }
}
function addNewUser() {
    qwp.form.action('#user_info', 'add', {
        reset: needReset,
        dialog: ['dialog_user', $L('Add a new user')],
        msgBox: {
            title : $L('Add new user confirmation'),
            message : $L('Are you sure to create this user?')
        }
    });
}
function editUser() {
    var ids = qwp.table.selectedIDs(tableName);
    if (ids.length === 0) {
        qwp.notice($L('No user is selected to edit!'), {type: 'warning'});
        return;
    }
    if (ids.length > 1) {
        qwp.notice($L('Please select only one user to edit!'), {type: 'warning'});
        return;
    }
    var id = ids[0];
    qwp.notice($L('User information is loading, please wait...'));
    qwp.get({
        quiet: true,
        url: qwp.uri.currentOps('list', {id: id}),
        fn:function(res, data) {
            if (!res.ret) return;
            if (!data || !data.length) {
                qwp.notice($L('Failed to get user data'), {type: 'warning'});
                return;
            }
            qwp.removeNotice();
            needReset = true;
            qwp.form.reset('#user_info');
            qwp.form.fill('#user_info', data[0], true);
            qwp.form.action('#user_info', 'edit', {
                reset: false,
                dialog: ['dialog_user', $L('Edit user information')],
                msgBox: {
                    title : $L('Edit user confirmation'),
                    message : $L('Are you sure to modify the information of this user?')
                },
                params: {id: id}
            });
        }
    });
}
function delUser(ids) {
    qwp.post({
        url:qwp.uri.currentOps('del'),
        params: {f: ids.join(',')},
        fn: function(res) {
            if (res.ret) qwp.table.load(tableName);
        }
    });
}
function initPage(){
    qwp.table.create('#users-table', tableName, {
        fetchData: 'fetchUsersData',
        selectable: true,
        simpleSearch: 'search_form',
        advSearch: 'adv_search_form',
        loadingNotes: loadingNotes,
        listOp: 'list_user',
        getRowDetail: function(r) {
            return "&nbsp; This is user: {0}'s detail information".format(r.id);
        },
        btns: {
            new:{
                click: addNewUser,
                tooltip:'Create a new user'
            },
            edit:{
                click: editUser,
                tooltip:'Edit user information'
            },
            del:{
                click: function() {
                    var ids = qwp.table.selectedIDs(tableName);
                    if (ids.length === 0) {
                        qwp.notice($L('Please select users!'), {type: 'warning'});
                        return;
                    }
                    qwp.dialog.showMsgBox({
                        title : $L('Delete users'),
                        message : $L('Are you sure to delete the selected users?'),
                        ok: function() {delUser(ids);}
                    });
                },
                tooltip:'Delete selected users'
            }
        },
        topCols:{
            left:5,
            right:7
        },
        header:<?php echo_json($users_header)?>
    });
    qwp.table.load(tableName);
}
</script>