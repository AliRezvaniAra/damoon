# Damoon

This is a Laravel application configured to run using **Laravel Sail** with Docker.

## Requirements

- Docker
- Docker Compose
- Laravel Sail (comes with the project after `composer install`)

---

## Installation

Clone the repository and navigate into the project directory:

```bash
git clone https://github.com/AliRezvaniAra/damoon.git
cd damoon
```
### Composer install:
```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/opt \
  -v ~/.composer/cache:/tmp/composer \
  -w /opt \
  laravelsail/php82-composer:latest \
  composer install --ignore-platform-req=ext-intl --no-cache

  ./vendor/bin/sail up -d
```
### Migrate:
```bash
php artisan migrate

./vendor/bin/sail artisan migrate
```
### Seeder:
```bash
php artisan migrate:fresh --seed

./vendor/bin/sail artisan migrate:fresh --seed
```
### Tests:
```bash

```
### Run Project:
```bash
php artisan serve

./vendor/bin/sail artisan serve
```
