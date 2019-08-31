<?php
/**
 * User: TheCodeholic
 * Date: 8/31/2019
 * Time: 5:46 PM
 */

namespace thecodeholic\yii2grapesjs\actions;

use thecodeholic\yii2grapesjs\models\Content;
use Yii;

/**
 * Class SaveAction
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package thecodeholic\yii2grapesjs\actions
 */
class SaveAction extends BaseAction
{

    public function runWithParams($params)
    {
        $id = $params['id'];
        $content = Content::findOne($id);
        if (!$content) {
            $content = new Content();
        }
        if ($content->load(Yii::$app->request->post(), '') && $content->save()) {
            return $content->toArray();
        }
        return $content->errors;
    }
}
