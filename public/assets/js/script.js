AOS.init(); // AOS Initialze
// viewUsers();



// Change Date Format

function formatDate(input) {
    var datePart = input.match(/\d+/g),
        year = datePart[0].substring(0), // get only two digits
        month = datePart[1], day = datePart[2];

    return day + '-' + month + '-' + year;
}

// Form validation

function Emailverify(data) {
    let emailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (data.match(emailformat)) {
        return true;
    } else {
        return false;
    }
}

function Formvalidation(input) {
    var result = "";
    input.each(function () {

        var inputvalues = $(this).val();
        var fields = $(this).parent('div').find('label').text();
        var errors = $(this).parent('div').find('.error-text');

        if (inputvalues == "") {

            if(fields != ""){
                errors.text(fields + " " + "field is required").css("font-size", "13px");
            }else{
                errors.text("This field is required").css("font-size", "13px");
            }
            result = "false";
            console.log(result);

        } else {

            if (result != "false") {
                result = "true";
            }
            errors.text("");
            if ($(this).attr("type") == "email") {
                var email = $(this, "[type='email']").val();
                if (Emailverify(email)) {
                    errors.text("");
                } else {
                    errors.text("Invalid Email Format").css("font-size", "13px");
                    result = "false";
                }
            }
            if ($(this).attr('type') == "number" || $(this).attr('type') == "tel") {
                var number = $(this, "[type='number']").val();
                var tel = $(this, "[type='tel']").val();
                if (number.match(/^[0-9]+$/) || tel.match(/^[0-9]+$/)) {
                    errors.text("");
                    result = "true";
                } else {
                    errors.text("Numbers only").css("font-size", "13px");
                    result = "false";
                }
            }

            if($(this).attr('type') == "tel"){
                if(inputvalues.length != 10){
                    errors.text("Must be 10 digits").css("font-size", "13px");
                    result = "false";
                }
            }
        }


    });

    if (result == 'true') {
        return true;
    } else {
        return false;
    }
}

// Allow only numbers

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(document).on('keypress','input',function(value){

    if($(this).attr('type')=="number" || $(this).attr('type')=="tel"){
        return isNumber(value);
    }
});

// Sliders

function numberWithCommas(x) { // Indian Rupee format Function

    x=x.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

    return res;
}

$('.content-slider').slick({
    dots: true,
    infinite: true,
    autoplaySpeed: 2000,
    cssEase: 'ease-in',
    autoplay: true,
    arrows: false
});

$('.radius_shape_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


// Password Shown

$(document).on("click", ".eye", function() {
    if ($('.eye i').hasClass("far fa-eye-slash")) {
        $('.eye i').removeClass("far fa-eye-slash");
        $('.eye i').addClass("far fa-eye");
        $(".login_password").attr("type", "text");
    } else {
        $('.eye i').removeClass("far fa-eye");
        $('.eye i').addClass("far fa-eye-slash");
        $(".login_password").attr("type", "password");

    }
});

// Append fields

// $(document).on("click", ".plus", function() {
//     var html = '<div class="row extra_fields position-relative mt-3"><div class="col-lg-6"><div class="form-input"><label for="">Name</label><span class="text-danger">*</span><br><input type="text" name="name"></div></div><div class="col-lg-6"><div class="form-input"><label for="">Code</label><span class="text-danger">*</span><br><input type="text" name="code"></div></div><div class="plus"><i class="fas fa-plus"></i></div><div class="remove_row"><i class="fas fa-times"></i></div></div>';

//     $(".field_groups").append(html);
// });

// $(document).on("click", ".remove_row", function() {
//     $(this).closest(".row").remove();
// });


$(document).ready(function() {
    $('#example').DataTable( {

        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
    "ordering": false
    } );
} );

$(document).ready(function() {
    $('#example1').DataTable( {
        "ordering": false
    } );
} );

$(document).ready(function() {
    $('#example2').DataTable( {
        "ordering": false
    } );
} );

var checklist = $(".checkout-box input[type='checkbox']");

    $(checklist).click(function(){
        $.each(checklist,function(){
            if($(this).is(':checked')){
                $(this).val("1");
            }else{
                $(this).val("0");
            }
        });
    });


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".preloader").hide();

$("#adduserdata").submit(function (event) {
    event.preventDefault();
    var d = new FormData(this);
    console.log(d);
    var elements = $("#createuser input[required]");

    if (Formvalidation(elements)) {
        $.ajax({
            method: "POST",
            url: "/api/createUser",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(".preloader").fadeIn();
            },
            success: function (data) {

                if ($.isEmptyObject(data.error)) {
                    // alert(data.success);

                    $(".error-text").text('');
                    name = $("#name").val('');
                    email = $("#email").val('');
                    mobilenumber = $("#mobilenumber").val('');
                    password = $("#password").val('');
                    role = $("#role").val('');
                    $('#profilepic').val();
                    $(".checkout-box input[type='checkbox']").each(function(){
                        $(this).attr('checked', 'false');
                    })

                    $("#createuser").modal('hide');
                    $(".preloader").fadeOut();
                    Swal.fire(
                        'Success!',
                        'User Created Successfully!',
                        'success'
                    )
                }
                else {
                    printErrorMsg(data.error);
                    $(".preloader").fadeOut();
                }
            },
            error: function (error) {
                $(".preloader").fadeOut();
            },


        });
    }

    function printErrorMsg(msg) {
        $.each(msg, function (key, value) {
            console.log(key);
            $('.' + key + '_error').text(value);
        });
    }

});


function viewUsers()
    {
        $.ajax({
            type:'GET',
            url:'/api/viewUsers',
            dataType:'json',
            success: function(response){

                // $('.userTable tbody').html("");
                $.each(response,function(key, item){

                    $('#userstable').append(
                        '<tr><td><a class="viewid">'+item.userid+'</a></td>\
                         <td>'+item.name+'</td>\
                         <td>'+item.role+'</td>\
                         <td>'+item.usertype+'</td>\
                         <td>\
                             <button data-user='+item.userid+' class="useredit btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>\
                         </td>\
                         <td>\
                             <button data-user='+item.userid+' class="btn btn-danger btn-sm deleteuser" id="deleteuser"><i class="fa fa-trash-o" aria-hidden="true"></i></button>\
                         </td></tr>'

                    )

                });
            }
        })
    }


    // Get area

$("#dealershipregion").change(function(){

    var region = $(this).val();
    // alert(region);
    {
        $.ajax({
            type:'GET',
            url:'/api/getArea/'+region,
            dataType:'json',
            success: function(response){

                $('#dealershiparea').html("");
                $.each(response,function(key, item){

                    $('#dealershiparea').append(
                        '<option value="'+item.taluk_code+'">'+item.taluk_name+'</option>'
                    )

                });
            }
        })
    }
});

