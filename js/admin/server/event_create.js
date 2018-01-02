var eventListTemplate = Handlebars.compile($('#event_list_template').html());
var eventFormTemplate = Handlebars.compile($('#event_form_template').html());
var eventTableTemplate = Handlebars.compile($('#event_table_template').html());
var eventActionButtonTemplate = Handlebars.compile($('#event_action_button_template').html());
var fileUploadTemplate = Handlebars.compile($('#file_upload_template').html());
var EventCreate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

EventCreate.Router = Backbone.Router.extend({
    routes: {
        '': 'renderList',
        'event/list': 'renderList'
    },
    renderList: function () {
        EventCreate.listview.listPage();
    }
});
EventCreate.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click #save_event_btn': 'saveEvent',
        'click #update_event_btn': 'saveEvent'
    },
    listPage: function () {
        this.$el.html(eventListTemplate);
        $('#event_data_table').html(eventTableTemplate);
        this.loadEventTable();
    },
    loadEventTable: function () {
        var eventActionRenderer = function (data, type, full, meta) {
            return eventActionButtonTemplate({"event_id": data});
        };
        eventsDataTable = $('#event_table').DataTable({
            ajax: {url: 'admin/events/get_events_data', dataSrc: "", type: "post"},
            bAutoWidth: false,
            ordering: false,
            columns: [
                {data: 'event_name'},
                {data: 'event_description'},
                {
                    "className": '',
                    "orderable": false,
                    "data": 'event_id',
                    "render": eventActionRenderer
                }
            ]
        });
    },
    newEvent: function () {
        $('#event_form_div').html(eventFormTemplate);
        $('#update_event_btn').hide();
        renderOptionsForTwoDimensionalArrayForRates(eventOrganizedForArray, 'organized_for');
        renderOptionsForTwoDimensionalArrayForRates(eventTypeArray, 'event_type');
        renderOptionsForTwoDimensionalArrayWithKeyValue(categoryData, 'category_id', 'category_id', 'category_name');
        renderOptionsForTwoDimensionalArrayWithKeyValue(subCategoryData, 'sub_category_id', 'sub_category_id', 'sub_category_name');
        renderOptionsForTwoDimensionalArrayWithKeyValue(userData, 'handle_by', 'user_id', 'name');
        $('.select2').select2({"allowClear": true});
        datePicker();
        $(".timepicker").timepicker({showInputs: true});
    },
    saveEvent: function () {
        var that = this;
        var eventFormData = $('#event_form').serializeFormJSON();
        eventFormData.event_start_time = changeTimeFormat(eventFormData.event_start_time);
        eventFormData.event_end_time = changeTimeFormat(eventFormData.event_end_time);
        if (eventFormData.event_name == '') {
            showError('Please Enter Event Name');
            $('#event_name').focus();
            return false;
        }
        if (eventFormData.category_id == '') {
            showError('Please Select Category');
            $('#category_id').focus();
            return false;
        }
        if (eventFormData.sub_category_id == '') {
            showError('Please Select Sub-Category');
            $('#sub_category_id').focus();
            return false;
        }
        if (eventFormData.organized_for == '') {
            showError('Please Select Organized For');
            $('#organized_for').focus();
            return false;
        }
        if (eventFormData.event_type == '') {
            showError('Please Select Event Type');
            $('#event_type').focus();
            return false;
        }
        if (eventFormData.event_place == '') {
            showError('Please Enter  Event Place');
            $('#event_place').focus();
            return false;
        }
        if (eventFormData.event_start_date == '') {
            showError('Please Enter Event Start Date');
            $('#event_start_date').focus();
            return false;
        }
        if (eventFormData.event_start_time == '') {
            showError('Please Enter Event Start Time');
            $('#event_start_time').focus();
            return false;
        }
        if (eventFormData.event_end_date == '') {
            showError('Please Enter Event End Date');
            $('#event_end_date').focus();
            return false;
        }
        if (eventFormData.event_end_time == '') {
            showError('Please Enter Event End Time');
            $('#event_end_time').focus();
            return false;
        }
        if (eventFormData.registration_start_date == '') {
            showError('Please Enter Registration Start Date');
            $('#registration_start_date').focus();
            return false;
        }
        if (eventFormData.registration_end_date == '') {
            showError('Please Enter Registration End Date');
            $('#registration_end_date').focus();
            return false;
        }
        if (eventFormData.handle_by == '') {
            showError('Please Select Handle By');
            $('#handle_by').focus();
            return false;
        }
        $('#spinner_event_btn').html(spinnerTemplate);
        $('#spinner_event_btn').show();
        $('#save_event_btn').hide();
        $('#update_event_btn').hide();
        var url;
        if (eventFormData.event_id == '') {
            url = 'create';
        } else {
            url = 'update';
        }
        $.ajax({
            type: 'POST',
            url: "admin/events/" + url + '_events',
            data: eventFormData,
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#spinner_event_btn').html('');
                $('#spinner_event_btn').hide();
                if (url == 'create') {
                    $('#save_event_btn').show();
                } else if (url == 'update') {
                    $('#update_event_btn').show();
                }
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                eventsDataTable.ajax.reload();
                that.newEvent();
            }
        });
    },
    deleteEvent: function (eventId) {
        getConfirm(function (result) {
            if (result === false) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "admin/events/delete_event",
                data: {"event_id": eventId},
                success: function (data) {
                    var parseData = JSON.parse(data);
                    if (parseData.success == false) {
                        showError(parseData.message);
                        return false;
                    }
                    showSuccess(parseData.message);
                    eventsDataTable.ajax.reload();
                }
            });
        });
    },
    editEvent: function (eventId) {
        var that = this;
        $.ajax({
            type: 'POST',
            url: "admin/events/get_event_by_id",
            data: {"event_id": eventId},
            success: function (data) {
                var parseData = JSON.parse(data);
                var eventsData = parseData.events_data;
                $('#event_form_div').html(eventFormTemplate({"event_data": eventsData}));
                $('#save_event_btn').hide();
                renderOptionsForTwoDimensionalArrayForRates(eventOrganizedForArray, 'organized_for');
                renderOptionsForTwoDimensionalArrayForRates(eventTypeArray, 'event_type');
                renderOptionsForTwoDimensionalArrayWithKeyValue(categoryData, 'category_id', 'category_id', 'category_name');
                renderOptionsForTwoDimensionalArrayWithKeyValue(subCategoryData, 'sub_category_id', 'sub_category_id', 'sub_category_name');
                renderOptionsForTwoDimensionalArrayWithKeyValue(userData, 'handle_by', 'user_id', 'name');
                $('#category_id').val(eventsData.category_id);
                $('#sub_category_id').val(eventsData.sub_category_id);
                $('#organized_for').val(eventsData.event_organized_for);
                $('#event_type').val(eventsData.event_type);
                $('#handle_by').val(eventsData.handle_by);
                $('.select2').select2({"allowClear": true});
                datePicker();
                $(".timepicker").timepicker({showInputs: true});

                $('#event_start_date').val(dateTo_DD_MM_YYYY(yyyymmddToDate(eventsData.event_start_date)));
                $('#event_end_date').val(dateTo_DD_MM_YYYY(yyyymmddToDate(eventsData.event_end_date)));
                $('#registration_start_date').val(dateTo_DD_MM_YYYY(yyyymmddToDate(eventsData.registration_start_date)));
                $('#registration_end_date').val(dateTo_DD_MM_YYYY(yyyymmddToDate(eventsData.registration_end_date)));

                $('#event_start_time').val(convert24To12Hours(eventsData.event_start_time));
                $('#event_end_time').val(convert24To12Hours(eventsData.event_end_time));
            }
        });
    },
    fileUpload: function (eventId) {
        var that = this;
        $.ajax({
            type: 'post',
            url: 'admin/events/get_event_image',
            data: {"event_id": eventId},
            success: function (data) {
                var images = JSON.parse(data);
                var row = '';
                if (images != '') {
                    $.each(images, function (k, s) {
                        var url = basUrl + 'event_pictures/';
                        row += displayImages(url, 'EventCreate', eventId, s);
                    });
                } else {
                    var url = basUrl + 'event_pictures/no-image.jpg';
                    row += displayDefaultImages(url);
                }
                $('#display_images').html(row);
            }
        });
        $('#event_image_upload').html(fileUploadTemplate);
        $('#upload_event_image').html('');
        $('#popup_model').modal('show');
        $('#upload_file').html('<div id="file_upload" class="upload_btn">Upload</div>');
        $("#upload_file").uploadFile({
            url: "admin/events/upload_event_image",
            fileName: "myfile",
            acceptFiles: "image/*",
            maxFileSize: 1024 * 1024 * 200,
            allowedTypes: "jpg,JPG,jpeg,JPEG,png",
            formData: {"event_id": eventId},
            onSuccess: function (files, response, xhr) {
                var parseData = JSON.parse(response);
                if (parseData.success == true) {
                    var url = basUrl + 'event_pictures/';
                    $('#display_images').append(displayImages(url, 'EventCreate', eventId, files[0]));
                    $('#no_image').hide();
                }
            }
        });
    },
    deleteImage: function (image_key, event_id) {
        getConfirm(function (result) {
            if (result === false) {
                event_id = 0;
                return false;
            }
            if (event_id == 0) {
                return false;
            }
            $.ajax({
                type: 'post',
                url: "admin/events/delete_image",
                data: {
                    event_id: event_id,
                    image_key: image_key
                },
                success: function (data) {
                    $('#delete_image' + image_key).hide('slow');
                    EventCreate.listview.fileUpload(event_id);
                    showSuccess('Image Deleted Successfully');
                }
            });
        });
    }
});