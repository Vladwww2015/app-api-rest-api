# Bagisto REST API Clone Version.

```Compare with Bagisto Rest Api original. Here was removed Shop and Sale features``` 

<p>Bagisto REST API is a medium to use the features of the core Bagisto System. By using Bagisto REST API, you can integrate your application to serve the default content of Bagisto.</p>

### 1. Requirements:

* **Bagisto**: v1.4.5

### 2. Installation:

##### To install Bagisto REST API from your console:

~~~
composer require app-api/rest-api dev-main
~~~

##### Add below options in the .env file (i.e. http://localhost/public your domain):

~~~
SANCTUM_STATEFUL_DOMAINS=http://localhost/public
~~~

##### To configure the REST API L5-Swagger Documentation run below command:

~~~
php artisan app-api-rest-api:install
~~~

#### To check the Admin end API documentation:

~~~
http://localhost/public/api/admin/documentation
~~~
* You can check the <a href="https://github.com/DarkaOnLine/L5-Swagger"> L5-Swagger </a> guidelines too regarding the configuration the API documentation.
