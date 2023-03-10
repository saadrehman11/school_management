function new_hoa_form() {
    $.ajax({
        url: "../../controller/head_of_accounts_controller/php/hoa_controller.php?type=101",
        type: "POST",
        data: new FormData(document.getElementById("new_hoa_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var resp = JSON.parse(dataResult);
            if(resp.status_Code == 100){
                alert("Head Of Account Added Successfully")
            }
        }
    });
}