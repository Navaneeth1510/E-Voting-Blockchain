<?php
    session_start();
    $image_dir = "Images/";
    $image_path = 'Images/'.$_SESSION['voter_img'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Voter Details</title>
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
            margin:5% 0% 11% 10%;
            display:flex;
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
            width:75%;
            margin:1% 2% 1% 4%;
        }
        .in-details{
            margin:1% 2% 1% 3%;
            font-weight:bold;
        }
        .agree-stmt{
            width:95%;
            /* border:2px solid black; */
            margin:5% 2.5% 5.7% 2.5%;
        }
        .checkbox{
            margin-top:1%;
            width:20px;
            height:15px;
        }
        .stmt{
            font-size:20px;
        }
        .submit{
            width:95%;
            font-size:20px;
            margin:0 2.5% 0 2.5%;
        }
        .image{
            margin-top:7.5%;
        }
        .img-size{
            width: 150px;
            height: 150px;
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
                Voter ID: <br>
                First Name: <br>
                Last Name: <br>
                Date Of Birth: <br>
                Address: <br><br>
                Email: <br>
            </div>
            <div class="answers">
                <?php if(isset($_SESSION['voter_id'])) echo $_SESSION['voter_id'] ?><br>
                <?php if(isset($_SESSION['fname'])) echo $_SESSION['fname'] ?><br>
                <?php if(isset($_SESSION['lname'])) echo $_SESSION['lname'] ?><br>
                <?php if(isset($_SESSION['dob'])) echo $_SESSION['dob'] ?><br>
                <?php if(isset($_SESSION['address'])) echo $_SESSION['address'] ?><br>
                <?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?><br>
            </div>
        </div>
    </div>
    <div class="agree-stmt">
        <form action="VotingPage8.php">
            <input type="checkbox" class="checkbox" required>
            <label class="stmt">By clicking this, you agree that these details belong to you and are correct.</label><br><br>
            <input type="submit" class="submit-button" value="I,Agree">
        </form>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>