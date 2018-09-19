<?php
    require_once '../app/init.php';
    require_once '../app/processes/load-dashboard.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INITS:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php Asset::loadStyles(['general', 'layout', 'header','colors', 'site-specific'])?>
        
        <style>
            
        </style>
    </head>
    <body  class="bg-light-grey">
        <div class="page-wrapper">
           <?php Asset::loadViewElement('header');?>
            <section class="outer-wrapper">
                <section class="major-section listings">
                    <?php
                        $admin->displayListings();
                    ?>
                </section>
            </section>
        </div>
    </body>
</html>