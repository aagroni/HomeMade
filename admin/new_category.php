<?php 
include ("../includes/connect_db.php");
include ("../includes/functions.php");

if (isset( $_POST['submit_new_category'] )) {
$emri = "";
$emri = validateFormData( $_POST["emri_kategoria"]);



$selekto = "SELECT * FROM kategoria WHERE emri='$emri'";
$result = mysqli_query($conn,$selekto);

if(mysqli_num_rows($result)>0){
    header("Location: categories.php?alert=addcategoryexists");
}else {
   if ($stmt = mysqli_prepare($conn, "INSERT INTO kategoria (emri) VALUES (?)")) {

    mysqli_stmt_bind_param($stmt, "s", $emri);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: categories.php?alert=addcategorysuccess");
}else {
   // $Deshtim = "<div class='alert alert-danger'>Error: ". mysqli_error($conn) ."<a class='close' data-dismiss='alert'>&times;</a></div>";
    header("Location: categories.php?alert=addcategoryfail");
}
}
}
mysqli_close($conn);
 ?>


    