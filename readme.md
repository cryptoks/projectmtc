#About Project
If it wasnt for time i would implement MVC Structure, Write Completely Abastract library to iterate and fetch data from the API way more faster.
Right now it takes about 420.8128s to fetch all data by not triggering "Too many requests" from the api using a limiter.
I would also use service container and not calling services based on singleton pattern, use DTO's to avoid data error's.
I would integrate validation in almost every part of project.
I would handle production and development environment better, basically i have a perfect idea of how i would do this project if i had enough time.

Beside UUID I added also id since on search and doing sql queries in big data UUID can be very painful and slow.

PHP version used <b>8.1.2</b>

#How To Run Project

First of all copy .env.example and provide information :

<b>1.Database Information</b>

<b>2.API Key</b>

Then put project into a domain in "apache\conf\extra\httpd-vhosts.conf"

example :

``
<VirtualHost *:80>
ServerAdmin webmaster@dummy-host2.example.com
DocumentRoot "C:\xampp\htdocs\testproject"
ServerName testproject.development
ErrorLog "logs/dummy-host2.example.com-error.log"
CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>
``

Then run command

``composer install``

Then run

``composer dump-autoload -o``

Then run database migrations with

``./vendor/bin/phinx migrate``

Get data from API with command (This should take time to run - around 420.8128s)

``vendor/bin/phinx seed:run``

And now navigate to domain.

