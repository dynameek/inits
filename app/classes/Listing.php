<?php
    /*  */
    class Listing
    {
        /*  */
        private $id;
        private $adminId;
        private $handle;
        private $info = [];
        private $contactInfo = [];
        private $imageUris = [];
        private $categories = [];
        
        
        /*  */
        public function __construct($id, $handle)
        {
            $this->id = $id;
            $this->handle = $handle;
        }

        /*  GETTERs */
        public function getBasicInfo()
        {
            return $this->info;
        }

        public function getContactInfo()
        {
            return $this->contactInfo;
        }
        
        public function getImageUris()
        {
            return $this->imageUris;
        }
        
        /*
         *  @method bool fetchBasicInfo()
         *  Fetch the listing's basic information
         *  (name, description, category, views, date_created)
         *
         *  Returns true on success. False otherwise
         *
        */
        public function fetchBasicInfo()
        {
            $retVal = false;
            $query = "
                SELECT name, description, category, views, date_created
                FROM listing WHERE id = '".$this->id."' AND is_active = 'yes'
                LIMIT 1
            ";
            $query_run = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1)
            {
                $queryResult = mysqli_fetch_assoc($query_run);
                $this->info['name'] = $queryResult['name'];
                $this->info['description'] = $queryResult['description'];
                $this->info['category'] = $queryResult['category'];
                $this->info['views'] = $queryResult['views'];
                $this->info['date_created'] = $queryResult['date_created'];
                
                $retVal = true;
            }
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool fetchContactInfo()
         *  fetch the listing's contact information
         *
         *  Returns true on success, false otherwise
        */
        public function fetchContactInfo()
        {
            $retVal = false;
            $query = "
                SELECT email, address, website, phone_1, phone_2
                FROM listing_contact WHERE listing = '".$this->id."'
                LIMIT 1
            ";
            $query_run = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1)
            {
                $queryResult = mysqli_fetch_assoc($query_run);
                $this->contactInfo['email'] = $queryResult['email'];
                $this->contactInfo['address'] = $queryResult['address'];
                $this->contactInfo['website'] = $queryResult['website'];
                $this->contactInfo['phone_1'] = $queryResult['phone_1'];
                $this->contactInfo['phone_2'] = $queryResult['phone_2'];
                
                $retVal = true;
            }
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool fetchImages()
         *  Fetch the listings image uri's
         *
         *  returns true, on success. false, otherwise
        */
        public function fetchImages()
        {
            $retVal = false;
            $query = "
                SELECT id, image FROM listing_images
                WHERE listing = '".$this->id."' AND is_active = 'yes'
            ";
            $query_run = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) >= 1)
            {
                for($i = 0; $i < mysqli_affected_rows($this->handle); $i++)
                {
                    $queryResult = mysqli_fetch_assoc($query_run);
                    $this->imageUris[$queryResult['id']] = $queryResult['image'];
                }
                
                $retVal = true;
            }
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool insertBasicInfo(str $name, str $description, str $category)
         *  Inserts a new record for a listing's basic information
         *
         *  returns true on success. false, otherwise.
        */
        public function insertBasicInfo($name, $description, $category)
        {
            $retVal = false;
            $timeStamp = time();
            $query = "
                INSERT INTO listing(id, name, description,
                category, admin, views, date_created, is_active)
                VALUES('".$this->id."', '".$name."', '".$description."',
                '".$category."','".$this->adminId."', 0, '".$timeStamp."', 'yes')
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool insertContactInfo(str $email, str $website,
         *  str $address, str $phone_1, str $phone_2)
         *  insert new record for listing's contact info.
         *
         *  returns true, on success. false, otherwise.
        */
        public function insertContactInfo($email = "", $website ="", $address = "", $phone_1 ="", $phone_2 = "")
        {
            $retVal = false;
            $query = "
                INSERT iNTO listing_contact(listing, email, website, address, phone_1, phone_2)
                VALUES('".$this->id."', '".$email."', '".$website."', '".$address."',
                '".$phone_1."', '".$phone_2."')
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool insertImages(str $url)
         *  insert a new record a listing's image uri
         *
         *  returns true, on success. false, otherwise
         *
        */
        public function insertImage($uri)
        {
            $retVal = false;
            $query = "
                INSERT INTO listing_images(listing, image, is_active)
                VALUES('".$this->id."', '".$uri."', 'yes')
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool updateBasicInfo(str $name, str $desc, $cat)
         *  update a listing's basic information
         *
         *  returns true, on success. false, otherwise.
        */
        public function updateBasicInfo($name, $desc, $cat)
        {
            $retVal = false;
            $query = "
                UPDATE listing SET name = '".$name."', description = '".$desc."',
                category = '".$cat."' WHERE id = '".$this->id."'
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }

        /*
         *  @method bool updateContactInfo(
         *   str $email, str $addr, str $webUri, str $phone1, str $phone2 
         *  )
         *  update a listing's contact information
         *
         *  returns true, on success. false, otherwise.
        */
        public function updateContactInfo($email, $addr, $web, $phone1, $phone2)
        {
            $retVal = false;
            $query = "
                UPDATE listing_contact SET email = '".$email."', address = '".$addr."',
                website = '".$web."', phone_1 = '".$phone1."', phone_2 = '".$phone2."'
                WHERE listing = '".$this->id."'
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *
         *
        */
        public function updateViewCount()
        {
            $retVal = false;
            $query = "UPDATE listing SET views = (views + 1)
                WHERE id='".$this->id."' LIMIT 1
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool delateImage(str $image_id)
         *  deactivates a listing's image
         *
         *  return true, on success. false, otherwise
        */
        public function deleteImage($image_id)
        {
            $retVal = false;
            $query = "
                UPDATE listing_images SET is_active = 'no'
                WHERE id = '".$image_id."' AND listing = '".$this->id."'
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool delete()
         *  remove a listing
         *
         *  return true, on success. false, otherwose.
        */
        public function delete()
        {
            $retVal = false;
            $query = "
                UPDATE listing SET is_active = 'no'
                WHERE id = '".$this->id."' LIMIT 1
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /**/
        public function setAdmin($adminId)
        {
            $this->adminId = $adminId;
        }
    }