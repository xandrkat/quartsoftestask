<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 */
class ComposerController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @return int Exit code
     */
    public function actionIndex($args = NULL): int
    {
        echo shell_exec($args) . "\n";

        return ExitCode::OK;
    }
}
