### PSR-4 Simple Logger Class
> PSR-4 Logger Class 
```php
<?php
    //Logger Instance
    /*
        if param 2 type is string write logfile
        if param 2 type is boolean true return log
    */
    $log = new Lib\Log\Log(new Lib\Log\Logger, 'log\log.log');
    //$log = new Lib\Log\Log(new Lib\Log\Logger, true);
    $log->debug('This is a debug info');
    $log->info('This is info');
    $log->notify('This is nityfi info');
    $log->error();
    $log->warning();
    $log->log();
    $log->critical();
?>
``` 
