<?php
    session_start();
    $con=mysqli_connect('localhost','root','','e-voting') or die("Connection failed: ".mysqli_connect_error());
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        if( isset($_POST['voter_id']) && isset($_POST['password'])){
            $voter_id=$_POST['voter_id'];
            $password=$_POST['password'];
            $passhash=hash('sha256',$password);
            //query
            $sql="SELECT * FROM voter_list where Voter_ID=$voter_id and Password='$passhash'";
            $sql1="SELECT Status FROM election";
            //execute the query
            $query = mysqli_query($con,$sql);
            $query1 = mysqli_query($con,$sql1);
            $row1=mysqli_fetch_assoc($query1);
            //if more than one entries are present
            if(mysqli_num_rows($query)>0){
                //fetch all the entries and store it in row
                $row=mysqli_fetch_assoc($query);
                //Status=>1 election going on
                if($row1['Status']==1){
                    if($row['Status']==0){
                        $_SESSION['voter_id']=$row['Voter_ID'];
                        $_SESSION['fname']=$row['FName'];
                        $_SESSION['lname']=$row['LName'];
                        $_SESSION['dob']=$row['DOB'];
                        $_SESSION['address']=$row['Address'];
                        $_SESSION['email']=$row['Email'];
                        $_SESSION['voter_img']=$row['Voter_Image'];
                        echo '<script type="text/javascript">
                                window.onload = function () { 
                                alert("Successful Login !!"); 
                                window.location.href = "VoterAgreePage4.php";
                                }
                                </script>';
                    }
                    else{
                        echo '<script type="text/javascript">
                                window.location.href = "AlreadyVotedPage.php";
                                </script>';
                    }
                }
                //Status=>0 election stopped
                else{
                    echo '<script type="text/javascript">
                            window.location.href = "ElectionOver.php";
                            </script>';
                }
            }
            else{
                echo '<script type="text/javascript">
                        window.onload = function () { 
                        alert("Wrong Credentials"); 
                        window.location.href = "VoterLoginPage2.php"; 
                        }
                        </script>';
            }
        }
    }
?>