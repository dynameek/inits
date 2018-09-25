<?php
        
    if(isset($_GET['id']))
    {
        #   Get Listing Id
        $l_id = $_GET['id'];
        
        #   Create objects
        $db = new Database;
        $db->selectDb('inits');
        
        #
        $listing = new Listing($l_id, $db->getConn());
        
        #   Perform operations
        if($listing->fetchBasicInfo() && $listing->fetchContactInfo())
        {
            $listing->fetchImages();
            $listing->updateViewCount();
            
            #
            $basicInfo = $listing->getBasicInfo();
            $contactInfo = $listing->getContactInfo();
            $images = $listing->getImageUris();
            
            $imageUri = [];
            
            #   Build the uri string for images
            foreach($images as $name)
            {
                $imageUri[] = "../app/assets/images/uploaded/".$name;
            }
            $headerImage = isset($imageUri[0]) ? $imageUri[0] : '';
            
            #   Parse array of image uris to javascript
            $imageUriInJSON = json_encode($imageUri);
            echo "<script> var imageUri = '".$imageUriInJSON."'; imageUri = JSON.parse(imageUri)</script>";
        }   
        else header('location: ./');
    }else
    {
        header('location: ./');
    }