/*
 *
 *
*/

var Listing = {
	parentId : 'listing-image-wrapper',
	msgBox: 'form-message',
	
	removeImage: function(element, imageId, listingId)
	{
		parentElement = document.getElementById(Listing.parentId);
		parentElement.removeChild(element.parentNode);
		
		let reqBody = "id="+imageId+"&listing="+listingId;
		let request = System.createAjaxObject();
		
		request.open('post', '../app/processes/remove-listing-image.php');
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(reqBody);
		
		request.onreadystatechange = function(){
			if(request.readyState === 4)
			{
				console.log(request.responseText);
				let response = JSON.parse(request.responseText);
				if(response.isSuccessful)
				{
					System.displayFormMessage(Listing.msgBox, response.message, 1);
				}else System.displayFormMessage(Listing.msgBox, response.massage, 3);
			}else System.displayFormMessage(Listing.msgBox, 'Processing...', 2);
		};
	}
};

window.addEventListener('load', function(){
	/*	Get Buttons	*/
	var basicBtn = document.getElementById('basic');
	var contactBtn = document.getElementById('contact');
	var deleteBtn = document.getElementById('delete');
	
	var msgBox = 'form-message';
	
	/*	Get Listing ID*/
	var listingID = document.getElementById('listingId').getAttribute('listing-id');
	var admin = document.getElementById('listingId').getAttribute('admin-id');
	
	/*	Check if error message is set	*/
	if(localStorage.getItem('image-err') && localStorage.getItem('image-code'))
	{
		System.displayFormMessage(msgBox, localStorage.getItem('image-err'), parseInt(localStorage.getItem('image-code')));
		localStorage.removeItem('image-err');
		localStorage.removeItem('image-code');
	}
	/*	*/
	basicBtn.addEventListener('click', function(){
		/*	get form values	*/
		let basicForm = document.forms.listing_basic;
		let bizName = basicForm.bizName.value;
		let bizDesc = basicForm.bizDesc.value;
		let bizCat = basicForm.bizCat.value;

		/*	Ensure form values are not empty*/
		if((bizName.length < 1) || (bizDesc.length < 1) || (bizCat.length < 1))
		{
			System.displayFormMessage(msgBox, 'Please fill all fields', 3);
		}else
		{
			/*	Prepare request body*/
			let reqBody = "id="+listingID+"&name="+bizName+"&desc="+bizDesc+"&category="+bizCat;
			reqBody += "&admin="+admin;

			/*	Prepare request	*/
			let request = System.createAjaxObject();
			request.open('post', '../app/processes/listing-basic.php');
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send(reqBody);
			
			request.onreadystatechange = function(){
				if(request.readyState === 4)
				{
					let response = JSON.parse(request.responseText);
					if(response.isSuccessful)
					{
						System.displayFormMessage(msgBox, response.message, 1);
					}else System.displayFormMessage(msgBox, response.massage, 3);
				}else System.displayFormMessage(msgBox, 'Processing...', 2);
			};
		}
	});

	/*	*/
	contactBtn.addEventListener('click', function(){
		/*	get form values	*/
		let cForm = document.forms.listing_contact;
		let bizMail = cForm.bizMail.value;
		let bizWeb = cForm.bizWeb.value;
		let bizAddr = cForm.bizAddr.value;
		let bizPhone1 = cForm.bizPhone1.value;
		let bizPhone2 = cForm.bizPhone2.value;
		
		/*	Prepare request body*/
		let reqBody = "id="+listingID+"&admin="+admin;
		reqBody += "&mail="+bizMail+"&web="+bizWeb+"&addr="+bizAddr;
		reqBody += "&phone1="+bizPhone1+"&phone2="+bizPhone2;

		/*	Prepare request	*/
		let request = System.createAjaxObject();
		request.open('post', './app/processes/listing-contact.php');
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(reqBody);
		
		request.onreadystatechange = function(){
			if(request.readyState === 4)
			{
				let response = JSON.parse(request.responseText);
				if(response.isSuccessful)
				{
					System.displayFormMessage(msgBox, response.message, 1);
				}else System.displayFormMessage(msgBox, response.massage, 3);
			}else System.displayFormMessage(msgBox, 'Processing...', 2);
		};
	});
	
	/*	*/
	deleteBtn.addEventListener('click', function(){
		let id = localStorage.getItem('active-edit');
		let admin = localStorage.getItem('admin');
		
		/*	Prepare request	*/
		let request = System.createAjaxObject();
		request.open('post', '../app/processes/delete-listing.php');
		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		request.send("id="+id+"&admin="+admin);
		
		request.onreadystatechange = function()
		{
			if(request.readyState === 4)
			{
				let response = JSON.parse(request.responseText);
				if(response.isSuccessful)
				{
					localStorage.removeItem('active-edit');
					window.location = './dashboard.php';
				}else System.displayFormMessage(msgBox, response.message, 3);
			}
		};
	});
});