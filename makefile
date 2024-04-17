include .env

up:
	docker-compose up --build
	docker-compose exec app php artisan passport:install
migrate-and-seed:
	docker-compose exec app php artisan migrate
	docker-compose exec app php artisan db:seed --class=UserSeeder
down:
	docker-compose down
