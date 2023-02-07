$("#areaexample thead tr")
    .clone(true)
    .addClass("filters")
    .appendTo("#areaexample thead");

$("#areaexample").DataTable({
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    aaSorting: [],
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function () {
        const api = this.api();
        // For each column
        api.columns()
            .eq(0)
            .each(function (colIdx) {
                // Set the header cell to contain the input element
                const cell = $(".filters th").eq(
                    $(api.column(colIdx).header()).index()
                );
                const title = $(cell).text();
                $(cell).html(
                    '<input type="text" placeholder="Search By ' +
                        title +
                        ' ..." />'
                );
                // On every keypress in this input
                $(
                    "input",
                    $(".filters th").eq($(api.column(colIdx).header()).index())
                )
                    .off("keyup change")
                    .on("change", function (e) {
                        // Get the search value
                        $(this).attr("title", $(this).val());
                        var regexr = "({search})"; //$(this).parents('th').find('select').val();

                        var cursorPosition = this.selectionStart;
                        // Search the column for that value
                        api.column(colIdx)
                            .search(
                                this.value != ""
                                    ? regexr.replace(
                                          "{search}",
                                          "(((" + this.value + ")))"
                                      )
                                    : "",
                                this.value != "",
                                this.value == ""
                            )
                            .draw();
                    })
                    .on("keyup", function (e) {
                        e.stopPropagation();

                        $(this).trigger("change");
                        $(this)
                            .focus()[0]
                            .setSelectionRange(cursorPosition, cursorPosition);
                    });
            });
    },
});

function dataTableReRender() {
    $("#areaexample").DataTable().destroy();

    $("#areaexample thead tr")
        .clone(true)
        .addClass("filters")
        .appendTo("#areaexample thead");

    $("#areaexample").DataTable({
        dom: "Bfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        aaSorting: [],
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            const api = this.api();

            // For each column
            api.columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    const cell = $(".filters th").eq(
                        $(api.column(colIdx).header()).index()
                    );
                    const title = $(cell).text();
                    $(cell).html(
                        '<input type="text" placeholder="Search ' +
                            title +
                            ' ..." />'
                    );
                    // On every keypress in this input
                    $(
                        "input",
                        $(".filters th").eq(
                            $(api.column(colIdx).header()).index()
                        )
                    )
                        .off("keyup change")
                        .on("change", function (e) {
                            // Get the search value
                            $(this).attr("title", $(this).val());
                            var regexr = "({search})"; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api.column(colIdx)
                                .search(
                                    this.value != ""
                                        ? regexr.replace(
                                              "{search}",
                                              "(((" + this.value + ")))"
                                          )
                                        : "",
                                    this.value != "",
                                    this.value == ""
                                )
                                .draw();
                        })
                        .on("keyup", function (e) {
                            e.stopPropagation();

                            $(this).trigger("change");
                            $(this)
                                .focus()[0]
                                .setSelectionRange(
                                    cursorPosition,
                                    cursorPosition
                                );
                        });
                });
        },
    });
}

let createAreaCounter = 0;
// Add area --> taluk appends code
$(document).on("click", ".taluk_plus", function () {
    var html = `
    <div class="row extra_fields position-relative">
        <div class="col-lg-6">
            <div class="form-input">
                <label for="">Name</label><span class="text-danger">*</span><br>
                <input type="text" name="taluk_name[]"
                    class="taluk_name_input taluk_name_input_${createAreaCounter}  taluk_name" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-input">
                <label for="">Code</label><span class="text-danger">*</span><br>
                <input type="text" name="taluk_code[]"
                    class="taluk_code_input taluk_code_input_${createAreaCounter} taluk_code" required>
            </div>
        </div>
        <div class="taluk_plus"><i class="fas fa-plus"></i></div>
        <div class="taluk_remove_row"><i class="fas fa-times"></i></div>
    </div>
    `;
    $(".taluk_field_groups").append(html);
    addValidation(createAreaCounter);
    createAreaCounter++;
});

