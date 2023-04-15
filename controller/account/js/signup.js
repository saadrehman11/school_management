function signup(){
    $.ajax({
        url: "../../controller/account/php/signup.php?type=100",
        type: "POST",
        data:  new FormData(document.getElementById("signup_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var res  = JSON.parse(dataResult)
            if(res.status_Code == 100){
                window.location = (window.location.origin)+"/projects/admin_panels/school_management/school_management/views/"+"account/login.php";
            }else if(res.status_Code == 400){
                $('#msg').html('<p class="bg-danger text-white">Email is already registered.</p>');
            }
            
        }
    });


}