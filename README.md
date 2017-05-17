## MeBlog


A blog base yii2+react

## 依赖环境

- docker
- docker-compose 

### 安装

    cp docker-compose-example.yml docker-compose.yml
    cp .env-example .env
    docker-compose up -d
    docker-compose run --rm web ./yii migrate

### 生成测试数据

    docker exec -ti meblog_app_1 ./yii fixture/load "*"

### 测试账号

    username: admin
    password: admin
