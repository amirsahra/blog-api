![Employee data](https://codigoonclick.com/wp-content/uploads/2021/07/api-rest-ful-laravel.png "Image")

# Laravel Blog Rest API

In this project, a blog has been implemented as a restful api.
Things like user registration, authentication, password recovery, email confirmation, user management by admin, posts, categories, comments have been created.

Fake data has been used for testing and development.

### Some rules :
- User management is done only by admin.
- We have two types of users, admin and member.
- ...

### Features :
```bash
- Auth ( Login , Register , verify email , Reset password )
- User ( Create , Read , Update , Destroy , Search ) just for admin
- Post ( Create , Read , Update , Destroy , Search)
- Comment ( Create , Read , Update , Destroy , Search)
- Category ( Create , Read , Update , Destroy , Search)
```

### Access level :
```bash
- Auth ( verify email , Reset password ) need to be authenticated
- User ( Create , Read , Update , Destroy , Search) need to be authorization( admin )
- Post ( Create , Update , Destroy ) need to be authorization( author )
- Comment ( Create , Update , Destroy ) need to be authorization( author )
- Category ( Create , Read , Update , Destroy ) need to be authorization( admin )
```

## How to use ?
Follow these steps to get this project live

### Get file
```bash
git clone https://github.com/amirsahra/blog-api.git
cd blog-api
composer install
php artisan key:generate
```
### Configure your .env file
Enter the database and table information that you have already created

For example :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```
### Create tables
```bash
php artisan migrate
```
### Fake data
To use fake data, you can use the created factories.
First, go to file `config/blogsetting.php` and change the `default_admin` with your information
Now :
```bash
php artisan db:seed
```
### Final steps
```bash
php artisan serv
```

## Who to work?
Now the project has been implemented and the request can be sent with the defined endpoints

### Endpoint
```bash
 1 User
    1 ) Show All    -> /api/v1/user 
    2 ) Create      -> /api/v1/user 
    3 ) Read        -> /api/v1/user/{id} 
    4 ) Update      -> /api/v1/user/{id} 
    5 ) Destroy     -> /api/v1/user/{id} 
    5 ) Search     -> /api/v1/users/search 
    
2. Auth
    1 ) Register             -> /api/v1/register 
    2 ) Login                -> /api/v1/login
    3 ) Logout               -> /api/v1/logout
    4 ) verification resend  -> /api/v1/email/resend 
    5 ) verification verify  -> /api/v1/email/verify/{id} 
    
3. Post
    1 ) Show All    -> /api/v1/post 
    2 ) Create      -> /api/v1/post 
    3 ) Read        -> /api/v1/post/{id} 
    4 ) Update      -> /api/v1/post/{id} 
    5 ) Destroy     -> /api/v1/post/{id}
     
4. Category
    1 ) Show All    -> /api/v1/caegory 
    2 ) Create      -> /api/v1/caegory 
    3 ) Read        -> /api/v1/caegory/{id} 
    4 ) Update      -> /api/v1/caegory/{id} 
    5 ) Destroy     -> /api/v1/caegory/{id} 
    
5. Comment
    1 ) Show All    -> /api/v1/comment 
    2 ) Create      -> /api/v1/comment 
    3 ) Read        -> /api/v1/comment/{id} 
    4 ) Update      -> /api/v1/comment/{id} 
    5 ) Destroy     -> /api/v1/comment/{id} 
    
   
```
## Api document

coming soon ....

## license
[MIT](https://choosealicense.com/licenses/mit/)
Copy write amirsahra
