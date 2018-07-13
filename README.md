# BLOG Laravel
use laravel 5.6 to build a blog

## Features
- you can post something
- comment someone's post
- you can press like button

## TODO
- add avatar
- chat room

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