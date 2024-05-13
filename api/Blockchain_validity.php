<?php
    $url = "http://localhost:5005/is_valid";  
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);  
    $response = curl_exec($ch);  
    curl_close($ch);  

    if ($response) {
        $data = json_decode($response, true); 
        if (is_array($data) && array_key_exists('is_valid', $data)) {  
            if ($data['is_valid']) {
                header("Location: Blockchain_valid.php");
            } 
            else {
                header("Location: Blockchain_invalid.php");
            }
            exit();  
        }
    }
    echo "Error: Could not determine the blockchain's validity.";
?>
