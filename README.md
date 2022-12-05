# uni-project

## Installation
First of all download and install Xampp. It's preferable to WAMP as it's easier to install and has wider compatibility<br>
It's available at https://www.apachefriends.org/download.html

After the installation, open the XAMPP control panel and start the Apache server and MySQL.
![Alt text](/start.png?raw=true "Start Apache and MySQL")

## Get the project on your computer

Navigate to the folder where Xampp was installed, then go inside xampp > htdocs

If you have git installed on your computer, open a command line and type: git clone https://github.com/adpopescu338/uni-project/

If you don't have git, create a new folder in xampp>httdocs named "uni-project".
Download the project as a zip from https://github.com/adpopescu338/uni-project/zipball/master/ and extract all the files into the new folder. 
When you navigate in the new folder you should see the index and the other files.

## Database

If you want you can inspect the database at http://localhost/phpmyadmin/index.php <br>
There's no need to manually create the database.
There's a script that will create the database and the tables. <br>
The script will run automatically when you use the website for the first time. 
To make the connection to the database possible, just, write your credentials in api/env
