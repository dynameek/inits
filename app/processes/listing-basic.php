<?php
    require_once '../init.php';
    
    #
    $retCode = 0;
    $retMsg = "";
    
    #   Retreive request body
    $bizId = htmlspecialchars($_POST['id']);
    $admin = htmlspecialchars($_POST['admin']);
    $bizName = htmlspecialchars($_POST['name']);
    $bizDesc = htmlspecialchars($_POST['desc']);
    $bizCat = htmlspecialchars($_POST['category']);
    
    try{
        #   Create Objects
        $db = new Database;
        $db->selectDb('inits');
        
        #   Check if bizId is set
        if(empty($bizId))
        {
            #   If bizId  is empty, we are adding new information to the database
            $bizId = hash('sha256', strtolower($bizName));
            
            $listing = new Listing($bizId, $db->getConn());
            $listing->setAdmin($admin);
            
            if($listing->insertBasicInfo($bizName, $bizDesc, $bizCat))
            {
                $retCode = 1;
                $retMsg = "Listing added successfully.";
            }else $retMsg = "Could not add Listing.";
        }else
        {
            #   Attempt an update
            $listing = new Listing($bizId , $admin, $db->getConn());
            if($listing->updateBasicInfo($bizName, $bizDesc, $bizCat))
            {
                $retCode = 1;
                $retMsg = "Listing updated successfully.";
            }else $retMsg = "Failed to update Listing";
        }
        
        /*  Close database connection   */
        $db->closeConnection();
    }catch(Exception $e)
    {
        $retMsg = $e->getMessage();
    }
    
    echo '{"isSuccessful" : '.$retCode.', "message" : "'.$retMsg.'"}';
    
    