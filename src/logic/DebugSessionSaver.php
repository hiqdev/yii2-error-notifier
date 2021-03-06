<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\errorNotifier\logic;

use hipanel\helpers\FileHelper;
use Yii;

/**
 * Class DebugSessionSaver is designed to save debug session result to a separate
 * directory to prevent valuable debug data from deleting with GC.
 */
class DebugSessionSaver
{
    /**
     * @var array
     */
    protected $key;

    /**
     * @var string
     */
    protected $dataPath;

    /**
     * @var string
     */
    protected $savedDataPath;

    /**
     * DebugSessionSaver constructor.
     * @param array $key
     * @param string $dataPath
     * @param string $savedDataPath
     * @internal param array $options
     */
    public function __construct($key, $dataPath = '@runtime/debug', $savedDataPath = '@runtime/saved-debug')
    {
        $this->key = $key;
        $this->dataPath = Yii::getAlias($dataPath);
        $this->savedDataPath = Yii::getAlias($savedDataPath);
    }

    /**
     * @return bool whether data was saved
     */
    public function run()
    {
        return $this->saveDebug();
    }

    /**
     * @return bool
     */
    protected function saveDebug()
    {
        $filename = "{$this->key}.data";

        $source = "{$this->dataPath}/$filename";
        if (!is_file($source)) {
            return false;
        }

        FileHelper::createDirectory($this->savedDataPath);

        return copy($source, "{$this->savedDataPath}/$filename") !== false;
    }
}
