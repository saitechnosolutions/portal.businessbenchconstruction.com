// Area page input validation
const designationValidation = new JustValidate("#add_designation_form");
designationValidation
    .addField(".designation_name", [
        {
            rule: "required",
            errorMessage: "* This field is required",
        },
    ])
    .onSuccess((event) => {
        saveDesignation();
    });

function saveDesignation() {
    const designationInputEl = document.getElementById("add_designation_form");
    const formdata = new FormData(designationInputEl);
    $.ajax({
        method: "POST",
        url: "api/createdesignation",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            document.getElementById("add_designation_form").reset();
            Swal.fire("Data Saved", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderdesignation`,
                    success: function (data, textStatus, xhr) {
                        $(".create_designation_modal").modal("hide");
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

function dataTableReRender() {
    $("#example").DataTable().destroy();

    $("#example thead tr")
        .clone(true)
        .addClass("filters")
        .appendTo("#example thead");

    $("#example").DataTable({
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

function viewBtnHandler() {
    $(".view_btn").on("click", function () {
        const html = `
                        <div class="preloader_container">
                            <img src="assets/images/dashboard/preloader.gif" alt="preloader_logo">
                        </div>
    `;
        $("#view_form_data").html(html);
        const id = this.dataset.designationId;
        $.ajax({
            method: "GET",
            url: `api/viewdesignation/${id}`,
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

function submitEditHandler(id) {
    const editFormEL = document.getElementById("edit_designation_form");
    const formdata = new FormData(editFormEL);
    $.ajax({
        method: "POST",
        url: `api/updatedesignation/${id}`,
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire("Data Updated", "", "success").then((result) => {
                $.ajax({
                    method: "POST",
                    url: `api/renderdesignation`,
                    success: function (data) {
                        $(".edit_designation_modal").modal("hide");
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
        const id = this.dataset.designationId;
        $.ajax({
            method: "post",
            url: `api/editdesignation/${id}`,
            success: function (data) {
                setTimeout(() => {
                    $("#edit_form_data").html(data);
                    editFormValidator(id);
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

function editFormValidator(id) {
    const editFormValidation = new JustValidate("#edit_designation_form");
    editFormValidation
        .addField(".designation_name", [
            {
                rule: "required",
                errorMessage: "* This field is required",
            },
        ])
        .onSuccess((event) => {
            submitEditHandler(id);
        });
}
//

function deleteBtnHandler() {
    $(".delete_btn").on("click", function () {
        const id = this.dataset.designationId;
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
                    url: `api/deletedesignation/${id}`,
                    success: function (data) {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        ).then((result) => {
                            $.ajax({
                                method: "POST",
                                url: `api/renderdesignation`,
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
                            text: "Please try again later",
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
