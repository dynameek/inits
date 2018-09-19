<?php
    #
    if(isset($_POST['image-btn']) && (!empty($_POST['image-btn'])))
    {
        #   Default error code
        $errCode = 3;
        #   If submit image btn is clicked
        $imageFile = $_FILES['new_image'];
        
        #   Get the image type
        $imageType = trim((explode('/', $imageFile['type']))[1]);
        
        #   Check file type
        if(!preg_match('(jpeg|png)', $imageType))
        {
            $errMsg = "Invalid Image File";
            
        }elseif($imageFile['size'] > 1000000) # Check for file size
        {
            $errMsg = "File is greater than 1MB";
        }
        else{
            #   It is of the allowed MIME extension
            $imagePath = $_SERVER['DOCUMENT_ROOT']."/inits/app/assets/images/uploaded/";
            $permanentImageName = $imagePath.$listingName.rand(0, 99).".".$imageType;
            if(move_uploaded_file($imageFile['tmp_name'], $permanentImageName))
            {
                #   Create Objects
                $listing->insertImage($permanentImageName);
                $errCode = 1;
                $errMsg = "Image Successfully Added.";
            }else $errMsg = "Image Could not be uploaded.";
        }
    }
    
    echo "<script>localStorage.setItem('image-err', '".$errMsg."');localStorage.setItem('image-code', '".$errCode."'); </script>";
?>