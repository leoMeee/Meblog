<?php
/*
 * post表测试数据
 * @author     wanglei@wyzc.com
 * @created_at    16/4/21 下午1:40
 */
use app\models\Post;

return [
    'id' => $index + 1,
    'title' => "前端工具与框架",
    'content' => "##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
",
    'tags' => "php",
    'created_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime,
    'status' => $faker->randomElement([Post::PUBLISHED, Post::UNPUBLISHED, Post::TRASH]),
    'author_id' => $index + 1,
];