$(".deleteuser").click(function(){


        const user = $(this).data("user");

    Swal.fire({
        title: "Are you sure?",
        text: "Delete the user",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url:'/api/deleteuser/'+user,
                success: function (data) {
                    Swal.fire(
                        "Delete!",
                        "Your File Deleted.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});

$(".viewid").click(function(){

        var viewid = $(this).data("viewid");
        $.ajax({
            type:'GET',
            url:'/api/getuser/'+viewid,
            dataType:'json',
            success: function(response){
                $(".clickhereimg").fadeOut();
            $(".view_card_box").fadeIn();
                $(".usercode").text(response.userid);
                $(".username").text(response.name);
                $(".usermbl").text(response.mobilenumber);
                $(".usermail").text(response.email);
                $(".userrole").text(response.role);
            }
        })
});

// Engineers




$("#addEngineerdata").submit(function(event){



    var input = $("#addEngineerdata input,#addEngineerdata textarea,#addEngineerdata select");

    var formData = $(this).serialize();

    if(Formvalidation(input)){



        $.ajax({
            type:"POST",
            url: "/api/createEngineer",
            data:new FormData(this),
            // async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".preloader").fadeIn();
            },
            success: function(data) {

                if($.isEmptyObject(data.error)){
                    // alert(data.success);

                    $(".error-text").text('');
                    name = $("#name").val('');
                    email = $("#email").val('');
                    mobilenumber = $("#mobilenumber").val('');

                    $("#createEngineers").modal('hide');
                    $(".preloader").fadeOut();
                    Swal.fire(
                        'Success!',
                        'Engineer Created Successfully..!',
                        'success'
                      )


                    // viewEngineers();
                }
                else
                {
                    printErrorMsg(data.error);
                }
            },



        });
    }

});


// viewEngineers();
function viewEngineers()
    {
        $.ajax({
            type:'GET',
            url:'/api/viewengineer',
            dataType:'json',
            success: function(response){

                // $('.userTable tbody').html("");
                $.each(response,function(key, item){

                    $('#engineerstable').append(

                        '<tr><td>'+item.engineerid+'</td>\
                         <td>'+item.name+'</td>\
                         <td>'+item.dealershiparea+'</td>\
                         <td>'+item.dealershipregion+'</td>\
                         <td>10</td>\
                         <td>5</td>\
                         <td>\
                             <button class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>\
                         </td>\
                         <td>\
                             <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>\
                         </td></tr>'

                    )

                });
            }
        })
    }

    $(".engineerview").click(function(){

        var viewid = $(this).data("engineerview");
        $.ajax({
            type:'GET',
            url:'/api/getengineer/'+viewid,
            dataType:'json',
            success: function(response){
                $(".clickhereimg").fadeOut();
                $(".view_card_box").fadeIn();
                var path = "/images/"+response.photo;
                $(".engineercode").text(response.engineerid);
                $(".engineername").text(response.name);
                $(".engineerstartdate").text(formatDate(response.startdate));
                $(".engineerenddate").text(formatDate(response.enddate));
                $(".engineeraddress").text(response.address);
                $(".engineerphone").text(response.phnumber);
                $(".engineermail").text(response.emailid);
                $(".engineerregion").text(response.dealershipregion);
                $(".engineerarea").text(response.dealershiparea);
                $(".engineerlocation").attr("href",response.maplocation);
                $(".engineerphoto").attr("src",path);
            }
        })
});


$(".engineerdelete").on("click", function () {

    const id = $(this).data("engid");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be delete this record..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `api/deleteeng/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".check_client").click(function(){
    var elements = $("#addClientsdata input[required],#addClientsdata textarea[required],#addClientsdata select[required]");
    Formvalidation(elements);
});


$("#addClientsdata").submit(function(){

    var elements = $("#addClientsdata input[required],#addClientsdata textarea[required],#addClientsdata select[required]");

    if(Formvalidation(elements)){
        $.ajax({
        type:"POST",
        url: "/api/createClients",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#createCLients").modal('hide');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Good job!',
                    'Client Created Successfully..',
                    'success'
                  )
                  location.reload();

                }
                else
                {
                    printErrorMsg(data.error);
                }
            },


        });
    }

});
$(".view_card_box").hide();
$(".clickhereimg").show();
$(".clientdetails").click(function(){
    var clientid = $(this).data("clientview");

    $.ajax({
        type:'GET',
        url:'/api/getclient/'+clientid,
        dataType:'json',
        success: function(response){
            $(".clickhereimg").hide();
            $(".view_card_box").show();
            var clientlink = "clientdetails/"+response.clientcode;
            $(".clientcode").text(response.clientcode);
            $(".clientname").text(response.name);
            $(".clientstartdate").text(formatDate(response.projectstartdate));
            $(".clientenddate").text(formatDate(response.expecteddate));
            $(".clientaddress").text(response.address);
            $(".clientphone").text(response.mobilenumber);
            $(".clientmail").text(response.emailid);
            $(".clientregion").text(response.regionalmanagercode);
            $(".clientarea").text(response.area);
            // $(".viewclientdetails").attr("href",clientlink);
            // $(".engineerphoto").attr("src",path);
        }
    })

});



// Stage 1


 $(document).on('click', '.stage1add', function() {

var html =
'<tr> <td> <div class="form-input mt-3"> <input type="text" name="stageqty[]" id="stageoneqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <select class="form-control" name="stageunit[]"> <option value="">-- UOM --</option> <option value="Cft">Cft</option> <option value="Sft">Sft</option> <option value="MT">MT</option> <option value="Nos">Nos</option> <option value="Rft">Rft</option> <option value="LN">LN</option> <option value="Coil">Coil</option> <option value="St">St</option> </select> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagedesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagerate[]" class="rate form-control" id="stageonerate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" class="amt form-control" name="stageamt[]" > </div></td><td> <button type="button" class="btn btn-success stage1add mb-3"><i class="fa fa-plus" aria-hidden="true"></i></button> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';
// <td> <div class="form-input mt-3"> <input type="text" name="stageoneamt[]" class="amt form-control" id="stageoneamt1"> </div></td>
// $('#stage1').append(html);
// $("#stage1 tr:nth-last-child(-n+1)").before(html);
$(html).insertBefore($("#stage1 tr:nth-last-child(8)"));


//    alert($("#app1").val())
});

$(document).on('click', '.remove', function() {
$(this).parents('tr').remove();
});

$(document).on("keyup",".rate",function(){
var qty = $(this).val();
var rate = $(this).closest('tr').find('.qty').val()
 $(this).closest('tr').find('.amt').val(rate*qty);

var amt = $(this).closest('#stage1').find('.amt');


 var total_price=0;

 $.each(amt,function(){
    // alert($(this).val());
    total_price += parseInt($(this).val());
});
$(this).closest('#stage1').find('.stagetotamt').val(total_price);

});


// Stage 2

$(document).on("keyup",".clientpercentage",function(){
    var stageamt = $(this).closest('#stage1').find('.stagetotamt').val();
    var percentage = $(this).val();
    var clientestimateamt = $(this).closest('#stage1').find('.clientestimateamt');
    // alert(stageamt*percentage."%");
    clientestimateamt.val(parseInt(stageamt/100*percentage)+parseInt(stageamt));

});

$(document).on("change",".paymentsplit",function(){
    var duetime = $(this).val();
    var clientestimateamt = $(this).closest('#stage1').find('.clientestimateamt').val();
    var dueamount = $(this).closest('#stage1').find('.dueamount');
    // alert(stageamt*percentage."%");
    dueamount.val(clientestimateamt/duetime);

});

$(document).on('click', '.stage2add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagetwoqty[]" id="stagetwoqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagetwounit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagetwodesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagetworate[]" class="rate form-control" id="stagetworate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagetwoper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagetwoamt[]" class="amt form-control" id="stagetwoamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage2').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)



    });

// Stage 3

    $(document).on('click', '.stage3add', function() {

        var html =
        '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagethreeqty[]" id="stagethreeqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagethreeunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagethreedesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagethreerate[]" class="rate form-control" id="stagethreerate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagethreeper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagethreeamt[]" class="amt form-control" id="stagethreeamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



        $('#stage3').append(html);
        //    alert($("#app1").val())
        });

        $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
        });

        $(document).on("keyup",".rate",function(){
        var qty = $(this).val();
        var rate = $(this).closest('tr').find('.qty').val()
         $(this).closest('tr').find('.amt').val(rate*qty)



        });

// Stage 4

$(document).on('click', '.stage4add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagefourqty[]" id="stagefourqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefourunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagefourdesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefourrate[]" class="rate form-control" id="stagefourrate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefourper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefouramt[]" class="amt form-control" id="stagefouramt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage4').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)



    });


// Stage 5

$(document).on('click', '.stage5add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagefiveqty[]" id="stagefiveqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefiveunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagefivedesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefiverate[]" class="rate form-control" id="stagefiverate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefiveper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagefiveamt[]" class="amt form-control" id="stagefiveamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage5').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });

// Stage 6

$(document).on('click', '.stage6add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagesixqty[]" id="stagesixqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesixunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagesixdesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesixrate[]" class="rate form-control" id="stagesixrate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesixper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesixamt[]" class="amt form-control" id="stagesixamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage6').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });

// Stage 7

$(document).on('click', '.stage7add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagesevenqty[]" id="stagesevenqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesevenunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stagesevendesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesevenrate[]" class="rate form-control" id="stagesevenrate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesevenper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagesevenamt[]" class="amt form-control" id="stagesevenamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage7').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });


// Stage 8

$(document).on('click', '.stage8add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stageeightqty[]" id="stageeightqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stageeightunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stageeightdesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stageeightrate[]" class="rate form-control" id="stageeightrate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stageeightper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stageeightamt[]" class="amt form-control" id="stageeightamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage8').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });


// Stage 9

$(document).on('click', '.stage9add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <input type="text" name="stagenineqty[]" id="stagenineqty1" class="qty form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagenineunit[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <textarea class="form-control" name="stageninedesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stageninerate[]" class="rate form-control" id="stageninerate1"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagenineper[]" class="form-control"> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagenineamt[]" class="amt form-control" id="stagenineamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';



    $('#stage9').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });

// Stage 10

$(document).on('click', '.stage10add', function() {

    var html =
    '<tr> <td> <div class="form-input mt-3"> <textarea class="form-control" name="stagetendesc[]"></textarea> </div></td><td> <div class="form-input mt-3"> <input type="text" name="stagetenamt[]" class="amt form-control" id="stagetenamt1"> </div></td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';


    $('#stage10').append(html);
    //    alert($("#app1").val())
    });

    $(document).on('click', '.remove', function() {
    $(this).parents('tr').remove();
    });

    $(document).on("keyup",".rate",function(){
    var qty = $(this).val();
    var rate = $(this).closest('tr').find('.qty').val()
     $(this).closest('tr').find('.amt').val(rate*qty)

    });


// Estimates


$("#addEstimates").submit(function(){

    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/api/createEstimates",
        data:new FormData(this),
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#createEstimate").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Estimates Created Successfully..',
                    'success'
                  )

                window.location='/estimatereq';
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(document).on("click",".clear_estimate",function(){
   $(this).closest("tr").remove();
});


$(".estimatesdelete").click(function(){

    const id = $(this).data("estid");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be delete this record..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `api/deleteest/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });

});


// Drawings

$("#addDrawings").submit(function(){

    $.ajax({
        type:"POST",
        url: "/drawrequest",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#createDrawings").modal('hide');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Good job!',
                    'Drawing Uploaded Successfully..',
                    'success'
                  );
                  location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(".uploaddraw").click(function(){

    var leadid = $(this).data("leadid");
    var drawid = $(this).data("drawid");
    var engineerid = $(this).data("engineerid");
    // var packagetype = $(this).data("package")

    $("#replyclientid").val(leadid);
    $("#replyengid").val(engineerid);
    $("#drawid").val(drawid);



});

$("#replyDrawings").submit(function(){

    $.ajax({
        type:"POST",
        url: "/replydraw",
        data:new FormData(this),
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#replyDrawingsmodal").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Drawing Uploaded Successfully..',
                    'success'
                  )

            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(".getestimatepayment").click(function(){
    var amt = $(this).data("amt");
    var paymenthod = $(this).data("paymenthod");
    var estid = $(this).data("estid");
    var id = $(this).data("id");

    $("#estmateid").text(estid);
    $("#paymentmd").text(paymenthod);
    $("#totamt").text(amt);
    $("#payid").val(id);
});

$(".stagepay").on("click", function () {

    // const id = $(this).data("id");
    const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "You Paid Amount",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Paid!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/stagepaid/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Review!",
                        "Your payment reviewed.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".tile .float").click(function(){
    $(this).html($(this).html() == '<i class="fa fa-times my-float"></i>' ? '<i class="fa fa-share my-float"></i>' : '<i class="fa fa-times my-float"></i>');
  $(".tile .soc").toggleClass("pad");
});
/* 2nd button */
$(".tile1 .float").click(function(){
    $(this).html($(this).html() == '<i class="fa fa-times"></i>' ? '<i class="fa fa-ellipsis-h"></i>' : '<i class="fa fa-times"></i>');
  $(".tile1 .soc").toggleClass("pad1");
});
/* 3rd button */
$(".tile2 .float").click(function(){
     $(this).html($(this).html() == '<i class="fa fa-times my-float"></i>' ? '<i class="fa fa-th my-float"></i>' : '<i class="fa fa-times my-float"></i>');
  $(".tile2 .soc").toggleClass("active");
});



$(document).on('click', '.desc', function() {

    var html =
    '<tr> <td> <textarea class="form-control" name="desc[]"></textarea> </td><td><button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

    $('#adddesc').append(html);
    //    alert($("#app1").val())
    });
    $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
        });

$(document).on('click', '.addreq', function() {

    var html =
     '<tr> <td> <input type="text" class="form-control" name="requirenments[]" style="width: 100%" > </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

      $('#addreq').append(html);
        //    alert($("#app1").val())
     });
     $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
        });

 $(document).on('click', '.addfamily', function() {

            var html =
             '<tr> <td> <input type="text" placeholder="Name" class="form-control" name="member[]" style="width: 100%" id="enddate"> </td><td> <input placeholder="Age" type="text" class="form-control" name="age[]" style="width: 100%" id="enddate"> </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

              $('#familyadd').append(html);
                //    alert($("#app1").val())
             });
             $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
   });


$("#addLeadsdata").submit(function(){

    // var input = $("#addLeadsdata input,#addLeadsdata textarea,#addLeadsdata select");

    // if(Formvalidation(input)){
        $.ajax({
        type:"POST",
        url: "/saveLeads",
        data:new FormData(this),
       // async: false,
       cache: false,
       contentType: false,
       processData: false,
       beforeSend: function() {
           $(".preloader").fadeIn();
       },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#createLead").modal('hide');

                $(".preloader").fadeOut();
                Swal.fire(
                    'Success!',
                    'Lead Added Successfully..',
                    'success'
                  )
                  location.reload();

                }
                else
                {
                    printErrorMsg(data.error);
                }
            },


        });
    // }

});



$(".uploaddrawings").submit(function(){

    $.ajax({
        type:"POST",
        url: "/uploaddrawings",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                // $(".error-text").text('');

                // $("#createLead").modal('hide');
        $(".preloader").fadeOut();
                Swal.fire(
                    'Success!',
                    'File Uploaded Successfully..',
                    'success'
                  )
                  location.reload();

            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});


$(".alluploaded").on("click", function () {

    const leadid = $(this).data("leadid");
    const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "All Files Uploaded",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Uploaded!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/architechuploadstatus/${leadid}/${drawid}`,
                success: function (data) {
                    Swal.fire(
                        "Review!",
                        "Your File Approved.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Check the error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".clientapprove").on("click", function () {

    const approveid = $(this).data("id");
    // const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approved This File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approved!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientapprove/${approveid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Your File Approved.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check the error",
                        "success"
                    );
                },
            });
        }
    });
});


$(".clientreject").on("click", function () {

    const approveid = $(this).data("id");
    // const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject This File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientreject/${approveid}`,
                success: function (data) {
                    Swal.fire(
                        "Rejected!",
                        "Your File Rejected.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Kindly check the error",
                        "success"
                    );
                },
            });
        }
    });
});

