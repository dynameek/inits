<?php
    #
    require_once '../app/init.php';
    require_once '../app/processes/load-search-results.php';
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
        </style>
    </head>
    <body  class="bg-light-grey">
        <div class="page-wrapper">
           <?php Asset::loadViewElement('header-public');?>
            <section class="outer-wrapper">
                <section class="major-section listings">
                    <div id="form-message"></div>
                    <?php
                        if(isset($searchResult)) $searchResult->displayResults();
                    ?>
                </section>
            </section>
        </div>
    </body>
</html>