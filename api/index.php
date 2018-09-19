<?php
    #   Open CORS access (insecure)
    header('Access-Control-Allow-Origin: *');
    require_once '../app/init.php';
    
    #   Return values
    $retCode = 0;
    $retBody = '{}';
    
    
    
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    $urlComponent = explode('/', $url);
    
    $operation = isset($urlComponent[0]) ? $urlComponent[0] : '';
    $operand = isset($urlComponent[1]) ? $urlComponent[1] : '';
    
    
    if($operation !== 'search')
    {
        #   If uri is not '../search/'
        $retBody = '"Incorrect Uri"';
    }elseif(strlen($operand) <= 1)
    {
        #   If no keyword is passed
        $retBody = '"No keyword(s) provided."';
    }else
    {
        #   If uri is properly formatted
        
        #   Create objects
        $db = new Database;
        $db->selectDb('inits');
        
        #   Initiate search
        $search = new Search($operand, $db->getConn());
        $searchIndexes = $search->getSearchIndexes(); # get indexes for the keywords
        
        $searchResult = new Result($db->getConn(), 0);
        $searchResult->setIndexes($searchIndexes);
        $searchResult->getResultsFromDatabase();
        
        #   Format return variable
        $retCode = 1;
        $retBody = $searchResult->getJSONResults();
        # 
        
    }
    
    echo '{"code" : '.$retCode.', "body" : '.$retBody.'}';