$("#estimaterequest").submit(function(){


    $.ajax({
        type:"POST",
        url: "/estimaterequest",
        data:new FormData(this),
       // async: false,
       cache: false,
       contentType: false,
       processData: false,
       beforeSend: function() {
           $(".preloader").fadeIn();
       },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                // $(".error-text").text('');

                // $("#createLead").modal('hide');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Success!',
                    'Request Send Successfully..',
                    'success'
                  );
                  location.reload();

            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });
});

$("#projectvalue").keyup(function(){

    var projectvalue =$(this).val();
    var mainestamt1 = $("#mainestamt1").val();

     var percentage1 = (mainestamt1/projectvalue)*100;
        $("#mainestpercentage1").val(percentage1);

        var projectvalue =$(this).val();
    var mainestamt2 = $("#mainestamt2").val();

     var percentage2 = (mainestamt2/projectvalue)*100;
        $("#mainestpercentage2").val(percentage2);

        var projectvalue =$(this).val();
    var mainestamt3 = $("#mainestamt3").val();

     var percentage3 = (mainestamt3/projectvalue)*100;
        $("#mainestpercentage3").val(percentage3);

        var projectvalue =$(this).val();
    var mainestamt4 = $("#mainestamt4").val();

     var percentage4 = (mainestamt4/projectvalue)*100;
        $("#mainestpercentage4").val(percentage4);

        var projectvalue =$(this).val();
    var mainestamt5 = $("#mainestamt5").val();

     var percentage5 = (mainestamt5/projectvalue)*100;
        $("#mainestpercentage5").val(percentage5);

        var projectvalue =$(this).val();
    var mainestamt6 = $("#mainestamt6").val();

     var percentage6 = (mainestamt6/projectvalue)*100;
        $("#mainestpercentage6").val(percentage6);

        var projectvalue =$(this).val();
    var mainestamt7 = $("#mainestamt7").val();

     var percentage7 = (mainestamt7/projectvalue)*100;
        $("#mainestpercentage7").val(percentage7);

        var projectvalue =$(this).val();
    var mainestamt8 = $("#mainestamt8").val();

     var percentage8 = (mainestamt8/projectvalue)*100;
        $("#mainestpercentage8").val(percentage8);

        var projectvalue =$(this).val();
    var mainestamt9 = $("#mainestamt9").val();

     var percentage9 = (mainestamt9/projectvalue)*100;
        $("#mainestpercentage9").val(percentage9);

        var projectvalue =$(this).val();
    var mainestamt10 = $("#mainestamt10").val();

     var percentage10 = (mainestamt10/projectvalue)*100;
        $("#mainestpercentage10").val(percentage10);
});

$("#mainestamt1").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt1 = $(this).val();

     var percentage1 = (mainestamt1/projectvalue)*100;
        $("#mainestpercentage1").val(percentage1);
})

$("#mainestamt2").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt2 = $(this).val();

     var percentage2 = (mainestamt2/projectvalue)*100;
        $("#mainestpercentage2").val(percentage2);
})

$("#mainestamt3").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt3 = $(this).val();

     var percentage3 = (mainestamt3/projectvalue)*100;
        $("#mainestpercentage3").val(percentage3);
})

$("#mainestamt4").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt4 = $(this).val();

     var percentage4 = (mainestamt4/projectvalue)*100;
        $("#mainestpercentage4").val(percentage4);
})

$("#mainestamt5").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt5 = $(this).val();

     var percentage5 = (mainestamt5/projectvalue)*100;
        $("#mainestpercentage5").val(percentage5);
})

$("#mainestamt6").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt6 = $(this).val();

     var percentage6 = (mainestamt6/projectvalue)*100;
        $("#mainestpercentage6").val(percentage6);
})

$("#mainestamt7").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt7 = $(this).val();

     var percentage7 = (mainestamt7/projectvalue)*100;
        $("#mainestpercentage7").val(percentage7);
})

$("#mainestamt8").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt8 = $(this).val();

     var percentage8 = (mainestamt8/projectvalue)*100;
        $("#mainestpercentage8").val(percentage8);
})

