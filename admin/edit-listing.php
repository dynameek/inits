<?php
    require_once('../app/init.php');
    require_once '../app/processes/load_listing.php';
    require_once '../app/processes/upload-image.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            Asset::loadStyles(['general', 'layout', 'header', 'forms',
                                 'colors', 'spans','site-specific']);
            Asset::loadJavaScripts(['system', 'edit-listing'])
        ?>
        <style>
            .form-wrapper{
                border: 1px solid #ccc;
            }
            form{
                padding-bottom: 0;
            }
            .listing-images
            {
                border-bottom: 1px solid #ccc;
                margin-bottom: 10px;
                padding: 10px;
            }
            .listing-image{
                width: 50px;
                height: 50px;
                
                border: 1px solid #aaa;
            }
        </style>
    </head>
    <body  class="bg-light-grey">
        <div class="page-wrapper">
            <?php Asset::loadViewElement('header');?>
            <section class="outer-wrapper">
                <section class="major-section listings">
                    <div id="listingId" listing-id="<?php echo $listingId?>" admin-id="<?php echo $_SESSION['admin']?>"></div>
                    <div class="form-wrapper">
                        <h3 class="form-title">Basic</h3>
                        <form name="listing_basic">
                            <div id="form-message"></div>
                            <input type="text" name="bizName" placeholder="Business Name" value="<?=$listingName?>"> 
                            <textarea type="text" name="bizDesc" placeholder="Description" rows='5'><?=$listingDesc?></textarea>
                            <input type="text" name="bizCat" placeholder="categories (comma separated)" value="<?=$listingCat?>">
                            <input type='button' name="basic-btn" id="basic" value="Save" class="bg-cool-blue">
                        </form>
                    </div>
                    <div class="form-wrapper">
                        <h3 class="form-title">Contact Info</h3>
                        <form name="listing_contact">
                            <input type="Email" name="bizMail" placeholder="Business Email" value="<?=$listingEmail?>">
                            <input type="text" name="bizWeb" placeholder="Website (e.g www.example.com)" value="<?=$listingWebsite?>" >
                            <input type="text" name="bizAddr" placeholder="Address" value="<?=$listingAddress?>" >
                            <input type="text" name="bizPhone1" placeholder="Phone Number (e.g +2348123456788)" value="<?=$listingPhone1?>" >
                            <input type="text" name="bizPhone2" placeholder="Phone Number (e.g +2348123456788)" value="<?=$listingPhone2?>" >
                            <input type='button' name="contact-btn" id="contact" value="Save" class="bg-cool-blue">
                        </form>
                    </div>
                    <div class="form-wrapper">
                        <h3 class="form-title">Images</h3>
                        
                        <form name="listing_image" action="" method="post" enctype="multipart/form-data">
                            <div class="listing-images">
                                <div>
                                    <div class="listing-image">
                                        
                                    </div>
                                    <span class="icon remove right" id="remove"></span>
                                </div>
                                <?php
                                
                                    print_r($images);
                                ?>
                            </div>
                            <input type="file" name="new_image">
                            <input type='submit' name="image-btn" value="Upload Image" class="bg-cool-blue">
                            <input type='button' name="remove" id="delete" value="Delete Listing" class="bg-red">
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </body>
</html>