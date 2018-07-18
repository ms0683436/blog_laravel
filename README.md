# BLOG Laravel
use laravel 5.6 to build a blog

## Features
- you can post something
- comment someone's post
- you can press like button

## TODO
- add avatar
- chat room

## Installation
- `git clone https://github.com/ms0683436/blog_laravel.git`
- `cd blog_laravel`
- `composer install`
- `php artisan migrate`
- `php artisan serve` to start the app on http://localhost:8000/

## Database Structure

users:

|   Column Name  	|   Type      	|
|:--------------:	|-----------	|
|       id       	|    Int    	|
|      name      	|   String  	|
|      email     	|   String  	|
| remember_token 	|   String    	|
|   update_time  	| Timestamp 	|
|   create_time  	| Timestamp 	|

posts:

| Column Name 	|    Type   	|
|:-----------:	|:---------:	|
|      id     	|    Int    	|
|   user_id   	|    Int    	|
|    title    	|   String  	|
|     body    	|  Longtext 	|
| update_time 	| Timestamp 	|
| create_time 	| Timestamp 	|

comments:

| Column Name 	|    Type   	|
|:-----------:	|:---------:	|
|      id     	|    Int    	|
|   user_id   	|    Int    	|
|   post_id   	|    Int    	|
|   comment   	|    Text   	|
| update_time 	| Timestamp 	|
| create_time 	| Timestamp 	|

likelist:

| Column Name |    Type   |
|:-----------:|:---------:|
|   user_id   |    Int    |
|  object_id  |    Int    |
|    object   |    Int    |
|  update_at  | Timestamp |
|  create_at  | Timestamp |