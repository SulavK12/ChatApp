<?php 
    session_start();
    include("includes/connection.php");
    include("includes/functions.php");
    $user_data = check_login($conn);
    
    $sender = $_SESSION['user_name'];
    $receiver = $_SESSION['receiver'];

    mysqli_query($conn, "UPDATE msg SET status = 0 WHERE sender='$receiver' AND receiver ='$sender'");
    
    $query = "SELECT * FROM (
        SELECT * FROM `msg` WHERE sender = '$sender' && receiver='$receiver' || sender='$receiver' && receiver='$sender'  ORDER BY `id` DESC LIMIT 15
      ) t1 ORDER BY t1.id";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    $row = mysqli_num_rows($result);
    if($row > 0){
        echo "<table>
        <tr>
            <th>Sent By</th>
            <th>Messages</th>
            <th>Date</th>
        </tr>";
        while($row = mysqli_fetch_assoc($result)){
            if($row['sender'] === $sender){
            echo "<tr>"."<td>You</td>".
            "<td>".$row['message']."</td>".
            "<td>".$row['date']."</td>"."</tr>";
            }
            else {
                if($row['sender'] === $receiver){
                    echo "<tr>"."<td>".$row['sender']."</td>".
                    "<td>".$row['message']."</td>".
                    "<td>".$row['date']."</td>"."</tr>";
                    }
            }
        }
        echo "</table>";

    }
        else{
		    echo "No messages yet...";

        }
    ?>