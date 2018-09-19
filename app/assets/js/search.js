/*
 *
*/
window.addEventListener('load', function(){
    var searchBtn = document.getElementById('search-btn');
    var msgBox = 'form-message';
    
    searchBtn.addEventListener('click', function(){
        let form = document.forms.search;
        let keyword = form.keyword.value;
        
        if(keyword.length < 1 ) System.displayFormMessage(msgBox, 'Please enter a keyword', 3);
        else
        {
            let request = System.createAjaxObject();
            request.open('get', '../app/processes/search.php?q='+keyword);
            request.send(null);
            
            request.onreadystatechange = function()
            {
                if(request.readyState === 4)
                {
                    let response = JSON.parse(request.responseText);
                    if(response.success)
                    {
                        System.gotoPage('./results.php?page=1');
                    }else System.displayFormMessage(msgBox, response.body, 3);
                }
            };
        }
    });
});