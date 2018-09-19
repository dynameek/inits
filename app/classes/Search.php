<?php
    class Search
    {
        /*  Properties  */
        private $keywords;
        private $searchIndexes; #   Holds searched indexes as encountered
        private $sortedSearchIndexes;   #   Holds indexes by keyword
        private $conn;
        public $Error;
        
        /*  Methods */
        public function __construct($keywords, $conn)
        {
            $this->keywords = trim($keywords);
            $this->conn = $conn;
            
            $this->processKeywords();
            $this->getKeyIndexes();
            
        }
        
        private function getKeyIndexes()
        {
            #
            foreach($this->keywords as $keyword)
            {
                $query = "
                    SELECT id FROM listing WHERE name LIKE '%".$keyword."%'
                ";
                $queryRun = mysqli_query($this->conn, $query);
                if(mysqli_affected_rows($this->conn) >= 1)
                {
                    for($i = 0; $i < mysqli_affected_rows($this->conn); $i++)
                    {
                        $queryResult = mysqli_fetch_assoc($queryRun);
                        
                        #   Populate arrays
                        $this->searchIndexes[] = $queryResult['id'];
                        $this->sortedSearchIndexes[$keyword][] = $queryResult['id'];
                    }
                }
            }
        }
        
        public function getSearchIndexes()
        {
            return $this->searchIndexes;
        }
        
        private function processKeywords()
        {
            #   Replace spaces with plus sign
            $words = preg_replace('/\s/', '+', $this->keywords);
            #   Break up into component keywords 
            $this->keywords = explode('+', $words);
        }
        
        public function saveIndexesToSession()
        {
            #
            $_SESSION['searchIndexes'] = $this->searchIndexes;
        }
    }