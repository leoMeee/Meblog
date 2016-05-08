<?php
/*
 * 评论表测试数据
 * @author     wanglei@wyzc.com
 * @created_at    16/4/21 下午1:40
 */
return [
    'id' => $index + 1,
    'author' => $faker->name,
    'content' => $faker->randomElement(['支持!','威武!','好样的!','有希望了!']),
    'created_at' => $faker->unixTime,
    'post_id' => $index + 1,
];
