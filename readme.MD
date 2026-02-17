# Damoon

This is a Laravel application configured to run using **Laravel Sail** with Docker.
## Description
I use Domain Driven Development approach to provide this test project
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
### Api:
```
Method: POST
http://localhost:8000/api/book
```
```json
{
    "room_id" : 1,
    "user_name" : "Ali_Rezvani",
    "user_email" : "ali.rezvaniara@gmail.com",
    "check_in_date" : "2026-11-24",
    "check_out_date": "2026-11-24"
}
```
### Run Project:
```bash
php artisan serve

./vendor/bin/sail artisan serve
```

### queue:
```bash
php artisan queue:work --queue=high,default
```

also there is a code in the job you can enable commented code below:(BookingEmailJob.php)
```php
dd([$this->reservationModel,$this->room,$this->hotel]);
```
to see what we can show in the view
