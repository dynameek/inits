<?php
    #
    require_once('../init.php');
    
    /*  Set return parameters   */
    $retCode = 0;
    $retMsg = "";
    
    try{
        /*  Get data    */
        $admin = htmlspecialchars($_POST['admin']);
        $name = htmlspecialchars($_POST['name']);
        $desc = htmlspecialchars($_POST['desc']);
        $category = htmlspecialchars($_POST['cat']);
        $email = htmlspecialchars($_POST['email']);
        $web = htmlspecialchars($_POST['web']);
        $addr = htmlspecialchars($_POST['addr']);
        $phone1 = htmlspecialchars($_POST['phone1']);
        $phone2 = htmlspecialchars($_POST['phone2']);
        
        #   Create a, ID hash
        $listing_id = hash('sha256', $name);
        
        #   Create database object
        $db = new Database;
        $db->selectDb('inits');
        
        #   Create Listing object
        $listing = new Listing($listing_id, $db->getConn());
        $listing->setAdmin($admin);
        
        #   Attempt inserting record
        if($listing->insertBasicInfo($name, $desc, $category))
            if($listing->insertContactInfo($email, $web, $addr, $phone1, $phone2))
            {
                $retCode = true;
                $retMsg = "Listing Added.";
            }else $retMsg = "Unable to add Listing Contact";
        else $retMsg = "Unable to add listing basic";
        
        #   cloase database connection
        $db->closeConnection();
            
    }catch(Exception $e)
    {
        $retMsg = $e->getMessage();
    }
    
    echo '{"isSuccessful" : '.$retCode.', "message" : "'.$retMsg.'"}';