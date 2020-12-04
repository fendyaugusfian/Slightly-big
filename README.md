# Slightly-big
 
# Quick Start

Copy this folder into htdocs of your XAMPP.<br />
Import the slightly-big.sql file to mysql database, change the params in the config/Database.php file to your own.<br />

The Disburse table is a table contains bank_code,account_number,amount,remark. <br />
The Auth table is a table contains username and password for authentication. <br />

# POST
Type (your localhost ip)/Slightly-big/post.php to see API when make a post request using basic auth. <br />
Example : https://192.168.1.6/Slightly-big/post.php <br />
![Example](https://github.com/fendyaugusfian/Slightly-big/blob/main/post.png?raw=true)<br />

# GET
Type (your localhost ip)/Slightly-big/get.php to see API when make a get request using basic auth. <br />
Example : https://192.168.1.6/Slightly-big/get.php<br />
![Example](https://github.com/fendyaugusfian/Slightly-big/blob/main/get.png?raw=true)<br />
