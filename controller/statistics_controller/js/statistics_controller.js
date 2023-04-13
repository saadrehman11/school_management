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
          console.log(data)
          $("#main_stats_table").html(data);
          $('#hoa_stats_table').dataTable( { } );
        }
    });
}