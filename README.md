# docker-symfony

Create the database:
make ssh-mysql
mysql-uroot -p
CREATE DATABASE symfony;
GRANT ALL PRIVILEGES ON symfony.* TO user;

