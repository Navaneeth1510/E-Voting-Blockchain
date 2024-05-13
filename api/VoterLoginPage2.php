<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Voter Login</title>
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
            margin:4% 37.5% 3% 37.5%;
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
        .para{
            text-align:left;
            color:#DEFBF9;
            font-size:20px;
            text-decoration: underline;
            font-style:italic;
            margin-top:-1%;
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
        .submit{
            width:40%;
            height:40px;
            margin-top:6%;
            border-radius:10px;
            font-size:20px;
            background-color: green;
            color:#DEFBF9;
        }
        .logout{
            margin-bottom:2%;
        }
        .logout-button{
            font-weight: bold;
            width:9%;
            border-radius: 10px;
            background-color: red;
            padding:0.75% 0 0.75% 0;
            margin:0 0 0 85%;
        }
    </style>
</head>
<body onLoad="noBack()" onpageshow="if (event.persisted) noBack();" onUnload="" oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="body">
        <div class="voter_login">
            <form action='Voter2.php' method='POST'>
                <div class="heading">
                    <h2 class="h2">VOTER LOGIN</h2>
                </div>
                <div class="details">
                    <label for="email" class="input1">Voter ID</label><br>
                    <input type='text' class="input" name='voter_id' placeholder="Enter Voter ID"required/><br><br>

                    <label for="password" class="input1">Password</label><br>
                    <input type='password' class="input" name='password' placeholder="Enter Password"required/><br><br>

                    <a href="ForgotPasswordVoter.php"><p class="input1 para">Forgot password?</p></a>
                </div>
                <div class="foot">
                    <input class="submit" type='submit' name='submit' id="submit" />
                </div>
            </form>
        </div>
    </div>    
    <div class="logout">
        <a href="EVotingMain1.php"><button class="logout-button">Back</button></a>
    </div>
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>