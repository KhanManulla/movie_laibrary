
<?php 
include 'include/config.php';
if(!empty($_SESSION['userid']))
{
  header("location:index.php");
}

if(isset($_POST['signup']))
{ 
    $name='';
    $email='';
    $password='';

    if(empty($_POST['name'])){
        $nameerror="Please fill name field are mandatory";
    }else{
        $name=validateinput($_POST['name']);
    }


    if(empty($_POST['email'])) {
        $emailerror="Please fill email field are mandatory";
    } else {
         if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            $emailerror="* Invalid Email Format";
        }else{
            $email=validateinput($_POST['email']);
        }
    }


    if(empty($_POST['password'])){
        $passworderror="Please fill password field are mandatory";
    }else{
       $password=validateinput($_POST['password']);
    }



    if($name==True && $email==True && $password==True)
    {
        $sql="insert into user(name,email,password) values('".$name."','".$email."','".$password."')";
        $res =mysqli_query($conn,$sql);
        if($res)
        {
            $success="Account Created Successfully !";
        }
        else
        {
            $failed="Failed To Create Acccount";
        }
    }
}


function validateinput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="container login-container">
            <div class="row">
              <div class="col-md-4 col-xs-4">
              </div>

                    <div class="col-md-4 col-xs-4 login-form-1">


                    <h3>Signup</h3>

                    <h6 align="center" style="color:green;"><?php if(isset($success)){echo $success; } ?></h6>


                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text"  id="name" class="form-control" name="name" placeholder="Enter your name*" value="" />
                            <?php if(isset($nameerror)) { ?>
                                <small class="form-text text-danger"><?php echo $nameerror; ?></small>
                            <?php } ?>
                        </div>  
                        <div class="form-group">
                            <input type="text" id="email1" name="email" class="form-control" placeholder="Enter your Email *" value="" />
                              <?php if(isset($emailerror)) { ?>
                                <small class="form-text text-danger"><?php echo $emailerror; ?></small>
                            <?php } ?>
                        </div>  
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Your Password *" value="" />
                              <?php if(isset($passworderror)) { ?>
                                <small class="form-text text-danger"><?php echo $passworderror; ?></small>
                            <?php } $passworderror=''; ?>
                        </div>
                        <div class="form-group">
                            <button name="signup" class="btnSubmit">Signup</button>
                        </div>
                        <div class="form-group">
                            <a href="login.php" class="ForgetPwd">click here to login</a>
                        </div>
                    </form>
                </div>

                 <div class="col-md-4 col-xs-4">
              </div>



            </div>
        </div>

        <style type="text/css">
           #email1:hover { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }
     #name:hover { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }
     #password:hover { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }

   #email1:focus { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }
   #name:focus { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }


    #password:focus { 
       /* border:5px solid orange;*/
        box-shadow: 0 0 10px orange;
    }


          .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}

.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: orange;
}
.login-form-1 .ForgetPwd{
    color: orange;
    font-weight: 600;
    text-decoration: none;
}

        </style>