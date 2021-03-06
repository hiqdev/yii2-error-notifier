<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

error_reporting(E_ALL & ~E_NOTICE);

$bootstrap = __DIR__ . '/../src/_bootstrap.php';

require_once file_exists($bootstrap) ? $bootstrap : __DIR__ . '/../vendor/autoload.php';
