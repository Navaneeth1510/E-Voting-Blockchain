<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        $captcha=$_POST['captcha'];
        $email=$_SESSION['gmail_id'];
        if($captcha==$_SESSION['captcha']){
            if($pass1==$pass2){
                $passhash=hash('sha256',$pass1);
                $sql = "UPDATE admin_login SET Password='$passhash' WHERE Email='$email'";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo '<script type="text/javascript">
                            window.onload = function () { 
                            alert("Successfully changed password!"); 
                            window.location.href = "AdminLoginPage3.php";
                            }
                            </script>';
                }
                else{
                    echo '<script type="text/javascript">
                            window.onload = function () { 
                            alert("Some error occured!"); 
                            window.location.href = "AdminLoginPage3.php";
                            }
                            </script>';
                }
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Passwords dont match!"); 
                        window.location.href = "AdminChangePassword.php";
                        }
                        </script>';
            }
        }
        else{
            echo '<script type="text/javascript">
                    window.onload = function () { 
                    alert("Wrong Captcha!"); 
                    window.location.href = "AdminChangePassword.php";
                    }
                    </script>';
        }
    }
?>