Jonathan RX - Project 3
==
*Produced as part of project 3 of OpenClassroom training*

--------------
How to use
-

This code need to be deployed on an apache server, after installation it can display a blog with the following features:
- Publication of chapters, with a visual editor
- Creating, reading, updating and deleting chapters
- Publication by visitors of comments on chapters
- Comment Reporting System
- Moderation of comments on the basis of reports
- Pages with fixed content: Home, Author, Contact, Legal notice

--------------
Required
-

- Apache server 
- PHP 7.2 or more
- Mysql

--------------
Installation
-

The project integrates composing with an autoloader in PSR-4 and phpmailer.
- [Composer](https://getcomposer.org/)
- [Phpmailer](https://packagist.org/packages/phpmailer/phpmailer)

1. Clone Github repository
> git clone https://github.com/Jonathan-RX/ocp3.git .

2. Create a database for this project and inject this for create tables 
>-- Table for chapters  
>CREATE TABLE IF NOT EXISTS `chapters` (  
>  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
>  `title` text,  
>  `slug` text,  
>  `content` longtext,  
>  `date_add` datetime DEFAULT NULL,  
>  PRIMARY KEY (`id`)  
>) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;  
>
>-- Table for comments   
>CREATE TABLE IF NOT EXISTS `comments` (  
>  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
>  `post_id` int(11) NOT NULL,  
> `author` varchar(200) DEFAULT NULL,  
>  `content` text,  
>  `report` tinyint(1) DEFAULT NULL,  
>  `moderate` tinyint(1) DEFAULT NULL,  
>  `date_add` datetime NOT NULL,  
>  PRIMARY KEY (`id`)  
>) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;  
>
>-- Table for Users  
>CREATE TABLE IF NOT EXISTS `users` (  
>  `id` int(11) NOT NULL AUTO_INCREMENT,  
>  `login` text NOT NULL,  
>  `password` longtext NOT NULL,  
>  `email` text NOT NULL,  
>  `token` text,  
>  `token_date` datetime DEFAULT NULL,  
>  PRIMARY KEY (`id`)  
>) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;  

3. Duplicate file Config.sample.php to Config.php in src and subdirectory config, and add your parameters in the first part :

```php
    private $dbHost         =   ''; //Database host, usualy localhost or 127.0.0.1
    private $dbUser         =   ''; //User for database
    private $dbPassword     =   ''; //User's password
    private $dbName         =   ''; //Database's name for this project

    private $smtpPassword   =   ''; //SMTP provider password
    private $smtpUser       =   ''; //SMTP procider User
    private $smtpHost       =   'smtp.gmail.com'; //SMTP provider Host, Google by default
    private $smtpAuth       =   true; //True if SMTP provider require authentification
    private $smtpSecure     =   'tls'; //Methode for SMTP authentification
    private $smtpPort       =   '587'; // Port of SMTP provider

    private $captchaSecret  =   ''; // Secret key for google captcha
    private $captchaPublic  =   ''; // Public key for google captcha
```

4. Done, now if installation success, you can add new chapters, and start to work. Thanks you for your participation.