
function load_students_data() {
    document.getElementById("search_submit_btn").innerHTML='<i class="bi bi-arrow-repeat"></i>';
    var st_name = $("#student_name").val();
    var branch = $("#branch").val();
    var batch = $("#batch").val();
    var semester = $("#semester").val();
    var discipline = $("#discipline").val();
    $.ajax({    
        type: "POST",
        url: "../../controller/students_controller/php/students_controller.php",   
        data:{
            type:102,
            st_name:st_name,
            branch:branch,
            batch:batch,
            semester:semester,
            discipline:discipline,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#students_table_div").html(data);
          document.getElementById("search_submit_btn").innerHTML='Search';
        }
    });
}

function add_student_db() {
    console.log("add_student_db");
    var formData = new FormData(document.getElementById("new_student_form"));
    $.ajax({
        url: "../../controller/students_controller/php/students_controller.php?type=101",
        type: "POST",
        data: formData,
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var resp = JSON.parse(dataResult);
            if(resp.status_Code == 100){
                alert("Student Added Successfully")
                document.getElementById("new_student_form").reset();
            }
            else if(resp.status_Code == 200){
                alert(resp.msg);
            }
        }
    });
}

function add_head_of_account(){
    var hoa_id = $('#hoa_id').val();
    var studentIds = $('input[name="student_ids[]"]:checked').map(function() {
        return $(this).val();
      }).get();
    if(studentIds == '' || hoa_id == ''){
        alert("Students And Head Of Account cannot be empty") 
    } 
    else{
        let text = "Are you sure you want to add the selected Head of account to all the selected Students?";
        if (confirm(text) == true) {
            $.ajax({    
                type: "POST",
                url: "../../controller/students_controller/php/students_controller.php",   
                data:{ 
                    student_ids:studentIds,
                    hoa_id:hoa_id,
                    type:103,
                },               
                success: function(data){ 
                    console.log(data)
                    var resp = JSON.parse(data);
                    alert(resp.msg) 
                    location.reload();
                }
            });
        } else {
          text = "You canceled!";
        }
    }
    

}


function promote_students(){
    var hoa_id = $('#hoaId').val();
    var studentIds = $('input[name="student_ids[]"]:checked').map(function() {
        return $(this).val();
      }).get();
    if(studentIds == '' || hoa_id == ''){
        alert("Students And Head Of Account cannot be empty") 
    } 
    else{
        let text = "Are you sure you want to Promote & add the selected Head of account to the selected Students?";
        if (confirm(text) == true) {
            
            
            $.ajax({    
                type: "POST",
                url: "../../controller/students_controller/php/students_controller.php",   
                data:{ 
                    student_ids:studentIds,
                    hoa_id:hoa_id,
                    type:104,
                },               
                success: function(data){ 
                    console.log(data)
                    var resp = JSON.parse(data);
                    alert(resp.msg) 
                    location.reload();
                }
            });
        } else {
          text = "You canceled!";
        }
    }
    

}

function load_student_detail(student_id){
    $.ajax({    
        type: "POST",
        url: "../../controller/students_controller/php/students_controller.php",   
        data:{ 
            student_id:student_id,
            type:105,
        },               
        success: function(data){ 
            // console.log(data)
            $("#edit_student_div").html(data);

        }
    });
}

function edit_student_detail(){
    var formData2 = new FormData(document.getElementById("edit_student_form"));
    $.ajax({
        url: "../../controller/students_controller/php/students_controller.php?type=106",
        type: "POST",
        data: formData2,
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var resp = JSON.parse(dataResult);
            if(resp.Status_Code == 100){
                alert("Record Updated Successfully")
                location.reload();
            }
            else if(resp.Status_Code == 200){
                alert("Error Updating Record")
            }
        }
    });
    
}


function change_student_status(student_id,status) {
    $.ajax({    
        type: "POST",
        url: "../../controller/students_controller/php/students_controller.php",   
        data:{ 
            student_id:student_id,
            status:status,
            type:107,
        },               
        success: function(data){ 
            console.log(data)
            var resp = JSON.parse(data);
            if(resp.status_Code == 100){
                alert("Status changed Successfully");
                location.reload();
            }
            else if(resp.status_Code == 200){
                alert("Error changing status");
            }
            
            

        }
    });
}

function populate_hoa_div(discipline_id){
    console.log("discipline_id ",discipline_id)
    $.ajax({    
        type: "POST",
        url: "../../controller/students_controller/php/students_controller.php",   
        data:{ 
            discipline_id:discipline_id,
            type:108,
        },               
        success: function(data){ 
            // console.log(data)
            $("#hoa_div").html(data);
        }
    });
}

function change_status_hoa(hoa_id) {
    // console.log("hoa_id ",hoa_id)
    var hoa_checkbox = document.getElementById('hoa_checkbox'+hoa_id);  
    // console.log(hoa_checkbox)
    if (hoa_checkbox.checked == true){  
        document.getElementById("hoa_input"+hoa_id).disabled = false;
    }
    else if(hoa_checkbox.checked == false){
        document.getElementById("hoa_input"+hoa_id).disabled = true;
    }
}