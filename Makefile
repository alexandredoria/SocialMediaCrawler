.PHONY: up
up:
	docker compose up -d

.PHONY: stop
stop:
	docker compose stop

.PHONY: install
install:
	./shell/composer install

.PHONY: migrations
migrations:
	php bin/console doctrine:migrations:migrate

.PHONY: data-fixtures
data-fixtures:
	php bin/console doctrine:fixtures:load

.PHONY: messenger-worker
messenger-worker:
	php bin/console messenger:consume async -vv

.PHONY: scheduler-worker
scheduler-worker:
	php bin/console messenger:consume scheduler_default -vv

.PHONY: check
check:
	{ \
	./shell/composer fix ;\
	./shell/composer sniff ;\
	./shell/composer phpmd ;\
	./shell/composer phpstan ;\
	}
	
.PHONY: test
test:
	./shell/composer test

.PHONY: coverage
coverage:
	./shell/composer coverage

.PHONY: test-mutation
test-mutation:
	./shell/composer test-mutation