<?php
    $restore_url = "http://localhost:5005/restore_blockchain";
    $ch = curl_init($restore_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_POST, true);           
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);  

    $response = curl_exec($ch);

    if ($response === false) {
        die("Error calling /restore_blockchain: " . curl_error($ch));
    }
    curl_close($ch);

    $response_data = json_decode($response, true);

    if (isset($response_data['error'])) {
        echo '<script type="text/javascript">
            window.onload = function () {
                alert("Failed to restore the blockchain: ' . $response_data['error'] . '");
                window.location.href = "AdminPage7.php";
            };
        </script>';
    } 
    elseif (isset($response_data['message'])) {
        echo '<script type="text/javascript">
                window.onload = function () {
                    alert("Blockchain restored: ' . $response_data['message'] . '");
                    window.location.href = "AdminPage7.php";
                };
            </script>';
    } 
    else {
        echo '<script type="text/javascript">
            window.onload = function () {
                alert("Unexpected response from /restore_blockchain");
                window.location.href = "AdminPage7.php";
            };
            </script>';
    }
?>
