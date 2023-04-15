<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

if($type=="101"){    
    // print_r($_POST);
    date_default_timezone_set('Asia/Karachi');
    $date_and_time = date("Y-m-d H:i:s");
    $stmt = $pconn->prepare("INSERT `head_of_accounts`(`account_name`, `category`, `amount`,`created_on`) VALUES  (:account_name, :category, :amount, :created_on)");
    $stmt->bindParam(':account_name', $account_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':created_on', $date_and_time);

    // insert a row
    $account_name = $_POST['account_name'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    if($stmt->execute()){
        echo json_encode(['status_Code'=>100]);
    }

}

// load hoa edit modal
if($type=="102"){

    $hoa_id = $_POST['hoa_id'];
    $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` = '$hoa_id'"));
    ?>
<form id="edit_hoa_form"  method="post" action="#" onsubmit="edit_hoa_form();return false">
        <div class="d-flex justify-content-center mt-3">
          <div class="col-md-6">
            <div class="card card-primary py-4">
              <div class="card-body">
                <div class="form-group py-2">
                  <label for="account_name">Account Name</label>
                  <input type="text" id="account_name"  name="account_name" class="form-control" value="<?=$check_hoa['account_name']?>" required>
                  <input type="hidden" name ="hoa_id" id ="hoa_id" value="<?=$hoa_id?>">
                </div>
                <div class="form-group py-2">
                  <label for="category">Category</label>
                  <select id="category" name="category" class="form-control custom-select" >
                    <option selected disabled>Select Category</option>
                    <option value="General" <?php if($check_hoa['category'] == "General"){echo "selected";}?>>General</option>
                    <option value="BS Degree" <?php if($check_hoa['category'] == "BS Degree"){echo "selected";}?>>BS Degree</option>
                    <option value="Diploma" <?php if($check_hoa['category'] == "Diploma"){echo "selected";}?>>Diploma</option>
                    <option value="CAT-B" <?php if($check_hoa['category'] == "CAT-B"){echo "selected";}?>>CAT-B</option>
                    <option value="Nursing" <?php if($check_hoa['category'] == "Nursing"){echo "selected";}?>>Nursing</option>
                    
                    </select>
                </div>
                <div class="form-group py-2">
                  <label for="amount">Amount</label>
                  <input type="number" id="amount" name="amount" class="form-control" value="<?=$check_hoa['amount']?>" required>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>
        <div>
          <div class="d-flex justify-content-evenly">
            <input type="submit" class="btn btn-success float-right">
          </div>
        </div>
      </form>
    <?php


}

// edit hoa
if($type=="103"){

    // print_r($_POST);
    $hoa_id = $_POST['hoa_id'];
    $account_name = $_POST['account_name'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $updatequery=mysqli_query($con, "UPDATE `head_of_accounts` SET `account_name`='$account_name',`category`='$category',`amount`='$amount' WHERE `id` = '$hoa_id'");

    if($updatequery){
        echo json_encode(['status_Code'=>100]);
    }
    else{
        echo json_encode(['status_Code'=>200]);
    }


}

// deleting hoa
if($type=="104"){
    $hoa_id = $_POST['hoa_id'];
    $status = $_POST['status'];
    $updatequery=mysqli_query($con, "UPDATE `head_of_accounts` SET `status`='$status' WHERE `id` = '$hoa_id'");

    if($updatequery){
        echo json_encode(['status_Code'=>100]);
    }
    else{
        echo json_encode(['status_Code'=>200]);
    }
}