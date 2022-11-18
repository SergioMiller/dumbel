.PHONY: up
up: ## Start dev environment
		docker-compose up

.PHONY: swagger
swagger:
		./vendor/bin/openapi --output ./public ./app

.PHONY: php-cs-fixer
php-cs-fixer:
		php-cs-fixer fix app/ --allow-risky=yes