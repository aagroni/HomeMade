<?php
session_start();
include ("../includes/connect_db.php");
//include ("../includes/functions.php")

if(!empty($_POST)){
    $emri = $mbiemri = $email = $password = $tel1 = $tel2 = $gjinia = $data_lindjes = $target = $foto = "";

    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $tel1 = $_POST["telefoni1"];
    $tel2 = $_POST["telefoni2"];
    $gjinia = $_POST["gjinia"];
    $data_lindjes = $_POST["data_lindjes"];
    $aktiv = "PO";
    $foto = $_POST['foto'];
    $roli = $_POST["roli"];
    
    //$target = "../uploads/".basename($_FILES['foto'] ['name']);
    //$foto = $_FILES['foto'] ['name'];

    if ($foto) { //nese ka shtu foto e merr edhe e ruan e nese jo e len foton e vjeter
            //unlink("uploads/people/".$foto1); //kta e perdorum nese dojm me e largu foton e vjeter
            //move_uploaded_file($_FILES['foto'] ['tmp_name'], $target); //foton e uplodume me qu ne folderin uploads/people
            //me marr prapashtesen e fotos e.g jpge,png
        $temp = explode(".", $_FILES["foto"]["name"]);
        //me gjeneru nje numer dhe mja bashkangjit prapashtesen
        $foto = round(microtime(true)) . '.' . end($temp);
        //foton e uplodume me qu ne folderin uploads/people
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../../uploads/people/" . $foto);
        } else {
            $foto = $foto1;
        }
    
    
    
    //ket pjese ato atribute qe mujn me kan null kena me i kontrollu a jane that nese po me i ba null qe me i dergu si te tilla.
    
    if ($tel1 =="") {
        $tel1 = NULL;
    }

    if ($tel2 =="") {
        $tel2 = NULL;
    }

    if ($gjinia =="") {
        $gjinia = NULL;
    }

    if ($datalindjes =="") {
        $datalindjes = NULL;
    }

    if ($pershkrimi =="") {
        $pershkrimi = NULL;
    }

    if ($profesioni =="") {
        $profesioni = NULL;
    }

    if ($roli =="") {
        $roli = 2;
    }
    
    // if ($_POST['foto']=="") {
    //     $newfoto = NULL;
    // }

    $output = '';


    if($_POST["user_id"] != ""){
        if ($tel1 =="") {
        $tel1 = NULL;
    }

    if ($tel2 =="") {
        $tel2 = NULL;
    }

    if ($gjinia =="") {
        $gjinia = NULL;
    }

    if ($datalindjes =="") {
        $datalindjes = NULL;
    }

    if ($pershkrimi =="") {
        $pershkrimi = NULL;
    }

    if ($profesioni =="") {
        $profesioni = NULL;
    }

    if ($roli =="") {
        $roli = 2;
    }
    
    if($emri == "" || $emri == null){
            $errormsg = "Name is required";
            exit;
    }
        $query = "UPDATE user 
                SET emri='$emri', mbiemri='$mbiemri', telefoni1='$tel1', telefoni2='$tel2', gjinia='$gjinia', data_lindjes='$datalindjes', foto='$foto', roli='$roli' 
                WHERE id='" . $_POST["user_id"] ."'";
    }

    else if($_POST['ban_user_id'] != ""){
            $ban_id = $_POST['ban_user_id'];
            $admin_id = $_SESSION['loggedInAdminId'];
            $arsya = $_POST['arsya'];

            $query = "INSERT INTO user_ban (user, moderator, arsya, isbanned)
                    VALUES ('$ban_id', '$admin_id', '$arsya', 'PO')";
    }

    else{
        if ($_POST['foto']=="") {
            $newfoto = NULL;
    }
        //me marr prapashtesen e fotos e.g jpge,png
    $temp = explode(".", $_FILES["foto"]["name"]);
    //me gjeneru nje numer dhe mja bashkangjit prapashtesen
    $newfoto = round(microtime(true)) . '.' . end($temp);
    //foton e uplodume me qu ne folderin uploads/people
    move_uploaded_file($_FILES["foto"]["tmp_name"], "../uploads/users/" . $newfoto);

        if($emri == "" || $emri == null){
            $errormsg = "Name is required";
            exit;
        }

        $query = "INSERT INTO user (emri, mbiemri, email, password, telefoni1, telefoni2, gjinia, data_lindjes, foto, aktiv, roli) 
                VALUES ('$emri', '$mbiemri', '$email', '" . password_hash($password, PASSWORD_DEFAULT) . "', '$tel1', '$tel2', '$gjinia', '$data_lindjes', '$newfoto', '$aktiv', '$roli')";

    //ktu duhet me ndrru kete pjese
    }
    
    if($query){
        if(mysqli_query($conn, $query)){
            $select_query = "SELECT user.id as uid, user.emri, user.mbiemri, user.email, user.telefoni1, user.created_date, user.aktiv, roli.id, roli.roli FROM user 
                            LEFT JOIN roli ON user.roli = roli.id";

            $result3 = mysqli_query($conn, $select_query);

            $output .= '
                <table id="sort-table" data-order="[[ 5, "desc" ]]" class="table table-striped table-bordered"">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th>Emri</th>
                            <th>Mbiemri</th>
                            <th class="no-sort">Email</th>
                            <th class="no-sort">Phone 1</th>
                            <th>Date Created</th>
                            <th class="no-sort">Active</th>
                            <th class="no-sort">Role</th>
                            <th class="no-sort">Manage</th>
                        </tr>
                    </thead>
                    <tbody>';

            while($row = mysqli_fetch_array($result3)){
                $output .= '
                        <tr>
                            <td>' . $row["uid"] . '</td>
                            <td>' . $row["emri"] . '</td>
                            <td>' . $row["mbiemri"] . '</td>
                            <td>' . $row["email"] . '</td>
                            <td>' . $row["telefoni1"] . '</td>
                            <td>' . $row["created_date"] . '</td>
                            <td>' . $row["aktiv"] . '</td>
                            <td>' . $row["roli"] . '</td>
                            <td><a type="button" name="edit" id="' . $row["uid"] . '" class="btn btn-primary editUser"><i class="glyphicon glyphicon-pencil"></i></a>
                        ';

                            $banQuery = "SELECT isbanned FROM user_ban
                                        RIGHT JOIN user ON user_ban.user = user.id
                                        WHERE user_ban.user ='".$row['uid']."' AND isbanned = 'PO'";

                            $resultBan = mysqli_query($conn, $banQuery);

                            if(mysqli_num_rows($resultBan) < 1){
                $output .= '
                                <a type="button" name="banUser" id="' . $row["uid"] . '" class="btn btn-danger banUser" data-toggle="modal" data-target="#ban_user"><i class="glyphicon glyphicon-ban-circle"></i></a></td>
                        </tr>
                        ';
                            }

                            else{
                $output .= '
                            </td>
                        </tr>
                        ';
                            }         
            }

            $output .= '
                    </tbody>
                </table>';
        }
        else{
            echo mysqli_error($conn);
        }
    }
    else{
        echo "<h1>No Query!</h1>";
    }

    echo $output;

    mysqli_close($conn);
}
?>