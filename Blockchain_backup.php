<?php    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['backup_blockchain'])) {
        $url = "http://localhost:5005/backup_blockchain";  // Correct URL
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);  

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $data = json_decode($response, true);  
            if (is_array($data) && isset($data['message'])) {
                echo "<script>
                    alert('" . $data['message'] . "');  // Display success message
                    window.location.href = 'AdminPage7.php';  // Redirect to AdminPage7
                </script>";
            }
        } else {
            echo "<script>
                alert('Failed to backup the blockchain.');  // Display error message
                window.location.href = 'AdminPage7.php';  // Redirect on error
            </script>";
        }
    }
?>
