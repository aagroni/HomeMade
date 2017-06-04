<?php
session_start();

include ("../includes/connect_db.php");

if(!empty($_POST)){
    $kategoria = $_POST["emri_kategoria"];

    $output = '';

    if($_POST["category_id"] != ""){
        $query = "UPDATE kategoria 
                SET emri='$kategoria'
                WHERE id='" . $_POST["category_id"] ."'";
    }

    else if($_POST['delete_category_id'] != ""){
        $query = "DELETE FROM kategoria
                WHERE id = '" . $_POST['delete_category_id'] . "'";
    }

    else{
        $query = "INSERT INTO kategoria (emri, parent)
                VALUES ('$kategoria', NULL)";
    }
    
    if($query){
        if(mysqli_query($conn, $query)){
            $select_query = "SELECT * FROM kategoria WHERE parent IS NULL";

            $result = mysqli_query($conn, $select_query);

            $output .= '
                    <table id="sort-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="no-sort">ID</th>
                                <th>Category</th>
                                <th class="no-sort">Manage</th>
                            </tr>
                        </thead>
                        <tbody>';

            while($row = mysqli_fetch_array($result)){
                $output .= "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["emri"] . "</td>
                                <td><a type='button' name='editCategory' class='btn btn-primary editCategory' id='". $row['id'] ."' data-toggle='modal' data-target='#new_category_modal'><i class='glyphicon glyphicon-pencil'></i></a>
                                    <a type='button' name='deleteCategory' class='btn btn-danger deleteCategory' id='".$row['id']."'><i class='glyphicon glyphicon-ban-circle'></i></a></td>
                            </tr>";   
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