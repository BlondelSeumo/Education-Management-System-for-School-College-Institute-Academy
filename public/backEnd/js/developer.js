// for date picker icon click
$('#apply_date_icon').on('click', function () {
    $('#apply_date').focus();
});
// for datepicker icon click
$('#to-date-icon').on('click', function () {
    $('#leave_to').focus();
});
// for datepicker icon click
$('#homework_date_icon').on('click', function () {
    $('#homework_date').focus();
});
// for datepicker icon click
$('#submission_date_icon').on('click', function () {
    $('#submission_date').focus();
});
$('#notice_date_icon').on('click', function () {
    $('#notice_date').focus();
});
$('#publish_on_icon').on('click', function () {
    $('#publish_on').focus();
});
$('#event_start_date').on('click', function () {
    $('#event_from_date').focus();
});
$('#event_end_date').on('click', function () {
    $('#event_to_date').focus();
});
$('#book_return_date_icon').on('click', function () {
    $('#due_date').focus();
});
$('#receive_date_icon').on('click', function () {
    $('#receive_date').focus();
});
// for upload attach file when apply leave
var fileInput = document.getElementById('attach_file');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderAttachFile').placeholder = fileName;
    }
}
// for global modal 
// $('body').on('click', '.nom_epi', function() { alert("hello"); })
$(document).ready(function () {
    $('body').on("click", ".modalLink", function (e) {

        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});
// for global Delete
$(document).ready(function () {
    $('body').on("click", ".deleteUrl", function (e) {

        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});
// select staff name from selecting role name
$(document).ready(function () {
    $("#staffNameByRole").change(function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'staffNameByRole',
            success: function (data) {
                console.log(data);
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, staffs) {
                            $('#selectStaffs').append($('<option>', {
                                value: staffs.id,
                                text: staffs.full_name
                            }));
                            $("#selectStaffsDiv ul").append("<li data-value='" + staffs.id + "' class='option'>" + staffs.full_name + "</li>");
                        });
                    } else {
                        $('#selectStaffsDiv .current').html('SELECT *');
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                    }
                });
                console.log(a);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
// select item name from selecting item category name
$(document).ready(function () {
    $("#item_category_id").change(function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'getItemByCategory',
            success: function (data) {
                console.log(data);
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectItems').find('option').not(':first').remove();
                        $('#selectItemsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, items) {
                            $('#selectItems').append($('<option>', {
                                value: items.id,
                                text: items.item_name
                            }));
                            $("#selectItemsDiv ul").append("<li data-value='" + items.id + "' class='option'>" + items.item_name + "</li>");
                        });
                    } else {
                        $('#selectItemsDiv .current').html('SELECT *');
                        $('#selectItems').find('option').not(':first').remove();
                        $('#selectItemsDiv ul').find('li').not(':first').remove();
                    }
                });
                console.log(a);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});


// select item name from selecting item category name
$(document).ready(function () {
    $("#infix_theme_style").change(function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'theme-style-active',
            success: function (data) {
                location.reload();
                console.log(data);
            }
        });
    });
});


// select item name from selecting item category name
$(document).ready(function () {
    $("#infix_theme_rtl").change(function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'theme-style-rtl',
            success: function (data) {
                location.reload();
                console.log(data);
            }
        });
    });
});


