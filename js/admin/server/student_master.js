var studentListTemplate = Handlebars.compile($('#student_list_template').html());
var studentFormTemplate = Handlebars.compile($('#student_form_template').html());
var studentTableTemplate = Handlebars.compile($('#student_table_template').html());
var studentActionButtonTemplate = Handlebars.compile($('#student_action_button_template').html());
var studentUploadFormTemplate = Handlebars.compile($('#student_upload_form_template').html());
var fileHeaderMainTemplate = Handlebars.compile($('#file_header_main_template').html());
var fileHeaderRowTemplate = Handlebars.compile($('#file_header_row_template').html());
var fileHeaderComboTemplate = Handlebars.compile($('#header_combo_template').html());
var StudentMaster = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
StudentMaster.Router = Backbone.Router.extend({
    routes: {
        'student/list': 'renderList'
    },
    renderList: function () {
        StudentMaster.listview.listPage();
    }
});
StudentMaster.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click #save_student_btn': 'saveStudent',
        'click #update_student_btn': 'saveStudent',
        'click #save_student_upload_btn': 'uploadStatement'
    },
    listPage: function () {
        if (USER_TYPE != SUPER_ADMIN) {
            showError("You Can't Access");
        } else {
            this.$el.html(studentListTemplate);
            $('#student_master_data_table').html(studentTableTemplate);
            this.loadStudentTable();
        }
    },
    newStudent: function () {
        $('#student_master_upload_form_div').html('');
        $('#student_master_upload_header_div').html('');
        $('#student_master_form_div').html(studentFormTemplate);
        $('#update_student_btn').hide();
        renderOptionsForTwoDimensionalArrayForRates(semesterArray, 'semester');
        renderOptionsForTwoDimensionalArrayForRates(divisionArray, 'division');
        $('.select2').select2({"allowClear": true});
    },
    newUpload: function () {
        $('#student_master_form_div').html('');
        $('#student_master_upload_header_div').html('');
        $('#student_master_upload_form_div').html(studentUploadFormTemplate);
        $('.select2').select2({"allowClear": true});
        $('.browse_student_data').click(function () {
            $('#student_data_file').trigger('click');
        });
        $('#student_data_file').change(function () {
            $('#display_selected_file_student_data').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    },
    loadStudentTable: function () {
        var studentActionRenderer = function (data, type, full, meta) {
            return studentActionButtonTemplate({"student_id": data});
        };
        var semesterRenderer = function (data, type, full, meta) {
            return semesterArray[data];
        };
        var divisionRenderer = function (data, type, full, meta) {
            return divisionArray[data];
        };
        allUserDataTable = $('#student_master_table').DataTable({
            ajax: {url: 'admin/student_master/get_student', dataSrc: "", type: "post"},
            bAutoWidth: false,
            ordering: false,
            columns: [
                {data: 'student_name'},
                {data: 'course'},
                {data: 'semester', "render": semesterRenderer},
                {data: 'division', "render": divisionRenderer},
                {data: 'enrollment_no'},
                {data: 'roll_number'},
                {
                    "className": '',
                    "orderable": false,
                    "data": 'student_id',
                    "render": studentActionRenderer
                }
            ]
        });
    },
    saveStudent: function () {
        var that = this;
        var studentFormData = $('#student_master_form').serializeFormJSON();
        if (studentFormData.course == "") {
            showError('Please Select Any Course');
            $('#course').focus();
            return false;
        }
        if (studentFormData.semester == "") {
            showError('Please Select Any Semester');
            $('#semester').focus();
            return false;
        }
        if (studentFormData.division == "") {
            showError('Please Select Any Division');
            $('#division').focus();
            return false;
        }
        if (studentFormData.enrollment_no == "") {
            showError('Please Enter Enrollment Number');
            $('#enrollment_no').focus();
            return false;
        }
        if (studentFormData.roll_number == "") {
            showError('Please Enter Roll Number');
            $('#roll_number').focus();
            return false;
        }
        if (studentFormData.student_name == "") {
            showError('Please Enter Student Full Name');
            $('#student_name').focus();
            return false;
        }
        if (studentFormData.student_mobile_no == "") {
            showError('Please Enter Student Mobile Number');
            $('#student_mobile_no').focus();
            return false;
        }
        if (studentFormData.gender == "") {
            showError('Please Select Any  Gender');
            return false;
        }
        $('#spinner_student_btn').html(spinnerTemplate);
        $('#spinner_student_btn').show();
        $('#save_student_btn').hide();
        $('#update_student_btn').hide();
        var url = studentFormData.student_id == '' ? 'create' : 'update';
        $.ajax({
            type: 'POST',
            url: "admin/student_master/" + url + "_student",
            data: studentFormData,
            error: function (textStatus, errorThrown) {
                showError('Some unexpected database error encountered due to which your transaction could not be completed');
            },
            success: function (data) {
                var parseData = JSON.parse(data);
                $('#spinner_student_btn').html('');
                $('#spinner_student_btn').hide();
                if (url == 'create') {
                    $('#save_student_btn').show();
                } else if (url == 'update') {
                    $('#update_student_btn').show();
                }
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                allUserDataTable.ajax.reload();
                that.newStudent();
            }
        });
    },
    deleteStudent: function (studentId) {
        getConfirm(function (result) {
            if (result === false) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "admin/student_master/delete_student",
                data: {"student_id": studentId},
                success: function (data) {
                    var parseData = JSON.parse(data);
                    if (parseData.success == false) {
                        showError(parseData.message);
                        return false;
                    }
                    showSuccess(parseData.message);
                    allUserDataTable.ajax.reload();
                }
            });
        });
    },
    uploadStatement: function () {
        var that = this;
        var fileType = $('#file_type').val();
        var bankStatementFile = $('#student_data_file').val();
        if (fileType == "") {
            showError('Please Select File Type');
            $('#file_type').focus();
            return false;
        }
        if (bankStatementFile == "") {
            showError('Please Upload ' + fileType + ' file');
            $('#student_data_file').focus();
            return false;
        }
        $('#save_student_upload_btn').hide();
        $('#spinner_student_upload_btn').show();
        $('#spinner_student_upload_btn').html(spinnerTemplate);
        $("#new_student_upload_form").ajaxSubmit({
            "url": 'admin/student_master/upload_student_statement',
            type: 'post',
            success: function (response) {
                if (response == 'file_not_readable') {
                    showError('File Not Readable Plase Select Propar File');
                    $('#save_student_upload_btn').show();
                    $('#spinner_student_upload_btn').html('');
                    $('#spinner_student_upload_btn').hide();
                }
                var parseData = JSON.parse(response);
                if (parseData.success === false) {
                    $('#save_student_upload_btn').show();
                    $('#spinner_student_upload_btn').html(spinnerTemplate);
                    $('#spinner_student_upload_btn').hide();
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                that.loadFileHeaderPage(parseData.headers_data);
            }
        });
    },
    loadFileHeaderPage: function (fileInformation) {
        $('#student_master_upload_form_div').html('');
        $('#student_master_form_div').html('');
        $('#student_master_upload_header_div').html(fileHeaderMainTemplate);
        var headerCount = 0;
        for (var h in fileInformation) {
            this.appendRow(fileInformation[h], headerCount);
            headerCount++;
        }
        $('#header_count').val(headerCount);
        $('.select2').select2();
    },
    appendRow: function (headers, headerCount) {
        var data = {"header_count": headerCount, "headers": headers};
        var result = fileHeaderRowTemplate(data);
        $("#file_header_item").append(result);
        this.appendSelectCombo(headerCount);
    },
    appendSelectCombo: function (headerCount) {
        var data = {"header_count": headerCount};
        var result = fileHeaderComboTemplate(data);
        $("#combo_area_" + headerCount).html(result);
    },
    listStatement: function () {
        if (!this.validateFileHeaderForm()) {
            return false;
        }
        $('#file_submit_button').html('<i class="fa fa-spinner fa-spin"></i> Submitting....');
        $('#file_submit_button').prop('disabled', true);
        $("#file_header_form").ajaxSubmit({
            url: 'admin/student_master/list_file_data',
            type: 'post',
            success: function (response) {
                var parseData = JSON.parse(response);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                allUserDataTable.ajax.reload();
                showSuccess(parseData.message);
//                showError('This Statement has errors on line numbers ' + parseData.error_entries);
                $('#file_submit_button').html('Submit');
                $('#file_submit_button').prop('disabled', false);
                $('#student_master_upload_form_div').html('');
                $('#student_master_form_div').html('');
                $('#student_master_upload_header_div').html('');
            }
        });
    },
    validateFileHeaderForm: function () {
        var flagArray = {
            'course_flag': false,
            'semester_flag': false,
            'division_flag': false,
            'enrollment_no_flag': false,
            'roll_number_flag': false,
            'student_name_flag': false,
            'student_mobile_no_flag': false,
            'gender_flag': false
        };
        var repeated = false;
        $('.headers-dropdown').each(function () {
            var ddValue = $(this).val();
            if (ddValue !== 'ignore' && flagArray[ddValue + '_flag'] === true) {
                repeated = true;
                return;
            }
            flagArray[ddValue + '_flag'] = true;
        });
        if (repeated) {
            showError("Any Field can be selected only once");
            return false;
        }
        if (!flagArray['course_flag']) {
            showError("Plase Select Course");
            return false;
        }
        if (!flagArray['semester_flag']) {
            showError("Plase Select Semester");
            return false;
        }
        if (!flagArray['division_flag']) {
            showError("Plase Select Division");
            return false;
        }
        if (!flagArray['enrollment_no_flag']) {
            showError("Plase Select Enrollment Number");
            return false;
        }
        if (!flagArray['roll_number_flag']) {
            showError("Plase Select Roll Number");
            return false;
        }
        if (!flagArray['student_name_flag']) {
            showError("Plase Select Student Name");
            return false;
        }
        if (!flagArray['student_mobile_no_flag']) {
            showError("Plase Select Mobile Number");
            return false;
        }
        if (!flagArray['gender_flag']) {
            showError("Plase Select Gender");
            return false;
        }
        return true;
    }
});