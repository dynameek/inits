<?php
    require_once('../app/init.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            Asset::loadStyles(['general', 'layout', 'header', 'forms',
                                 'colors', 'site-specific']);
            Asset::loadJavaScripts(['system', 'add-listing']);
            echo "<script> localStorage.setItem('admin','".$_SESSION['admin']."');</script>";
        ?>
        <style>
            
        </style>
    </head>
    <body  class="bg-light-grey">
        <div class="page-wrapper">
            <?php Asset::loadViewElement('header');?>
            <section class="outer-wrapper">
                <section class="major-section listings">
                    <div class="form-wrapper">
                        <h3 class="form-title">New Listing</h3>
                        <form name="new_listing">
                            <div id="form-message"></div>
                            <input type="text" name="bizName" placeholder="Business Name"> 
                            <textarea type="text" name="bizDesc" placeholder="Description" rows='5' ></textarea>
                            <input type="text" name="bizCat" placeholder="categories (comma separated)" >
                            <input type="email" name="bizMail" placeholder="Business Email" >
                            <input type="text" name="bizWeb" placeholder="Website (e.g www.example.com)" >
                            <input type="text" name="bizAddr" placeholder="Address">
                            <input type="text" name="bizPhone1" placeholder="Phone Number (e.g +2348123456788)">
                            <input type="text" name="bizPhone2" placeholder="Phone Number (e.g +2348123456788)">
                            <input type='button' id="add-listing" value="Add Listing" class="bg-cool-blue">
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </body>
</html>