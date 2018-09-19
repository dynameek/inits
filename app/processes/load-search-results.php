<?php
    
    #
    if(isset($_SESSION['searchIndexes']))
    {
        #   get page
        if(!isset($_GET['page']) || ($_GET['page'] == 0 ))
            $page = 1;
        else   $page = $_GET['page'];
        
        #  Create objects
        $db = new Database;
        $db->selectDb('inits');
        
        echo $db->getErrMessage();
        
        $searchResult = new Result($db->getConn(), $page);
        $searchResult->getIndexesFromSession();
        $searchResult->getResultsFromDatabase();
        
    }else
    {
        header('Loaction: ./index.php');
    }