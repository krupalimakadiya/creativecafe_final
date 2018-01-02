var categoryListTemplate = Handlebars.compile($('#category_list_template').html());
var categoryTableTemplate = Handlebars.compile($('#category_table_template').html());
var categoryFormTemplate = Handlebars.compile($('#category_form_template').html());
var categoryActionButtonsTemplate = Handlebars.compile($('#category_action_button_template').html());
var Category = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Category.Router = Backbone.Router.extend({
    routes: {
        'category/list': 'renderList'
    },
    renderList: function () {
        Category.listview.listPage();
    }
});
Category.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click #save_category_btn': 'saveCategory',
        'click #update_category_btn': 'saveCategory'
    },
    listPage: function () {
        this.$el.html(categoryListTemplate);
        $('#category_data_table').html(categoryTableTemplate);
        this.loadCategoryTable();
    },
    loadCategoryTable: function () {
        var categoryActionRenderer = function (data, type, full, meta) {
            return categoryActionButtonsTemplate({"category_id": data});
        };
        categoryDataTable = $('#category_table').DataTable({
            ajax: {url: 'admin/category/get_category', dataSrc: "", type: "post"},
            bAutoWidth: false,
            ordering: false,
            columns: [
                {data: 'category_name'},
                {data: 'category_description'},
                {
                    "className": '',
                    "orderable": false,
                    "data": 'category_id',
                    "render": categoryActionRenderer
                }
            ]
        });
    },
    newCategory: function () {
        $('#category_form_div').html(categoryFormTemplate);
        $('#update_category_btn').hide();
    },
    saveCategory: function () {
        var that = this;
        var categoryFormData = $('#category_form').serializeFormJSON();
        if (categoryFormData.category_name == '') {
            showError('Please Enter Category Name');
            $('#category_name').focus();
            return false;
        }
        if (categoryFormData.category_description == '') {
            showError('Please Enter Category Description');
            $('#category_description').focus();
            return false;
        }
        $('#spinner_category_btn').html(spinnerTemplate);
        $('#spinner_category_btn').show();
        $('#save_category_btn').hide();
        $('#update_category_btn').hide();
        var url;
        if (categoryFormData.category_id == '') {
            url = 'create';
        } else {
            url = 'update';
        }
        $.ajax({
            type: 'POST',
            url: "admin/category/" + url + '_category',
            data: categoryFormData,
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#spinner_category_btn').html('');
                $('#spinner_category_btn').hide();
                if (url == 'create') {
                    $('#save_category_btn').show();
                } else if (url == 'update') {
                    $('#update_category_btn').show();
                }
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                var categoryItemObj = {};
                categoryItemObj[parseData.category_data['category_id']] = parseData.category_data;
                categoryData = $.extend({}, categoryData, categoryItemObj);

                categoryDataTable.ajax.reload();
                that.newCategory();
            }
        });
    },
    deleteCategory: function (categoryId) {
        getConfirm(function (result) {
            if (result === false) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "admin/category/delete_category",
                data: {"category_id": categoryId},
                success: function (data) {
                    var parseData = JSON.parse(data);
                    if (parseData.success == false) {
                        showError(parseData.message);
                        return false;
                    }
                    showSuccess(parseData.message);
                    delete categoryData[categoryId];
                    categoryDataTable.ajax.reload();
                }
            });
        });
    },
    editCategory: function (categoryId) {
        var that = this;
        $.ajax({
            type: 'POST',
            url: "admin/category/get_category_by_id",
            data: {"category_id": categoryId},
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#category_form_div').html(categoryFormTemplate({"category_data": parseData.category_data}));
                $('#save_category_btn').hide();
            }
        });
    }
});