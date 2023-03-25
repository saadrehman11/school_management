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
            // console.log(dataResult);
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
                }
            });
        } else {
          text = "You canceled!";
        }
    }
    

}


function edit_student_detail(student_id){

    
}