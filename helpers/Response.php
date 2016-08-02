<?php
namespace app\helpers;

use Yii;

class  Response
{
    /**
     * 操作成功
     * @param array $data
     * @param int $code
     * @return array
     */
    public static function success($data = array(), $code = 200)
    {
        Yii::$app->response->statusCode = $code;

        return $data;
    }

    /**
     * 用户请求失败,服务器没有进行新建或修改数据 (请求数据不合法)
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function _400($message = '', $code = 400)
    {

        Yii::$app->response->statusCode = 400;
        $message = empty($message) ? \yii\web\Response::$httpStatuses[400] : $message;

        return ['message' => $message, 'code' => $code];
    }

    /**
     * 操作失败
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function error($message = '', $code = 400){
        return self::_400($message,$code);
    }
    
    /**
     * 身份认证失败 (用户需要登录才能执行此操作)
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function _401($message = '', $code = 401)
    {
        Yii::$app->response->statusCode = 401;
        $message = empty($message) ? \yii\web\Response::$httpStatuses[401] : $message;

        return ['message' => $message, 'code' => $code];

    }

    /**
     * 权限认证失败 (用户没有权限执行此操作)
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function _403($message = '', $code = 403)
    {
        Yii::$app->response->statusCode = 403;
        $message = empty($message) ? \yii\web\Response::$httpStatuses[403] : $message;

        return ['message' => $message, 'code' => $code];
    }

    /**
     * 用户请求的资源不存在 (课程不存在,文章不存在...)
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function _404($message = '', $code = 404)
    {
        Yii::$app->response->statusCode = 404;
        $message = empty($message) ? \yii\web\Response::$httpStatuses[404] : $message;

        return ['message' => $message, 'code' => $code];
    }

    /**
     * 服务器发生错误 (上传文件失败,加载资源失败...)
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function _500($message = '', $code = 500)
    {
        Yii::$app->response->statusCode = 500;
        $message = empty($message) ? \yii\web\Response::$httpStatuses[500] : $message;

        return ['message' => $message, 'code' => $code];
    }

}