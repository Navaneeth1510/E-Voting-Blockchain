<?php
    session_start();
    $image_dir = "Images/";
    $image_path = 'Images/'.$_SESSION['image'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin Page</title>
    <script src="Disable.js"></script>
    <script src="DisableHistory.js"></script>
    <style>
        body{
            background-color: #DEFBF9 ;
            background-blend-mode: darken;
            /* #FB8313,#FB7E0B */
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
            display: flex;
            height:100%;
            margin:1%;
            height: 100%;
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
            color:#DEFBF9;
            font-size:15px;
            font-family: "Times New Roman", Times, serif; 
        }
        .body{
            width:95%;
            margin:1% 2.5% 0 2.5%;
            align-items:center;
        }
        .heading{
            width:95%;
            margin:-2% 2.5% 0 2.5%;
            text-align:center;
        }
        .submit-button{
            width:8%;
            height:37px;
            margin-bottom:0.5%;
            border-radius:10px;
            font-size:20px;
            background-color: green;
            color:#DEFBF9;
        }
        .details{
            width:87.5%;
            margin:5% 0% 6% 10%;
            display:flex;
            padding-bottom:1%;
        }
        .voter-details{
            font-size:22.5px;
            display:flex;
            width:100%;
            margin:0 0 0 5%;
            border-left:2px solid black;
            width:
        }
        .answers{
            width:50%;
            margin:1% 2% 1% 4%;
            padding=bottom:2%;
            /* border:1px solid black; */
        }
        .in-details{
            margin:1% 2% 1% 3%;
            font-weight:bold;
        }
        .agree-stmt{
            width:95%;
            padding-top:1%;
            display:flex;
            margin-left:2.5%;
            margin-bottom:3%;
        }
        .agree-left{
            width:50%;
            /* border:1px solid black; */
            align-items:center;
        }
        .agree-right{
            width:50%;
            /* border:1px solid black; */
            align-items:center;
        }
        .submit{
            width:95%;
            /* border:1px solid black; */
            margin:0 2.5% 0 2.5%;
        }
        .election, .others{
            width:30%;
            padding:2%;
            background-color: black;
            color:#DEFBF9;
            /* margin:1% 35% 1% 35%; */
            border-radius:10px;
        }
        .election{
            margin:0 25% 2% 45%;
            font-size:15px;
        }
        .others{
            margin:0 45% 2% 25%;
            font-size:15px;
        }
        .logout{
            width:95%;
            margin:3.5% 2.5% 4.3% 2.5%;
        }
        .logout-button{
            width:10%;
            font-weight:bold;
            font-size:15px;
            background-color: red;
            border-radius:10px;
            padding:0.75% 0 0.75% 0;
            margin:0 0 0 85%;
        }
        .image{
            margin-top:7.5%;
        }
        .img-size{
            width: 150px;
            height: 150px;
            margin-top:-4%;
        }
    </style>
</head>
<body onLoad="noBack()" onpageshow="if (event.persisted) noBack();" onUnload="" oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="details">
        <div class="voter-image">
            <div class="image">
            <img src="<?php echo $image_path; ?>" class="img-size">
            </div>
        </div>
        <div class="voter-details">
            <div class="in-details">
                Administrator ID: <br>
                Administrator Name: <br>
                Email: <br>
                Post:<br>
            </div>
            <div class="answers">
                <?php if(isset( $_SESSION['admin_id'])) echo  $_SESSION['admin_id'] ?><br>
                <?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?><br>
                <?php if(isset($_SESSION['mailid'])) echo $_SESSION['mailid'] ?><br>
                <?php if(isset($_SESSION['post'])) echo  $_SESSION['post'] ?><br>
            </div>
        </div>
    </div>
    <div class="agree-stmt">
        <div class="agree-left">
            <a href="StartElection.php"><button type="submit" name="Start Election" class="election" value="Start Election">Start Election</button></a><br>
            <a href="StopElection.php"><button type="submit" name="btn" class="election" value="Stop Election">Stop Election</button></a>
        </div>
        <div class="agree-right">
            <a href="Blockchain_validity.php"><button type="submit" name="btn" class="others" value="change_password">Validation</button></a><br>
            <a href="Votes.php"><button type="submit" name="btn" class="others" value="votes">Statistics</button></a>
        </div>
    </div>
    <div class="logout">
        <a href="Logout.php"><button class="logout-button">LOGOUT</button></a>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>