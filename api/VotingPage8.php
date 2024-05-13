<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'e-voting') or die("Connection failed: " . mysqli_connect_error());
    $query = "SELECT Candidate_ID, FullName, Party_Name, Party_Image FROM candidate_list c, party_list p WHERE c.Party_ID = p.Party_ID";
    $result = mysqli_query($con, $query);
    $result2 = mysqli_query($con, $query);  // If both queries are the same, only one query is needed
    $image_dir = "Images/";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Voting</title>
    <script src="Disable.js"></script>
    <script src="DisableHistory.js"></script>
    <script>
        var logoutTime = 30; // 30 seconds
        var logoutTimeout;  // Variable to store the timeout ID

        function startLogoutTimer() {
            // Set a timer to redirect to logout.php after 30 seconds
            logoutTimeout = setTimeout(function() {
                alert("Session Timeout! Please login again to vote")
                window.location.href = 'logout.php'; // Redirect to logout.php
            }, logoutTime * 1000); // 30 seconds in milliseconds
        }

        function resetLogoutTimer() {
            clearTimeout(logoutTimeout);  // Clear the current timeout
            startLogoutTimer();  // Restart the timeout
        }

        // Reset the timer on user interaction
        document.onclick = resetLogoutTimer;  // On click
        document.onmousemove = resetLogoutTimer;
        document.onkeypress = resetLogoutTimer; 

        window.onload = startLogoutTimer;
    </script>
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
            color:#DEFBF9   ;
            font-family: "Times New Roman", Times, serif; 
        }
        .heading2{
            font-size:20px;
        }
        .body{
            display:flex;
            width:95%;
            height:77vh;
            /* border:1px solid black; */
            margin:2% 2.5% 2% 2.5%;
        }
        .left{
            width:50%;
            margin:0% 1% 0% 0%;
            border-right:1px solid black;
            align-items: center;
        }
        .table{
            border-collapse: collapse;
            font-size:22px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            width: 95%;
            border: 1px solid #E2DBDA;
            padding: 4px 0px;
            border-radius:8px 8px 0 0;
            margin:7.5% 3.5% 0% 0%;
            background-color: black;
            color:white;
            overflow: hidden ;
            align-items: center;
            text-align: center;
        }
        .table thead tr{
            font-weight: bold;
            font-size:20px;
            color:white;
            background-color:black;
            border-bottom: 4px solid black;
        }
        .table tbody tr{
            font-size: 18px;
        }
        .table tbody th,.table tbody td{
            padding:5px 5px;
            color:black;
        }
        .table tbody tr{
            border-bottom: 1px solid #E2DBDA ;
        }
        .table tbody tr:nth-of-type(even){
            background-color:#C3C2C0;
        }
        .table tbody tr:nth-of-type(odd){
            background-color:#DAD9D7;
        }
        .table tbody tr:last-of-type{
            border-bottom: 4px solid black;
        }
        .right{
            width:50%;
            margin:0% 0% 0% -1%;
            border-left:1px solid black;
            /* border:1px solid black; */
            align-items:center;
        }
        .up{
            width:90%;
            margin:19% 5% 2% 5%;
            padding:1% 0 1% 0%;
            text-align: center;
        }
        .down{
            width:70%;
            /* border:1px solid black; */
            margin:2% 5% 20% 5%;
            padding:3% 0 2% 24%;
            font-size:22px;
        }
        select{
            width:25%;
            border:2px solid black;
            border-radius:5px;
            font-size:20px;
            text-align: center;
        }
        .heading2{
            text-decoration: underline;
            font-size:22px;
        }
        .submit-button{
            width:25%;
            height:7%;
            background-color: green;
            color:white;
            margin:5% 0 0 20%;
            border-radius: 10px;
            padding:2%;
            align-items:center;
        }
        .img-size{
            width:50px;
            height:50px;
        }
        .img-size1{
            width:20px;
            height:20px;
        }
        .footer{
            background-color:black;
            border:3px solid black;
            height:1rem;            
            margin:0 0.5% 0.5% 0;
            width:98.65%;
            position: absolute; 
            bottom: 0;
        }
        #c2{
            color:#DEFBF9 ;
            font-size:15px;
            font-family: "Times New Roman", Times, serif; 
        }
    </style>
</head>
<body onLoad="noBack()" onpageshow="if (event.persisted) noBack();" onUnload="" oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="body">
        <div class="left">
            <table class="table">
                <thead>
                    <tr>
                        <th>Candidate ID</th>
                        <th>Candidate Name</th>
                        <th>Candidate Party</th>
                        <th>Party Symbol</th>
                    </tr>
                </thead>
                <!-- Table content -->
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result2)) {
                    ?>
                        <tr>
                            <td><?php echo $row['Candidate_ID']; ?></td>
                            <td><?php echo $row['FullName']; ?></td>
                            <td><?php echo $row['Party_Name']; ?></td>
                            <?php $image_path = $image_dir . $row['Party_Image']; ?>
                            <td><img src="<?php echo $image_path; ?>" class="img-size"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="right">
            <div class="up">
                <h3 class="heading2">Please select the candidate ID to vote</h3>
            </div>
            <div class="down">
                <form action="InsertVote.php" method="POST">
                    <label for="voter_id" class="input1"><b>Voter ID:</b></label>
                    <?php if (isset($_SESSION['voter_id'])) echo $_SESSION['voter_id']; ?><br><br>
                    <label for="select"><b>Select Candidate ID: </b>
                        <select name="select" class="select_id">
                            <option>---Select---</option>
                            <?php
                            while ($row1 = mysqli_fetch_array($result)) {
                            ?>
                                <option>
                                    <?php echo $row1['Candidate_ID'] . ' - ' . $row1['Party_Name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </label> 
                    <button type="submit" class="submit-button" name="submit" value="VOTE">VOTE</button>                  
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISSION OF INDIA</center>
    </div>
</body>
</html>