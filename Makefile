include .env

up:
	docker-compose up -d
stop:
	docker-compose stop
bash:
	docker exec -it --user ${USER_PHP} ${CONTAINER_PHP} bash
migrate:
	docker exec --user ${USER_PHP} ${CONTAINER_PHP} php artisan migrate
seed:
	docker exec --user ${USER_PHP} ${CONTAINER_PHP} php artisan app:fill-rates
supervisor:
	docker exec --user root ${CONTAINER_PHP} service supervisor restart
	docker exec --user root ${CONTAINER_PHP} service supervisor start laravel-worker