$("#mainestamt9").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt9 = $(this).val();

     var percentage9 = (mainestamt9/projectvalue)*100;
        $("#mainestpercentage9").val(percentage9);
})

$("#mainestamt10").keyup(function(){
    var projectvalue = $("#projectvalue").val();
    var mainestamt10 = $(this).val();

     var percentage10 = (mainestamt10/projectvalue)*100;
        $("#mainestpercentage10").val(percentage10);
})

$("#addMainest").submit(function(){

    $.ajax({
        type:"POST",
        url: "/createMainestimate",
        data:new FormData(this),
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');
                name = $("#name").val('');
                email = $("#email").val('');
                mobilenumber = $("#mobilenumber").val('');

                // $("#successmodal").modal('show');
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                  )


                // viewEngineers();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });

});


$(".leadview").click(function(){

    var leadid = $(this).data('leadid');

    $.ajax({
        type:"GET",
        url: "/getleaddetails/"+leadid,

        success: function(data) {
                if(data.leadid == undefined)
                {
                    $("#leadviewnodata").modal('show');
                }
                else
                {
                    $("#leadview").modal('show');

                    $("#leadids").text(data.leadid);
                    $("#leadname").text(data.name);
                    $("#mobilenumber").text(data.mobile_num);
                    $("#leademail").text(data.email);
                    $("#leadaddress").text(data.address);
                    // $("#leadid").text(data.google_map_link);
                    $("#siteaddress").text(data.address);
                    $("#plotsqft").text(numberWithCommas(data.plotarea));
                    $("#budgetvalue").text(numberWithCommas(data.budgetvalue));
                    $("#leadstartdate").text(formatDate(data.startdate));
                    $("#leadenddate").text(formatDate(data.enddate));
                    $("#leadloc").attr("href",data.google_map_link);

                }



        }


    });

    $.ajax({
        type:"GET",
        url: "/gethouserequirements/"+leadid,
        success: function(data1)
        {
            // $('#req').find('li').remove().end();
            $.each(data1,function(key, item){
                // $("#req").find("li").remove();
                $('#req').append(
                    '<li>'+item.spec1+'</li>'
                )
            });
        }
    });

    $.ajax({
        type:"GET",
        url: "/getfamilymembers/"+leadid,
        success: function(response1)
        {
            // $('#familydetails').find('li').remove().end();
            $.each(response1,function(key, item){
                // $("#familydetails").find("li").remove();
                $('#familydetails').append(
                    '<li>'+item.name+' - '+item.age+'</li>'
                )
            });
        }
    });

});

$(".nodata").click(function(){
    Swal.fire({
        imageUrl: '/assets/images/processingimg.svg',
        imageHeight: 300,
        imageAlt: 'Estimate Process'
      })
})


// $("#stagemasterimport").submit(function(){
$(document).on('submit','#stagemasterimport',function(){

    $.ajax({
        type:"POST",
        url: "/uploadstage",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                $("#importstages").modal('show');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Stages Uploaded Successfully',
                    showConfirmButton: false,
                    timer: 1500
                  })

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


$(".editstage").click(function(){
    var editstage = $(this).data("edit");
    var deletestage = $(this).data("delete");

    $.ajax({
        type:"GET",
        url: "/geteditstage/"+editstage,
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#editstage").modal('show');
            $("#stageid").val(data.stageid);
            $("#stagename").val(data.stagename);
            $("#description").val(data.description);
            $("#sid").val(data.id);
        },



    });
})


$(document).on('submit','#stageupdate',function(){

    $.ajax({
        type:"POST",
        url: "/updatestage",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Stages Updated Successfully',
                    showConfirmButton: false,
                    timer: 1500
                  })

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


$(".deletestage").on("click", function () {

    const stageid = $(this).data("delete");
    // const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject This File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/stagedelete/${stageid}`,
                success: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Stage Deleted Successfully..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});

$(document).ready(function() {
    // $('.js-example-basic-single').each(function(){
    //     $(".js-example-basic-single").select2();
    // })


});

// $(document).on('click', '.addstage', function() {

//     var html =
//      '<tr> <td> <select class="form-control" name="stages[]"> <option>-- Choose Stages --</option> @if($stagemasters) @foreach ($stagemasters as $stage) <option value="{{$stage->stageid}}">{{$stage->stagename}}</option> @endforeach @endif </select> </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

//       $('#stagedetails').append(html);
//            alert($("#app1").val())
//      });
//      $(document).on('click', '.remove', function() {
//         $(this).parents('tr').remove();
// });


$(".createbtn").click(function(){
    var engid = $(this).data("engid");
    var clientid = $(this).data("clientid");
    $("#engid").val(engid);
    $("#clientid").val(clientid);

});


$(document).on('submit','#estimatebulkupload',function(){

    $.ajax({
        type:"POST",
        url: "/uploadestimates",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Estimate Updated Successfully',
                    showConfirmButton: false,
                    timer: 1500
                  })

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});

$(document).ready(function () {

    $(".removestage:first").css("visibility", "hidden");

    $(".js-example-basic-single").select2();


    $(document).on("click", ".addstage", function () {

        $(".js-example-basic-single").select2('destroy');

        setTimeout(function () {
            $(".js-example-basic-single").select2();

        }, 100);

        $(".removestage:first").css("visibility", "visible");

        var main = $("#appendstageparent");

        // var appendstage = main.children('.appendstage')[0].outerHTML;

        var appendstage = $(this).closest("tr").html();

        if ($(".removestage:first").css("visibility", "visible")) {
            if (main.append("<tr class='appendstage'>" + appendstage + "</tr>")) {
                $(".addstage:first").prop("disabled", true);
                $(".removestage:first").css("visibility", "hidden");
            }
        }

    });

    $(document).on("click", ".removestage", function () {
        if ($(this).closest("tr").remove()) {
            if ($(".addstage").length == 1) {
                $(".addstage:first").prop("disabled", false);
                $(".removestage:first").css("visibility", "hidden");
            }
        }

    })
});
$(".raisebutton").click(function(){
    var estid = $(this).data("estimateid");
    var stageid = $(this).data("stageid");
    var amount = $(this).data("amount");
    var id = $(this).data("id");
    var esttype = $(this).data("esttype");

    $("#payestimateid").val(estid);
    $("#payetageid").val(stageid);
    $("#payamt").val(amount);
    $("#id").val(id);
    $("#esttype").val(esttype);
});


$(document).on('submit','#raisepayment',function(){

    $.ajax({
        type:"POST",
        url: "/paymentraise",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Payment',
                    'Payment raises Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


$(".paynowbtn").click(function(){

    var estid = $(this).data("estimateid");
    var stageid = $(this).data("stageid");
    var amount = $(this).data("amount");
    var clientid = $(this).data("clientid");
    var id = $(this).data("id");
    // alert(clientid);
    $("#payestimateid1").val(estid);
    $("#payetageid1").val(stageid);
    $("#payamt1").val(amount);
    $("#clientid").val(clientid);
    $("#id1").val(id);

});

$(document).on('submit','#paymentpaid',function(){

    $.ajax({
        type:"POST",
        url: "/paymentpaid",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Payment',
                    'Payment Paid Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


$(".paymentapprove").on("click", function () {

    const estid = $(this).data("estid");
    const stageid = $(this).data("stageid");
    const esttype = $(this).data("esttype");



    Swal.fire({
        title: "Are you sure?",
        text: "Approved This Payment",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approved!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/paymentapprove/${stageid}/${estid}/${esttype}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Payment Approved Successfully..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".imageupload").click(function(){

    var clientid = $(this).data("clientid");
    var estid = $(this).data("estid");
    var stageid = $(this).data("stageid");
    var ae = $(this).data("ae");

    $("#clientcode").val(clientid);
    $("#engineercode").val(ae);
    $("#estid").val(estid);
    $("#stageid").val(stageid);

});


$(document).on('click', '.imgadd', function() {

    var html =
     '<tr> <td> <input type="file" class="form-control" name="completeimages[]" style="width: 100%" > </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

      $('#viewimage').append(html);
        //    alert($("#app1").val())
     });
     $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
        });

        $(document).on('click', '.imgadd2', function() {

            var html =
             '<tr> <td> <input type="file" class="form-control" name="processcompleteimages[]" style="width: 100%" > </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

              $('#viewimage').append(html);
                //    alert($("#app1").val())
             });
             $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
                });


        $(document).on('submit','#paymentpaid',function(){

            $.ajax({
                type:"POST",
                url: "/paymentpaid",
                data:new FormData(this),
                // async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".preloader").fadeIn();
                },
                success: function(data) {

                    if($.isEmptyObject(data.error)){
                        // alert(data.success);


                        // $("#importstages").modal('show');
                        $(".preloader").fadeOut();
                        Swal.fire(
                            'Payment',
                            'Payment Paid Successfully..!',
                            'success'
                          )

                        // viewEngineers();
                        location.reload();
                    }
                    else
                    {
                        printErrorMsg(data.error);
                    }
                },



            });
        });



        $(document).on('submit','#imageupload',function(){

            $.ajax({
                type:"POST",
                url: "/imageupload",
                data:new FormData(this),
                // async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".preloader").fadeIn();
                },
                success: function(data) {

                    if($.isEmptyObject(data.error)){
                        // alert(data.success);


                        // $("#importstages").modal('show');
                        $(".preloader").fadeOut();
                        Swal.fire(
                            'Complete Of Works',
                            'Images Uploaded Successfully..!',
                            'success'
                          )

                        // viewEngineers();
                        location.reload();
                    }
                    else
                    {
                        printErrorMsg(data.error);
                    }
                },



            });
        });

        $(".approveimg").on("click", function () {

            const id = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                text: "Approved This Image",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Approved!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "GET",
                        url: `/imageapprove/${id}`,
                        success: function (data) {
                            Swal.fire(
                                "Image!",
                                "Image Approved Successfully..",
                                "success"
                            ).then((result) => {
                                location.reload();
                                // $("#example").DataTable().destroy();
                                // dataTableReRender();
                            });
                        },
                        error: function (data) {
                            Swal.fire(
                                "Error!",
                                "Error.",
                                "success"
                            );
                        },
                    });
                }
            });
        });


        $(".rejectimg").on("click", function () {

            const id = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                text: "Reject This Image",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Reject!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "GET",
                        url: `/imagereject/${id}`,
                        success: function (data) {
                            Swal.fire(
                                "Image!",
                                "Image Rejected Successfully..",
                                "success"
                            ).then((result) => {
                                location.reload();
                                // $("#example").DataTable().destroy();
                                // dataTableReRender();
                            });
                        },
                        error: function (data) {
                            Swal.fire(
                                "Error!",
                                "Error.",
                                "success"
                            );
                        },
                    });
                }
            });
        });

