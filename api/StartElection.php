<?php
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    $sql="SELECT Status from election";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($query);
    //==> Election Status=0 : Election is stopped
    if($query && $row['Status']==0){
        //make the election status as going on
        $sql1="UPDATE election SET Status = 1";
        $q1=mysqli_query($con,$sql1);
        //delete all the previous votes done
        $sql2="DELETE from votes";
        $q2=mysqli_query($con,$sql2);
        //make the status of all voters as not yet voted
        $sql3="UPDATE voter_list SET Status = 0";
        $q3=mysqli_query($con,$sql3);
        //make the result table also empty
        $sql4="DELETE from result";
        $q4=mysqli_query($con,$sql4);
        echo'<script>
                window.location.href="ElectionStartedPage.php";
                </script>';

       
        $url = "http://localhost:5005/reset_blockchain";  # Flask endpoint to reset the blockchain
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  # Get the response
        curl_setopt($ch, CURLOPT_POST, true);  # POST request to reset
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
        $response = curl_exec($ch);  # Execute the request
        curl_close($ch);
    
        if ($response) {
            $response_data = json_decode($response, true);  # Decode the response
            if (isset($response_data['message'])) {
                echo $response_data['message'];  # Display the success message
            }
        } else {
            echo'<script>
                alert("Failed to reset blockchain!");
                </script>';
        }

                

        #empty the json file here
        $file_path = 'trial_blockchain.json';
        if (file_exists($file_path)) { 
            if (unlink($file_path)) {  
                echo'<script>
                alert("File deleted successfully!");
                </script>';
            } else {
                echo "Error: Unable to delete the file.";
            }
        } else {
            echo "File not found.";
        }
    }
    //==> Election Status=1 : Election is going on
    else{
        echo'<script>
                window.location.href="AlreadyStartedPage.php";
                </script>';
    }
?>