<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'e-voting') or die("Connection failed: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $string = $_POST['select'];
    $parts = explode(' - ', $string);
    $candidate_id = $parts[0];
    $timestamp = date("Y-m-d H:i:s");
    $voter_id=$_SESSION['voter_id'];

    // Fetch the election ID
    $sql1 = "SELECT Election_ID FROM election";
    $query1 = mysqli_query($con, $sql1);
    if (!$query1) {
        die("Error fetching Election ID");
    }
    $row1 = mysqli_fetch_assoc($query1);
    $election_id = $row1['Election_ID'];

    // Step 1: Validate the blockchain before vote insertion
    $validate_url = "http://localhost:5005/is_valid";

    $ch_validate = curl_init($validate_url);
    curl_setopt($ch_validate, CURLOPT_RETURNTRANSFER, true);
    $validate_response = curl_exec($ch_validate); 
    curl_close($ch_validate);

    $is_valid = json_decode($validate_response, true)['is_valid'] ?? false;

    if ($is_valid) {
        // Step 2: Insert the vote into the database
        $sql2 = "INSERT INTO votes (Candidate_ID, Election_ID, Voter_ID) VALUES ($candidate_id, $election_id, " . $_SESSION['voter_id'] . ")";
        $query2 = mysqli_query($con, $sql2);

        if ($query2) {

            // Step 3: Create a new block in the blockchain
            $mine_url = "http://localhost:5005/mine_block";
            $data = json_encode(['candidate_id' => $candidate_id, 'timestamp' => $timestamp]);

            $ch_mine = curl_init($mine_url);
            curl_setopt($ch_mine, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch_mine, CURLOPT_POST, true);
            curl_setopt($ch_mine, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch_mine, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response_mine = curl_exec($ch_mine);
            curl_close($ch_mine);

            if ($response_mine) {
                // Step 4: Validate the blockchain after block creation
                $ch_validate = curl_init($validate_url);
                curl_setopt($ch_validate, CURLOPT_RETURNTRANSFER, true);
                $validate_response2 = curl_exec($ch_validate);
                curl_close($ch_validate);

                $is_valid2 = json_decode($validate_response2, true)['is_valid'] ?? false;

                if ($is_valid2) {
                    // Step 5: Backup the blockchain if it remains valid
                    $backup_url = "http://localhost:5005/backup_blockchain";

                    $ch_backup = curl_init($backup_url);
                    curl_setopt($ch_backup, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch_backup, CURLOPT_POST, true);
                    curl_setopt($ch_backup, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch_backup, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                    $backup_response = curl_exec($ch_backup);
                    curl_close($ch_backup);

                    if ($backup_response) {
                        $sql3="UPDATE voter_list SET Status=1 WHERE Voter_ID=$voter_id";
                        $query3=mysqli_query($con,$sql3);
                        echo '<script type="text/javascript">
                                window.onload = function () {
                                    alert("Successfully voted !!");
                                    window.location.href = "ThankVotingPage.php";
                                }</script>';
                    } else {
                        echo '<script type="text/javascript">
                                window.onload = function () {
                                    alert("Error during blockchain backup.");
                                    window.location.href = "VotingPage8.php";
                                }</script>';
                    }
                } else {
                    echo '<script type="text/javascript">
                            window.onload = function () {
                                alert("Blockchain is invalid. Please wait for some time");
                                window.location.href = "VotingPage8.php";
                            }</script>';
                }
            } else {
                echo '<script type="text/javascript">
                        window.onload = function () {
                            alert("Error creating a block.");
                            window.location.href = "VotingPage8.php";
                        }</script>';
            }
        } else {
            echo '<script type="text/javascript">
                    window.onload = function () {
                        alert("Error inserting vote into the database.");
                        window.location.href = "VotingPage8.php";
                    }</script>';
        }
    } else {
        echo '<script type="text/javascript">
                window.onload = function () {
                    alert("Blockchain is invalid before block creation.");
                    window.location.href = "VotingPage8.php";
                }</script>';
    }
}
?>
