# Survey

## Installation

```bash
$ git clone ssh://git@git.kuhdo.de:7999/kuh/laravel-survey.git
$ cd laravel-survey
$ docker run --rm --volume $PWD:/var/www/html registry.kuhdo.de/repository/webapp/app:latest composer install
```

## Testing

```bash
$ docker run --rm --volume $PWD:/var/www/html registry.kuhdo.de/repository/webapp/app:latest composer test
```
