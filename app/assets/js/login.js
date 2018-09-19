/*
 *
 *
*/
window.addEventListener('load', function(){
    /*  Get LogIn Btn   */
    var lgBtn = document.getElementById('lg-btn');
    var msgBox = "form-message";
    
    lgBtn.addEventListener('click', function(){
       /*   Get form and form widgets   */
       let lgForm = document.forms.login;
       let email = lgForm.email.value;
       let passwd = lgForm.passwd.value;
       
       /*   Check if form widgets are empty */
       if((email.length < 1) || (passwd.length < 1))
       {
            System.displayFormMessage(msgBox, 'Please fill all fields.', 3);
       }else
       {
            /*  Prepare request body    */
            let reqBody = "email="+email+"&passwd="+passwd;
            
            /*  Prepare the request */
            let request = System.createAjaxObject();
            request.open('post', '../app/processes/login.php');
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(reqBody);
            
            request.onprogress = function(){
                System.displayFormMessage(msgBox, 'Logging In...', 2);
            };
            
            request.onreadystatechange = function(){
               if(request.readyState === 4)
               {
                    /*  Get response    */
                    let response = JSON.parse(request.responseText);
                    if(response.isSuccessful)
                    {
                        window.location = './dashboard.php?user='+response.message;
                    }else System.displayFormMessage(msgBox, response.message, 3);
               }
            };
       }
    });
});