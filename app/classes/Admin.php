 <?php

    class Admin
    {
        /*  PROPERTIES  */
        private $id;
        private $handle;
        private $info = [];
        private $listings = [];
        
        /*  METHODS */
        public function __construct($id, $handle)
        {
            $this->id = $id;
            $this->handle = $handle;
        }
        
        /*  GETTERS */
        public function getInfo()
        {
            return $this->info;
        }
        
        public function getListings()
        {
            return $this->listings;
        }

        public function displayListings()
        {
            foreach ($this->listings as $key => $value) {
                $listing = "<div class='listing card'>";
                $listing .=  "<h3>".$value[0]."<a href='./edit-listing.php?id=".$key."'><span class='edit'></span></a></h3>";
                $listing .=  "<p>".wordwrap($value[1], 150)."</p>";
                $listing .=  "<div class ='extra'>
                                <span class='views'></span>".$value[3].
                                "<span class='date'></span>".date('j M, Y', $value[4]).
                             "</div>";
                $listing .= "</div>";
                
                echo $listing;
            }
        }
        /*
         *  @method bool fetchInfo()
         *  Fetch user's information from database
         *
         *  Returns true on success, false otherwise
        */
        public function fetchInfo()
        {
            $retVal = false;
            $query = "
                SELECT firstname, lastname, email FROM admin
                WHERE id ='".$this->id."' AND is_active = 'yes' LIMIT 1
            ";
            $query_run = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1)
            {
                $results = mysqli_fetch_assoc($query_run);
                $this->info['firstname'] = $results['firstname'];
                $this->info['lastname'] = $results['lastname'];
                $this->info['email'] = $results['email'];
                
                $retVal = true;
            }
            
            return $retVal;
        }
        
        /*
         *  @method fetchListings()
         *  Fetch all listings posting by user
         *
         *  Returns true on success, false otherwise
        */
        public function fetchListings()
        {
            $retVal = false;
            $query = "SELECT id, name, description, category, views, date_created
                      FROM listing
                      WHERE admin = '".$this->id."' AND is_active = 'yes'
            ";
            $query_run = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) >= 1)
            {
                for($i = 0; $i < mysqli_affected_rows($this->handle); $i++)
                {
                    $result = mysqli_fetch_assoc($query_run);
                    $this->listings[$result['id']][] = $result['name'];
                    $this->listings[$result['id']][] = $result['description'];
                    $this->listings[$result['id']][] = $result['category'];
                    $this->listings[$result['id']][] = $result['views'];
                    $this->listings[$result['id']][] = $result['date_created'];
                }
                $retVal = true;
            }
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool updateLogin()
         *  Update admin's login time
         *
         *  returns true on success, false otherwise
        */
        public function updateLogin()
        {
            $retVal = false;
            $time = time();
            $query = "UPDATE admin_extra SET last_login = '".$time."'
                      WHERE admin = '".$this->id."'
            ";
            mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool updateInfo(str $firstName, str $lastName, str $email)
         *  updates admin information
         *
         *  Returns true on success, false otherwise
         *
        */
        public function updateInfo($firstName, $lastName, $email)
        {
            $retVal = false;
            $query = "UPDATE admin SET firstname = '".$firstName."',
            lastname = '".$lastName."', email = '".$email."'
            WHERE id = '".$this->id."' LIMIT 1";
            mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1) $retVal = true;
            
            #
            return $retVal;
        }
    }