$(".viewimg").click(function(){
    var imgname = $(this).data("imgname");
    var imagelink = "/images/"+imgname;
        $("#viewimagelarge").modal('show');

            $("#showimg").attr("src",imagelink);
});


$(document).on("change",".leadid",function(){
    var leadid = $(this).val();

    $.ajax({
        url:"lead_get",
        type:"POST",
        data:{leadid:leadid},
        dataType:"json",
        beforeSend: function(){
          $(".ajax-load").show();
        },
        success:function(data){

            $(".leadname").val(data.name);
            $(".leadaddresss").val(data.address);
            $(".leadmobile").val(data.mobile_num);
            $(".leadmail").val(data.email);
            $(".leadvalue").val(data.budgetvalue);
            $(".maplink").val(data.google_map_link);
            $(".leadploat").val(data.plotarea);
            $(".leadstart").val(data.startdate);
            $(".leadend").val(data.enddate);
            // $(".leadstart").val(formatDate(data.startdate));
            // $(".leadend").val(formatDate(data.enddate));

        },
        complete: function(){
            $(".ajax-load").hide();
        }
    });
});


$(document).on('submit','#saveestimate',function(){

    $.ajax({
        type:"POST",
        url: "/saveestimate",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Estimate',
                    'Estimate Created Successfully..!',
                    'success'
                  )

                // viewEngineers();
                window.location="/estimatereq";
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


// Gokul

$(document).on("click",".edit_engineer",function(){
    let view_id = $(this).attr("data-id");



    $.ajax({
        url:"view_engineer",
        type:"POST",
        data:{view_id:view_id},
        dataType:"json",
        beforeSend: function(){
            $(".ajax-load").show();
        },
        success:function(data){

            $("#editEngineers .edit_engineer_id").val(data[0][0].id);
            $("#editEngineers input[name=name]").val(data[0][0].name);
            $("#editEngineers input[name=startdate]").val(data[0][0].startdate);
            $("#editEngineers input[name=enddate]").val(data[0][0].enddate);
            $("#editEngineers textarea[name=address]").val(data[0][0].address);
            $("#editEngineers input[name=maplocation]").val(data[0][0].maplocation);
            $("#editEngineers input[name=phnumber]").val(data[0][0].phnumber);
            $("#editEngineers input[name=emailid]").val(data[0][0].emailid);
            $(".exist_img:first").attr("src","/images/"+data[0][0].photo);
            $(".exist_img:last").attr("src","/images/"+data[0][0].aadhardocument);
            $(".photo_img").val(data[0][0].photo);
            $(".aadhar_img").val(data[0][0].aadhardocument);

            let option = '';
            $("#editregion").empty();
            for (i = 0; i < data[1].length; i++) {
                if (data[1][i].district_code == data[0][0].dealershipregion) {
                    option = `<option value="${data[1][i].district_code}" selected>${data[1][i].district_name}</option>`;
                } else {
                    option = `<option value="${data[1][i].district_code}">${data[1][i].district_name}</option>`;
                }
                $("#editregion").append(option);
            }

            for (i = 0; i < data[2].length; i++) {
                if (data[2][i].taluk_code == data[0][0].dealershiparea) {
                    option = `<option value="${data[2][i].taluk_code}" selected>${data[2][i].taluk_name}</option>`;
                } else {
                    option = `<option value="${data[2][i].taluk_code}">${data[2][i].taluk_name}</option>`;
                }
                $("#editarea").append(option);
            }
        },
        complete: function(){
            $(".ajax-load").hide();
        }
    });
});

$(".ajax-load").hide();


// User Edit

$(document).on("click",".useredit",function(){
    let view_id = $(this).attr("data-id");

    $.ajax({
        url:"get_users",
        type:"POST",
        data:{view_id:view_id},
        dataType:"json",
        beforeSend: function(){
            $(".ajax-load").show();
        },
        success:function(data){

            $("#edit_user .edit_user_id").val(data[0][0].id);
            $("#edit_user input[name=name]").val(data[0][0].name);
            $("#edit_user input[name=mail]").val(data[0][0].email);
            $(".hide_password").val(data[0][0].password);
            $("#edit_user input[name=mobile]").val(data[0][0].mobilenumber);
            $(".old_user_img").val(data[0][0].user_img);

            let option = '';
            $(".role").empty();
            for (i = 0; i < data[1].length; i++) {
                if (data[1][i].id == data[0][0].role) {
                    option = `<option value="${data[1][i].id}" selected>${data[1][i].designation_name}</option>`;
                } else {
                    option = `<option value="${data[1][i].id}">${data[1][i].designation_name}</option>`;
                }
                $(".role").append(option);
            }

            if(data[0][0].project == 1){
                $(".projectmenu").prop("checked",true);
                $(".projectmenu").val("1");
            }else{
                $(".projectmenu").prop("checked",false);
                $(".projectmenu").val("0");
            }
            if(data[0][0].zones == 1){
                $(".zonemenu").prop("checked",true);
                $(".zonemenu").val("1");
            }else{
                $(".zonemenu").prop("checked",false);
                $(".zonemenu").val("0");
            }
            if(data[0][0].area == 1){
                $(".areamenu").prop("checked",true);
                $(".areamenu").val("1");
            }else{
                $(".areamenu").prop("checked",false);
                $(".areamenu").val("0");
            }
            if(data[0][0].drawings == 1){
                $(".drawingmenu").prop("checked",true);
                $(".drawingmenu").val("1");
            }else{
                $(".drawingmenu").prop("checked",false);
                $(".drawingmenu").val("0");
            }
            if(data[0][0].engineers == 1){
                $(".engineersmenu").prop("checked",true);
                $(".engineersmenu").val("1");
            }else{
                $(".engineersmenu").prop("checked",false);
                $(".engineersmenu").val("0");
            }
            if(data[0][0].users == 1){
                $(".usersmenu").prop("checked",true);
                $(".usersmenu").val("1");
            }else{
                $(".usersmenu").prop("checked",false);
                $(".usersmenu").val("0");
            }
            if(data[0][0].clients == 1){
                $(".clientsmenu").prop("checked",true);
                $(".clientsmenu").val("1");
            }else{
                $(".clientsmenu").prop("checked",false);
                $(".clientsmenu").val("0");
            }
            if(data[0][0].estimates == 1){
                $(".estimatemenu").prop("checked",true);
                $(".estimatemenu").val("1");
            }else{
                $(".estimatemenu").prop("checked",false);
                $(".estimatemenu").val("0");
            }
            if(data[0][0].leads == 1){
                $(".leadsmenu").prop("checked",true);
                $(".leadsmenu").val("1");
            }else{
                $(".leadsmenu").prop("checked",false);
                $(".leadsmenu").val("0");
            }
            if(data[0][0].designation == 1){
                $(".designationmenu").prop("checked",true);
                $(".designationmenu").val("1");
            }else{
                $(".designationmenu").prop("checked",false);
                $(".designationmenu").val("0");
            }

        },
        complete: function(){
            $(".ajax-load").hide();
        }
    });
});

$(".edit_pass").hide();

$("#changepass").click(function(){
   if($(this).is(":checked")){
       $(".edit_pass").show();
   }else{
       $(".edit_pass").hide();
   }
});

setTimeout(function(){
    $(".float-alert").fadeOut();
},5000);

$(document).on("click",".checkboxes input",function(){
    $(".checkboxes input").each(function(){
       if($(this).is(':checked')){
           $(this).val("1");
       }else{
           $(this).val("0");
       }
    });
});


$(".addcomments").click(function(){
    var descnum = $(this).data("descnum");
    var stageid = $(this).data("stageid");
    var estid = $(this).data("estid");
    var clientid = $(this).data("clientid");

    $("#clientcode").val(clientid);
    $("#estid").val(estid);
    $("#stageid").val(stageid);
    $("#descid").val(descnum);
});

$("#savecomments").submit(function(event){

        $.ajax({
            type:"POST",
            url: "/savecomments",
            data:new FormData(this),
            // async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".preloader").fadeIn();
            },
            success: function(data) {

                if($.isEmptyObject(data.error)){

                    $("#addComments").modal('hide');
                    $(".preloader").fadeOut();
                    Swal.fire(
                        'Success!',
                        'Comments Added Successfully..!',
                        'success'
                      )


                    // viewEngineers();
                }
                else
                {
                    printErrorMsg(data.error);
                }
            },



        });
});

$(".viewcomments").click(function(){
    var descnum = $(this).data("descnum");
    var stageid = $(this).data("stageid");
    var estid = $(this).data("estid");
    var clientid = $(this).data("clientid");

    $.ajax({
        type:'GET',
        url:'/viewcomments'+'/'+stageid+'/'+descnum+'/'+clientid+'/'+estid,
        dataType:'json',
        success: function(response){

            $("#viewcomments").modal('show');
            $('#commentsdata').html("");
            $.each(response,function(key, item){

                $('#commentsdata').append(
                    '<tr>\
                     <td>'+item.comments+'</td>\
                     </tr>'

                )

            });
        }
    })
});

$(".checkstatus").click(function(){

    var descnum = $(this).data("descnum");
    var stageid = $(this).data("stageid");
    var estid = $(this).data("estid");
    var clientid = $(this).data("clientid");
    var status = $(this).data("status");

    $(".clientcode").val(clientid);
    $(".estid").val(estid);
    $(".stageid").val(stageid);
    $(".descid").val(descnum);
    $(".status").val(status);

});


$("#updatestatus").submit(function(event){

    $.ajax({
        type:"POST",
        url: "/updatestatus",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){

                $("#addComments").modal('hide');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Success!',
                    'Status Updated..!',
                    'success'
                  )

                  location.reload();
                // viewEngineers();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },

    });
});

$(document).on("click",".editlead",function(){
    let view_id = $(this).attr("data-id");

    $.ajax({
        url:"get_leads",
        type:"POST",
        data:{view_id:view_id},
        dataType:"json",
        beforeSend: function(){
            $(".ajax-load").show();
        },
        success:function(data){

            $("#editLead .edit_lead_id").val(data[0].id);
            $("#editLead input[name=name]").val(data[0].name);
            $("#editLead input[name=emailid]").val(data[0].email);
            $("#editLead input[name=phnumber]").val(data[0].mobile_num);
            $("#editLead textarea[name=address]").val(data[0].address);
            $("#editLead input[name=maplocation]").val(data[0].google_map_link);
            $("#editLead input[name=plotarea]").val(data[0].plotarea);

            $("#editLead input[name=startdate]").val(data[0].startdate);
            $("#editLead input[name=enddate]").val(data[0].enddate);
            $("#editLead input[name=budgetvalue]").val(data[0].budgetvalue);;
            $("#editLead input[name=availability]").val(data[0].availabilityonsite);
            $("#editLead input[name=occupation]").val(data[0].occupasion);


            $("#editLead input[name=qntwo]").val(data[0].qntwo);
            $("#editLead input[name=qnthree]").val(data[0].qnthree);
            $("#editLead input[name=qnfour]").val(data[0].qnfour);
            $("#editLead input[name=qnfive]").val(data[0].qnfive);
            $("#editLead input[name=qnsix]").val(data[0].qnsix);

            let options = $("#editLead select[name=payment]").children("option");

            options.each(function(){
                if(data[0].payment == $(this).val()){
                    $(this).prop("selected",true);
                }else{
                    $(this).prop("selected",false);
                }
            });

            let optionss = $("#editLead select[name=qnone]").children("option");

            optionss.each(function(){
               if(data[0].qnone == $(this).text()){
                    $(this).prop("selected",true);
                }else{
                    $(this).prop("selected",false);
                }
            });

            $("#editaddreq").empty();
            $("#editfamilyadd").empty();

            let requireelement = '';

            $(".hidden_leadid").val(data[3]);

            for (i = 0; i < data[2].length; i++) {
                requireelement = `<tr> <td> <input type="text" value="${data[2][i].spec1}" class="form-control" name="requirenments[]" style="width: 100%" > </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>`;
                $("#editaddreq").append(requireelement);
            }

            let familyelement = '';

            for (i = 0; i < data[1].length; i++) {
                familyelement = `<tr> <td> <input type="text" value="${data[1][i].name}" placeholder="Name" class="form-control" name="member[]" style="width: 100%" id="enddate"> </td><td> <input placeholder="Age" value="${data[1][i].age}" type="text" class="form-control" name="age[]" style="width: 100%" id="enddate"> </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>`;
                $("#editfamilyadd").append(familyelement);
            }

        },
        complete: function(){
            $(".ajax-load").hide();
        }
    });
});


$(document).on('click', '.editaddreq', function() {

    var html =
     '<tr> <td> <input type="text" class="form-control" name="requirenments[]" style="width: 100%" > </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

      $('#editaddreq').append(html);
        //    alert($("#app1").val())
     });
     $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
    });

 $(document).on('click', '.editaddfamily', function() {

        var html =
         '<tr> <td> <input type="text" placeholder="Name" class="form-control" name="member[]" style="width: 100%" id="enddate"> </td><td> <input placeholder="Age" type="text" class="form-control" name="age[]" style="width: 100%" id="enddate"> </td><td> <button type="button" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button> </td></tr>';

          $('#editfamilyadd').append(html);
            //    alert($("#app1").val())
         });
         $(document).on('click', '.remove', function() {
            $(this).parents('tr').remove();
  });


