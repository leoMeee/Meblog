##MeBlog


A blog base yii2

###Install

    cp docker-compose-example.yml docker-compose.yml
    cp .env-example .env
    docker-compose up -d
    docker-compose run --rm web ./yii migrate