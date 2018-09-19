<?php

    class Result
    {
        /*  */
        private $conn;
        private const step = 15;
        private $page;
        private $indexes = [];
        private $results = [];
        
        /*  */
        public function __construct($conn, $page)
        {
            $this->conn = $conn;
            $this->page = $page;
        }
        
        public function displayResults()
        {
            foreach ($this->results as $id => $result)
            {
                $listing = "<div class='listing card'>";
                $listing .=  "<h3><a href='./listing.php?id=".$id."'>".$result['name']."</a></h3>";
                $listing .=  "<p>".wordwrap($result['description'], 150)."</p>";
                $listing .=  "<div class ='extra'>
                                <span class='views'></span>".$result['views'].
                                "<span class='date'></span>".date('j M, Y', $result['date']).
                             "</div>";
                $listing .= "</div>";
                
                echo $listing;
            }
        }
        public function getIndexesFromSession()
        {
            $this->indexes = isset($_SESSION['searchIndexes']) ? $_SESSION['searchIndexes'] : [];
        }
        
        public function getJSONResults()
        {
            return json_encode($this->results);
        }
        
        public function getResultsFromDatabase()
        {
            $stop = $this->page * self::step;
            $start = $stop - self::step;
            
            #   Check for overflow;
            if($stop > sizeof($this->indexes))
                $stop = sizeof($this->indexes);
                
            #   Check if page = 0
            #   Yes: we want to get all data at once
            if($this->page == 0)
            {
                $start = 0;
                $stop = sizeof($this->indexes);
            }
            
            
            for($start; $start < $stop; $start++)
            {
                
                #
                $id = $this->indexes[$start];
                $query = "
                    SELECT name, description, category, views, date_created
                    FROM listing WHERE id = '".$id."' AND is_active = 'yes'
                ";
                $query_run = mysqli_query($this->conn, $query);
                if(mysqli_affected_rows($this->conn) === 1)
                {
                    $queryResult = mysqli_fetch_assoc($query_run);
                    $this->results[$id]['name'] = $queryResult['name'];
                    $this->results[$id]['description'] = $queryResult['description'];
                    $this->results[$id]['categories'] = explode(',', $queryResult['category']);
                    $this->results[$id]['views'] = $queryResult['views'];
                    $this->results[$id]['date'] = $queryResult['date_created'];
                }
            }
        }
        
        public function setIndexes($indexes)
        {
            $this->indexes = $indexes;
        }
    }