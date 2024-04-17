Integration with Giphy 

- This is an integration with GiphyAPI to prove my knowledge in several techonologies and good practices such as: 
docker, php, laravel, postman, clean pattern, diagrams, REST api, third party api, etc.  

- Api's diagrams are inside `.diagram` folder in the root folder, describing each flow and design. 

Requirements, must have:  

- Docker or docker-compose installed and running. 
- Make installed (optional)
- Postman installed

Steps to install with and without MAKE: 

Without make: 
1. Open project and run `docker-compose up --build`
2. Run `docker-compose exec app php artisan passport:install`
3. Run `docker-compose exec app php artisan migrate`
4. Run `docker-compose exec app php artisan db:seed --class=UserSeeder`

With make:  
1. Run makefile routine: `make up`
2. Run makefile routine: `make migrate-and-seed`

How to use? 

- Download postman workspace located in the top of root folder (.postman)
- Import its content as a workspace and use it!



