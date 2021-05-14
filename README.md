# Phase2
Contain docker files 
This folder also contains docker-compose.yml. You can either run docker-compose.yml or just run Docker Files and then link together. 
The corresponding file is written in each of folders php and mysql.
File php also contains an index.php file for viewing and execution guidance.
To connect to the database, you can also run the file docker, create the corresponding image and then link to php.
It is noteworthy that the mysql database image as well as php is embedded in the Docker Hub repository. And you can use it.

Docke hub repository:
docker pull nedaprogrammer/doctor-user-db
docker pull nedaprogrammer/doctor-user-panel
