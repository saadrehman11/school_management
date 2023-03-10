function load_students_data(st_name,branch) {
    var st_name;
    var branch;
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data:{
            type:101,
        },               
        success: function(data){ 
          console.log(data)
        }
    });
}