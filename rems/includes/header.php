<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['signup']))
  {
      
    $fname=$_POST['fullname'];
     $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $usertype=$_POST['usertype'];
       $password=md5($_POST['password']);

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
 echo "<script>alert('This email already associated with another account');</script>";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, Email, MobileNumber, Password,UserType) value('$fname', '$email','$mobno', '$password','$usertype' )");
    if ($query) {
 echo "<script>alert('You have successfully registered');</script>";
  }
  else
    {
    echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
}

//code for login
if(isset($_POST['signin']))
  {
     
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID,UserType,Email from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
$_SESSION['ut']=$ret['UserType'];
$_SESSION['remsuid']=$ret['ID'];
$_SESSION['uemail']=$ret['Email'];
   
     header('location:index.php');
    }
    else{
   echo "<script>alert('Invalid Details');</script>";
    }
  }


?>

<header id="navbar-spy" class="header header-1 header-transparent header-fixed">
            <nav id="primary-menu" class="navbar navbar-fixed-top">
                <div class="container-fluid" style="background-color: black;">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                 <a class="logo" href="index.php">
                    <img src="assets/images/manoj.png" height="45px" width="45px">
                    <strong style="color:#edca0c; font-size:18px;">Bhavishya Nidhi</strong>
                </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                        <ul class="nav navbar-nav nav-pos-center navbar-left" >
                            <!-- Home Menu -->
                            <li>
                                <a href="index.php" style="color:white;">home</a>
                               
                            </li>
                            <!-- li end -->

                             <li><a href="about.php" style="color:white;">about</a></li>

                        
                            <li><a href="properties-grid.php" style="color:white;">properties</a></li>

                            <li><a href="contact.php" style="color:white;">contact</a></li>
                              <!-- Profile Menu-->
                            <li class="has-dropdown" style="color:white; !important">
                                <?php if (strlen($_SESSION['remsuid']!=0)) {?>
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item" style="color:white; !important"> My Account</a>
                                <ul class="dropdown-menu" >
                                    <li><a href="user-profile.php" style="color:black;">user profile</a></li>
                                    <li><a href="change-password.php" style="color:black;">change password</a></li>
                                   <li><a href="logout.php" style="color:black;">Logout</a></li>
                                </ul>
                                <?php } ?>
                            </li>
                               <?php if (strlen($_SESSION['remsuid']==0)) {?>
                            <li>
                                <a href="admin/login.php" style="color:white;">admin</a>
                               
                            </li>
                        <?php } ?>
                        </ul>
                        <!-- Module Signup  -->

                        <div class="module module-login pull-left">
                            <?php if (strlen($_SESSION['remsuid']==0)) {?>  
                            <a class="btn-popup" data-toggle="modal" data-target="#signupModule" style="color:white;">Login</a>
                            <?php } ?>
                            <div class="modal register-login-modal fade" tabindex="-1" role="dialog" id="signupModule">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#login" data-toggle="tab">login</a>
                                                    </li>
                                                    <li><a href="#signup" data-toggle="tab">signup</a>
                                                    </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active" id="login">
                                                        <div class="signup-form-container text-center">
                                                            <form class="mb-0" method="post" name="signin">
                                                                
                                                                <div class="or-text">
                                                                <span style="color: blue">Bhavishya Nidhi</span>
                                                            </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" name="email" id="email" required="true" placeholder="Email Address">
                                                                </div>
                                                                <!-- .form-group end -->
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" name="password" id="password" required="true" placeholder="Password">
                                                                </div>
                                                               
                                                                <input type="submit" name="signin" class="btn btn--primary btn--block" value="Sign In">
                                                                <a href="forgot-password.php" class="forget-password">Forget your password?</a>
                                                            </form>
                                                            <!-- form  end -->
                                                        </div>
                                                        <!-- .signup-form end -->
                                                    </div>
                                                    <div class="tab-pane" id="signup">
                                                        <form class="mb-0" method="post" name="signup">
                                                            
                                                            <div class="or-text">
                                                                <span style="color: blue">REMS</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
                                                            </div>
                                                            <!-- .form-group end -->
                                                           <div class="form-group">
                                                                <input type="email" class="form-control" name="email" id="email" required="true" placeholder="Email Address">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" maxlength="10" required="true" placeholder="Mobile Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" class="form-control" name="password" id="password" required="true" placeholder="Password">
                                                            </div>
                                                             <div class="form-group">
                                                               
                                                                <input type="radio" name="usertype" value="1" checked="true">Broker &nbsp; &nbsp;<input type="radio" name="usertype" value="2" >Owner &nbsp; &nbsp; <input type="radio" name="usertype" value="3">User
                                                            </div>
                                                            <!-- .form-group end -->
                                                        
                                                            <input type="submit" class="btn btn--primary btn--block" name="signup" value="Register">
                                                        </form>
                                                        <!-- form  end -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                        <?php 


                        if (strlen($_SESSION['ut']!=3)) {


                            ?>
                        <div class="module module-property pull-left">
                            <a href="add-property.php"  class="btn" style="background-color:#edca0c;"><i class="fa fa-plus"></i> add property</a>
                        </div>
                        <?php  }
                       ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>

        </header>