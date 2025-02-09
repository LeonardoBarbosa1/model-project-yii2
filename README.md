Model Project
=========



## Docker

```bash
rm -rf vendor/ composer.lock
```

### DEV

```bash
docker kill model-project.localhost
docker kill phpmyadmin.model-project.localhost
docker kill mysql.model-project.localhost

docker rm model-project.localhost
docker rm phpmyadmin.model-project.localhost
docker rm mysql.model-project.localhost

docker rmi -f model-project-model-project.localhost
docker rmi -f model-project-mysql.model-project.localhost

```

```bash
docker compose up -d

```