/*
 *
 *
*/
window.addEventListener('load', function(){
    /*  */
    var addBtn = document.getElementById('add-listing');
    var admin = localStorage.getItem('admin');
    var msgBox = "form-message";
    
    function checkFormElements(elements = [])
    {
        let retVal = true;
        for(let a = 0; a < elements.length; a++)
        {
            if(elements[a].value.length < 1) //if empty
            {
                retVal = false;
                elements[a].style.borderColor = '#ED7192';
                break;
            }
        }
        
        return retVal;
    }
    addBtn.addEventListener('click', function(){
        /*  */
        let nForm = document.forms.new_listing;
        let name = nForm.bizName;
        let desc = nForm.bizDesc;
        let category = nForm.bizCat;
        let email = nForm.bizMail;
        let web = nForm.bizWeb;
        let addr = nForm.bizAddr;
        let phone1 = nForm.bizPhone1;
        let phone2 = nForm.bizPhone2;
        
        /* Check the */
        if(!checkFormElements([name, desc, category, email, addr, web, phone1]))
        {
            System.displayFormMessage(msgBox, "Please fill the affected field", 3);
        }else
        {
            /*  prepare request body    */
            let reqBody = "admin="+admin+"&name="+name.value+"&desc="+desc.value+"&cat="+category.value;
            reqBody += "&email="+email.value+"&web="+web.value+"&addr="+addr.value+"&phone1="+phone1.value;
            reqBody += "&phone2="+phone2.value;
            
            /*  Prepare actual request  */
            let request = System.createAjaxObject();
            request.open('post', '../app/processes/add-listing.php');
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(reqBody);
            
            /*  */
            request.onreadystatechange = function(){
                if(request.readyState === 4)
                {
                    let response = JSON.parse(request.responseText);
                    if(response.isSuccessful)
                    {
                        System.displayFormMessage(msgBox, response.message, 1);
                    }else System.displayFormMessage(msgBox, response.message, 3);
                }
            };
        }
    });
});