.PHONY: up
up:
		docker-compose up

.PHONY: swagger
swagger:
		./vendor/bin/openapi --output ./public ./app

.PHONY: php-cs-fixer
php-cs-fixer:
		php-cs-fixer fix app/ --allow-risky=yes

.PHONY: app
app:
		docker compose exec php bash

.PHONY: optimize
optimize:
		docker compose exec php sh -lc 'php artisan optimize'

.PHONY: composer-install
composer-install:
		docker-compose exec php sh -lc 'composer install'

.PHONY: migrate
migrate:
		docker-compose exec app sh -lc 'php artisan migrate'

.PHONY: seed
seed:
		docker-compose exec app sh -lc 'php artisan migrate'
