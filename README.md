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
|   updated_time  	| Timestamp 	|
|   created_time  	| Timestamp 	|

password_resets:

| Column Name |    Type   |
|:-----------:|:---------:|
|    email    |  Varchar  |
|    token    |  Varchar  |
|  created_at | Timestamp |

posts:

| Column Name 	|    Type   	|
|:-----------:	|:---------:	|
|      id     	|    Int    	|
|   user_id   	|    Int    	|
|    title    	|   String  	|
|     body    	|  Longtext 	|
| updated_time 	| Timestamp 	|
| created_time 	| Timestamp 	|

comments:

| Column Name 	|    Type   	|
|:-----------:	|:---------:	|
|      id     	|    Int    	|
|   user_id   	|    Int    	|
|   post_id   	|    Int    	|
|   comment   	|    Text   	|
| updated_time 	| Timestamp 	|
| created_time 	| Timestamp 	|

likelist:

| Column Name |    Type   |
|:-----------:|:---------:|
|   user_id   |    Int    |
|  object_id  |    Int    |
|    object   |    Int    |
|  updated_at  | Timestamp |
|  created_at  | Timestamp |

migrations:

| Column Name |   Type  |
|:-----------:|:-------:|
|      id     |   Int   |
|  migration  | Varchar |
|    batch    |   Int   |