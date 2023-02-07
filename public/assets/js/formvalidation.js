$("#name").blur(function(){

    var name = $(this).val();

     if (!/^[a-zA-Z]+$/.test(name))
     {
        $(".name_error").text("Name only contain letters only");
        $("#name").focus();
      }
      else
      {
        $(".name_error").text("");
      }
});

$("#phnumber").blur(function(){

    var phnumber = $(this).val();

    if(!/^\d{10}$/.test(phnumber))
    {
        $(".phnum_error").text("Please enter 10 digit");
        $("#phnumber").focus();
    }
    else
    {
        $(".phnum_error").text("");
    }
});


