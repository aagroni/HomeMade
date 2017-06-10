<?php
session_start();
include ("../includes/connect_db.php");
//include ("../includes/functions.php")

if(!empty($_POST)){
    $emri = $mbiemri = $email = $password = $tel1 = $gjinia = $data_lindjes = "";

    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $gjinia = $_POST["gjinia"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $tel1 = $_POST["telefoni1"];
    $data_lindjes = $_POST["data_lindjes"];
    $aktiv = "PO";
    $roli = $_POST["roli"];
    
    if ($tel1 =="") {
        $tel1 = NULL;
    }

    if ($gjinia =="") {
        $gjinia = NULL;
    }

    if ($datalindjes =="") {
        $datalindjes = NULL;
    }

    if ($roli =="") {
        $roli = 2;
    }

    $output = '';


    if($_POST["user_id"] != ""){
        if($emri == "" || $emri == null){
            $errormsg = "Name is required";
            exit;
        }

        $query = "UPDATE user 
                SET emri='$emri', mbiemri='$mbiemri', telefoni1='$tel1', gjinia='$gjinia', data_lindjes='$datalindjes', roli='$roli' 
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
        if($emri == "" || $emri == null){
            $errormsg = "Name is required";
            exit;
        }

        $query = "INSERT INTO user (emri, mbiemri, email, password, telefoni1, gjinia, data_lindjes, aktiv, roli) 
                VALUES ('$emri', '$mbiemri', '$email', '" . password_hash($password, PASSWORD_DEFAULT) . "', '$tel1', '$gjinia', '$data_lindjes', '$aktiv', '$roli')";
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