$(".lead-delete").on("click", function () {

    const id = $(this).attr("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this record..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `lead_delete/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});

$(document).on("click",".client_edit",function(){
    let client_id = $(this).attr("data-id");
    $("#editCLients input[name=engineercode]").prop('readonly',false);
   if(client_id != ''){
        $.ajax({
           url:"/get_client/"+client_id,
           type:"GET",
           beforeSend: function(){
             $(".ajax-load").show();
           },
           success: function(data){
                 $("#editCLients .edit_client_id").val(data.id);
                 $("#editCLients input[name=name]").val(data.name);
                 $("#editCLients input[name=emailid]").val(data.emailid);
                 $("#editCLients input[name=phnumber]").val(data.mobilenumber);
                 $("#editCLients textarea[name=address]").val(data.address);
                 $("#editCLients input[name=maplocation]").val(data.googlemaplocation);
                 $("#editCLients input[name=plotarea]").val(data.plotarea);

                 $("#editCLients input[name=startdate]").val(data.projectstartdate);
                 $("#editCLients input[name=enddate]").val(data.expecteddate);

                 $("#editCLients input[name=constructionarea]").val(data.constructionarea);
                 $("#editCLients input[name=estimatedvalue]").val(data.totalestimatevalue);

                 if($("#editCLients input[name=engineercode]").val(data.engineercode)){
                     $("#editCLients input[name=engineercode]").prop('readonly',true);
                 }





                 let serviceoptions = $("#editCLients select[name=services]").children("option");

                 serviceoptions.each(function(){
                     if(data.typeofservices == $(this).val()){
                         $(this).prop("selected",true);
                     }else{
                         $(this).prop("selected",false);
                     }
                 });

                 let packageoptions = $("#editCLients select[name=package]").children("option");

                 packageoptions.each(function(){
                     if(data.planname == $(this).val()){
                         $(this).prop("selected",true);
                     }else{
                         $(this).prop("selected",false);
                     }
                 });

                 let regionoptions = $("#editCLients select[name=dealershipregion]").children("option");

                 regionoptions.each(function(){
                     if(data.zone == $(this).val()){
                         $(this).prop("selected",true);
                     }else{
                         $(this).prop("selected",false);
                     }
                 });

                 var region = data.zone;
                 // alert(region);

                     $.ajax({
                         type:'GET',
                         url:'/api/getArea/'+region,
                         dataType:'json',
                         success: function(response){

                             $('.shiparea').html("");
                             $.each(response,function(key, item){

                                 $('.shiparea').append(
                                     '<option value="'+item.taluk_code+'">'+item.taluk_name+'</option>'
                                 )

                             });
                         }
                     });

                 let areaoptions = $("#editCLients select[name=dealershiparea]").children("option");

                 areaoptions.each(function(){
                     if(data.area == $(this).val()){
                         $(this).prop("selected",true);
                     }else{
                         $(this).prop("selected",false);
                     }
                 });

           },
           complete: function(){
             $(".ajax-load").hide();
           }
        });
   }
 });

 $(".aeapprove").on("click", function () {

    const approveid = $(this).data("id");
    // const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approved This File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approved!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/aeapprove/${approveid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Your File Approved.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                },
            });
        }
    });
});

