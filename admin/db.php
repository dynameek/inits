<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $name = "inits";
    
    $handle = mysqli_connect($host, $user, $pass);
    
    #   Create database
    $sql = "CREATE DATABASE IF NOT EXISTS ".$name;
    
    if(mysqli_query($handle, $sql))
    {
        # select database
        mysqli_select_db($handle, $name);
        
        # Create tables
        $sql = "CREATE TABLE IF NOT EXISTS admin(
            id VARCHAR(100) NOT NULL UNIQUE,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(100) NOT NULL,
            is_active ENUM('yes', 'no') NOT NULL,
            PRIMARY KEY(id)
        )";
        if(mysqli_query($handle, $sql)) echo "admin table created.<br>";
        
        $sql = "CREATE TABLE IF NOT EXISTS admin_extra(
            id TINYINT(3) NOT NULL AUTO_INCREMENT,
            admin VARCHAR(100) NOT NULL UNIQUE REFERENCES admin(id),
            joined_on VARCHAR(20) NOT NULL,
            last_login VARCHAR(20) NOT NULL,
            PRIMARY KEY(id)
        )";
        if(mysqli_query($handle, $sql)) echo "admin_extra table created.<br>";
        
        $sql = "CREATE TABLE IF NOT EXISTS listing(
            id VARCHAR(100) NOT NULL UNIQUE,
            name VARCHAR(100) NOT NULL,
            description TEXT(500) NOT NULL,
            category VARCHAR(200) NOT NULL,
            admin VARCHAR(100) NOT NULL REFERENCES admin(id),
            views INT(5) NOT NULL,
            date_created VARCHAR(20) NOT NULL,
            is_active ENUM('yes', 'no') NOT NULL,
            PRIMARY KEY(id)
        )";
        if(mysqli_query($handle, $sql)) echo "listing table created.<br>";
        
        $sql = "CREATE TABLE IF NOT EXISTS listing_contact(
            id INT(5) NOT NULL AUTO_INCREMENT,
            listing VARCHAR(100) NOT NULL UNIQUE REFERENCES listing(id),
            email VARCHAR(150) NULL UNIQUE,
            website VARCHAR(150) NULL UNIQUE,
            address VARCHAR(200) NULL,
            phone_1 VARCHAR(20) NULL,
            phone_2 VARCHAR(20) NULL,
            PRIMARY KEY(id)
        )";
        if(mysqli_query($handle, $sql)) echo "listing_contact table created.<br>";
        
        $sql = "CREATE TABLE IF NOT EXISTS listing_images(
            id INT(5) NOT NULL AUTO_INCREMENT,
            listing VARCHAR(100) NOT NULL REFERENCES listing(id),
            image VARCHAR(100) NOT NULL,
            is_active ENUM('yes', 'no') NOT NULL,
            PRIMARY KEY(id)
        )";
        if(mysqli_query($handle, $sql)) echo "listing_images table created.<br>";
    }
    
    mysqli_close($handle);