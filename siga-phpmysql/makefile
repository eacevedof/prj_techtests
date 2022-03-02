rebuild: ## rebuild containers
	docker-compose down
	docker-compose up -d

destroy-all: ## destroy containers
	docker-compose down --rmi all

ssh-web: ## web
	docker exec -it --user root cont-apache bash

start:
	docker-compose start

stop:
	docker-compose stop