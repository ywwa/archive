<h3 align="center">pwnCloud</h3>
<div align="center">
Web application to quicky backup necessary data before migrating from one OS to other
</div>

### Requirements
* PHP 8.1+
* MySQL 5.7+ or MariaDB

## Installation
```shell
$ git clone https://github.com/yuukilla/pwnCloud.git
$ cd pwnCloud/
$ composer install
$ php bin/console setup
```
## Start server 
```shell
$ composer start:fresh # copies necessary stuff ["vendor/" -> "templates/"]
```
or
```shell
$ composer start # start server without recopying necessary
```

## License
<b>pwnCloud</b> is licensed under two licenses.
* The MIT License (MIT). See [pwnCloud License File](LICENSE)
* The MIT License (MIT). See [Slim-skeleton License File](LICENSE-slim-skeleton)