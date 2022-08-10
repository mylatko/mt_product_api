.DEFAULT_GOAL := help

help:			##show this help
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

build:			##build containers
	docker-compose build

up:			##up containers
	docker-compose up -d
	docker exec -it -u root mytheresa_php /bin/bash -c "export COMPOSER_HOME=/var/www && composer install"

down:			##down containers
	docker-compose down

make run:		##run project
	make build
	make up