.PHONY: up
up:
		docker-compose up

.PHONY: swagger
swagger:
	docker compose exec php sh -lc './vendor/bin/openapi --output ./public ./app'

.PHONY: php-cs-fixer
php-cs-fixer:
		docker compose exec php sh -lc 'php-cs-fixer fix app/ --allow-risky=yes'

.PHONY: app
app:
		docker compose exec php bash

.PHONY: optimize
optimize:
		docker compose exec php sh -lc 'php artisan optimize'

.PHONY: composer-install
composer-install:
		docker-compose exec php sh -lc 'composer install'

.PHONY: db-migrate
db-migrate:
		docker-compose exec php sh -lc 'php artisan migrate'

.PHONY: db-seed
db-seed:
		docker-compose exec php sh -lc 'php artisan db:seed'
