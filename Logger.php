<?php
/**
 * Created by 布卡漫画.
 * User: LwB
 * Date: 2016/11/18
 * Time: 20:56
 */

namespace Lib\Logger;

use Lib\Logger\Log;
use Lib\Logger\LoggerAwareInterface;

class Logger implements LoggerAwareInterface
{
    private $logFile;
    private $log;

    public function __construct(LoggerInterface $logger, $logFile)
    {
        $this->logFile = $logFile;
        $this->setLogger($logger);
    }

    /**
     * 设置一个日志记录实例
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->log = $logger;
    }

    /**
     * 写入日志文件
     * @param $logFile
     * @param $logMsg
     */
    private function write($logMsg)
    {
        $fp = fopen($this->logFile, 'a+');
        fwrite($fp, $logMsg."\n");
        fclose($fp);
    }

    public function __call($method, $param)
    {
        if(!method_exists($this->log, $method))
        {
            throw new \BadMethodCallException($method . 'not Method');
        }
        $logMsg = call_user_func_array(array($this->log, $method), $param);
        $this->write($logMsg);
    }

}