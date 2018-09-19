<?php
	try{
		$listings;
		if(isset($_GET['user']) || !empty($_SESSION['admin']) || isset($_COOKIE['admin']))
		{
			if(isset($_GET['user']))
			{
				$user_id = htmlspecialchars(($_GET['user']));
				
				#	Save user ID to session and cookie
				$_SESSION['admin'] = $user_id;
				setcookie('admin', $user_id, (60 * 60 * 60 * 24 * 7));
			}else
			{
				$user_id = isset($_COOKIE['admin']) ? $_COOKIE['admin'] : $_SESSION['admin'];
			}
			
	
			#	Create database object
			$db = new Database;
			$db->selectDb('inits');
	
			#	Create Admin object
			$admin = new Admin($user_id, $db->getConn());
	
			#	Update Login Time
			$admin->updateLogin();
	
			# fetch info
			if($admin->fetchInfo()) $_SESSION['admin_info'] = $admin->getInfo();
			else $listings = "failed to fetch info";
	
			# fetch listings
			if($admin->fetchListings())	$listings = $admin->getListings();
			else $listings = "failed to fetch listing";
	
	
			#	close connection
			$db->closeConnection();
		}else
		{
			require('../app/processes/logout.php');
		}

	}catch(Exception $e)
	{
		$e->getMessage();
	}

?>