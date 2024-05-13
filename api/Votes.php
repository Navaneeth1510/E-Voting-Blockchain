<?php
    // Connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'e-voting') or die("Connection failed: " . mysqli_connect_error()); 

    // Retrieve the blockchain data
    function get_blockchain() {
        $url = "http://localhost:5005/get_chain";  
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); 

        $response = curl_exec($ch); 
        curl_close($ch);

        if ($response) { 
            $data = json_decode($response, true);  
            return $data;  
        } else {
            return null;  
        }
    }

    $blockchain_data = get_blockchain(); 


    //to calculate voting percentage
    $blockchain_length = $blockchain_data['length'];

    if ($blockchain_length > 1) {  
        $vote_count = $blockchain_length - 1;
        $sql = "SELECT COUNT(*) AS total_voters FROM voter_list";  
        $q = mysqli_query($con, $sql);
        
        if ($q) {  
            $result = mysqli_fetch_assoc($q);  
            $total_count = $result['total_voters'];
            
            // Calculate final percentage
            $finalPercent = ($vote_count / $total_count) * 100; 
            $finalPercent = number_format($finalPercent, 2); 
        } 
        else {
            die("Error fetching total voter count: " . mysqli_error($con));
        }
    } 
    else {
        $finalPercent = 0;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Election Stats</title>
    <script src="Disable.js"></script>
    <script src="DisableHistory.js"></script>
    <style>
            body{
                background-color: #DEFBF9 ;
                background-blend-mode: darken;
                background-attachment: fixed;
            }
            .header{
                background-color:black;
                border:4px solid black;
                height:0.8rem;
                padding:8px 0 35px 0;
            }
            #c1{
                font-size:35px;
                color:#DEFBF9;
                font-family: "Times New Roman", Times, serif; 
            }
            .body{
                height:100%;
                margin:1%;
            }
            .votes{
                width:90%;
                margin:3% 5% 3% 5%;
            }
            
            .footer{
                background-color:black;
                border:3px solid black;
                /* position:absolute; */

                height:1rem;            
                margin:0 0.5% 0.5% 0;
                width:98.6%;
                bottom: 0;
            }
            #c2{
                color:#DEFBF9;
                font-size:15px;
                font-family: "Times New Roman", Times, serif; 
            }
            .point{
                font-size:20px;
                font-weight:bold;
                margin-left:5%;
            }
            .head{
                font-size:25px;
                font-weight:bold;
                text-decoration:underline;
            }
            .block_chain{
                border: 4px solid black;
                border-radius:10px;
                font-size: 19px;
                padding:1% 0 1% 1%;
                width: 50%;
                margin-left:25%; 
                margin-bottom:1%;   
                
            }
            .block_margin {
                margin-left: 2%; 
            }
            .block_head{
                font-size:20px;
                font-weight:bold;
                margin-top:-2%;

            }
            .block_arrow{
                margin-left: 50%;
            }
            .logout{
                margin-top: auto;
                display: flex;
                flex-direction: column;
            }
            .logout-button{
                font-weight: bold;
                width:10%;
                font-size:15px;
                background-color: red;
                border-radius:10px;
                padding:0.75% 0 0.75% 0;
                margin-top:-5%;
                margin:0 0 3% 85%;
            }
        </style>
</head>
<body oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="body">
        <div class="points">
            <p class="head">Voting Statistics</p>
            <p class="point">Vote Percentage: <?php echo $finalPercent ?> %</p>
        </div>
        <hr>
        <div>           
            <p class="head">Current Votes</p>
        </div>
        <div class="votes">
        <?php
        if ($blockchain_data) {
        ?>
            <div class="block_head">
                <u>Blockchain length:</u> <?php echo $blockchain_data['length']; ?><br><br><br>
            </div>
            <?php
            $block_count = count($blockchain_data['chain']);
            foreach ($blockchain_data['chain'] as $index => $block) {
            ?>
                <div class="block_chain">
                    <b>Block:</b> <?php echo $block['index']; ?><br>
                    <b>Timestamp:</b> <?php echo $block['timestamp']; ?><br>
                    <b>Proof:</b> <?php echo $block['proof']; ?><br>
                    <b>Previous Hash:</b> <?php echo $block['previous_hash']; ?><br>
                    <?php
                    if (isset($block['block_data'])) { 
                    ?>
                        <b>Block Data:</b><br>
                        <?php
                        foreach ($block['block_data'] as $key => $value) {
                            echo "<span class='block_margin'><b>" . ucfirst($key) . "</b>: " . $value . "</span><br>";
                        }
                        ?>
                    <?php
                    }
                    ?> 
                </div>

                <?php
                // Insert SVG arrow between blocks, but not after the last block
                if ($index < $block_count - 1) {  // Place an arrow between blocks, but not after the last block
                    echo "<div class='block_arrow'>";
                    echo '<svg width="20" height="40" fill="currentColor" viewBox="0 0 16 32">';
                    echo '<path d="M8 24.293l-6-6a.5.5 0 0 1 .707-.707L8 23.586l5.293-6a.5.5 0 0 1 .707.707l-6 6a.5.5 0 0 1-.707 0z" fill="currentColor" stroke="currentColor" stroke-width="2"/>';
                    echo '<path d="M8 1.5v22.793a.5.5 0 0 1 1 0V1.5a.5.5 0 0 0-1 0z" fill="currentColor" stroke="currentColor" stroke-width="2"/>';
                    echo '</svg>';
                    echo "</div>";
                }
                ?>
            <?php
            }
        } else {
            echo "Failed to retrieve blockchain data.";
        }
        ?>
    </div>


    <div class="logout">
        <a href="AdminPage7.php"><button class="logout-button">Back</button></a>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>






<!-- BEGIN
    DECLARE vote_count INT;
    DECLARE voter_count INT;
    DECLARE percentage DECIMAL(10,2);
    SELECT COUNT(*) INTO vote_count FROM votes;
    SELECT COUNT(*) INTO voter_count FROM voter_list;
    IF voter_count > 0 THEN
        SET percentage = (vote_count / voter_count) * 100;
    ELSE
        SET percentage = 0;
    END IF;
    SELECT percentage AS vote_percentage;
END -->