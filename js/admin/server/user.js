var userListTemplate = Handlebars.compile($('#user_list_template').html());
var userFormTemplate = Handlebars.compile($('#user_form_template').html());
var UserData = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
UserData.Router = Backbone.Router.extend({
    routes: {
        'user/list': 'renderList'
    },
    renderList: function () {
        UserData.listview.listPage();
    }
});
UserData.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click #save_user_btn': 'saveUser'
    },
    listPage: function () {
        if (USER_TYPE != SUPER_ADMIN) {
            showError("You Can't Access");
        } else {
            this.$el.html(userListTemplate);
            this.loadUserTable();
        }
    },
    newUser: function () {
        $('#user_form_div').html(userFormTemplate);
        $('#update_user_btn').hide();
    },
    loadUserTable: function () {
        var userActionRenderer = function (data, type, full, meta) {
            if (data == IS_ACTIVE_NO) {
                return '<button type="button" class="btn btn-xs btn-info" onclick="UserData.listview.activeDeactiveUser(' + IS_ACTIVE_YES + ',' + full.user_id + ')"><label class="label-btn-fonts">Active</label></button>';
            } else if (data == IS_ACTIVE_YES) {
                return '<button type="button" class="btn btn-xs btn-danger" onclick="UserData.listview.activeDeactiveUser(' + IS_ACTIVE_NO + ',' + full.user_id + ')"><label class="label-btn-fonts">De-Activate</label></button>';
            }
        };
        var userTypeRenderer = function (data, type, full, meta) {
            return userTypeArray[data];
        };
        var userStatusRenderer = function (data, type, full, meta) {
            if (data == IS_ACTIVE_NO) {
                return '<span class="label label-warning">' + statusArray[data] + '</span>';
            } else if (data == IS_ACTIVE_YES) {
                return '<span class="label label-success">' + statusArray[data] + '</span>';
            }
        };
        allUserDataTable = $('#user_table').DataTable({
            ajax: {url: 'admin/signup/get_all_user', dataSrc: "", type: "post"},
            bAutoWidth: false,
            ordering: false,
            columns: [
                {data: 'username'},
                {data: 'name'},
                {data: 'user_type', "render": userTypeRenderer},
                {data: 'is_active', "render": userStatusRenderer},
                {
                    "className": '',
                    "orderable": false,
                    "data": 'is_active',
                    "render": userActionRenderer
                }
            ]
        });
    },
    saveUser: function () {
        var userFormData = $('#registration_form').serializeFormJSON();
        if (userFormData.user_name == "") {
            showError('Please Enter Full Name');
            $('#user_name').focus();
            return false;
        }
        if (userFormData.user_email == "") {
            showError('Please Enter Email Address');
            $('#user_email').focus();
            return false;
        }
        if (userFormData.user_password == "") {
            showError('Please Enter Password');
            $('#user_password').focus();
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "admin/signup/create",
            data: userFormData,
            error: function (textStatus, errorThrown) {
                showError('Some unexpected database error encountered due to which your transaction could not be completed');
            },
            success: function (data) {
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess('You have Succesfully Created Admin User');
                var userItemObj = {};
                userItemObj[parseData.user_data['user_id']] = parseData.user_data;
                userData = $.extend({}, userData, userItemObj);
                allUserDataTable.ajax.reload();
                $('#user_name').val('');
                $('#user_email').val('');
                $('#user_password').val('');
            }
        });
    },
    activeDeactiveUser: function (status, userId) {
        $.ajax({
            type: 'POST',
            url: "admin/signup/active_diactive_user",
            data: {'user_status': status, 'user_id': userId},
            success: function (data) {
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                if (status == IS_ACTIVE_NO) {
                    showSuccess('User Deactive successfully');
                    delete userData[userId];
                } else if (status == IS_ACTIVE_YES) {
                    var userItemObj = {};
                    userItemObj[parseData.user_data['user_id']] = parseData.user_data;
                    userData = $.extend({}, userData, userItemObj);
                    showSuccess('User Active successfully');
                }
                allUserDataTable.ajax.reload();
            }
        });
    }
});