<?php
    #
    require_once('../init.php');
    
    #   Return variables
    $retCode = 0;
    $retMsg = "No Match found.";
    
    #   GET data;
    $keywords = htmlspecialchars($_GET['q']);
    
    #   Create objects
    $db = new Database;
    $db->selectDb('inits');
    
    $search = new Search($keywords, $db->getConn());
    $search->saveIndexesToSession();
    
    if(isset($_SESSION['searchIndexes']))
        if($_SESSION['searchIndexes'] !== [])
        {
            $retCode = 1;
            $retMsg = "search successful";
        }
        
    #
    $db->closeConnection();
    
    echo '{"success": '.$retCode.', "body" : "'.$retMsg.'"}';
?>