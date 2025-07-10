PHP=php
ARTISAN=$(PHP) artisan
COMPOSER=composer

## Install Composer dependencies
install: ## Установить зависимости проекта
	$(COMPOSER) install

## Run Laravel server
serve: ## Запустить локальный сервер Laravel
	$(ARTISAN) serve

## Run database migrations
migrate: ## Выполнить миграции
	$(ARTISAN) migrate

## Rollback last migration
rollback: ## Откатить последнюю миграцию
	$(ARTISAN) migrate:rollback

## Fresh DB migrate and seed
refresh: ## Полностью пересоздать базу данных и наполнить сидерами
	$(ARTISAN) migrate:fresh --seed

## Run PHPUnit tests
test: ## Запустить тесты
	$(PHP) vendor/bin/phpunit

## Generate Swagger docs
docs: ## Сгенерировать документацию Swagger
	$(ARTISAN) l5-swagger:generate


## Run Pint (Laravel code style fixer)
lint: ## Запустить Laravel Pint для автоформатирования кода
	$(PHP) vendor/bin/pint


build:
	make install
	make migrate
	make docs
	make serve

