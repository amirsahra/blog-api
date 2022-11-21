# Laravel Blog Rest API

In this project, a blog has been implemented as a restful api.
Things like user registration, authentication, password recovery, email confirmation, user management by admin, posts, categories, comments have been created.

Fake data has been used for testing and development.

### Some rules :
- User management is done only by admin.
- We have two types of users, admin and member.
- ...

###Features :
- Auth ( Login , Register , verify email , Reset password ) just for admin
- User ( Create , Read , Update , Destroy ) just for admin
- Post ( Create , Read , Update , Destroy )
- Comment ( Create , Read , Update , Destroy )
- Category ( Create , Read , Update , Destroy )


###Access level :
- Auth [ verify email , Reset password ] need to be authenticated
- User ( Create , Read , Update , Destroy ) need to be authorization( admin )
- Post ( Create , Update , Destroy ) need to be authorization( author )
- Comment ( Create , Update , Destroy ) need to be authorization( author )
- Category ( Create , Read , Update , Destroy ) need to be authorization( admin )

## How to use ?
Follow these steps to get this project live

###Get file
```bash
git clone https://github.com/amirsahra/blog-api.git
cd blog-api
composer install
php artisan key:generate
```
###Configure your .env file
For example:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```
###Create tables
```bash
php artisan migrate
```
###Fake data
To use fake data, you can use the created factories.
First, go to file `config/blogsetting.php` and change the `default_admin` with your information
Now :
```bash
php artisan db:seed
```
###Final steps
```bash
php artisan serv
```
