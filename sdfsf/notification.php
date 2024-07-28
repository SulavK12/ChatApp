<?php 
    session_start();
    include("includes/connection.php");
    include("includes/functions.php");
    $user_data = check_login($conn);
     
    $sender = $_SESSION['user_name'];
echo "

<audio id='sound' src='includes/notification.mp3'></audio>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

";

    

    $result = mysqli_query($conn,"SELECT * FROM msg WHERE receiver = '$sender' AND status = 1 ORDER BY id DESC") or die(mysqli_error($conn));
    $row = mysqli_num_rows($result);
    if($row > 0){
               
        echo "<table>
        <tr>
            <th>Users</th>
            <th>New Message</th>
            <th>Chat</th>
        </tr>";
        while($row = mysqli_fetch_assoc($result)){
            
            echo "<tr>"."<td>".$row['sender']."</td>".
            "<td>".$row['message']."</td>".
            "<td><a href='chat.php?chat=$row[sender]'>Chat</a></td>".
            "</tr>";
            if($row['notify'] == 1){
                echo "
                <script>
                $('#sound')[0].play();
                </script>
                ";
                mysqli_query($conn, "UPDATE msg SET notify = 0 WHERE receiver = '$sender'");
            }
        }
        echo "</table>";

        }
        
    ?>