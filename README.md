# Sample usage

## Docker

```
docker-compose run app bin/console app:process-events test_data/recruitment-task-source.json --outInspection=test_data/inspection.json --outFailureReport=test_data/failureReport.json
```

or

```
docker-compose run app bin/console app:process-events test_data/recruitment-task-source.json -i test_data/inspection.json -f test_data/failureReport.json
```

## Run tests

```
docker compose run app vendor/bin/phpunit
```