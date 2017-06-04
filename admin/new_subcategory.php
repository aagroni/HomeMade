<?php 
include ("../includes/connect_db.php");
include ("../includes/functions.php");

if (isset( $_POST['submit_new_subcategory'] )) {
$emri = "";
$emri = validateFormData( $_POST["emri_subkategoria"]);
$parentKategoria = validateFormData( $_POST["kategoria_parent"]);



$selekto = "SELECT * FROM kategoria WHERE emri='$emri'";
$result = mysqli_query($conn,$selekto);

if(mysqli_num_rows($result)>0){
    header("Location: subcategories.php?alert=addcategoryexists");
}else {
   if ($stmt = mysqli_prepare($conn, "INSERT INTO kategoria (emri,parent) VALUES (?,?)")) {

    mysqli_stmt_bind_param($stmt, "si", $emri,$parentKategoria);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: subcategories.php?alert=addcategorysuccess");
}else {
   // $Deshtim = "<div class='alert alert-danger'>Error: ". mysqli_error($conn) ."<a class='close' data-dismiss='alert'>&times;</a></div>";
    header("Location: subcategories.php?alert=addcategoryfail");
}
}
}
mysqli_close($conn);
 ?>


    