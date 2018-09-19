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
        $email = $db->cleanVariable(htmlspecialchars($_POST['email']));
        $passwd = htmlspecialchars($_POST['passwd']);
        
        if(!$form->checkEmptiness([$email, $passwd]))
        {
        	#	If any form value is empty
        	$retMsg = "Please fill all fields";
        }else
        {
        	#	Select database
        	$db->selectDb('inits');

        	#	Create guest object
        	$guest = new Guest($db->getConn());

        	#	Attempt a Login
        	if($guest->logIn($email, $passwd))
        	{
        		$retCode = 1;
        		$retMsg = $guest->getMessage();
        	}else
        	{
        		$retMsg = $guest->getMessage();
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