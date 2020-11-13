# docker-symfony 🐳

## Installation
### Pre-requisites
Install [Docker Desktop](https://docs.docker.com/desktop/) in your laptop.

Copy the environment files:
```
$ cp .env .env.local
```

### Database
It's necessary to create a database manually as well as give privileges to the user we ha ve created:
```
$ make ssh-mysql
$ mysql-uroot -p
$ CREATE DATABASE <MYSQL_DATABASE>;
$ GRANT ALL PRIVILEGES ON <MYSQL_DATABASE>.* TO <MYSQL_USER>;
```

## Debugger

## Testing

## Contributors
[ ] Pending


