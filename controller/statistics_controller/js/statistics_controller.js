function load_statistics(){
    var dateValue = document.getElementById("myDateInput").value;
    console.log("The selected date is: " + dateValue);
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
        data:{
            type:101,
            dateValue:dateValue,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#main_stats_table").html(data);
          $('#hoa_stats_table').dataTable( { } );
        }
    });
}


function batch_wise_stats() {
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
        data:{
            type:104,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#batch_wise_stats_div").html(data);
        //   $('#discipline_stats_table').dataTable( { } );
        }
    });
}

function show_semester_wise_detail(batch) {
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
        data:{
            type:105,
            batch:batch,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#semester_wise_row"+batch).html(data);
        //   $('#discipline_stats_table').dataTable( { } );
        }
    });
}

function discipline_wise_stats() {
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
        data:{
            type:102,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#discipline_wise_stats_div").html(data);
        //   $('#discipline_stats_table').dataTable( { } );
        }
    });
}

function show_semester_detail(discipline_id,batch){
    $.ajax({    
        type: "POST",
        url: "../../controller/statistics_controller/php/statistics_controller.php",   
        data:{
            type:103,
            discipline_id:discipline_id,
            batch:batch,
        },               
        success: function(data){ 
        //   console.log(data)
          $("#semester_row"+discipline_id+''+batch).html(data);
        }
    });
}