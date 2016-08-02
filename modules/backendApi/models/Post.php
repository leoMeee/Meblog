<?php
namespace app\modules\backendApi\models;

use app\models\Post as PostModel;

class Post extends PostModel
{
    const SCENARIO_CREATE = 'scenario_create';
    const SCENARIO_UPDATE = 'scenario_update';
    const SCENARIO_UPDATE_STATUS = 'scenario_update_status';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'title'], 'required', 'on' => self::SCENARIO_CREATE],
            [['content', 'title'], 'required', 'on' => self::SCENARIO_UPDATE],
            ['status', 'in', 'range' => [self::STATUS_UNPUBLISHED, self::STATUS_PUBLISHED, self::STATUS_TRASH]],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['content', 'title', 'status'];
        $scenarios[self::SCENARIO_UPDATE] = ['content', 'title', 'status'];
        $scenarios[self::SCENARIO_UPDATE_STATUS] = ['status'];

        return $scenarios;
    }

    public function fields()
    {
        $fields = parent::fields();

        return $fields;
    }

}