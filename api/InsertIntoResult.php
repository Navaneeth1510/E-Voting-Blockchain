<?php 
    $con = mysqli_connect('localhost', 'root', '', 'e-voting') or die("Connection failed: " . mysqli_connect_error());
    //insert into result table
    $s = "INSERT IGNORE INTO result (Candidate_ID, Vote_Count)
    SELECT c.Candidate_ID, COUNT(v.Candidate_ID)
    FROM candidate_list c
    LEFT JOIN votes v ON c.Candidate_ID = v.Candidate_ID
    GROUP BY c.Candidate_ID";
    $q = mysqli_query($con, $s);
?>