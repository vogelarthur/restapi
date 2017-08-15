Flights REST API Application
========================

Requirements
------------

  * PHP 5.5.9 or higher;
  * PDO-Mysql PHP extension enabled;
  * and the [usual Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html).

Installation
------------

For install, use the commands above.

> **NOTE**
>
>
>     $ git clone https://github.com/vogelarthur/restapi restapi
>     $ cd restapi/
>     $ composer install --no-interaction

Usage
-----

There is no need to configure a virtual host in your web server to access the application.
Just use the built-in web server:

```bash
$ cd restapi/
$ php bin/console server:run
```

The application of REST API runs in this link. http://localhost:8000/api/doc

