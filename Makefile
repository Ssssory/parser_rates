include .env

up:
	docker-compose up -d
stop:
	docker-compose stop
bash:
	docker exec -it --user ${USER_PHP} ${CONTAINER_PHP} bash
migrate:
	docker exec --user ${USER_PHP} ${CONTAINER_PHP} bash php artisan migrate