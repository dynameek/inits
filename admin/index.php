<?php
    require_once('../app/init.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            Asset::loadStyles(['general', 'layout', 'colors', 'forms']);
            Asset::loadJavaScripts(['system', 'register']);
        ?>
        
        <style>
            .dark-veil {
                text-align: center;
                color: #fff;
            }
            .dark-veil > h1:first-child{
                font-size: 5.6em;
            }
            .dark-veil > h1{
                font-size: 4.0em;
            }
            .dark-veil > p{
                font-size: 1.75em;
                color: #ccc;
            }
            .dark-veil > hr{
                width: 100px;
            }
            a{
                text-decoration: none;
            }
            a[class='button']{
                align-self: center;
                width: 200px;
                border: 2px solid;
                border-radius: 50px;
                margin-top: 25px;
                padding: 15px 0;
                
                font-size: 1.35em;
                color: #fff;
            }
            
            .form-wrapper{
                align-self: center;
                width: 400px;
                
                border-radius: 5px;
                
                background: #fff;
            }
            .form-wrapper > h3{
                border-bottom: 1px solid #ddd;
                padding: 10px 15px;
                padding-bottom: 5px;
            }
            
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="landing-wrapper" style="background: url('../app/assets/images/index-back.jpg')">
                <div class="dark-veil center-col-flex">
                    <h1>YOUR BUSINESS</h1>
                    <h1>MAXIMUM EXPOSURE</h1>
                    <hr>
                    <p>Let us help you give your business the best exposure it needs</p>
                    <a class="button" href="#register">Start Here</a>
                </div>
            </div>
            <div class="full-screen bg-grey center-col-flex" id="register">
                <div class="form-wrapper">
                    <h3>Create Account</h3>
                    <form name="register">
                        <div id="form-message"></div>
                        <input type="text" name="fName" placeholder="First Name">
                        <input type="text" name="lName" placeholder="Last Name">
                        <input type="email" name="email" placeholder="Email Address">
                        <input type="password" name="passwd" placeholder="Password">
                        <input type="password" name="cPasswd" placeholder="Confirm Password">
                        <input type="button" id="reg-btn" value="Register" class="bg-dark-blue">
                        <div><a href="./login.php">Log In</a></div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>