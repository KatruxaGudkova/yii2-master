include .env

install:
	@$(MAKE) -s down
	@$(MAKE) -s docker-build
	@$(MAKE) -s up

up:
	@docker compose -p calculator-form up -d

down:
	@docker compose -p calculator-form down --remove-orphans

ps:
	@docker compose -p calculator-form ps

restart: down up

logs:
	@docker compose -p calculator-form logs -f

docker-build: \
	docker-build-php-fpm \
	docker-build-nginx

docker-build-php-fpm:
	@docker build --target=fpm \
	--build-arg USER=1000 \
	--build-arg GROUP=1000 \
	-t localhost/calculator-form-php-fpm:latest -f ./docker/Dockerfile .

docker-build-nginx:
	@docker build --target=nginx \
	-t localhost/calculator-form-nginx:latest -f ./docker/Dockerfile .