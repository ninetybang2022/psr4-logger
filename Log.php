<?php
/**
 * Created by 布卡漫画.
 * User: LwB
 * Date: 2016/11/18
 * Time: 20:16
 */

namespace Lib\Logger;

use Lib\Logger\LoggerInterface;
use Lib\Logger\LogLevel;

class Log implements LoggerInterface
{
    /**
     * 系统不可用
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     *  **必须** 立刻采取行动
     *
     * 例如：在整个网站都垮掉了、数据库不可用了或者其他的情况下， **应该** 发送一条警报短信把你叫醒。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::ALERT, $message, $context);
    }

    /**
     * 紧急情况
     *
     * 例如：程序组件不可用或者出现非预期的异常。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * 运行时出现的错误，不需要立刻采取行动，但必须记录下来以备检测。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::ERROR, $message, $context);
    }

    /**
     * 出现非错误性的异常。
     *
     * 例如：使用了被弃用的API、错误地使用了API或者非预想的不必要错误。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::WARNING, $message, $context);
    }

    /**
     * 一般性重要的事件。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::NOTICE, $message, $context);
    }

    /**
     * 重要事件
     *
     * 例如：用户登录和SQL记录。
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::INFO, $message, $context);
    }

    /**
     * debug 详情
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        return $this->commonLogMsg(LogLevel::DEBUG, $message, $context);
    }

    /**
     * 任意等级的日志记录
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if(!method_exists($this, $level))
        {
            throw new InvalidArgumentException('log level invalid');
        }
        return $this->$level($message, $context);
    }

    private function commonLogMsg($level, $message, array $context = array())
    {
        if(isset($context['exception']))
        {
            if(!$context['exception'] instanceof \Exception)
            {
                throw new \InvalidArgumentException('exception key must be instanceof Exception ');
            }
        }
        $logMsg = $this->logTime() . strtoupper($level) . ':' . $this->placeholderToVariable($message, $context);
        return $logMsg;
    }

    private function logTime()
    {
        return '['.date('Y-m-d H:i:s', time()).']';
    }

    /**
     * 将点位字符替换为相应context中key的值
     * @param $message
     * @param $context
     */
    private function placeholderToVariable($message, $context)
    {
        $replace = array();
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }

}