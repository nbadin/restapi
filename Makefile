up:
	vendor/bin/sail up -d

migrate:
	vendor/bin/sail artisan migrate --seed

down:
	 vendor/bin/sail down
