<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Authentication</title>
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
            align-items:center;
        }
        .voter_login{
            height:25%;
            width:25%;
            margin:7.2% 37.5% 7.4% 37.5%;
            border:3px solid black;
            border-radius: 30px;
            background-color:black;
            color:#DEFBF9;
        }
        .heading{
            width:95%;
            margin:-2% 2.5% 2% 2.5%;
            padding:2% 0 2% 0;
            text-align:center;
        }
        .h2{
            font-size:25px;
            padding:0 0 9px 0;
            border-bottom:2px solid #DEFBF9;
        }
        .details{
            width:80%;
            margin:2% 10% 0 10%;
            padding:2% 0 3% 0;
            /* border:1px solid black; */
            /* text-align:center; */
        }
        .input1{
            text-align:left;
            font-size:22px;
        }
        .input{
            align-items:center;
            font-size:20px;
            width:90%;
            margin:3% 10% 0 4%;
            border:2px solid black;
            border-radius:7px;
            height:25px;
        }
        .foot{
            align-items:center;
            text-align:center;
            margin-bottom:5%;
        }
        .para{
            text-align:left;
            color:#DEFBF9;
            font-size:20px;
            margin-top:-5%;
        }
        .submit{
            width:40%;
            height:40px;
            margin-top:6%;
            border-radius:10px;
            font-size:20px;
            background-color: green;
            color:#DEFBF9;
        }
    </style>
</head>
<body onLoad="noBack()" onpageshow="if (event.persisted) noBack();" onUnload="" oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="body">
        <div class="voter_login">
            <form action='VerifyOTP.php' method='POST'>
                <div class="heading">
                    <h2 class="h2">OTP Verification</h2>
                </div>
                <div class="details">
                    <p class="para">An OTP has been sent to this email id - <?php echo $_SESSION['gmail_id'] ?></p>
                    <label for="otp" class="input1" name="otp">Enter OTP</label><br>
                    <input type='text' class="input" name='voter_otp' placeholder="Enter OTP"required/><br><br>
                </div>
                <div class="foot">
                    <input class="submit" type='submit' name='submit' id="submit" />
                </div>
            </form>
        </div>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>



