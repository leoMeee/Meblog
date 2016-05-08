<?php
/*
 * 评论表测试数据
 * @author     wanglei@wyzc.com
 * @created_at    16/4/21 下午1:40
 */
return [
    'author' => $faker->name,
    'content' => $faker->realText(200, 2),
    'created_at' => $faker->unixTime,
    'post_id' => 29,
];
