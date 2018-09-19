/*

*/
window.addEventListener('load', function(){
    var regBtn = document.getElementById('reg-btn');
    var msgBox = "form-message";
    
    regBtn.addEventListener('click', function(){
        /*  Get form and form data  */
        let regForm = document.forms.register;
        let fName = regForm.fName.value;
        let lName = regForm.lName.value;
        let email = regForm.email.value;
        let passwd = regForm.passwd.value;
        let cPasswd = regForm.cPasswd.value;
        
        /*  */
        if((fName.length < 1) || (lName.length < 1) || (email.length < 1) ||
           (passwd.length < 1) || (cPasswd.length < 1))
        {
            /*  If any field is empty   */
            System.displayFormMessage(msgBox, 'Please fill all fields', 3);
        }else
        {
            /*  Define request body  */
            let reqBody = "fName="+fName+"&lName="+lName+"&email="+email;
            reqBody += "&passwd="+passwd+"&cPasswd="+cPasswd;
            
            /*  Prepare Requeest  */
            let request = System.createAjaxObject();
            request.open('post', '../app/processes/register.php');
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(reqBody);
            
            /*  */
            request.onreadystatechange = function(){
               if(request.readyState === 4)
               {
                    /*  Get response */
                    let response = JSON.parse(request.responseText);
                    if(response.isSuccessful)
                    {
                        /*  If registration is successful, redirect user to login page*/
                        window.location = './login.php';
                    }else System.displayFormMessage(msgBox, response.message, 3);
               }else
               {
                    System.displayFormMessage(msgBox, 'Creating Account', 2);
               }
            };
        }
    });
});