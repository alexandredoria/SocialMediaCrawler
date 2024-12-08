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
	./shell/php bin/console doctrine:migrations:migrate

.PHONY: data-fixtures
data-fixtures:
	./shell/php bin/console doctrine:fixtures:load

.PHONY: messenger-worker
messenger-worker:
	./shell/php bin/console messenger:consume async -vv

.PHONY: scheduler-worker
scheduler-worker:
	./shell/php bin/console messenger:consume scheduler_default -vv

.PHONY: update-dispatcher
update-dispatcher:
	./shell/php bin/console app:update-all-social-media-user

.PHONY: check
check:
	{ \
	./shell/composer fix ;\
	./shell/composer phplint ;\
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