# Survey

## Installation

```bash
$ docker run --rm --volume $PWD:/var/www/html registry.kuhdo.de/repository/webapp/app:latest composer install
```

## Testing

```bash
$ docker run --rm --volume $PWD:/var/www/html registry.kuhdo.de/repository/webapp/app:latest composer test
```
