<?php
    require ('../init.php');

    #   Prepre return variables
    $retCode = 0;
    $retMsg = "";

    #
    try
    {
        
        #   Create object
        $form = new Form;
        $db = new Database;
        
        #   Recieve form data
        $fName = $db->cleanVariable(htmlspecialchars($_POST['fName']));
        $lName = $db->cleanVariable(htmlspecialchars($_POST['lName']));
        $email = $db->cleanVariable(htmlspecialchars($_POST['email']));
        $passwd = $db->cleanVariable(htmlspecialchars($_POST['passwd']));
        $cPasswd = $db->cleanVariable(htmlspecialchars($_POST['cPasswd']));
        
        #   Check form data length
        if(!$form->checkEmptiness([$fName, $lName, $email, $passwd, $cPasswd]))
        {
            $retMsg = "Please fill all fields";
        }else
        {
            #   Check if passwords match
            if($passwd !== $cPasswd)
            {
                $retMsg = "Unmatched Passwords";
            }else
            {
                #   Select a database to work on
                $db->selectDb('inits');
                
                #   create guest object
                $guest = new Guest($db->getConn());
                
                #   Attempt to register a user
                if($guest->register($fName, $lName, $email, $passwd))
                {
                    $retCode = 1;
                    $retMsg = "User Added Successfully";
                }else
                {
                    $retMsg = $guest->getMessage();
                }
            }
        }

        #   Close Database connection
        $db->closeConnection();
    }catch(Exception $e)
    {
        $retMsg = "Internal Error:".$e->getMessage();
    }

    #echo return value
    echo '{"isSuccessful" : '.$retCode.', "message" : "'.$retMsg.'"}';