function addValidation(counter) {
    const areaValidation = new JustValidate("#add_area_form");
    areaValidation
        .addField(`.taluk_name_input_${counter}`, [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(`.taluk_code_input_${counter}`, [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ]);
}

// Add Area --> taluk remove code
$(document).on("click", ".taluk_remove_row", function () {
    $(this).closest(".row").remove();
});

// Area page input validation

const areaValidation = new JustValidate("#add_area_form");
areaValidation
    .addField(".district_name", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .addField(".district_code", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .addField(".taluk_name_input", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .addField(".taluk_code_input", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .onSuccess((event) => {
        saveArea();
    });

function editAreaFormValidation(id) {
    const editAreaValidation = new JustValidate("#edit_area_form");
    editAreaValidation
        .addField(".district_name", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(".district_code", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(".taluk_name_input", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(".taluk_code_input", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .onSuccess((event) => {
            editFormSubmit(id);
        });
}

function saveArea() {
    const district_name = $(".district_name").val();
    const district_code = $(".district_code").val();
    const taluk_name = [];
    const taluk_code = [];
    $(".taluk_name").each(function (key, el) {
        taluk_name[key] = el.value;
    });
    $(".taluk_code").each(function (key, el) {
        taluk_code[key] = el.value;
    });
    $.ajax({
        method: "POST",
        url: "api/createarea",
        data: {
            district_name: district_name,
            district_code: district_code,
            taluk_name: taluk_name,
            taluk_code: taluk_code,
        },
        success: function (data) {
            document.getElementById("add_area_form").reset();
            Swal.fire("Data Saved", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderarea`,
                    success: function (data) {
                        $(".create_area_modal").modal("hide");
                        $("#re_render").html(data);
                        callAllHandlers();
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Something went wrong",
                            text: data.responseJSON.message,
                            icon: "warning",
                        });
                    },
                });
            });
        },
        error: function (data) {
            Swal.fire({
                title: "Something went wrong",
                text: data.responseJSON.message,
                icon: "warning",
            });
        },
    });
}

function viewBtnHandler() {
    $(".view_btn").on("click", function () {
        const html = `
                        <div class="preloader_container">
                            <img src="assets/images/dashboard/preloader.gif" alt="preloader_logo">
                        </div>
    `;
        $("#view_form_data").html(html);
        const id = this.dataset.areaId;
        $.ajax({
            method: "GET",
            url: `api/viewarea/${id}`,
            success: function (data) {
                setTimeout(() => {
                    $("#view_form_data").html(data);
                }, 100);
            },
            error: function (data) {
                Swal.fire({
                    title: "Something went wrong",
                    text: data.responseJSON.message,
                    icon: "warning",
                });
            },
        });
    });
}
viewBtnHandler();

function editFormSubmit(id) {
    const editFormEL = document.getElementById("edit_area_form");
    const formdata = new FormData(editFormEL);
    $.ajax({
        method: "POST",
        url: `api/updatearea/${id}`,
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire("Data Updated", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderarea`,
                    success: function (data) {
                        $(".edit_area_modal").modal("hide");
                        $("#re_render").html(data);
                        callAllHandlers();
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Something went wrong",
                            text: data.responseJSON.message,
                            icon: "warning",
                        });
                    },
                });
            });
        },
        error: function (data) {
            Swal.fire({
                title: "Something went wrong",
                text: data.responseJSON.message,
                icon: "warning",
            });
        },
    });
}

function editBtnHandler() {
    $(".edit_btn").on("click", function () {
        const html = `
                            <div class="preloader_container">
                                <img src="assets/images/dashboard/preloader.gif" alt="preloader_logo">
                            </div>
        `;
        $("#edit_form_data").html(html);
        const id = this.dataset.areaId;
        $.ajax({
            method: "GET",
            url: `api/editarea/${id}`,
            success: function (data) {
                setTimeout(() => {
                    $("#edit_form_data").html(data);
                    editAreaFormValidation(id);
                }, 200);
            },
            error: function (data) {
                Swal.fire({
                    title: "Something went wrong",
                    text: data.responseJSON.message,
                    icon: "warning",
                });
            },
        });
    });
}
editBtnHandler();

//

function deleteBtnHandler() {
    $(".delete_btn").on("click", function () {
        const id = this.dataset.areaId;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: `api/deletearea/${id}`,
                    success: function (data) {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        ).then((result) => {
                            $.ajax({
                                method: "POST",
                                url: `api/renderarea`,
                                success: function (data) {
                                    $("#re_render").html(data);
                                    callAllHandlers();
                                },
                                error: function (data) {
                                    Swal.fire({
                                        title: "Something went wrong",
                                        text: data.responseJSON.message,
                                        icon: "warning",
                                    });
                                },
                            });
                        });
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Something went wrong",
                            text: data.responseJSON.message,
                            icon: "warning",
                        });
                    },
                });
            }
        });
    });
}
deleteBtnHandler();

function callAllHandlers() {
    editBtnHandler();
    viewBtnHandler();
    deleteBtnHandler();
    dataTableReRender();
}
