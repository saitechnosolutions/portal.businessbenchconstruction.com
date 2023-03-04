$("#name").blur(function(){

    var name = $(this).val();

     if (!/^[a-zA-Z]+$/.test(name))
     {
        $(".name_error").text("Name only contain letters only");
        // $("#name").focus();
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
        // $("#phnumber").focus();
    }
    else
    {
        $(".phnum_error").text("");
    }
});

$("#email").blur(function(){
        
            var email = $(this).val();
            
            if(!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email))
            {
                $(".email_error").text("Enter Valid email address");        
            }
            else
            {
                $(".email_error").text("");
            }
             
});

$("#password").blur(function(){
   
    var password = $(this).val();
    
    var strength = checkPasswordStrength(password);
    if(strength == "Good" || strength == "Strong")
    {
        $(".password_good").html(strength);    
        $(".password_error").html("");
    }
    else if(strength == "Weak" || strength == "Too short")
    {
        $(".password_error").html(strength);
        $(".password_good").html("");    
    }
    else
    {
        $(".password_error").html("");
    }
    
    
    
    // $(".password_error").html(strength);
});


function checkPasswordStrength(password) {
  var strength = 0;
  if (password.length < 6) {
    return "Too short";
  }
  if (password.length >= 6) strength += 1;
  if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
  if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1;
  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
  if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
  if (strength < 2) {
    return "Weak";
  } else if (strength == 2) {
    return "Good";
  } else {
    return "Strong";
  }
}


$("#enddate").blur(function(){
   var startdate = $("#startdate").val();
   var lastdate = $(this).val();
    
    // alert(startdate);
    // alert(lastdate);
  if(startdate > lastdate)
  {
      $(".date_error").html("End date should be greater than start date");
    // alert("date error");
  }
  else
  {
      $(".date_error").html("");
  }
});
