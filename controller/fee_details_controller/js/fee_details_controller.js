function load_students_data() {
    document.getElementById("search_submit_btn").innerHTML='<i class="bi bi-arrow-repeat"></i>';
    var st_name = $("#student_name").val();
    var branch = $("#branch").val();
    var batch = $("#batch").val();
    var semester = $("#semester").val();
    var discipline = $("#discipline").val();
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data:{
            type:101,
            st_name:st_name,
            branch:branch,
            batch:batch,
            semester:semester,
            discipline:discipline,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#fee_table_div").html(data);
          document.getElementById("search_submit_btn").innerHTML='Search';
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


function see_remaining_fee_details(student_id) {
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data:{
            type:103,
            student_id:student_id,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#fee_submit_modal_body").html(data);
        }
    });
}



function submit_paying_amount(fee_record_id) {
    var paying_amount_input = $("#paying_amount_input"+fee_record_id).val();
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data: {
            fee_record_id:fee_record_id,
            paying_amount_input:paying_amount_input,
            type:104,
        },             
        success: function(data){ 
            var res = JSON.parse(data)
            alert(res.msg);
            if(res.status_Code == 100){
                see_remaining_fee_details(res.student_id)
            }
        }
    });
}

function load_outstanding_fee() {
    console.log("load_outstanding_fee")
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data: {
            type:105,
        },             
        success: function(data){ 

            // var res = JSON.parse(data)
            // alert(res.msg);
            // if(res.status_Code == 100){
            //     see_remaining_fee_details(res.student_id)
            // }
        }
    });
}
function load_paid_fee() {
    console.log("load_paid_fee")
    $.ajax({    
        type: "POST",
        url: "../../controller/fee_details_controller/php/fee_details_controller.php",   
        data: {
            type:106,
        },             
        success: function(data){ 
            
            // var res = JSON.parse(data)
            // alert(res.msg);
            // if(res.status_Code == 100){
            //     see_remaining_fee_details(res.student_id)
            // }
        }
    });
}
