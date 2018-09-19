<?php
    /*  */
    require_once '../init.php';
    
    #   Return values
    $retCode = 0;
    $retMsg = "";
    
    try
    {
        #   Get listing id and admin id
        $l_id = htmlspecialchars($_POST['id']);
        $a_id = htmlspecialchars($_POST['admin']);
        
        #   Create database objetc
        $db = new Database;
        $db->selectDb('inits');
        
        #   Create Listing object
        $listing = new Listing($l_id, $db->getConn());
        $listing->setAdmin($a_id);
        
        #   perform delete operation
        if($listing->delete())
        {
            $retCode = 1;
            $retMsg = "Delete sucessful";
        }else $retMsg = "Unable to delete listing";
        
        #   close connection
        $db->closeConnection();
    }catch(Exception $e)
    {
        $retMsg = $e->getMessage();
    }
    
    echo '{"isSuccessful" : '.$retCode.', "message": "'.$retMsg.'"}';