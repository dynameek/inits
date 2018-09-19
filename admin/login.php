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
            Asset::loadJavaScripts(['system', 'login']);
        ?>
        
        <style>
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
            <div class="full-screen bg-grey center-col-flex" id="register">
                <div class="form-wrapper">
                    <h3>Log In</h3>
                    <form name="login">
                        <div id="form-message"></div>
                        <input type="email" name="email" placeholder="Email Address">
                        <input type="password" name="passwd" placeholder="Password">
                        <input type="button" id="lg-btn" value="Log In" class="bg-dark-blue">
                        <div><a href="./index.php#register">Create account</a></div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>