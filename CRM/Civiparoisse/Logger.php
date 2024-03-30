<?php
use Psr\Log\AbstractLogger;
class CRM_Civiparoisse_Logger extends AbstractLogger
{
  protected string $_output;
  protected static $stdoutLogger=null;
  protected static $stderrLogger=null;

  protected function __construct(string $output)
  {
    $this->_output=$output;
  }

  public function log($level, $message, array $context = [])
  {
    $logMessage=[
        'dt'=>(new DateTime())->getTimestamp(),
        'level'=>$level,
        'message'=>$message,
        'context'=>$context
      ];
    $json_encoded=json_encode($logMessage).PHP_EOL;
    $fd=fopen($this->_output,'a');
    fwrite($fd,$json_encoded);
    fflush($fd);
    fclose($fd);

  }

  public static function getStdoutLogger(): CRM_Civiparoisse_Logger
  {
    if(static::$stdoutLogger==null)
    {
      static::$stdoutLogger=new CRM_Civiparoisse_Logger('php://stdout');
    }
    return static::$stdoutLogger;
  }

  public static function getStderrLogger(): CRM_Civiparoisse_Logger
  {
    if(static::$stderrLogger==null)
    {
      static::$stderrLogger=new CRM_Civiparoisse_Logger('php://stderr');
    }
    return static::$stderrLogger;
  }
}
