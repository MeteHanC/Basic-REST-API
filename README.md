# Basic REST API

Basic REST API is a simple API for communicating with the database. All of the codes are based on the PSR-2 standard. Also Dependency-Injection and Repository patterns are followed in this project.

## Getting Started

In order to run the API on the server, you need to run a web development environment (e.g Wamp Server) and move the API folder to environment's root directory (e.g "www" Directory for Wamp )

### Prerequisites

To edit the project you need to have a PHP IDE installed along with Composer.  After installing the IDE and setting the path to PHP root you can install composer with following command line;

```
php composer-setup.php --install-dir=bin --filename=composer
```

### Configuring the Database

You can configure the Database by editing the "StudentRepository" class. Default configuration is ;

```
$dsn = 'mysql:host=localhost;dbname=College_DB;charset=utf8';
$usr = 'root';
$pwd = '';
```

After configuring the Database if you want to use the exact same data, you can create your database by following Query ;

```
create DATABASE if not exists College_DB;
use College_DB;
create table if not exists Students(id int not null primary key,name char(20));
```

### Usage

There are currently 3 requests, "get_names", "get_all", "add_student". Please take a look at the below examples given in Python

Getting all the content from API. Returns a JSON

```
import requests
response = requests.get("http://localhost/Basic-REST-API/public/index.php/get_all")
data = response.json()
```

Getting only the names from API. Returns a JSON

```
import requests
response = requests.get("http://localhost/Basic-REST-API/public/index.php/get_names")
data = self.__response.json()
```

Adding a student to Database 

```
import requests
response = requests.post("http://localhost/Basic-REST-API/public/index.php/add_student/Student_ID/Student_Name")
```



