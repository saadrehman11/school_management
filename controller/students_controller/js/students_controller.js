function add_student_db() {
    console.log("add_student_db()");
    // var formData = new FormData(document.getElementById("new_student_form"));
    // formData.append('product_type_title', product_type_title);
    $.ajax({
        url: "../php/students_controller.php?type=101",
        type: "POST",
        data:  new FormData(document.getElementById("new_student_form")),
        contentType: false,
        processData:false,
        cache: false,
        success: function(dataResult){
            console.log(dataResult);
            document.getElementById("new_productType_form").reset();
        }
    });
}