# FEIP - Dev Symfony

---
## Requirements
- Docker
- GNU Make (only for helper Makefile)

## Development setup
1. Copy `.env` to `.env.local` and set variables.
2. Run `make first-time-setup`

## How to run web server for local development
Run `make start` then navigate to `http://localhost:{APP_DOCKER_HOST_PORT}` (see .env for port)

## How to set up PHP interpreter in PhpStorm on Mac OS X
1. Go to `PhpStorm -> Preferences -> PHP`
2. Set language level to `8.1`
3. Click on `...` button next to `CLI Interpreter` input field
4. Click on `+` button in the left top corner, select `From Docker` in pop-up
5. Select `Docker Compose` radio button
6. Click `New...` button next to `Server` field if it's empty, select `Docker for Mac` radio button, click `OK`
7. Select `php` in `Service`, click `OK` (this may take a while)
8. Check `Visible only for this project` checkbox
9. Select `Lifecycle -> Connect to existing container radio button` radio button, click `OK`
10. Click `OK` to apply PHP preferences

## How to set up PHPUnit to run unit tests in PhpStorm on Mac OS X
1. Go to `PhpStorm -> Preferences -> PHP -> Test Frameworks`
2. Click on `+` button in the top left corner, select `PHPUnit by Remote Interpreter` in pop-up
3. Select PHP interpreter from previous readme section, click `OK`
4. Click `OK` to apply settings
    - If PHPUnit and/or configuration file not found:
        - Run `make install`
        - Go to `File -> Invalidate Caches...`
        - Check all checkboxes
        - Click `Invalidate and Restart`
5. Go to `Run -> Edit Configurations...`
6. Click on `+` button in the top left corner, select `PHPUnit` in pop-up
7. Set `Name` to `Run Tests`
8. Select `Defined in the configuratin file` radio button in `Test Scope` radio group
9. Click `OK`
10. Run `Run Tests` configuration

## How to set up database connection in PhpStorm on Mac OS X
1. Run `make start`
2. Go to `View -> Tool Windows -> Database`
3. Click on `+` button, select `Data Source -> PostgreSQL`
4. Set input field values:
    - `Host` = `localhost`
    - `Port` = `DB_DOCKER_HOST_PORT` from `.env`
    - `User` = `DB_USERNAME` from `.env`
    - `Password` = `DB_PASSWORD` from `.env`
    - `Database` = `DB_DATABASE` from `.env`
5. Click `Test Connection` to verify settings
6. Click `OK`

## Tips
- Run `make` to list available commands
- You can use `./dep` (on Unix) or `dep` (on Windows) instead of `docker compose exec php`
