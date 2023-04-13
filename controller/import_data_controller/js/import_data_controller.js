function import_data(){
    document.querySelector('#import_btn').innerHTML = 'Uploading';
    $.ajax({
        url: "../../controller/import_data_controller/php/import_data_controller.php?type=101",
        type: "POST",
        data: new FormData(document.getElementById("import_file_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            document.querySelector('#import_btn').innerHTML = 'Import';
        }
    });
}