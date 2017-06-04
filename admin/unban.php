<?php
session_start();
include ("../includes/connect_db.php");

if(($_POST['user_ban_id'])){
    $output = '';

    $query = "DELETE FROM user_ban 
            WHERE user_ban.user = '" . $_POST["user_ban_id"] . "'";
    
    if(mysqli_query($conn, $query)){
        $select_query = "SELECT user_ban.id AS ubid, user_ban.user, user_ban.moderator, user_ban.data, user_ban.arsya, user_ban.isBanned FROM user_ban
                        LEFT JOIN user AS u1 ON user_ban.user = u1.id
                        LEFT JOIN user AS u2 ON user_ban.moderator = u2.id";

        $result = mysqli_query($conn, $select_query);

        if(mysqli_num_rows($result) > 0){
            $output .= '
                <table id="sort-table" data-order="[[ 4, "desc" ]]" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th>Banned User</th>
                            <th>Moderator</th>
                            <th>Date Banned</th>
                            <th class="no-sort">Reason for Ban</th>
                            <th class="no-sort">Currently Banned</th>
                            <th class="no-sort">Manage</th>
                        </tr>
                    </thead>
                    <tbody>';

            while($row = mysqli_fetch_assoc($result)){
                $query2 = "SELECT emri, mbiemri FROM user
                            INNER JOIN user_ban ON user.id = user_ban.user
                            WHERE user.id = '" . $row["user"] . "'";
                
                $result2 = mysqli_query($conn, $query2);

                $row2 = mysqli_fetch_assoc($result2);

                $query3 = "SELECT emri, mbiemri FROM user
                            INNER JOIN user_ban ON user.id = user_ban.moderator
                            WHERE user.id = '" . $row["moderator"] . "'";

                $result3 = mysqli_query($conn, $query3);

                $row3 = mysqli_fetch_assoc($result3);

                $output .= '
                        <tr>
                            <td>' . $row["ubid"] . '</td>
                            <td>' . $row2["emri"] . ' ' . $row2["mbiemri"] . '</td>
                            <td>' . $row3["emri"] . ' ' . $row3["mbiemri"] . '</td>
                            <td>' . $row["data"] . '</td>
                            <td>' . $row["arsya"] . '</td>
                            <td>' . $row["isBanned"] . '</td>
                            <td><a type="button" name="delete" id="' . $row["user"] . '" class="btn btn-success deleteUser"><i class="glyphicon glyphicon-heart"></i></a></td>
                        </tr>';
            }

            $output .= '
                </tbody>
            </table';
        }
    }

    echo $output;

    mysqli_close($conn);
}
?>