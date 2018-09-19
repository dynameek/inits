<?php
    /*  */
    class Guest
    {
        /*  */
        private $handle;
        private $loginInfo = [];
        private $message;
        
        /*  */
        public function __construct($handle)
        {
            $this->handle = $handle;
        }
        
        /*
         *  @method bool doesAdminExist(str $email)
         *  checks if the administrator exists
         *
         *  returns true, if admin exists. false, otherwise.
        */
        private function doesAdminExist($email)
        {
            $retVal = false;
            $query = "
                SELECT id, password FROM admin
                WHERE email ='".$email."' AND is_active = 'yes'
                LIMIT 1
            ";
            $queryRun = mysqli_query($this->handle, $query);
            if(mysqli_affected_rows($this->handle) === 1)
            {
                $queryResult = mysqli_fetch_assoc($queryRun);
                $this->loginInfo['id'] = $queryResult['id'];
                $this->loginInfo['passwd'] = $queryResult['password'];
                
                $retVal = true;
            }
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool createAdminRecord(
         *      str $fName, str $lName, str $email, str $passwd   
         *  )
         *  insert a new admin record to database
         *
         *  return true, on success. false, otherwise.
        */
        private function createAdminRecord($fName, $lName, $email, $passwd)
        {
            $retVal = false;
            $id = hash('sha256', $email);
            $passwd = hash('sha256', $passwd);
            $query = "
                INSERT INTO admin(id, firstname, lastname, email, password, is_active)
                VALUES('".$id."','".$fName."', '".$lName."','".$email."', '".$passwd."', 'yes')
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool createAdminExtra(str $admin)
         *  create a new record for the Admin's extra info
         *
         *  return true on success. false, otherwise
        */
        private function createAdminExtra($admin)
        {
            $retVal = false;
            $time = time();
            $query = "
                INSERT INTO admin_extra(admin, joined_on, last_login)
                VALUES('".$admin."', '".$time."', '".$time."')
            ";
            if(mysqli_query($this->handle, $query)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*  */
        public function getMessage()
        {
            return $this->message;
        }

        /*
         *  @method bool logIn(str $email, str $password)
         *  attempt to log a user in
         *
         *  returns true on success. false, otherwise
         *
        */
        public function logIn($email, $password)
        {
            $retVal = false;
            $password = hash('sha256', strtolower($password));
            
            #   Check if admin exists
            if($this->doesAdminExist($email))
            {
                if($this->loginInfo['passwd'] == $password)
                {
                    #   save ID to session
                    $this->message = $this->loginInfo['id'];
                    $retVal = true;
                }else $this->message = "Email/Password do not match";
            }
            else $this->message = "User does not exist";
            
            #
            return $retVal;
        }
        
        /*
         *  @method bool register(str $fName, str $lName, str $email, str $passwd)
         *  attempts to add a new user in the admin system
         *
         *  returns true on sussess, false, otherwise.
         *
        */
        public function register($fName, $lName, $email, $passwd)
        {
            $retVal = false;

            /*  */
            $id = hash('sha256', $email);
            
            #   Check if admin exists
            if($this->doesAdminExist($email))
            {
                $this->message = "Email already in use";
                $this->loginInfo = [];  #   Empty the loginInfo array
            }else
            {
                if($this->createAdminRecord($fName, $lName, $email, $passwd))
                {
                    if($this->createAdminExtra($id))
                    {
                        $retVal = true;
                    }
                    else $this->message = "Error: Could not add user.";
                }
                else $this->message = "Error: could not add admin.";
            }
            
            #
            return $retVal;
        }
    }