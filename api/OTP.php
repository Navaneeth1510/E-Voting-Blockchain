<!-- 
Two step verification done.
navaneethnaren6@gmail.com
Added password :(  kiom hewv qarw gljz  ) 
-->

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $mail=new PHPMailer(true);
        if( isset($_POST['voter_email'])){
            $gmail_id=$_POST['voter_email'];

            $sql="Select Email from voter_list";
            $result=mysqli_query($con,$sql);

            $flag=0;
            while($row = mysqli_fetch_assoc($result)){
                if($row['Email']==$gmail_id){
                    $flag=1;
                    break;
                }
            }
            if($flag==0){
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("No such Email ID found!"); 
                        window.location.href = "VoterLoginPage2.php";
                        }
                        </script>';
            }
            else{
                $otp=rand(00000,99999);
                $_SESSION['gmail_id']=$gmail_id;
                $_SESSION['otp']=$otp;

                //send email
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'navaneethnaren6@gmail.com';//your email
                $mail->Password = 'kiom hewv qarw gljz';//your gmail app password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPDebug = 0;

                $mail->setFrom('navaneethnaren6@gmail.com','E-Voting Portal');
                $mail->addAddress($gmail_id);

                $mail->isHTML(true);
                $mail->Subject = 'Reset Your Password: Your One-Time Password (OTP)';
                $mail->Body = "
                <html>
                <head>
                    <style>
                    .header{
                        background-color:black;
                        border:4px solid black;
                        height:0.8rem;
                        padding:8px 0 20px 0;
                    }
                    #c1{
                        font-size:20px;
                        color:#DEFBF9;
                        font-family: 'Times New Roman', Times, serif; 
                    }
                    </style>
                </head>
                <body>
                    <div class='header'>
                        <center id='c1'>GENERAL ELECTIONS - 2024</center>
                    </div>
                    <h2>Hello,</h2>
                    <p>We received a request to reset your password.</p>
                    <p>Your One-Time Password (OTP) is:</p>
                    <h3 style='color: #28a745;'>{$otp}</h3>
                    <p>Please use this OTP to reset your password. Once you've reset it, we recommend changing your password to something memorable but secure.</p>
                    <p>If you didn't request this change, please ignore this email or contact our support team for further assistance.</p>
                    <br>
                    <p>Thank you,<br>
                    E-Voting Portal</p>
                </body>
                </html>
                ";

                $mail->send();

                echo '<script type="text/javascript">
                    window.onload = function () { 
                    alert("Successfully sent the OTP"); 
                    window.location.href = "VoterEnterOTP.php";
                    }
                    </script>';
            }            
        }
        else if( isset($_POST['admin_email'])){
            $gmail_id=$_POST['admin_email'];

            $sql="Select Email from admin_login";
            $result=mysqli_query($con,$sql);

            $flag=0;
            while($row = mysqli_fetch_assoc($result)){
                if($row['Email']==$gmail_id){
                    $flag=1;
                    break;
                }
            }
            if($flag==0){
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("No such Email ID found!"); 
                        window.location.href = "AdminLoginPage3.php";
                        }
                        </script>';
            }
            else{
                $otp=rand(000000,999999);
                $_SESSION['gmail_id']=$gmail_id;
                $_SESSION['otp']=$otp;

                //send email
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'navaneethnaren6@gmail.com';//your email
                $mail->Password = 'kiom hewv qarw gljz';//your gmail app password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPDebug = 0;

                $mail->setFrom('navaneethnaren6@gmail.com','E-Voting Portal');
                $mail->addAddress($gmail_id);

                $mail->isHTML(true);
                $mail->Subject = 'Reset Your Password: Your One-Time Password (OTP)';
                $mail->Body = "
                <html>
                <head>
                    <style>
                    .header{
                        background-color:black;
                        border:4px solid black;
                        height:0.8rem;
                        padding:10px 0 20px 0;
                    }
                    #c1{
                        font-size:20px;
                        color:#DEFBF9;
                        font-family: 'Times New Roman', Times, serif; 
                    }
                    </style>
                </head>
                <body>
                    <div class='header'>
                        <center id='c1'>GENERAL ELECTIONS - 2024</center>
                    </div>
                    <h2>Hello,</h2>
                    <p>We received a request to reset your password.</p>
                    <p>Your One-Time Password (OTP) is:</p>
                    <h3 style='color: #28a745;'>{$otp}</h3>
                    <p>Please use this OTP to reset your password. Once you've reset it, we recommend changing your password to something memorable but secure.</p>
                    <p>If you didn't request this change, please ignore this email or contact our support team for further assistance.</p>
                    <br>
                    <p>Thank you,<br>
                    E-Voting Portal</p>
                </body>
                </html>
                ";

                $mail->send();


                echo '<script type="text/javascript">
                    window.onload = function () { 
                    alert("Successfully sent the OTP"); 
                    window.location.href = "AdminEnterOTP.php";
                    }
                    </script>';
            }            
        }
    }
?>

