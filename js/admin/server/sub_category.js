var subCategoryListTemplate = Handlebars.compile($('#sub_category_list_template').html());
var subCategoryTableTemplate = Handlebars.compile($('#sub_category_table_template').html());
var subCategoryFormTemplate = Handlebars.compile($('#sub_category_form_template').html());
var subCategoryActionButtonsTemplate = Handlebars.compile($('#sub_category_action_button_template').html());
var SubCategory = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

SubCategory.Router = Backbone.Router.extend({
    routes: {
        'sub_category/list': 'renderList'
    },
    renderList: function () {
        SubCategory.listview.listPage();
    }
});
SubCategory.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click #save_sub_category_btn': 'saveSubCategory',
        'click #update_sub_category_btn': 'saveSubCategory'
    },
    listPage: function () {
        this.$el.html(subCategoryListTemplate);
        $('#sub_category_data_table').html(subCategoryTableTemplate);
        this.loadSubCategoryTable();
    },
    loadSubCategoryTable: function () {
        var subCategoryActionRenderer = function (data, type, full, meta) {
            return subCategoryActionButtonsTemplate({"sub_category_id": data});
        };
        SubCategoryDataTable = $('#sub_category_table').DataTable({
            ajax: {url: 'admin/sub_category/get_sub_category', dataSrc: "", type: "post"},
            bAutoWidth: false,
            ordering: false,
            columns: [
                {data: 'sub_category_name'},
                {data: 'sub_category_description'},
                {
                    "className": '',
                    "orderable": false,
                    "data": 'sub_category_id',
                    "render": subCategoryActionRenderer
                }
            ]
        });
    },
    newSubCategory: function () {
        $('#sub_category_form_div').html(subCategoryFormTemplate);
        $('#update_sub_category_btn').hide();
    },
    saveSubCategory: function () {
        var that = this;
        var subCategoryFormData = $('#sub_category_form').serializeFormJSON();
        if (subCategoryFormData.sub_category_name == '') {
            showError('Please Enter Sub Category Name');
            $('#sub_category_name').focus();
            return false;
        }
        if (subCategoryFormData.sub_category_description == '') {
            showError('Please Enter Sub Category Description');
            $('#sub_category_description').focus();
            return false;
        }
        $('#spinner_sub_category_btn').html(spinnerTemplate);
        $('#spinner_sub_category_btn').show();
        $('#save_sub_category_btn').hide();
        $('#update_sub_category_btn').hide();
        var url;
        if (subCategoryFormData.sub_category_id == '') {
            url = 'create';
        } else {
            url = 'update';
        }
        $.ajax({
            type: 'POST',
            url: "admin/sub_category/" + url + '_sub_category',
            data: subCategoryFormData,
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#spinner_sub_category_btn').html('');
                $('#spinner_sub_category_btn').hide();
                if (url == 'create') {
                    $('#save_sub_category_btn').show();
                } else if (url == 'update') {
                    $('#update_sub_category_btn').show();
                }
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                var subCategoryItemObj = {};
                subCategoryItemObj[parseData.sub_category_data['sub_category_id']] = parseData.sub_category_data;
                subCategoryData = $.extend({}, subCategoryData, subCategoryItemObj);
                SubCategoryDataTable.ajax.reload();
                that.newSubCategory();
            }
        });
    },
    deleteSubCategory: function (subCategoryId) {
        getConfirm(function (result) {
            if (result === false) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "admin/sub_category/delete_sub_category",
                data: {"sub_category_id": subCategoryId},
                success: function (data) {
                    var parseData = JSON.parse(data);
                    if (parseData.success == false) {
                        showError(parseData.message);
                        return false;
                    }
                    showSuccess(parseData.message);
                    delete subCategoryData[subCategoryId];
                    SubCategoryDataTable.ajax.reload();
                }
            });
        });
    },
    editSubCategory: function (subCategoryId) {
        var that = this;
        $.ajax({
            type: 'POST',
            url: "admin/sub_category/get_sub_category_by_id",
            data: {"sub_category_id": subCategoryId},
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#sub_category_form_div').html(subCategoryFormTemplate({"sub_category_data": parseData.sub_category_data}));
                $('#save_sub_category_btn').hide();
            }
        });
    }
});