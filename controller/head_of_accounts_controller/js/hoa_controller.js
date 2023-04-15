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
                document.getElementById("new_hoa_form").reset();
            }
        }
    });
}

function load_hoa_detail(hoa_id){
    $.ajax({
        url: "../../controller/head_of_accounts_controller/php/hoa_controller.php",
        type: "POST",
        data:{
            hoa_id:hoa_id,
            type:102,
        },
        success: function(dataResult){
            // console.log(dataResult);
            $('#hoa_edit').html(dataResult)
        }
    });
}

function edit_hoa_form() {
    $.ajax({
        url: "../../controller/head_of_accounts_controller/php/hoa_controller.php?type=103",
        type: "POST",
        data: new FormData(document.getElementById("edit_hoa_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            var resp = JSON.parse(dataResult);
            if(resp.status_Code == 100){
                alert("Head Of Account Updated Successfully")
                location.reload();
            }
            else{
                alert("Error updating record")
            }
        }
    });
}

function change_status_hoa(hoa_id,status) {
    $.ajax({
        url: "../../controller/head_of_accounts_controller/php/hoa_controller.php",
        type: "POST",
        data: {
            hoa_id:hoa_id,
            status:status,
            type:104,
        },
        success: function(dataResult){
            console.log(dataResult);
            var resp = JSON.parse(dataResult);
            if(resp.status_Code == 100){
                alert("Status Changed Successfully")
                location.reload();
            }
            else{
                alert("Error updating status")
            }
        }
    });
}