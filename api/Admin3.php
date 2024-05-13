<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        if( isset($_POST['admin_id']) && isset($_POST['password'])){
            $admin_id=$_POST['admin_id'];
            $pass=$_POST['password'];


            //hash the password retreived from the login page
            $passhash=hash('sha256',$pass);
            //query
            $sql="SELECT * FROM admin_login where Admin_ID=$admin_id and Password='$passhash'";

            //execute the query
            $query = mysqli_query($con,$sql);
            //if more than one entries are present
            if(mysqli_num_rows($query)>0 && $row=mysqli_fetch_assoc($query)){
                $_SESSION['admin_id']=$row['Admin_ID'];
                $_SESSION['name']=$row['Name'];
                $_SESSION['mailid']=$row['Email'];
                $_SESSION['post']=$row['Post'];
                $_SESSION['password']=$row['Password'];
                $_SESSION['image']=$row['Admin_Image'];

                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Successful Login !!"); 
                        window.location.href = "AdminPage7.php";
                        }
                        </script>';
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Wrong Credentials"); 
                        window.location.href = "AdminLoginPage3.php"; 
                        }
                        </script>';
            }
        }
    }
?>
