<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        if( isset($_POST['old']) && isset($_POST['new']) && isset($_POST['new1'])){
            $old=$_POST['old'];
            $new=$_POST['new'];
            $new1=$_POST['new1'];
            $admin_id=$_SESSION['admin_id'];
            if($_SESSION['password']==hash('sha256',$old)){
                if($new==$new1){
                    $newhash=hash('sha256',$new);
                    $sql="UPDATE admin_login SET `Password`='$newhash' WHERE Admin_ID=$admin_id";
                    $query=mysqli_query($con,$sql);
                    if($query){
                        echo '<script type="text/javascript">
                            window.onload = function () { 
                            alert("Successfully changed passwords"); 
                            window.location.href = "AdminLoginPage3.php"; 
                            }
                            </script>'; 
                    }
                }
                else{
                    echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("New Passwords dont match"); 
                        window.location.href = "ChangePassword.php"; 
                        }
                        </script>';    
                }
            }
            // else{
            //     echo '<script type="text/javascript">
            //             window.onload = function () { 
            //             alert("Wrong Old Password ");
            //             window.location.href = "ChangePassword.php"; 
            //             }
            //             </script>';
            // }
        }
    }
?>