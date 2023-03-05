.PHONY: up
up: ## Start dev environment
		docker compose -f docker-compose.yml up

.PHONY: build
build:
		docker compose -f docker-compose.yml build

.PHONY: stop
stop:
		docker compose stop

.PHONY: composer-install
composer-install:
		docker compose exec app bash -lc 'composer install'

.PHONY: db-migrate
db-migrate:
		docker compose exec app bash -lc 'php artisan migrate'

.PHONY: db-seed
db-seed:
		docker compose exec app bash -lc 'php artisan db:seed'

.PHONY: optimize
optimize:
		docker-compose exec app bash -lc 'php artisan optimize'

.PHONY: swagger
swagger:
	docker-compose exec app bash -lc './vendor/bin/openapi ./app -o ./storage'

.PHONY: app
app:
		docker-compose exec app bash
