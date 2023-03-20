function load_students_data() {
    document.getElementById("search_submit_btn").innerHTML='<i class="bi bi-arrow-repeat"></i>';
    var st_name = $("#student_name").val();
    var branch = $("#branch").val();
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data:{
            type:101,
            st_name:st_name,
            branch:branch,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#fee_table_div").html(data);
          document.getElementById("search_submit_btn").innerHTML='Submit';
        }
    });
}

function see_details(student_id) {
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data:{
            type:102,
            student_id:student_id,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#student_row"+student_id).html(data);
        }
    });
}


