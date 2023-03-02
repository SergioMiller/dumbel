.PHONY: start
start: down build up composer-install

.PHONY: restart
restart: stop up

.PHONY: up-prod
up-prod: ## Start prod environment
		docker compose -f docker-compose.yml up

.PHONY: up
up: ## Start dev environment
		docker compose -f docker-compose.yml up

.PHONY: build
build: ## Build dev environment and initialize composer and project dependencies
		docker compose -f docker-compose.yml build

.PHONY: stop
stop: ## stop environment
		docker compose stop

.PHONY: down
down: stop## Stop and delete containers, clean volumes.
		docker-compose down

.PHONY: composer-install
composer-install: ## Run composer dump-autoload
		docker compose exec app sh -lc 'composer install'

.PHONY: composer-optimize
composer-optimize: ## Run composer dump-autoload
		docker compose exec app sh -lc 'composer dump-autoload --no-dev --classmap-authoritative'

.PHONY: key-gen
key-gen: ## Run php artisan key:generate
		docker compose exec app sh -lc 'php artisan key:generate'

.PHONY: db-reset
db-reset: ## Run migrations
		docker compose exec app sh -lc 'php artisan migrate:reset'

.PHONY: db-migrate
db-migrate: ## Run migrations
		docker compose exec app sh -lc 'php artisan migrate'

.PHONY: db-rollback
db-rollback: ## Run rollback migrations
		docker compose exec app sh -lc 'php artisan migrate:rollback'

.PHONY: db-seed
db-seed: ## Run migrations
		docker compose exec app sh -lc 'php artisan db:seed'

.PHONY: optimize
optimize: ## Run optimize
		docker-compose exec app sh -lc 'php artisan optimize'

.PHONY: logs
logs: ## Show docker-compose logs
		docker-compose logs -f

.PHONY: swagger
swagger: ## Generate OpenAPI
	docker-compose exec app sh -lc './vendor/bin/openapi ./app -o ./storage'

.PHONY: app
app: ## Go inside php container
		docker-compose exec app sh
