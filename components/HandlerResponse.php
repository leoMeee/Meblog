<?php
/*
 * response 处理
 * @author     wanglei@wyzc.com
 * @created_at    16/6/1 下午12:05
 */
namespace app\components;

use yii\web\Response;

class HandlerResponse
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function processor()
    {
        if ($this->response->format == Response::FORMAT_JSON) {
            if ($this->response->statusCode == 200) {
                $this->successProcessor();
            } else {
                $this->errorProcessor();
            }
        };

    }

    /**
     * 成功返回
     * -----------------------------
     *  {
     *    "success": true,
     *    "data": [], //业务数据
     *    "message": "success",
     *    "code": 200,
     *    "status": 200
     *  }
     * -----------------------------
     */
    private function successProcessor()
    {
        $this->response->data = [
            'success' => true,
            'data' => $this->response->data,
            'message' => 'success',
            'code' => 200,
            'status' => 200,
        ];

    }

    /**
     * 失败返回
     * -----------------------------
     *  {
     *    "success": false,
     *    "data": [],
     *    "message": "Unauthorized", //失败原因
     *    "code": 1004,  //业务状态码
     *    "status": 401  //http状态码
     *  }
     * -----------------------------
     */
    public function errorProcessor()
    {
        $message = $this->response->data['message'] ? $this->response->data['message'] : $this->response->data['name'];
        if (is_array($message)) {
            $message = array_values($message);
            $message = array_shift($message);
            $message = is_array($message) ? array_shift($message) : $message;
        }
        $this->response->data = [
            'success' => false,
            'data' => [],
            'message' => $message,
            'code' => $this->response->data['code'] > 0 ? $this->response->data['code'] : $this->response->statusCode,
            'status' => $this->response->statusCode,
        ];

    }
}