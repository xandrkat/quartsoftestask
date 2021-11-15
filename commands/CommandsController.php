<?php

namespace app\commands;

/**
 * CommandsController
 */
class CommandsController extends \yii\console\Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex($args = NULL): int
    {
        echo 'hello' . PHP_EOL;

        return \yii\console\ExitCode::OK;
    }
}