$(".aereject").on("click", function () {

    const approveid = $(this).data("id");
    // const drawid = $(this).data("drawid");
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject This File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/aereject/${approveid}`,
                success: function (data) {
                    Swal.fire(
                        "Reject!",
                        "Your File Rejected.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Kindly Check Error.",
                        "success"
                    );
                },
            });
        }
    });
});

$(".selectregion").hide();
$(document).on("change", ".designation", function() {
    var designation = $(this).val();

    // alert(designation);
    if(designation == 8)
    {
        $(".selectregion").show();
    }
    else
    {
        $(".selectregion").hide();
    }
});


// Additional Estimate

$(document).on('submit','#saveadditionalestimate',function(){

    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/saveadditionalestimate",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            Swal.fire(
                "Additional Estimate!",
                "Your File Saved.",
                "success"
            ).then((result) => {
                location.reload();
                // $("#example").DataTable().destroy();
                // dataTableReRender();
            });


        },
        error: function (data) {
            Swal.fire(
                "Error!",
                "Error.",
                "success"
            );
        },


    });

});

$(document).on('submit','#saveadditionalest',function(){

    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/saveadditionalest",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            Swal.fire(
                "Estimate",
                "Additional Estimate Created Successfully.",
                "success"
            ).then((result) => {
                location.url('/estimatereq');
                // $("#example").DataTable().destroy();
                // dataTableReRender();
            });
        },


    });

});

$(".clientapproveimg").on("click", function () {

    const id = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "Approved This Image",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approved!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientapproveimg/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Image!",
                        "Image Approved Successfully..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".clientrejectimg").on("click", function () {

    const id = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "Reject This Image",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientrejectimg/${id}`,
                success: function (data) {
                    Swal.fire(
                        "Image!",
                        "Image Rejected Successfully..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".assignedto").click(function(){
    var assignedto = $(this).data("leadid");
    var telecaller_assign_id = $(this).data("telecaller_assign_id");
    if(telecaller_assign_id == 0)
    {
        $('#telecallerassign :selected').text("-- Select Telecaller --");
    }
    else
    {
        $('#telecallerassign :selected').text(telecaller_assign_id);
    }
    $("#leadassign").val(assignedto)
    $("#assignedto").modal('show');
});

$(".assignedtoeng").click(function(){
    var assignedto = $(this).data("leadid");
    var engid = $(this).data("engid");
    $("#leadassign1").val(assignedto);
    if(engid == 0)
    {
        $('#assignaeid :selected').text("-- Select AE --");
    }
    else
    {
        $('#assignaeid :selected').text(engid);
    }
    // alert(assignedto);
    // $("#assignaeid").val(assignedto);


    $("#assignedtoe").modal('show');
});

$(document).on('submit','#assigntelecaller',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/assigntelecaller",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignedto").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Telecaller Assigned Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(document).on('submit','#assignae',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/assignae",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignedto").modal('hide');

                Swal.fire(
                    'Good job!',
                    'AE Assigned Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});


$(".addrequirement").click(function(){
    var leadid = $(this).data("leadid");
    // alert(leadid);
    var name = $(this).data("name");
    var email = $(this).data("email");
    var location = $(this).data("location");
    var mblnum = $(this).data("mblnum");


    // $("#addLeadsdata input[type='text']:first").val(name);
    $("#name2").val(name);
    $("#addLeadsdata input[type='tel']").val(mblnum);
    $("#addLeadsdata input[type='email']").val(email);
    $("#addLeadsdata textarea").val(location);
    $("#leadid5").val(leadid);
});

$(".drawrequest").click(function(){
    var leadid = $(this).data("leadid");
    $("#leadid2").val(leadid);
});

$(".leadstatuschange").click(function(){
    var leadid = $(this).data("leadid");
    $("#leadid3").val(leadid);
});


$(document).on('submit','#Leadstatuschange',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/changeleadstatus",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignedto").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Lead Converted Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});


$(".assignedtoarchitect").click(function(){

    var drawid = $(this).data("drawid");
    $("#drawid1").val(drawid);
    $("#assigndraw").modal('show');
})

$(".assignedtostructuraleng").click(function(){

    var drawid = $(this).data("drawid");
    $("#drawid2").val(drawid);
    $("#assigndraw2").modal('show');
})


$(document).on('submit','#assigndrawing',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/assigndrawing",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignedto").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Project Assign Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(document).on('submit','#assignstructuraleng',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/assignstructuraleng",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignedto").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Project Assign Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(".quantityallocation").click(function(){

    var estid = $(this).data("estid");
     $("#surveyorid").val(estid);
    $("#assignquantitysurveyor").modal('show');
})

$(document).on('submit','#assignquantity',function(){
    var d = new FormData(this);
    // alert(d);
    $.ajax({
        type:"POST",
        url: "/assignquantity",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);

                $(".error-text").text('');

                $("#assignquantitysurveyor").modal('hide');

                Swal.fire(
                    'Good job!',
                    'Project Assign Successfully..',
                    'success'
                  )
                    location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },


    });

});

$(document).on('submit','#processimageupload',function(){

    $.ajax({
        type:"POST",
        url: "/processimageupload",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Complete Of Works',
                    'Images Uploaded Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },



    });
});


$(".assignedtorm").click(function(){
    var assignedto = $(this).data("engid");
    $("#engid1").val(assignedto)
    $("#assignedto").modal('show');
});

$(document).on('submit','#assignengineer',function(){

    $.ajax({
        type:"POST",
        url: "/assignengineer",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Engineer Assigned',
                    'Engineer Assigned Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },

    });
});

