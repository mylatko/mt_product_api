.DEFAULT_GOAL := help

help:			##show this help
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

build:			##build containers
	docker-compose build

up:			##up containers
	docker-compose up -d
	docker exec -it -u root mytheresa_php /bin/bash -c "export COMPOSER_HOME=/var/www && composer install"

down:			##down containers
	docker exec -it -u root mytheresa_php /bin/bash -c "php bin/console doctrine:schema:drop -n --force --full-database"
	docker-compose down

make run:		##run project
	make build
	make up
	make migration
	make insert

migration:		##make migrations; containers should be run
	docker exec -it mytheresa_php /bin/bash -c "php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration"

insert:			##seed database
	docker exec -it -u root mytheresa_php /bin/bash -c "php bin/console doctrine:fixtures:load -n"

test:			##run tests
	docker exec -it mytheresa_php /bin/bash -c "\
    php bin/console cache:pool:clear cache.app && \
    php vendor/bin/codecept build && \
    php bin/console --env=test doctrine:migrations:migrate -n && \
    php bin/console --env=test doctrine:fixtures:load -n && \
    vendor/bin/codecept run api"

stan: 			##check stan
	docker exec -it mytheresa_php /bin/bash -c "php -d memory_limit=256M vendor/bin/phpstan analyse src"