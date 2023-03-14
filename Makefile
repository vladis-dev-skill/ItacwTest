down: docker-down
up: docker-up
init: docker-down-clear docker-pull docker-build docker-up run-app
exec_bash: docker-exec-bash
test: itacwt-test

itacwt-test:
	docker exec -it itacwt_php-fpm php bin/phpunit

docker-up:
	docker-compose -f docker_itacwt/docker-compose.yml up -d

docker-down:
	docker-compose -f docker_itacwt/docker-compose.yml down --remove-orphans

docker-down-clear:
	docker-compose -f docker_itacwt/docker-compose.yml down -v --remove-orphans

docker-pull:
	docker-compose -f docker_itacwt/docker-compose.yml pull

docker-build:
	docker-compose -f docker_itacwt/docker-compose.yml build

docker-exec-bash:
	docker exec -it itacwt_php-fpm bash

#Run app

run-app: composer-install itacwt-migrate itacwt-fixture itacwt-phpcs

composer-install:
	docker exec -it itacwt_php-fpm composer install

itacwt-migrate:
	docker exec -it itacwt_php-fpm php bin/console doctrine:migrations:migrate --no-interaction

itacwt-fixture:
	docker exec -it itacwt_php-fpm php bin/console doctrine:fixtures:load --no-interaction

itacwt-phpcs: itacwt-phpcs-mkdir itacwt-phpcs-composer
itacwt-phpcs-mkdir:
	docker exec -it itacwt_php-fpm mkdir -p --parents tools/php-cs-fixer
itacwt-phpcs-composer:
	docker exec -it itacwt_php-fpm composer require --no-interaction --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

itacwt-php-cs-fixer:
	docker exec -it itacwt_php-fpm tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src