$(".forwardtoqtysurveyor").on("click", function () {

    const estid = $(this).data("estimateid");
    const stageid = $(this).data("stageid");
    const esttype = $(this).data("esttype");
    const id = $(this).data("id");


    Swal.fire({
        title: "Are you sure?",
        text: "Forwarded to QS Head",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Forward!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/forwardqs/${estid}/${stageid}/${id}/${esttype}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Forwarded Quantity Surveyor Head..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});

$(".approveforclient").on("click", function () {

    const estid = $(this).data("estimateid");
    const stageid = $(this).data("stageid");
    const esttype = $(this).data("esttype");
    const id = $(this).data("id");


    Swal.fire({
        title: "Are you sure?",
        text: "Approve for Client",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approveforclient/${estid}/${stageid}/${id}/${esttype}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Quantity Surveyor Head Approved for Client payment..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});

$(".forwardtogm").on("click", function () {

    const estid = $(this).data("estid");
    const stageid = $(this).data("stageid");
    const amount = $(this).data("amount");



    Swal.fire({
        title: "Are you sure?",
        text: "Forwarded to GM",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Forward!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/forwardtogm/${estid}/${stageid}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Forwarded to General Manager..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".approvegm").on("click", function () {

    const estid = $(this).data("estid");
    const stageid = $(this).data("stageid");
    const amount = $(this).data("amount");



    Swal.fire({
        title: "Are you sure?",
        text: "Approve",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Forward!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approvegm/${estid}/${stageid}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Approved General Manager & Move to RM..",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});


$(".approvepaybtn").on("click", function () {

    const estid = $(this).data("estimateid");
    const stageid = $(this).data("stageid");
    const esttype = $(this).data("esttype");
    const id = $(this).data("id");


    Swal.fire({
        title: "Are you sure?",
        text: "Approve the Payment",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approvepaybtn/${estid}/${stageid}/${id}/${esttype}`,
                success: function (data) {
                    Swal.fire(
                        "Payment!",
                        "Approve the Payment",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});

// GN

$(document).on("click",".clientdetailsbox.completed",function(){
    var work_id = $(this).data("id");
    console.log(work_id);
    $.ajax({
        method: "POST",
        url: "/complete_work",
        data:{work_id:work_id},
        success: function(data){
            $(".completed_body").html(data);
        }
    });
});

$(document).on("change","#editregion",function(){
    var region = $(this).val();

    $.ajax({
        type: 'POST',
        url: "area_view",
        dataType: "json",
        data:{region:region},
        success:function(data){

            let option = '';
            $("#editarea").empty();

            for (i = 0; i < data.length; i++) {
                option = `<option value="${data[i].taluk_code}">${data[i].taluk_name}</option>`;
                $("#editarea").append(option);
            }
        }
    });
});

$(document).on('submit','#addLead',function(){

    $.ajax({
        type:"POST",
        url: "/addLead",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Leads',
                    'Lead Added Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },

    });
});


// Image Lightbox Effect

$(document).on("click",".drawingdetails.process_imgs img",function(){
    var src = $(this).attr("src");

    $(".lightbox_img").addClass("zoom_img");
    $(".lightbox_img .lightbox_inner img").attr("src",src);
});

$(".close_img").click(function(){
    $(".lightbox_img").removeClass("zoom_img");
    $(".lightbox_img .lightbox_inner").css("max-width","700px");
});

$(document).on("dblclick",".lightbox_img.zoom_img .lightbox_inner img",function(){
    if($(this).parent().css('max-width') == '1000px'){
        $(this).parent().css("max-width","700px");
    }else{
        $(this).parent().css("max-width","1000px");
    }
});


$(".clientstatuschange").click(function(){
        var clientid = $(this).data("clientid");

        $("#clientapprovalid").val(clientid);
        $("#clientstatus").modal('show');
});



$(document).on('submit','#clientapproval',function(){

    $.ajax({
        type:"POST",
        url: "/clientapproval",
        data:new FormData(this),
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preloader").fadeIn();
        },
        success: function(data) {

            if($.isEmptyObject(data.error)){
                // alert(data.success);


                // $("#importstages").modal('show');
                $(".preloader").fadeOut();
                Swal.fire(
                    'Client',
                    'Client Approved Successfully..!',
                    'success'
                  )

                // viewEngineers();
                location.reload();
            }
            else
            {
                printErrorMsg(data.error);
            }
        },

    });
});

$(".leaddelete").on("click", function () {

    const leadid = $(this).data("leadid");

    Swal.fire({
        title: "Are you sure?",
        text: "Delete Lead",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/leaddelete/${leadid}`,
                success: function (data) {
                    Swal.fire(
                        "Leads!",
                        "Lead Delete Successfully",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Error.",
                        "success"
                    );
                },
            });
        }
    });
});

$("#constructionarea").keyup(function(){
    var plotarea = $("#plotareatext").val();
    var constructionarea = $(this).val();

    if(constructionarea>plotarea)
    {
        $(".constructionareaerror").text("Check your plot area");
        $(".constructionareaerror").css("color", "red")
    }
    else
    {
        $(".constructionareaerror").text("");
        $(".constructionareaerror").css("color", "green")
    }
});

// $(".notifyicon").mouseenter(function(){
    $(document).on("mouseenter",".notifyicon",function(){


    $.ajax({
        type:"POST",
        url: "/updatenotificationstatus",
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // alert("text");
        }

    });

})


$(".clientapproveestimate").on("click", function () {

    const userid = $(this).data("userid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve the estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientapproveestimate/${userid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Your Estimate Approved.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });
});



$(".clientrejectestimate").on("click", function () {

    const userid = $(this).data("userid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject the estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/clientrejectestimate/${userid}`,
                success: function (data) {
                    Swal.fire(
                        "Reject!",
                        "Your Estimate Rejected.",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });
});

$(".allimagesupload").on("click",function(){

    const stageid = $(this).data("stageid");
    const estid = $(this).data("estid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve All Images",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/allimagesupload/${stageid}/${estid}`,
                success: function (data) {
                    if(data != 0)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please Approve all images',
                          }).then((result) => {
                            // location.reload();
                            // $("#example").DataTable().destroy();
                            // dataTableReRender();
                        });
                    }
                    else
                    {
                        Swal.fire(
                            "Approved!",
                            "Your Completed images approved please pay amount next stage.",
                            "success"
                        ).then((result) => {
                            location.reload();
                            // $("#example").DataTable().destroy();
                            // dataTableReRender();
                        });
                    }

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});



$(".approveaddnest").on("click",function(){

    const addiestid = $(this).data("addiestid");
    const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve The Additional Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approveaddnest/${addiestid}/${clientid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Additional Estimate Approved",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});

$(".approveest").on("click",function(){

    const addiestid = $(this).data("addnestid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve The Additional Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approveaddnestae/${addiestid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Additional Estimate Approved",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});



$(".clientapproveest").on("click",function(){

    const addiestid = $(this).data("addnestid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve The Additional Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/approveaddnestclient/${addiestid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Additional Estimate Approved",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});



$(".qsheadapproveestimate").on("click",function(){

    const estid = $(this).data("estid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/qsheadapproveestimate/${estid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Estimate Approved",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});


$(".aeapproveestimate").on("click",function(){

    const estid = $(this).data("estid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Approve Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/aeapproveestimate/${estid}`,
                success: function (data) {
                    Swal.fire(
                        "Approved!",
                        "Estimate Approved",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});



$(".aerejectest").on("click",function(){

    const addnestid = $(this).data("addnestid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/aerejectestimate/${addnestid}`,
                success: function (data) {
                    Swal.fire(
                        "Reject!",
                        "Estimate Rejected",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});




$(".aerejectmainestimate").on("click",function(){

    const estid = $(this).data("estid");
    // alert(addiestid);
    // const clientid = $(this).data("clientid");
    // alert(userid)
    // const id = $("#payid").val();

    Swal.fire({
        title: "Are you sure?",
        text: "Reject Estimate",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reject!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: `/aerejectmainestimate/${estid}`,
                success: function (data) {
                    Swal.fire(
                        "Reject!",
                        "Estimate Rejected",
                        "success"
                    ).then((result) => {
                        location.reload();
                        // $("#example").DataTable().destroy();
                        // dataTableReRender();
                    });

                },
                error: function (data) {
                    Swal.fire(
                        "Error!",
                        "Please check",
                        "success"
                    );
                },
            });
        }
    });

});

$(document).on("change","#role",function(){
    var role = $(this).val();
    // alert(role);
    if(role == '1' || role == '10' || role == '11')
    {

        $("#stagemaster").prop('checked', true);
        $("#stagemaster").val("1");
        $("#zonemenu").prop('checked', true);
        $("#zonemenu").val("1");
        $("#areamenu").prop('checked', true);
        $("#areamenu").val("1");
        $("#drawingmenu").prop('checked', true);
        $("#drawingmenu").val("1");
        $("#engineersmenu").prop('checked', true);
        $("#engineersmenu").val("1");
        $("#usersmenu").prop('checked', true);
        $("#usersmenu").val("1");
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");
        $("#estimatemenu").prop('checked', true);
        $("#estimatemenu").val("1");
        $("#leadsmenu").prop('checked', true);
        $("#leadsmenu").val("1");
        $("#designationmenu").prop('checked', true);
        $("#designationmenu").val("1");
    }

    if(role == "2" || role == '12')
    {
        $("#leadsmenu").prop('checked', true);
        $("#leadsmenu").val("1");
        $("#engineersmenu").prop('checked', true);
        $("#engineersmenu").val("1");

        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#drawingmenu").prop('checked', false);

        $("#usersmenu").prop('checked', false);
        $("#clientsmenu").prop('checked', false);
        $("#estimatemenu").prop('checked', false);

        $("#designationmenu").prop('checked', false);
    }


    if(role == "3")
    {
        $("#leadsmenu").prop('checked', true);
        $("#leadsmenu").val("1");
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");

        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#drawingmenu").prop('checked', false);
        $("#engineersmenu").prop('checked', false);
        $("#usersmenu").prop('checked', false);

        $("#estimatemenu").prop('checked', false);

        $("#designationmenu").prop('checked', false);

    }

    if(role == "5" || role == "14" || role == "18" || role == "20")
    {
        $("#drawingmenu").prop('checked', true);
        $("#drawingmenu").val("1");
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");
        $("#engineersmenu").prop('checked', false);
        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#usersmenu").prop('checked', false);
        $("#estimatemenu").prop('checked', false);
        $("#leadsmenu").prop('checked', false);
        $("#designationmenu").prop('checked', false);
    }

    if(role == "7" || role == "13")
    {
        $("#estimatemenu").prop('checked', true);
        $("#estimatemenu").val("1");
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");
        $("#engineersmenu").prop('checked', false);

        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#drawingmenu").prop('checked', false);
        $("#usersmenu").prop('checked', false);

        $("#leadsmenu").prop('checked', false);
        $("#designationmenu").prop('checked', false);
    }

    if(role == "8" || role == '15')
    {
        $("#estimatemenu").prop('checked', false);
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");
        $("#engineersmenu").prop('checked', true);
        $("#engineersmenu").val("1");

        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#drawingmenu").prop('checked', false);
        $("#usersmenu").prop('checked', false);

        $("#leadsmenu").prop('checked', false);
        $("#designationmenu").prop('checked', false);
    }

    if(role == "9")
    {
        $("#estimatemenu").prop('checked', false);
        $("#clientsmenu").prop('checked', true);
        $("#clientsmenu").val("1");
        $("#engineersmenu").prop('checked', true);
        $("#engineersmenu").val("1");

        $("#stagemaster").prop('checked', false);
        $("#zonemenu").prop('checked', false);
        $("#areamenu").prop('checked', false);
        $("#drawingmenu").prop('checked', false);
        $("#usersmenu").prop('checked', false);

        $("#leadsmenu").prop('checked', false);
        $("#designationmenu").prop('checked', false);
    }

});

$(".deletedrawing").click(function(){


    const drawingid = $(this).data("draid");

Swal.fire({
    title: "Are you sure?",
    text: "Delete the Drawing",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Delete!",
}).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            method: "GET",
            url:'/deletedrawing/'+drawingid,
            success: function (data) {
                Swal.fire(
                    "Deleted!",
                    "Your File Deleted.",
                    "success"
                ).then((result) => {
                    location.reload();
                    // $("#example").DataTable().destroy();
                    // dataTableReRender();
                });
            },
            error: function (data) {
                Swal.fire(
                    "Deleted!",
                    "Your file has been deleted.",
                    "success"
                );
            },
        });
    }
});
});
