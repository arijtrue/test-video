Test Video
========================

_Apache2 config:_
=
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

_Installation script_:
=
Run from the project root folder `bin/install` it will:
* install composer (with wget)
* install dependencies via composer + request(prompt) access to DB (access parameters)
  * `database_*` - mysql user should have the rights to create DB
  * `mailer_*` - leave it blank
  * `secret` - some dummy text
  * others - just leave default values
* create DB (on behalf of specified user)
* apply migrations:
  * db structure
  * dummy data (specied lower here)
  
_HOW2_
=
* when you visit `http://[local-domain]/` you'll be prompted to enter user+pass (any value from dummy data can be used.)
* after login you'll see:
  * link to `api-doc + sandbox`, click it, it will be opened in next tab (target="_blank")
  * here you'll see all endpoints, you'll be able to se requirements + parameters awaited on each endpoint
  * this `api-doc` also contains curl examples of usage
  * please note, `apikey` header is used for `token`, it should be used from 1st page to each of these endpoint calls  
 
_DB test data:_
=

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