// for add staff earnings in payroll
function addMoreEarnings() {
    var table = document.getElementById("tableID");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='earningsType" + id + "' name='earningsType[]'><label for='earningsType" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='earningsValue" + id + "' name='earningsValue[]'><label for='earningsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_earings(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_earings(id) {
    var table = document.getElementById("tableID");
    var rowCount = table.rows.length;
    $("#row" + id).html("");
}

// for minus staff deductions in payroll
function addDeductions() {
    var table = document.getElementById("tableDeduction");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='DeductionRow" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='deductionstype" + id + "' name='deductionstype[]'><label for='deductionstype" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='deductionsValue" + id + "' name='deductionsValue[]'><label for='deductionsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_deduction(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_deduction(id) {
    var tables = document.getElementById("tableDeduction");
    var rowCount = tables.rows.length;
    $("#DeductionRow" + id).html("");
}

// payroll calculate for staff
function calculateSalary() {
    var basicSalary = $("#basicSalary").val();
    if (basicSalary == 0) {
        alert('Please Add Employees Basic Salary from Staff Update Form First');
    } else {
        var earningsType = document.getElementsByName('earningsValue[]');
        var earningsValue = document.getElementsByName('earningsValue[]');
        var tax = $("#tax").val();
        var total_earnings = 0;
        var total_deduction = 0;
        var deductionstype = document.getElementsByName('deductionstype[]');
        var deductionsValue = document.getElementsByName('deductionsValue[]');
        for (var i = 0; i < earningsValue.length; i++) {
            var inp = earningsValue[i];
            if (inp.value == '') {
                var inpvalue = 0;
            } else {
                var inpvalue = inp.value;
            }
            total_earnings += parseInt(inpvalue);
        }
        for (var j = 0; j < deductionsValue.length; j++) {
            var inpd = deductionsValue[j];
            if (inpd.value == '') {
                var inpdvalue = 0;
            } else {
                var inpdvalue = inpd.value;
            }
            total_deduction += parseInt(inpdvalue);
        }
        var gross_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction);
        var net_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction) - parseInt(tax);

        $("#total_earnings").val(total_earnings);
        $("#total_deduction").val(total_deduction);
        $("#gross_salary").val(gross_salary);
        $("#final_gross_salary").val(gross_salary);
        $("#net_salary").val(net_salary);
        
        if ($('#total_earnings').val() != '') {
            $('#total_earnings').focus();
        }
    
        if ($('#total_deduction').val() != '') {
            $('#total_deduction').focus();
        }
    
        if ($('#net_salary').val() != '') {
            $('#net_salary').focus();
        }
    }
}

function validateForm() {
    var x = $("#payment_mode").val();
    if (x === "") {
        $('.modal_input_validation').show();
        $(".modal_input_validation").html("<font style='color:red;'>Must be Fill Up</font>");
        $("span.modal_input_validation").addClass("red_alert");
        return false;
    }
    return true;
    preventDefault();
}

function validateToDoForm() {
    var todo_title = $("#todo_title").val();
    if (todo_title === "") {
        $('.modal_input_validation').show();
        $(".modal_input_validation").html("<font style='color:red;'>Must be Fill Up</font>");
        $("span.modal_input_validation").addClass("red_alert");
        return false;
    }
    return true;
    preventDefault();
}

$("select.niceSelect").change(function () {
    $('.modal_input_validation').hide();
});
// student subject drop down info by section change
$(document).ready(function () {
    $("#sectionSelectStudent").change(function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val(),
            class: $('#classSelectStudent').val()
        };
        //console.log(formData);
        // get subjects dropdown
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'ajaxSubjectDropdown',
            success: function (data) {
                console.log(data);
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#subjectSelect').find('option').not(':first').remove();
                        $('#subjectSelecttDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, subjectsName) {
                            $('#subjectSelect').append($('<option>', {
                                value: subjectsName.id,
                                text: subjectsName.subject_name
                            }));
                            $("#subjectSelecttDiv ul").append("<li data-value='" + subjectsName.id + "' class='option'>" + subjectsName.subject_name + "</li>");
                        });
                    } else {
                        $('#subjectSelecttDiv .current').html('Subject *');
                        $('#subjectSelect').find('option').not(':first').remove();
                        $('#subjectSelecttDiv ul').find('li').not(':first').remove();
                    }
                });
                console.log(a);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
