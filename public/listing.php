<?php
    #
    require_once '../app/init.php';
    require_once '../app/processes/load-listing-public.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            Asset::loadStyles(['general', 'layout', 'header','colors', 'forms', 'links', 'spans', 'site-specific']);
            Asset::loadJavaScripts(['system', 'search', 'Listing']);
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
                
                background: url(<?php echo "'".$headerImage."'"?>);
                background-position: center;
            }
            .listing-info-wrap, .listing-contact-wrap{
                min-height: 80px;
                border: 1px solid #ddd;
                border-top: none;
                
                padding: 20px;
                
                background: #fff;
            }
            .listing-stat
            {
                border-bottom: 1px solid #ddd;
                margin: 5px 0;
                padding-bottom: 5px;
            }
            .listing-contact-wrap{
                border: 1px solid #ddd;
                margin-top: 20px;
            }
            .listing-contact-wrap > div {
                margin-bottom: 10px;
            }
            .listing-contact-wrap > div:last-child {
                margin-bottom: 0px;
            }
            .listing-image-wrap{
                height: auto;
                margin: 25px 0;
                
                overflow-x: scroll;
                
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
                        <div class="listing-stat">
                            <span class="icon view"></span><?=$basicInfo['views'] ?>
                            <span class="icon date"></span><?=date('j M, Y',$basicInfo['date_created']) ?>
                        </div>
                        <p><?=$basicInfo['description'] ?></p>
                    </div>
                    <div class="listing-contact-wrap">
                        <div>
                            <span class="icon icon-lg email"></span><?=$contactInfo['email'] ?>
                        </div>
                        <div>
                            <span class="icon icon-lg location"></span><?=$contactInfo['address'] ?>
                        </div>
                        <div>
                            <span class="icon icon-lg uri"></span><?=$contactInfo['website'] ?>
                        </div>
                        <div>
                            <span class="icon icon-lg phone"></span><?=$contactInfo['phone_1'] .", ".$contactInfo['phone_2'] ?>
                        </div>
                        
                    </div>
                    <div class="listing-image-wrap row-flex" id='listing-image-wrap'>
                        
                    </div>
                </section>
            </section>
        </div>
    </body>
</html>