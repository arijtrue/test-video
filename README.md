#Test Video
======

## Docker setup
--
```
$ docker-compose up --build
```
Run in the next console:
```
$ docker ps
```
Check a `container id` named 'test-video_php-apache'
Login to it's ssh:
```
$ docker exec -it [container_id] /bin/bash
```
You'll get into:
```
root@[container_id]:/var/www# 
```
Run there:
```
# bin/install 
``` 
`bin/install` will:
* install dependencies via composer in silent mode
* apply migrations:
  * db structure
  * dummy data (specified lower here)
* applies 777 rights (fast solution) to logs+cache folders

Move to _HOW2_ section

## Apache setup
--

### Apache2 config:
------
```
<VirtualHost *:80>
    ServerName [local-domain]

    DocumentRoot [projectPath]/web
    <Directory [projectPath]/web>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order Allow,Deny
        Allow from All
        Require all granted
    </Directory>
</VirtualHost>
```

### Installation script:
=
Run from the project root folder `bin/install` it will:
* install dependencies via composer + request(prompt) access to DB (access parameters)
  * `database_*` - mysql user should have the rights to create DB, DB should exist
  * `mailer_*` - leave it blank
  * `secret` - some dummy text
  * others - just leave default values
* apply migrations:
  * db structure
  * dummy data (specified lower here)
* applies 777 rights (fast solution) to logs+cache folders
  
  
  
## _HOW2_
--
* when you visit `http://127.0.0.1:8080/app_dev.php/` (docker, with symfony dev-mode) or `http://[local-domain]/` (apache) you'll be prompted to enter user+pass (any value from dummy data can be used.)
* after login you'll see:
  * link to `api-doc + sandbox`, click it, it will be opened in next tab (target="_blank")
  * here you'll see all endpoints, you'll be able to se requirements + parameters awaited on each endpoint
  * this `api-doc` also contains curl examples of usage
  * please note, `apikey` header is used for `token`, it should be used from 1st page to each of these endpoint calls  
 
## DB test data:
--

Users:

| username | password |
|----------|----------|
|user1     |111       |
|user2     |111       |
|user3     |111       |
|user4     |111       |
|user5     |111       |

Videos

| title    | description          | year   |
|----------|----------------------|--------|
|Video 1   | Video 1 description  | random |
|Video 2   | Video 2 description  | random |
|...       | ...                  | random |
|Video 20  | Video 20 description | random |
