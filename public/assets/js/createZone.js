$("#zoneexample thead tr")
    .clone(true)
    .addClass("filters")
    .appendTo("#zoneexample thead");

$("#zoneexample").DataTable({
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

// Re render data tables
function dataTableReRender() {
    $("#zoneexample").DataTable().destroy();

    $("#zoneexample thead tr")
        .clone(true)
        .addClass("filters")
        .appendTo("#zoneexample thead");

    $("#zoneexample").DataTable({
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

let createZoneCounter = 0;
// Append fields
$(document).on("click", ".zone_plus", async function () {
    const optionsEL = await getDistrict();
    var html = `
            <div class="row extra_fields position-relative mt-3">
            <div class="col-lg-6">
            <div class="form-input">
                <label for="">Name</label><span class="text-danger">*</span><br>
                <select class="form-select district_name district_name_input_${createZoneCounter}  district_name_input zone_district_name_select"
                    name="district_name[]">
                    <option selected value="" disabled> Select District Name</option>
                        ${optionsEL}
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-input">
                <label for="">Code</label><span class="text-danger">*</span><br>
                <select class="form-select district_code district_code_input_${createZoneCounter} district_code_input zone_district_code_select"
                    name="district_code[]">
                    <option selected value="">Select District Code</option>
                </select>
            </div>
        </div>
        <div class="plus zone_plus"><i class="fas fa-plus"></i></div>

                <div class="remove_row"><i class="fas fa-times"></i></div>
            </div>
    `;
    $(".field_groups").append(html);
    addValidation(createZoneCounter);
    createZoneCounter++;
});

function addValidation(counter) {
    const zoneValidation = new JustValidate("#add_zone_form");
    zoneValidation
        .addField(`.district_name_input_${counter}`, [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(`.district_code_input_${counter}`, [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ]);
}

$(document).on("click", ".remove_row", function () {
    $(this).closest(".row").remove();
});

const zoneValidation = new JustValidate("#add_zone_form");
zoneValidation
    .addField(".zone_id_input", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .addField(".district_code_input", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .addField(".district_name_input", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .onSuccess((event) => {
        saveZone();
    });

function editZoneFormValidation(id) {
    const editZoneValidation = new JustValidate("#edit_zone_form");
    editZoneValidation
        .addField(".zone_id_input", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(".district_code_input", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .addField(".district_name_input", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .onSuccess((event) => {
            editZoneFormSubmit(id);
        });
}

function saveZone() {
    const zone_id = $(".zone_id").val();
    const district_name = [];
    const district_code = [];
    $(".district_name").each(function (key, el) {
        district_name[key] = el.value;
    });
    $(".district_code").each(function (key, el) {
        district_code[key] = el.value;
    });
    $.ajax({
        method: "POST",
        url: "api/createzone",
        data: {
            zone_id: zone_id,
            district_name: district_name,
            district_code: district_code,
        },
        success: function (data) {
            document.getElementById("add_zone_form").reset();
            Swal.fire("Data Saved", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderzone`,
                    success: function (data) {
                        $(".create_zone_modal").modal("hide");
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

$(document).on("input", ".zone_district_name_select", async function () {
    const districtname = this.value;
    const res = await fetch(`api/getTaluk/${districtname}`, {
        method: "POST",
        headers: {
            "X-CSRF-Token": document.querySelector("[name='_token']").value,
        },
    });
    if (res.status != 200) return;
    const data = await res.text();
    $(
        this.closest(".extra_fields").querySelector(
            ".zone_district_code_select"
        )
    ).html(data);
});

async function getDistrict() {
    let resHtml = null;
    await $.ajax({
        type: "post",
        url: "api/getDistrict",
        success: function (response) {
            resHtml = response;
        },
        error: function (data) {
            Swal.fire({
                title: "Something went wrong",
                text: data.responseJSON.message,
                icon: "warning",
            });
        },
    });
    return resHtml;
}

function viewBtnHandler() {
    $(".view_btn").on("click", function () {
        const html = `
                            <div class="preloader_container">
                                <img src="assets/images/dashboard/preloader.gif" alt="preloader_logo">
                            </div>
        `;
        $("#view_form_data").html(html);
        const id = this.dataset.zoneId;
        $.ajax({
            method: "GET",
            url: `api/viewzone/${id}`,
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

function editZoneFormSubmit(id) {
    const editFormEL = document.getElementById("edit_zone_form");
    const formdata = new FormData(editFormEL);
    $.ajax({
        method: "POST",
        url: `api/updatezone/${id}`,
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire("Data Updated", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderzone`,
                    success: function (data) {
                        $(".edit_zone_modal").modal("hide");
                        $("#re_render").html(data);
                        editZoneFormValidation(id);
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
        const id = this.dataset.zoneId;
        $.ajax({
            method: "POST",
            url: `api/editzone/${id}`,
            success: function (data) {
                setTimeout(() => {
                    $("#edit_form_data").html(data);
                    editZoneFormValidation(id);
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

function deleteBtnHandler() {
    $(".delete_btn").on("click", function () {
        const id = this.dataset.zoneId;
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
                    url: `api/deletezone/${id}`,
                    success: function (data) {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        ).then((result) => {
                            $.ajax({
                                method: "POST",
                                url: `api/renderzone`,
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
                            icon: "warning",
                            title: "Something went wrong",
                            text: "Reload this page and try again",
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
