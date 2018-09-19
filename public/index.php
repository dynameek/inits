<?php
    require_once '../app/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BizBuzz: </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            Asset::loadStyles(['general', 'colors', 'forms']);
            Asset::loadJavaScripts(['system', 'search'])
        ?>
        
        <style>
            .veil{
                display: flex;
                flex-direction: column;
                align-content: center;
                justify-content: center;
                text-align: center;
                color: #fff;
            }
            .veil h1{
                font-size: 4em;
                margin-bottom: 15px;
            }
            .veil h3{
                font-size: 1.5em;
                margin-bottom: 30px;
            }
            .form-wrapper{
                width: 600px;
                align-self: center;
                display: flex;
                flex-direction: row;
            }
            input[type='text']{
                margin: 0;
                height: 40px;
                width: 80%;
            }
            input[type='button']{
                margin: 0;
                width: 20%;
                height: 40px;
            }
        </style>
    </head>
    <body>
        <div class='page-wrapper'>
            <div class="landing-wrapper" style="background: url('../app/assets/images/index-back.jpg')">
                <div class="veil center-col-flex">
                    <h1>BizBuzz</h1>
                    <h3>The #1 business directory</h3>
                    <div class="form-wrapper">
                        <form name="search">
                            <div id="form-message"></div>
                            <input type="text" name="keyword" placeholder="Enter a keyword">
                            <input type="button" value="Search" id="search-btn" class="bg-cool-blue">
                        </form>
                    </div>
                </div>
            </div>   
        </div>
    </body>
</html>