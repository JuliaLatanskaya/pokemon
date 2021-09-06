1. Clone repository
2. cd into root folder where docker-compose.yaml is located
3. > docker-compose up
4. > docker ps
5. Be sure that pokemon-php-fpm container is up
6. > docker exec -it pokemon-php-fpm bash
7. > yarn encore dev --watch
8. Open localhost:8080