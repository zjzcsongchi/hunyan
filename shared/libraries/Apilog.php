<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Logging Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/errors.html
*/
class Apilog {

    /**
     * Path to save log files
     *
     * @var string
     */
    protected $_log_path;

    /**
     * File permissions
     *
     * @var	int
     */
    protected $_file_permissions = 0644;

    /**
     * Level of logging
     *
     * @var int
     */
//     protected $_threshold = 1;

    /**
     * Array of threshold levels to log
     *
     * @var array
     */
//     protected $_threshold_array = array();

    /**
     * Format of timestamp for log files
     *
     * @var string
    */
    protected $_date_fmt = 'Y-m-d H:i:s';

    /**
     * Filename extension
     *
     * @var	string
     */
    protected $_file_ext;

    /**
     * Whether or not the logger can write to the log files
     *
     * @var bool
     */
    protected $_enabled = TRUE;

    /**
     * Predefined logging levels
     *
     * @var array
     */
    protected $_levels = array('ERROR' => 1, 'DEBUG' => 2, 'INFO' => 3, 'ALL' => 4, 'USER_INFO'=> 5);

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * @return	void
    */
    public function __construct($config)
    {

        $this->_log_path = ($config['log_path'] !== '') ? $config['log_path'] : APPPATH.'logs/';
        $this->_file_ext = (isset($config['log_file_extension']) && $config['log_file_extension'] !== '')
        ? ltrim($config['log_file_extension'], '.') : 'php';

        file_exists($this->_log_path) OR mkdir($this->_log_path, 0755, TRUE);

        if ( ! is_dir($this->_log_path) OR ! is_really_writable($this->_log_path))
        {
            $this->_enabled = FALSE;
        }

//         if (is_numeric($config['log_threshold']))
//         {
//             $this->_threshold = (int) $config['log_threshold'];
//         }
//         elseif (is_array($config['log_threshold']))
//         {
//             $this->_threshold = 0;
//             $this->_threshold_array = array_flip($config['log_threshold']);
//         }

        if ( ! empty($config['log_date_format']))
        {
            $this->_date_fmt = $config['log_date_format'];
        }

        if ( ! empty($config['log_file_permissions']) && is_int($config['log_file_permissions']))
        {
            $this->_file_permissions = $config['log_file_permissions'];
        }
    }

    // --------------------------------------------------------------------

    /**
     * Write Log File
     *
     * Generally this function will be called using the global log_message() function
     *
     * @param	string	the error level: 'error', 'debug' or 'info'
     * @param	string	the error message
     * @return	bool
     */
    public function write_log($level, $msg)
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $level = strtoupper($level);

        if ( ! isset($this->_levels[$level]))
        {
            return FALSE;
        }

        $filepath = $this->_log_path.'log-'.date('Y-m-d').'.'.$this->_file_ext;
        $message = '';

        if ( ! file_exists($filepath))
        {
            $newfile = TRUE;
            // Only add protection to php files
            if ($this->_file_ext === 'php')
            {
                $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
            }
        }

        if ( ! $fp = @fopen($filepath, 'ab'))
        {
            return FALSE;
        }

        // Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
        if (strpos($this->_date_fmt, 'u') !== FALSE)
        {
            $microtime_full = microtime(TRUE);
            $microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
            $date = new DateTime(date('Y-m-d H:i:s.'.$microtime_short, $microtime_full));
            $date = $date->format($this->_date_fmt);
        }
        else
        {
            $date = date($this->_date_fmt);
        }

        $message .= $level.' | '.$date.' | '.$msg."\n";

        flock($fp, LOCK_EX);

        for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
        {
            if (($result = fwrite($fp, substr($message, $written))) === FALSE)
            {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        if (isset($newfile) && $newfile === TRUE)
        {
            chmod($filepath, $this->_file_permissions);
        }

        return is_int($result);
    }

}