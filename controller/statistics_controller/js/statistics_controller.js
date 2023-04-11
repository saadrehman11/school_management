function load_statistics(){
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
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
          $("#students_table_div").html(data);
          document.getElementById("search_submit_btn").innerHTML='Search';
        }
    });
}