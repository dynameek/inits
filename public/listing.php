<?php
    #
    require_once '../app/init.php';
    
    if(isset($_GET['id']))
    {
        #   Get Listing Id
        $l_id = $_GET['id'];
        
        #   Create objects
        $db = new Database;
        $db->selectDb('inits');
        
        #
        $listing = new Listing($l_id, $db->getConn());
        
        #   Perform operations
        if($listing->fetchBasicInfo() && $listing->fetchContactInfo())
        {
            $basicInfo = $listing->getBasicInfo();
            $contactInfo = $listing->getContactInfo();
        }   
        else header('location: ./');
    }else
    {
        header('location: ./');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            Asset::loadStyles(['general', 'layout', 'header','colors', 'forms', 'links', 'site-specific']);
            Asset::loadJavaScripts(['system', 'search']);
        ?>
        
        <style>
            header{
                padding-top: 2.5px;
            }
            .site-icon{
                font-size: 1.80em;
            }
            form[name='search']{
               display: flex;
               flex-direction: row;
               
               width: 500px;
            }
            input{
                height: 32.5px;
            }
            
            .major-section{
                width: 60%;
                padding-left: 15%;
            }
            .listing-header{
                height: 250px;
                
                background: #C991BF;
            }
            .listing-info-wrap, .listing-contact-wrap{
                min-height: 80px;
                border: 1px solid #ddd;
                border-top: none;
                
                padding: 20px;
                
                background: #fff;
            }
            .listing-contact-wrap{
                border: 1px solid #ddd;
                margin-top: 20px;
            }
            .listing-image-wrap{
                height: 250px;
                margin: 25px 0;
                
                background: #fff;
            }
        </style>
    </head>
    <body  class="bg-light-grey">
        <div class="page-wrapper">
           <?php Asset::loadViewElement('header-public');?>
            <section class="outer-wrapper">
                <section class="major-section">
                    <div id="form-message"></div>
                    <div class="listing-header">
                        
                    </div>
                    <div class="listing-info-wrap">
                        <h3><?=$basicInfo['name'] ?></h3>
                        <div>
                            <span id="view"></span><?=$basicInfo['views'] ?>
                            <span id="date"></span><?=date('j M, Y',$basicInfo['date_created']) ?>
                        </div>
                        <p><?=$basicInfo['description'] ?></p>
                    </div>
                    <div class="listing-contact-wrap">
                        
                        <span id="email"></span><?=$contactInfo['email'] ?>
                        <span id="address"></span><?=$contactInfo['address'] ?>
                        <span id="website"></span><?=$contactInfo['website'] ?>
                        <span id="phone"></span><?=$contactInfo['phone_1'] .", ".$contactInfo['phone_2'] ?>
                    </div>
                    <div class="listing-image-wrap">
                        
                    </div>
                </section>
            </section>
        </div>
    </body>
</html>