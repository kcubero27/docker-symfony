#!/bin/bash

PROJECT_NAME=${PROJECT_NAME:-docker-symfony}
UID=$(shell id -u)

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose stop

restart: ## Restart the containers
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose restart

build: ## Rebuilds all the containers
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose build

prepare: ## Runs backend commands
	mkdir -p var/cache/{dev,prod}

# Backend commands
composer-install: prepare run ## Installs composer dependencies
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} php composer install \
		--no-scripts --no-interaction --optimize-autoloader

php-logs: run ## Tails the Symfony dev log
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} php tail -f var/log/dev.log
# End backend commands

ssh-php: run ## ssh's into the be container
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} php ash

ssh-mysql: run ## ssh's into the db container
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} mysql bash

ssh-nginx: run ## ssh's into the web container
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} nginx ash

code-style: run ## Runs php-cs to fix code styling following Symfony rules
	U_ID=${UID} COMPOSE_PROJECT_NAME=${PROJECT_NAME} \
	docker-compose exec -u ${UID} php php-cs-fixer fix src --rules=@Symfony
