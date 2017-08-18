<?php

/**
 * 日志记录工具
 * 默认日志目录为'/tmp' 初始化需要提供path参数进行日志目录创建（提供目录均为绝对路径）
 * 默认日志级别为'15',及全部级别（包括debug,info,warn,error）,初始化需要提供level参数进行更改
 * @author yuanxiaolin@gloabl28.com
 * @version 1.0.0
 * @since 2016.01.14
 */
class Logfile
{
    private $handle = null;
    private $filepath = '/tmp';
    private $level = 15;
    
    // $param  如：['path' => '/path/to','level' => 15]
    public function __construct($param = array())
    {
        $this->_init($param);
    }
    
    public function __destruct()
    {
        fclose($this->handle);
    }
    
    public function debug($msg)
    {
        return $this->write(1, $msg);
    }
    
    public function info($msg)
    {
        
        return $this->write(2, $msg);
    }
    
    public function warn($msg)
    {
        return $this->write(4, $msg);
    }
    
    public function error($msg)
    {
        return $this->write(8, $msg);
    }
    
    public function write($level,$msg)
    {
        if(($level & $this->level) == $level )
        {
            return $this->_write( $this->_leveltostr($level),$msg);
        }
    }
    
    private function _init( $param = array() ){
        
        if(isset($param['path']) && !empty($param['path']))
        {
            $this->filepath = rtrim($param['path'],'/');
        }
        
        if(isset($param['level']) && !empty($param['level']))
        {
            $this->level = $param['level'];
        }
        
        if( ! file_exists($this->filepath)){
            mkdir($this->filepath,0755,true);
        }
        
        $this->filepath = $this->filepath.'/log-'.date('Y-m-d').'.log';
        if ( ! file_exists($this->filepath))
        {
            $newfile = TRUE;
        }
        
        if ( ! $this->handle = @fopen($this->filepath, 'ab'))
        {
            $this->handle = FALSE;
            throw new Exception('cant not open file:'.$this->filepath);
        }
        
        if (isset($newfile) && $newfile === TRUE)
        {
            chmod($this->filepath, 0644);
        }
    }
        
    private function _write($level='',$message = '')
    {
    
        $date = date('Y-m-d H:i:s');
    
        $message = $level.' | '.$date.' | '.$message."\n";
    
        flock($this->handle, LOCK_EX);
    
        for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
        {
            if (($result = fwrite($this->handle, substr($message, $written))) === FALSE)
            {
                throw new Exception("cant not write {$message} in file");
                break;
            }
        }
    
        flock($this->handle, LOCK_UN);
    
        return is_int($result);
    }
    
    private function _leveltostr($level)
    {
        switch ($level)
        {
            case 1:
                return 'debug';
                break;
            case 2:
                return 'info';
                break;
            case 4:
                return 'warn';
                break;
            case 8:
                return 'error';
                break;
            default:
        }
    }
}
