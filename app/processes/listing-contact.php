<?php
    require_once '../init.php';
    
    #
    $retCode = 0;
    $retMsg = "";
    
    #   Retreive request body
    $bizId = htmlspecialchars($_POST['id']);
    $admin = htmlspecialchars($_POST['admin']);
    $mail = htmlspecialchars($_POST['mail']);
    $addr = htmlspecialchars($_POST['addr']);
    $web = htmlspecialchars($_POST['web']);
    $phone1 = htmlspecialchars($_POST['phone1']);
    $phone2 = htmlspecialchars($_POST['phone2']);
    
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
            
            if($listing->insertContactInfo($mail, $web, $addr, $phone1, $phone2))
            {
                $retCode = 1;
                $retMsg = "Listing contact added successfully.";
            }else $retMsg = "Could not add Listing contact.";
        }else
        {
            #   Attempt an update
            $listing = new Listing($bizId , $admin, $db->getConn());
            if($listing->updateContactInfo($mail, $addr, $web, $phone1, $phone2))
            {
                $retCode = 1;
                $retMsg = "Listing contact updated successfully.";
            }else $retMsg = "Failed to update Listing contact.";
        }
        
        /*  Close database connection   */
        $db->closeConnection();
    }catch(Exception $e)
    {
        $retMsg = $e->getMessage();
    }
    
    echo '{"isSuccessful" : '.$retCode.', "message" : "'.$retMsg.'"}';
    
    