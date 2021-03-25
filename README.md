# Productive Cloud

Cloud platform used to upload, manage and share files.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

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

#### 2. Install dependencies

To install the dependencies run the following command:
```
composer install
```

#### 3. Add the DB credentials & App config

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

#### 4. Migrate Database

Now you need to migrate the database, you have to run the following command  in the root directory:

```
php artisan migrate
```

#### 5. That's it!

Have fun!

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
