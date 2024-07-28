<?php 
    session_start();
    include("includes/connection.php");
    include("includes/functions.php");
    $user_data = check_login($conn);
    
    $sender = $_SESSION['user_name'];



    if(isset($_SESSION['user_name'])){

     $in_time = strtotime(date("Y-m-d H:i:s"). '+5 second');
    $in_time = date("Y-m-d H:i:s", $in_time);  

    $query = "UPDATE users SET log_in = '$in_time' WHERE user_name = '$sender'";
    mysqli_query($conn,$query);
    };
    
    $check_time = strtotime(date("Y-m-d H:i:s"). '-0 second');
    $check_time = date("Y-m-d H:i:s", $check_time);    

    

    $result = mysqli_query($conn,"SELECT user_name, log_in FROM users WHERE NOT user_name = '$sender'") or die(mysqli_error($conn));
    $row = mysqli_num_rows($result);
    if($row > 0){
        echo "<table>
        <tr>
            <th>Users</th>
            <th>Status</th>
            <th>Chat</th>
        </tr>";
        while($row = mysqli_fetch_assoc($result)){


            if($row['log_in'] > $check_time){
                
                $status = "<button style='background-color:green; color:white; padding:5px;'>Online</button>";
                
            }
            else{

                $status = "<button style='background-color:red; color:white; padding:5px;'>Offline</button>";
            
            }

            echo "<tr>"."<td>".$row['user_name']."</td>".
            "<td>".$status."</td>".
            "<td><a href='chat.php?chat=$row[user_name]'>Chat</a></td>".
            "</tr>";
        }
        echo "</table>";

        }
        
    ?>