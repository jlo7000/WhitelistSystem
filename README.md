#iCarey.net Whitelist System
A PHP/MySQL based whitelist system with RCON commands, and automatic emails to approved/denied users.

Requirements:
MySql
PHP 5.5
RCON Enabled on your Minecraft Server

Installation:

Create a database in phpmyadmin or via MySQL Console
Create a user that has full access to the datanase you created. (For security reason ONLY the database you created)
Import whitelist.sql in to your created database via phpmyadmin MySQL
Upload the contents of the zip file to your web hosting root. (minus whitelist.sql)
Get a Google REcaptcha (https://www.google.com/recaptcha/intro/index.html) after
Enter your site key in the space reserved on line 97 of "whitelist.php" between the quotes data-sitekey="YOUR SITEKEY HERE"
Enter your secret key in the space reserved on line 12 of "register.php" between secret= and the &
Edit the notification EMAIL and settings in "register.php" lines 33 - 50 and line 89.
Edit the config in "includes/config.ini.php".
Edit the default Approved and Denied Email subject and messages in "whitelist/functions.php" Approved starts on line 57 Denied starts on line 94

Scripts included:
whitelist.php (Whitelist Registration Page) 
registration.php (Whitelist registration script)
whitelist/* (Whitelist Panel login/logoff approve/deny rcon/mail ...etc)
phpmailer/* (PHPMailer needed for sending mail from whitelist panel)
includes/*  (various PHP scripts to make the whitelist functional)

Configuration files:
includes/config.ini.php (Main Config in PHP and INI format for security)

Features of the whitelist system:
Application form on the web site with Google REcaptcha.
Admin Panel with the ability to approve/deny, view approved/denied/waiting users, and mass mail your approved users.
You can also send RCON commands to the server via the Admin Panel Command Center.
When approved: the user is added to the whitelist and the whitelist updated via RCON.
WHen denied: the user is removed from the whitelist and the whitelist update via RCON.
Checking users against Fishbans coming soon!


