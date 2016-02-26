# _Hair Salon App_

#### _Allows user to add stylists and add clients to each stylist, 2.26.2016_

#### By _**Josh Overly**_

## Description

Users can add all of their stylists to a database.  They can update or delete individual stylists. Users can also link clients to each stylist.  The app allows users to update individual clients as well._

## Setup/Installation Requirements

* Open the terminal on your computer
* Go to link: https://github.com/jos-h20/hair_salon
* Copy it.
* In your terminal, change your directory to desktop, type "git clone" and paste the link in.
* The folder hair_salon will download on your desktop.
* Change your directory to hair_salon.
* Type in "composer install" in that folder.
* Open web folder inside word_counter in your terminal.
* Start your PHP server by typing in "php -S localhost:8000".
* Open your web browser and type in "localhost:8000".

## MySQL commands used
* mysql.server start
* mysql -uroot -proot
* CREATE DATABASE hair_salon;
* USE hair_salon;
* CREATE TABLE stylists (name VARCHAR(255), id serial PRIMARY KEY);
* CREATE TABLE clients (name VARCHAR(255), stylist_id INT, id serial PRIMARY KEY);


## Known Bugs

_No known bugs._

## Support and contact details

_email: joshoverly@student.com_

## Technologies Used

_Bootstrap, PHP, PHPUnit, Twig, Silex, MySQL_

### License

Copyright (c) 2016 **_OverlyDev Licensing MIT_**
