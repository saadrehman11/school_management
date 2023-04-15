function login(){
    $.ajax({
        url: "../../controller/account/php/login.php?type=100",
        type: "POST",
        data:  new FormData(document.getElementById("login_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var res= JSON.parse(dataResult)
           
            if(res.status_Code == 100){
                // console.log((window.location.origin)+"/projects/admin_panels/inventory_management/views/"+"dashboard/dashboard.php")
                window.location = (window.location.origin)+"/projects/admin_panels/school_management/school_management/views/"+"students/students.php";
            }else{
                $('#msg').html('<p class="bg-danger text-white text-center">Invalid Email or Password</p>');
            }
            
        }
    });




}