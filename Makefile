#!/usr/bin/make

export DOCKER_SCAN_SUGGEST = false

ifeq ($(OS), Windows_NT)
	PLATFORM = windows
	NUMBER_OF_LOGICAL_CORES = ${NUMBER_OF_PROCESSORS}
else
	UNAME_S = $(shell uname -s)
	ifeq ($(UNAME_S), Linux)
		PLATFORM = unix
		NUMBER_OF_LOGICAL_CORES = $(shell nproc)
	else ifeq ($(UNAME_S), Darwin)
		PLATFORM = unix
		NUMBER_OF_LOGICAL_CORES = $(shell sysctl -n hw.logicalcpu)
	endif
endif

ifeq ($(PLATFORM), windows)
	SHELL = cmd.exe
	DEP = dep
	HELP_SUPPORTED = $(shell where printf 2>&1 >nul && where awk 2>&1 >nul && echo yes)
else
	DEP = ./dep
	HELP_SUPPORTED = yes
endif

COMPOSE = docker compose --env-file .env.local

# https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help
help: ## Show this help
ifeq ($(HELP_SUPPORTED), yes)
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  \033[32m%-19s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)
else
	@echo Add "printf" and "awk" to PATH to display help
endif

.PHONY: create
create: ## Create containers
	$(COMPOSE) build

.PHONY: destroy
destroy: ## Destroy containers
	$(COMPOSE) down --rmi all --volumes --remove-orphans

.PHONY: start
start: ## Start containers
	$(COMPOSE) up --detach --remove-orphans

.PHONY: stop
stop: ## Stop containers
	$(COMPOSE) stop

.PHONY: restart
restart: stop start ## Restart containers

.PHONY: pull
pull: ## Pull fresh code from remote repository
	git pull
	git submodule update --init --recursive

.PHONY: install
install: ## Install all application dependencies
	$(DEP) composer install --ansi

.PHONY: install-assets
install-assets: ## Install all bundle assets
	$(DEP) php bin/console assets:install --symlink

.PHONY: first-time-setup
first-time-setup: pull start install install-assets ## Run initial setup

XDEBUG = $(COMPOSE) exec -u root php php docker/php/xdebug.php

.PHONY: xdebug-status
xdebug-status: ## Show Xdebug status
	$(XDEBUG) status

.PHONY: xdebug-enable
xdebug-enable: ## Enable Xdebug
	$(XDEBUG) enable
	@docker compose restart php
	$(XDEBUG) status

.PHONY: xdebug-disable
xdebug-disable: ## Disable Xdebug
	$(XDEBUG) disable
	@docker compose restart php
	$(XDEBUG) status

.PHONY: load-fixture
load-fixture:
	$(DEP) php bin/console doctrine:fixtures:load --no-interaction


.PHONY: php-cs-fixer
php-cs-fixer: ## Run PHP Coding Standards Fixer in analyze mode
	$(DEP) ./docker/php/php-cs-fixer fix --verbose --allow-risky=yes --dry-run

.PHONY: php-cs-fixer-fix
php-cs-fixer-fix: ## Run PHP Coding Standards Fixer in fix mode
	$(DEP) ./docker/php/php-cs-fixer fix --verbose --allow-risky=yes

.PHONY: php-codesniffer
php-codesniffer: ## Run PHP CodeSniffer in analyze mode
	$(DEP) ./docker/php/phpcs --standard='php-codesniffer.xml'

.PHONY: php-codesniffer-fix
php-codesniffer-fix: ## Run PHP CodeSniffer in fix mode
	$(DEP) ./docker/php/phpcbf --standard='php-codesniffer.xml'

PSALM = $(DEP) ./docker/php/psalm

.PHONY: psalm
psalm: ## Run Psalm in analyze mode
	$(PSALM) --diff

.PHONY: lint
lint: php-cs-fixer-fix php-codesniffer psalm ## Run all coding standard checkers, static analyzers etc

.PHONY: fix
fix: php-cs-fixer-fix php-codesniffer-fix ## Attempt to fix coding standard violations, static analyzer errors etc

.PHONY: md
migrate-diff:
	$(DEP) php bin/console doctrine:migrations:diff ## Generate migration

.PHONY: m
migrate:
	$(DEP) php bin/console doctrine:migrations:migrate ## Apply migrations

.PHONY: recreate-empty-db
recreate-empty-db: ## Recreate database and load fixtures
	$(DEP) bin/console doctrine:database:drop --force
	$(DEP) bin/console doctrine:database:create

.PHONY: openapi
openapi: recreate-empty-db ## Generate OpenAPI documentation
	$(DEP) php bin/console  nelmio:apidoc:dump --format=yaml > openapi.yaml