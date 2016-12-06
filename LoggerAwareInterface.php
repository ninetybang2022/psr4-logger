<?php
/**
 * Created by 布卡漫画.
 * User: LwB
 * Date: 2016/11/18
 * Time: 20:17
 */

namespace Lib\Logger;


/**
 * logger-aware 定义实例
 */
interface LoggerAwareInterface
{
    /**
     * 设置一个日志记录实例
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger);
}