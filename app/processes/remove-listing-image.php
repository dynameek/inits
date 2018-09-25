<?php
    require_once '../init.php';
    
    #
    $retCode = 0;
    $retMsg = "Unable to remove Image";
    # get id
    if(isset($_POST['id']))
    {
        #
        $id = htmlspecialchars($_POST['id']);
        $listingId = htmlspecialchars($_POST['listing']);
        
        #
        $db = new Database;
        $db->selectDb('inits');
        
        $listing = new Listing($listingId, $db->getConn());
        if($listing->deleteImage($id))
        {
            $retCode = 1;
            $retMsg = "Image Removed";
        }
        
        $db->closeConnection();
    }
    
    echo '{"isSuccessful" : '.$retCode.', "message": "'.$retMsg.'"}';
?>