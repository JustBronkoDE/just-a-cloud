# Productive Cloud

Cloud platform used to upload, manage and share files.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Server Prerequisites

What things you need to install the cloud application

```
 - PHP >= 5.6.4
 - OpenSSL PHP Extension
 - PDO PHP Extension
 - Mbstring PHP Extension
 - Tokenizer PHP Extension
 - XML PHP Extension
```

### Installing

#### 1. Clone the project

First clone the repository:

```
git clone https://github.com/JustBronkoDE/ProductiveCloud.git
```

#### 2. Add the DB credentials & App config

Next make sure to create a new database and add your database credentials and application config to your .env file:

```
APP_NAME=Productive
APP_ENV=local
APP_KEY=
APP_DEBUG=false
APP_LOG_LEVEL=production
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password  
```

#### 3. Migrate Database

Now you need to migrate the database, you have to run the following command  in the root directory:

```
php artisan migrate
```

#### 3. That's it!

Have fun! 

## Add test data

You can create 50 public test users with 150 public dummy files using php^  unit. Simply run the following command in the root directory:
```
phpunit
```

## Deployment

### Make sure your permissions are set correctly

**Your user as owner:**

I prefer to own all the directories and files, so I do:
```
sudo chown -R my-user:www-data /path/to/your/laravel/root/directory
```

Then I give both myself and the webserver permissions:
```
sudo find /path/to/your/laravel/root/directory -type f -exec chmod 664 {} \;
sudo find /path/to/your/laravel/root/directory -type d -exec chmod 775 {} \;
```

***Then give the webserver the rights to read and write to storage and cache***

Whichever way you set it up, then you need to give read and write permissions to the webserver for storage, cache and any other directories the webserver needs to upload or write too (depending on your situation), so run the commands from bashy above :
```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```
Now, you're secure and your website works, AND you can work with the files fairly easily. Alternatively you can set the webserver as owner, but this may give you problems using e.g FTP. Because u cant properly upload or work with files. You can fix this by adding your user to the webserver group.

### If you are using composer and have problems with the *php artisan* command:

Try running the following command:
```
composer update
```

## Built With

* [Laravel 5.4](https://laravel.com/docs/5.4) - The php web framework used
* [Bootstrap 3](https://getbootstrap.com/docs/3.3/) - Frontend css framework

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Lamine Dia** - *Initial work* - [JustBronkoDE](https://github.com/JustBronkoDE)

See also the list of [contributors](https://github.com/JustBronkoDE/ProductiveCloud/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
