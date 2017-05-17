## MeBlog


A blog base yii2+react

## 依赖环境

- docker
- docker-compose 

### 安装

    cp docker-compose-example.yml docker-compose.yml
    cp .env-example .env
    docker-compose up -d
    docker-compose run --rm app ./yii migrate

### 生成测试数据

    docker exec -ti meblog_app_1 ./yii fixture/load "*"

### 后台地址

    http://your.domain.com/backend

