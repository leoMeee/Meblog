<?php
/*
 * post表测试数据
 * @author     wanglei@wyzc.com
 * @created_at    16/4/21 下午1:40
 */
use app\models\Post;

return [
    'title' => "文章标题 ".$faker->company,
    'content' => $faker->realText(200, 2),
    'tags' => "php",
    'created_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime,
    'status' => $faker->randomElement([Post::PUBLISHED,Post::UNPUBLISHED,Post::TRASH]),
    'author_id' => 2,
];
