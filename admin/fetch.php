<?php
    session_start();

    include ("../includes/connect_db.php");

    if(isset($_POST["user_id"])){
        $query = "SELECT * FROM user WHERE id = '" . $_POST["user_id"] . "'";

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($result);
            $id = $row['id'];
            $emri = $row['emri'];
            $mbiemri = $row['mbiemri'];
            $gjinia = $row['gjinia'];
            $email = $row['email'];
            $tel1 = $row['telefoni1'];
            $tel2 = $row['telefoni2'];
            $foto = $row['foto'];
            $data_lindjes = $row['data_lindjes'];
            $roli = $row['roli'];

            $tedhenat = json_encode(array("id"=>$id, "emri"=>$emri, "mbiemri"=>$mbiemri, "gjinia"=>$gjinia, "email"=>$email, "tel1"=>$tel1, "tel2"=>$tel2, "foto"=>$foto, "data_lindjes"=>$data_lindjes, "roli"=>$roli));

            echo $tedhenat;
    }

    if(isset($_POST['ban_id'])){
        $query2 = "SELECT * FROM user WHERE id = '" . $_POST["ban_id"] . "'";
        $query3 = "SELECT * FROM user WHERE id = '" . $_SESSION['loggedInAdminId'] . "'";

        $result2 = mysqli_query($conn, $query2);
        $result3 = mysqli_query($conn, $query3);

        $row2 = mysqli_fetch_array($result2);
        $row3 = mysqli_fetch_array($result3);

            $user_id = $row2['id'];
            $user_emri = $row2['emri'];
            $user_mbiemri = $row2['mbiemri'];

            $admin_emri = $row3['emri'];
            $admin_mbiemri = $row3['mbiemri'];
        
        $tedhenat2 = json_encode(array("user_id"=>$user_id, "user_emri"=>$user_emri, "user_mbiemri"=>$user_mbiemri, "admin_emri"=>$admin_emri, "admin_mbiemri"=>$admin_mbiemri));

        echo $tedhenat2;
    }

    if(isset($_POST['category_id'])){
        $query4 = "SELECT * FROM kategoria WHERE id = '" . $_POST['category_id'] . "'";

        $result4 = mysqli_query($conn, $query4);

        $row4 = mysqli_fetch_array($result4);

            $id = $row4['id'];
            $emri = $row4['emri'];

        $tedhenat3 = json_encode(array("id"=>$id, "emri"=>$emri));

        echo $tedhenat3;
    }
?>