// for upload attach file when add Homework
var fileInput = document.getElementById('homework_file');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderHomeworkName').placeholder = fileName;
    }
}
// for upload content when change in role in available for
$(document).ready(function () {
    $('body').on("change", "#available_for", function (e) {
        e.preventDefault();
        role_id = $(this).val();
        if (role_id == '2') {
            $(".forStudentWrapper").slideDown();
        } else {
            //$('.forStudentWrapper').hide();
            $(".forStudentWrapper").slideUp();
        }
    });
});
// for staff photo  in Staff Add Module
var fileInput = document.getElementById('staff_photo');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderStaffsName').placeholder = fileName;
    }
}
// for upload content in teacher module
var fileInput = document.getElementById('upload_content_file');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderUploadContent').placeholder = fileName;
    }
}
// for upload Event File  in communication module
var fileInput = document.getElementById('upload_event_image');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderEventFile').placeholder = fileName;
    }
}
// for upload Holiday File  in communication module
var fileInput = document.getElementById('upload_holiday_image');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        console.log(fileName);
        document.getElementById('placeholderHolidayFile').placeholder = fileName;
    }
}
// for add member  in Library module
$(document).ready(function () {
    $('body').on("change", "#member_type", function (e) {
        e.preventDefault();
        role_id = $(this).val();
        if (role_id == '2') {
            $(".forStudentWrapper").slideDown(1000);
            $("#selectStaffsDiv").slideUp(1000);
            $('#selectStaffs').find('option').not(':first').remove();
            $('#selectStaffsDiv ul').find('li').not(':first').remove();
        } else {
            $(".forStudentWrapper").slideUp(1000);
            $("#selectStaffsDiv").slideDown(1000);

            $('#select_student').find('option').not(':first').remove();
            $('#select_student_div ul').find('li').not(':first').remove();


            var url = $('#url').val();
            var formData = {
                id: $(this).val()
            };

            console.log(formData);
            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'staffNameByRole',
                success: function (data) {
                    console.log(data);
                    var a = '';
                    $.each(data, function (i, item) {
                        if (item.length) {
                            $('#selectStaffs').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                            $.each(item, function (i, staffs) {
                                if (role_id == "3") {
                                    $('#selectStaffs').append($('<option>', {
                                        value: staffs.user_id,
                                        text: staffs.fathers_name
                                    }));
                                    $("#selectStaffsDiv ul").append("<li data-value='" + staffs.user_id + "' class='option'>" + staffs.fathers_name + "</li>");
                                } else {
                                    $('#selectStaffs').append($('<option>', {
                                        value: staffs.user_id,
                                        text: staffs.full_name
                                    }));
                                    $("#selectStaffsDiv ul").append("<li data-value='" + staffs.user_id + "' class='option'>" + staffs.full_name + "</li>");
                                }
                            });
                        } else {
                            $('#selectStaffsDiv .current').html('SELECT *');
                            $('#selectStaffs').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        }
                    });
                    console.log(a);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});

function addRow() {
    $("#addRowBtn").button("loading");
    var tableLength = $("#productTable tbody tr").length;
    var url = $('#url').val();
    var tableRow;
    var arrayNumber;
    var count;
    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }
    $.ajax({
        url: url + '/' + 'get-receive-item',
        type: 'post',
        dataType: 'json',
        success: function (response) {
            $("#addRowBtn").button("reset");
            var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' + '<td class="border-top-0"><div class="input-effect">';


            tr += '<select class="niceSelect form-control" name="item_id[]" id="productName' + count + '" style="display:none">' + '<option value="">Select Item</option>';


            $.each(response, function (index, value) {
                tr += '<option value="' + value.id + '">' + value.item_name + '</option>';
            });

            tr += '</select>';


            tr += "<div class='nice-select w-100 bb niceSelect form-control' tabindex='0'>";
            tr += "<span class='current'>Select Item</span>";
            tr += "<div class='nice-select-search-box'><input type='text' class='nice-select-search' placeholder='Search...'></div>";
            tr += "<ul class='list'>";
            tr += "<li data-value='' data-display='Select Item' class='option selected'>Select Item</li>";


            $.each(response, function (key, value) {
                tr += "<li data-value=" + value.id + " class='option'>" + value.item_name + "</li>";
            });
            tr += "</ul>";


            tr += '</div></td>' + '<td class="border-top-0" width=""><div class="input-effect">' + '<input type="text" name="unit_price[]" onkeyup="getTotalByPrice(' + count + ')" id="unit_price' + count + '"  autocomplete="off" class="primary-input form-control"  min="1" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><div class="input-effect">' + '<input type="text" name="quantity[]" onkeyup="getTotal(' + count + ')" id="quantity' + count + '" autocomplete="off"  class="form-control primary-input" />' + '<input type="hidden" name="costValue[]" id="costValue' + count + '" autocomplete="off" class="form-control primary-input" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><div class="input-effect">' + '<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control primary-input" value= "0.00" />' + '<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control primary-input" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><button type="button" class="removeProductRowBtn primary-btn icon-only fix-gr-bg" onclick="removeProductRow(' + count + ')"><span class="ti-trash"></span></button></td>' + '</td>' + '</tr>';
            if (tableLength > 0) {
                $("#productTable tbody tr:last").after(tr);
            } else {
                $("#productTable tbody").append(tr);
            }
            $('.common-select').addClass("new_select_css");
        } // /success
    }); // get the product data
}

// add new row when sell a product in Item Sell List
function addRowInSell() {
    $("#addRowBtn").button("loading");
    var tableLength = $("#productTable tbody tr").length;
    var url = $('#url').val();
    var tableRow;
    var arrayNumber;
    var count;
    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }
    $.ajax({
        url: url + '/' + 'get-receive-item',
        type: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $("#addRowBtn").button("reset");
            var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' + '<td class="border-top-0"><div class="input-effect">';


            tr += '<select class="niceSelect form-control" name="item_id[]" id="productName' + count + '"  style="display:none">' + '<option value="">Select Item</option>';

            $.each(response, function (index, value) {
                tr += '<option value="' + value.id + '">' + value.item_name + '</option>';
            });
            tr += '</select>';


            tr += "<div class='nice-select w-100 bb niceSelect form-control' tabindex='0'>";
            tr += "<span class='current'>Select Item</span>";
            tr += "<div class='nice-select-search-box'><input type='text' class='nice-select-search' placeholder='Search...'></div>";
            tr += "<ul class='list'>";
            tr += "<li data-value='' data-display='Select Item' class='option selected'>Select Item</li>";


            $.each(response, function (key, value) {
                tr += "<li data-value=" + value.id + " class='option'>" + value.item_name + "</li>";
            });
            tr += "</ul>";


            tr += '</div></td>' + '<td class="border-top-0" width=""><div class="input-effect">' + '<input type="text" name="unit_price[]" onkeyup="getTotalByPrice(' + count + ')" id="unit_price' + count + '"  autocomplete="off" class="primary-input form-control"  min="1" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><div class="input-effect">' + '<input type="text" name="quantity[]" onkeyup="getTotalInSell(' + count + ')" id="quantity' + count + '" autocomplete="off"  class="form-control primary-input" />' + '<input type="hidden" name="costValue[]" id="costValue' + count + '" autocomplete="off" class="form-control primary-input" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><div class="input-effect">' + '<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control primary-input" value= "0.00" />' + '<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control primary-input" />' + '<span class="focus-border"></span>' + '</div></td>' + '<td class="border-top-0"><button type="button" class="removeProductRowBtn primary-btn icon-only fix-gr-bg" onclick="removeProductRow(' + count + ')"><span class="ti-trash"></span></button></td>' + '</td>' + '</tr>';
            if (tableLength > 0) {
                $("#productTable tbody tr:last").after(tr);
            } else {
                $("#productTable tbody").append(tr);
            }
            $('.common-select').addClass("new_select_css");
        } // /success
    }); // get the product data
}

//for table row Total by Unit Price
function getTotalByPrice(row = null) {

    if (row) {
        product_id = $("#productName" + row).val();

        if (product_id > 0) {
            var total = Number($("#unit_price" + row).val()) * Number($("#quantity" + row).val());
            total = total.toFixed(2);


            $("#total" + row).val(total);
            $("#totalValue" + row).val(total);


            subAmount();
        } else {
            alert("please select a product first");
            $("#unit_price" + row).val('');
            $("#productName" + row).focus();
        }
    } else {
        alert('no row !! please refresh the page');
    }
}


//for table row Total by Quantity
function getTotal(row = null) {
    if (row) {
        product_id = $("#productName" + row).val();
        var url = $("#url").val();
        if (product_id > 0) {
            var total = Number($("#unit_price" + row).val()) * Number($("#quantity" + row).val());
            total = total.toFixed(2);
            $("#total" + row).val(total);
            $("#totalValue" + row).val(total);
            subAmount();
        } else {
            alert("please select a product first");
            $("#quantity" + row).val('');
            $("#productName" + row).focus();
        }
    } else {
        alert('no row !! please refresh the page');
    }
}

// get quantity by product ID and get the sum of Sub Total
function getTotalInSell(row = null) {
    if (row) {
        product_id = $("#productName" + row).val();
        quantity = $("#quantity" + row).val();
        var url = $("#url").val();
        if (product_id > 0) {
            $.ajax({
                type: "POST",
                data: {
                    product_id: product_id
                },
                url: url + '/' + 'check-product-quantity',
                success: function (data) {
                    if (Number(quantity) > Number(data)) {
                        alert("Your Given Quantity is not bigger than Stock Quantity.");
                        $("#quantity" + row).val('');
                    } else {
                        var total = Number($("#unit_price" + row).val()) * Number($("#quantity" + row).val());
                        total = total.toFixed(2);
                        $("#total" + row).val(total);
                        $("#totalValue" + row).val(total);
                        subAmount();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        } else {
            alert("please select a product first");
            $("#quantity" + row).val('');
            $("#productName" + row).focus();
        }
    } else {
        alert('no row !! please refresh the page');
    }
}

function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    var totalSubQuantity = 0;
    var totalPaid = $('#totalPaid').val();
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
        totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
        totalSubQuantity = Number(totalSubQuantity) + Number($("#quantity" + count).val());
    } // /for
    totalSubAmount = totalSubAmount.toFixed(2);
    // sub total
    $("#subTotal").val(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);
    // sub total Quantity
    $("#subTotalQuantity").val(totalSubQuantity);
    $("#subTotalQuantityValue").val(totalSubQuantity);
    // Due Amount

    var dueAmount = totalSubAmount - totalPaid;


    if ($('input[name="full_paid"]').is(':checked')) {
        $('#totalPaid').val(totalSubAmount);
        $("#totalDue").val();
        $("#totalDueValue").val();
    } else {
        $("#totalDue").val(dueAmount);
        $("#totalDueValue").val(dueAmount);
    }


}

// if paid Amount set then Calculate the Due
function paidAmount() {
    var subTotal = $("#subTotal").val();
    if (subTotal) {
        var dueAmount = Number($("#subTotal").val()) - Number($("#totalPaid").val());
        dueAmount = dueAmount.toFixed(2);
        $("#totalDue").val(dueAmount);
        $("#totalDueValue").val(dueAmount);
    }
} // /paid amount function

$('input[name="full_paid"]').on('click', function () {
    if ($(this).is(':checked')) {
        var subTotal = $("#subTotal").val();

        $("#totalPaid").val(subTotal);

        $("#totalDue").val(0);

        $("#totalDueValue").val(0);
    } else {
        $("#totalPaid").val(0);
        $("#totalDue").val($("#subTotal").val());
        $("#totalDueValue").val($("#subTotal").val());
    }
});

function removeProductRow(row = null) {
    if (row) {
        $("#row" + row).remove();
        $("#totalPaid").val(0);
        $("#totalPaidValue").val(0);
        subAmount();
    } else {
        alert("Something went Wrong");
    }
}

function deleteReceiveItem(row = null) {
    //var url = $('#url').val();
    if (row) {
        $("#row" + row).remove();
        $("#totalPaid").val('');
        $("#full_paid").prop("checked", false)
        subAmount();
    }
}

function printDiv(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}

function checkDue() {
    total_due_value = $("#total_due_value").val();
    total_due = $("#total_due").val();
    if (Number(total_due) > Number(total_due_value)) {
        alert("Payment amount Should not bigger than Due Amount");
        $("#total_due").val('');
        $("#total_due").focus();
    }
}

function delete_receive_payments(id) {
    var r = confirm("Are You Sure To delete This Payment ?");
    if (r == true) {
        event.preventDefault();
        var url = $("#url").val();
        var receive_payment_id = id;
        $.ajax({
            type: "POST",
            data: {
                receive_payment_id: receive_payment_id
            },
            url: url + '/' + 'delete-receive-payment',
            success: function (data) {
                //console.log(data);
                window.location.href = url + "/" + 'item-receive-list';
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("div.successMessage").hide('slide');
                $("div.errorMsg").hide('slide');
                $("div.errorMsg").show('slide');
            }
        });
    } else {
        return false;
    }
}


// delete sell payments
function delete_sell_payments(id) {
    var r = confirm("Are You Sure To delete This Payment ?");
    if (r == true) {
        event.preventDefault();
        var url = $("#url").val();
        var sell_payment_id = id;
        $.ajax({
            type: "POST",
            data: {
                sell_payment_id: sell_payment_id
            },
            url: url + '/' + 'delete-sell-payment',
            success: function (data) {
                //console.log(data);
                window.location.href = url + "/" + 'item-sell-list';
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("div.successMessage").hide('slide');
                $("div.errorMsg").hide('slide');
                $("div.errorMsg").show('slide');
            }
        });
    } else {
        return false;
    }
}

// sms gateway submit form clickatell
$('form[id="clickatell_form"]').validate({
    rules: {
        clickatell_username: 'required',
        clickatell_password: 'required',
        clickatell_api_id: 'required',
    },
    messages: {
        clickatell_username: 'This field is required',
        clickatell_password: 'This field is required',
        clickatell_api_id: 'This field is required',

    },
    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#clickatell_form").serialize();
        updateClickatellData = $("#clickatell_form_url").val();
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + updateClickatellData,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('Clickatell Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});

// sms gateway submit form twilio
$('form[id="twilio_form"]').validate({
    rules: {
        twilio_account_sid: 'required',
        twilio_authentication_token: 'required',
        twilio_registered_no: 'required',
    },
    messages: {
        twilio_account_sid: 'This field is required',
        twilio_authentication_token: 'This field is required',
        twilio_registered_no: 'This field is required',

    },
    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#twilio_form").serialize();
        updateTwilioData = $("#twilio_form_url").val();
        url = $("#url").val();
        var twilio_account_sid = $("#twilio_account_sid").val();
        $(".invalid-feedback").remove();
        if (twilio_account_sid.length < 1) {
            alert(twilio_account_sid);
            $('#twilio_account_sid').after('<span class="invalid-feedback" role="alert"><strong>This field is Required</strong></span>');
        }
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + updateTwilioData,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('Twilio Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});


// sms gateway submit form msg91
$('form[id="msg91_form"]').validate({
    rules: {
        msg91_authentication_key_sid: 'required',
        msg91_sender_id: 'required',
        msg91_route: 'required',
        msg91_country_code: 'required'
    },
    messages: {
        msg91_authentication_key_sid: 'This field is required',
        msg91_sender_id: 'This field is required',
        msg91_route: 'This field is required',
        msg91_country_code: 'This field is required',

    },
    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#msg91_form").serialize();
        updateMsg91Data = $("#msg91_form_url").val();
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + updateMsg91Data,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('Msg91 Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});


// select a service
$("#sms_service").change(function (e) {
    e.preventDefault();
    sms_service = $("#sms_service").val();
    url = $("#url").val();
    $.ajax({
        type: "POST",
        data: {
            sms_service: sms_service
        },
        url: url + '/activeSmsService',
        success: function (data) {
            console.log(data);
            if (data == "success") {
                toastr.success('This Service is Active Now', 'Successful', {
                    timeOut: 5000
                })
            } else {
                toastr.error('You Got Error', 'Inconceivable!', {
                    timeOut: 5000
                })
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
        }
    });
});
// select staff name from selecting role name
$(document).ready(function () {
    $("#staffsByRoleCommunication").change(function () {
        $("#checkbox").prop("checked", false);
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        //alert(formData.id);
        // for remove all values from multiple select after select role
        $('#selectStaffss').select2('val', '');
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'studStaffByRole',
            success: function (data) {
                console.log(data);
                var a = '';
                if (formData.id == 2) {
                    $.each(data, function (i, item) {
                        if (item.length) {
                            $('#selectStaffss').find('option').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();

                            $.each(item, function (i, students) {
                                $('#selectStaffss').append($('<option>', {
                                    value: students.full_name + '-' + students.email + '-' + students.mobile,
                                    text: students.full_name
                                }));
                            });
                        } else {
                            $('#selectStaffsDiv .current').html('SELECT *');
                            $('#selectStaffss').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        }
                    });

                }

                if (formData.id == 3) {
                    $.each(data, function (i, item) {
                        if (item.length) {
                            $('#selectStaffss').find('option').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();

                            $.each(item, function (i, parents) {
                                $('#selectStaffss').append($('<option>', {
                                    value: parents.fathers_name + '-' + parents.guardians_email + '-' + parents.fathers_mobile,
                                    text: parents.fathers_name
                                }));
                            });
                        } else {
                            $('#selectStaffsDiv .current').html('SELECT *');
                            $('#selectStaffss').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        }
                    });
                }
                if (formData.id != 2 && formData.id != 3) {
                    $.each(data, function (i, item) {
                        if (item.length) {
                            $('#selectStaffss').find('option').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();

                            $.each(item, function (i, staffs) {
                                $('#selectStaffss').append($('<option>', {
                                    value: staffs.full_name + '-' + staffs.email + '-' + staffs.mobile,
                                    text: staffs.full_name
                                }));
                            });
                        } else {
                            $('#selectStaffsDiv .current').html('SELECT *');
                            $('#selectStaffss').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        }
                    });

                }

                console.log(a);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
// in communication send To tab selected
$(".nav-link").click(function () {
    selectTab = $(this).attr('selectTab');
    $("#selectTab").val(selectTab);
    $("#initialselectTab").val();
});
// get all section by class_id selection in email sms part
$(document).ready(function () {
    $("#class_id_email_sms").change(function () {
        $("#checkbox_section").prop("checked", false);
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        $('#selectSectionss').select2('val', '');
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'ajaxStudentPromoteSection',
            success: function (data) {
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectSectionss').find('option').remove();
                        $('#selectSectionsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, section) {
                            $('#selectSectionss').append($('<option>', {
                                value: section.id,
                                text: section.section_name
                            }));
                            // $("#selectSectionsDiv ul").append("<li data-value='"+section.id+"' class='option'>"+section.section_name+"</li>");
                        });
                    } else {
                        $('#selectSectionsDiv .current').html('SELECT SECTION *');
                        $('#selectSectionss').find('option').not(':first').remove();
                        $('#selectSectionsDiv ul').find('li').not(':first').remove();
                    }
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
// for upload resume  in Staff Add Module
var resumefileInput = document.getElementById('resume');
if (resumefileInput) {
    //alert("staffs photo");
    resumefileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var resumefileInput = event.srcElement;
        var fileName = resumefileInput.files[0].name;
        document.getElementById('placeholderResume').placeholder = fileName;
    }
}

// for upload joining_letter  in Staff Add Module
var joining_letterfileInput = document.getElementById('joining_letter');
if (joining_letterfileInput) {
    joining_letterfileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var joining_letterfileInput = event.srcElement;
        var fileName = joining_letterfileInput.files[0].name;
        document.getElementById('placeholderJoiningLetter').placeholder = fileName;
    }
}

// for upload other Document  in Staff Add Module
var other_documentfileInput = document.getElementById('other_document');
if (other_documentfileInput) {
    other_documentfileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var other_documentfileInput = event.srcElement;
        var fileName = other_documentfileInput.files[0].name;
        document.getElementById('placeholderOthersDocument').placeholder = fileName;
    }
}


// for upload main School logo in General Settings
//var upload_logo = document.getElementById('upload_logo');
var upload_logo = document.getElementById('logo_wrapper');
if (upload_logo) {

    upload_logo.addEventListener('change', showFileName);

    function showFileName(event) {
        var upload_logo = event.srcElement;
        var fileName = upload_logo.files[0].name;

    }
}

// for document upload in profile View
var staff_upload_document = document.getElementById('staff_upload_document');
if (staff_upload_document) {
    alert("asdas");
    staff_upload_document.addEventListener('change', showFileName);

    function showFileName(event) {
        var staff_upload_document = event.srcElement;
        var fileName = staff_upload_document.files[0].name;

    }
}

$("#email_engine_type").change(function () {
    email_engine_type = $("#email_engine_type").val();
    if (email_engine_type == 'email') {
        $(".smtp_inner_wrapper").slideUp();
    } else {
        $(".smtp_wrapper").slideDown();
        $(".smtp_wrapper_block").slideDown();
        $(".smtp_inner_wrapper").slideDown();
    }
});


// payment gateway submit form paypal
$('form[id="paypal_settings_form"]').validate({
    rules: {
        paypal_username: 'required',
        paypal_password: 'required',
        paypal_signature: 'required',
        paypal_client_id: 'required',
        paypal_secret_id: 'required',
    },
    messages: {
        paypal_username: 'This field is required',
        paypal_password: 'This field is required',
        paypal_signature: 'This field is required',
        paypal_client_id: 'This field is required',
        paypal_secret_id: 'This field is required',

    },
    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#paypal_settings_form").serialize();
        paypal_form_url = $("#paypal_form_url").val();
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + paypal_form_url,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('Paypal Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});


// payment gateway submit form Stripe
$('form[id="stripe_form"]').validate({
    rules: {
        stripe_api_secret_key: 'required',
        stripe_publisher_key: 'required'
    },
    messages: {
        stripe_api_secret_key: 'This field is required',
        stripe_publisher_key: 'This field is required'

    },

    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#stripe_form").serialize();
        stripe_form_url = $("#stripe_form_url").val();
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + stripe_form_url,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('Stripe Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});

// payment gateway submit form PayUMoney
$('form[id="payumoney_form"]').validate({
    rules: {
        pay_u_money_key: 'required',
        pay_u_money_salt: 'required'
    },
    messages: {
        pay_u_money_key: 'This field is required',
        pay_u_money_salt: 'This field is required'

    },

    submitHandler: function (form) {
        // form.submit(event);
        //event.preventDefault();
        form_data = $("#payumoney_form").serialize();
        payumoney_form_url = $("#payumoney_form_url").val();
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: form_data,
            url: url + '/' + payumoney_form_url,
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('PayUMoney Data has been updated successfully', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
});

// active payment gateway
function active_payment_gateway(gateway_id = null) {
    alert(gateway_id);
    if (gateway_id) {
        url = $("#url").val();
        $.ajax({
            type: "POST",
            data: {gateway_id: gateway_id},
            url: url + '/active-payment-gateway',
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    toastr.success('This Payment Gateway has been activated', 'Successful', {
                        timeOut: 5000
                    })
                } else {
                    toastr.error('You Got Error', 'Inconceivable!', {
                        timeOut: 5000
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
}

// javascript for stripe payment gateway
$(function () {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function (e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});


// add new row for marks distribution
function addRowMark() {
    $("#addRowBtn").button("loading");
    var tableLength = $("#productTable tbody tr").length;
    var url = $('#url').val();
    var tableRow;
    var arrayNumber;
    var count;
    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }

    $("#addRowBtn").button("reset");
    var newRow = "<tr id='row1' class='0'>";
    newRow += "<td class='border-top-0'>";
    newRow += "<div class='input-effect'>";
    newRow += "<input class='primary-input form-control' type='text' placeholder='title' id='exam_title' name='exam_title[]' autocomplete='off'>";


    newRow += "</div>";
    newRow += "</td>";
    newRow += "<td class='border-top-0'>";
    newRow += "<div class='input-effect'>";
    newRow += "<input class='primary-input form-control exam_mark' type='number' id='exam_mark' name='exam_mark[]' autocomplete='off'>";
    newRow += "</div>";
    newRow += "</td> ";
    newRow += "<td  class='border-top'>";
    newRow += "<button class='primary-btn icon-only fix-gr-bg' type='button' id='removeMark'>";
    newRow += "<span class='ti-trash'></span>";
    newRow += "</button>";

    newRow += "</td>";
    newRow += "</tr>";


    if (tableLength > 0) {
        $("#productTable tbody tr:last").after(newRow);
    } else {
        $("#productTable tbody").append(newRow);
    }
    $('.common-select').addClass("new_select_css");

}


// Assign class routine get subject
$(document).on("click", "#removeMark", function (event) {
    $(this).closest("tr").remove();
    var totalMarks = 0;
    $('tr#row1 input[name^="exam_mark"]').each(function () {
        if ($(this).val() != "") {
            totalMarks += parseInt($(this).val());
        }
    });

    $('th#totalMark input').val(totalMarks);
});

$(document).on("keyup", ".exam_mark", function (event) {

    var totalMarks = 0;
    $('tr#row1 input[name^="exam_mark"]').each(function () {
        if ($(this).val() != "") {
            totalMarks += parseInt($(this).val());
        }
    });


    if (totalMarks > parseInt($('#exam_mark_main').val())) {
        alert('you have distributed marks more than exam mark');
        $(this).val(0);
        var totalMarks = 0;
        $('tr#row1 input[name^="exam_mark"]').each(function () {
            if ($(this).val() != "") {
                totalMarks += parseInt($(this).val());
            }
        });
        $('th#totalMark input').val(totalMarks);
        return false;
    }

    $('td#totalMark input').val(totalMarks);
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURL(this);
});

