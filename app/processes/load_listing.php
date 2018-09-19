<?php
	#	Get listing from url
	if(isset($_GET['id']))
	{
		#clean id
		$listing_id = htmlspecialchars($_GET['id']);

		#create database object
		$db = new Database();
		$db->selectDb('inits');

		$listing_id = $db->cleanVariable($listing_id);

		#Create Listing object
		$listing = new Listing($listing_id, $db->getConn());
		$listing->setAdmin($_SESSION['admin']);

		#	fetch listing information
		$listing->fetchBasicInfo();
		$listing->fetchContactInfo();
		$listing->fetchImages();

		$basicInfo = $listing->getBasicInfo();
		$contactInfo = $listing->getContactInfo();
		$images = $listing->getImageUris();

		#	Prepare variables for use
		$listingId = isset($listing_id) ? $listing_id : '';
		$listingName = isset($basicInfo['name']) ? $basicInfo['name'] : '';
		$listingDesc = isset($basicInfo['description']) ? $basicInfo['description'] : '';
		$listingCat = isset($basicInfo['category']) ? $basicInfo['category'] : '';
	
		$listingEmail = isset($contactInfo['email']) ? $contactInfo['email'] : '';
		$listingAddress = isset($contactInfo['address']) ? $contactInfo['address'] : '';
		$listingWebsite = isset($contactInfo['website']) ? $contactInfo['website'] : '';
		$listingPhone1 = isset($contactInfo['phone_1']) ? $contactInfo['phone_1'] : '';
		$listingPhone2 = isset($contactInfo['phone_2']) ? $contactInfo['phone_2'] : '';
		
		/*	Save Listing Id to localStorage	*/
		echo "<script> localStorage.setItem('active-edit', '".$listing_id."');</script>";
		
	}
	else header("Location: new-listing.php");
?>