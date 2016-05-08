<?php
namespace app\widgets;

use yii\base\Widget;

class Alert extends Widget
{
    public $success = null;
    public $warning = null;
    public $danger = null;
    public $info = null;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if (!empty($this->success)) {
            $type = "success";
            $message = $this->success;
        } elseif (!empty($this->warning)) {
            $type = "warning";
            $message = $this->warning;
        } elseif (!empty($this->danger)) {
            $type = "danger";
            $message = $this->danger;
        } elseif (!empty($this->info)) {
            $type = "info";
            $message = $this->info;
        } else {
            return false;
        }

        return $this->render('alert', compact('type', 'message'));

    }
}
