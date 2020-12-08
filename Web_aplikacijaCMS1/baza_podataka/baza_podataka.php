<?php 


  //Drajveri za localhost server
$database = new PDO('mysql: host=localhost;','root','');
 

 //Kreiranje baze podataka 
$sqlDB = "CREATE DATABASE `web-aplikacija`";
$data_base = $database->query($sqlDB);



//Kreiranje tabele korisnici u bazi web-aplikacija
$sqlTB1 = "CREATE TABLE `web-aplikacija`.`korisnici` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   username varchar(128) not null , 
   password varchar(128) not null , 
   name varchar(128) not null , 
   email varchar(128) not null , 
   email_confirm varchar(128) not null , 
   user_code varchar(128) not null  

);";
$table1 = $database->query($sqlTB1);


//Kreiranje tabele komentari u bazi web-aplikacija
$sqlTB2 = "CREATE TABLE `web-aplikacija`.`komentari` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   user_id int(11) not null , 
   user_name varchar(128) not null , 
   tekst text not null , 
   datum date not null , 
   vijesti_id int(11) not null


);";
$table2 = $database->query($sqlTB2);


//Kreiranje tabele vijesti u bazi web-aplikacija
$sqlTB3 = "CREATE TABLE `web-aplikacija`.`vijesti` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   subject varchar(128) not null , 
   name varchar(128) not null , 
   tekst text not null , 
   type varchar(128) not null , 
   image varchar(512) not null , 
   order_news int(11) not null 


);";
$table3 = $database->query($sqlTB3);


