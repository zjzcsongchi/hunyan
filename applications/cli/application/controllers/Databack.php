<?php
/**
 * 数据备份
 * @author chaokai@gz-zc.cn
 */
class Databack extends MY_Controller {
    
    private $db_bakpath;//备份目录
    private $expire_time;//备份文件最长保留时间，超过时间删除备份文件
    public function __construct(){
        
        parent::__construct();
        
        $this->db_bakpath = C('db_bak.path');
        $this->expire_time = C('db_bak.expire_time');
        
        //使用表格类
        $this->load->library('table');
    }
    
    public function index(){
        $database_file = APPPATH.'config/'.ENVIRONMENT.'/database.php';
        
        include($database_file);
        if(!isset($db)){
            log_message('ERROR', 'NOT SET DATABASE CONFIG');
            exit;
        }
        
        $db_hostname = $db['default']['hostname'];
        $db_username = $db['default']['username'];
        $db_password = $db['default']['password'];
        $db_database = $db['default']['database'];
        
        $db_backfile = $this->db_bakpath.'bainian_'.date('YmdHis').'.sql';
        
        $exec_str = 'mysqldump -u'.$db_username.' -h'.$db_hostname.' -p'.$db_password.' '.$db_database.' > '.$db_backfile;
        $result = system($exec_str);
        //删除旧的备份文件
        $this->remove_old_bak();
        if($result === FALSE){
            $email = array(date('Y-m-d H:i:s'), $db['default']['database'], '数据库备份失败');
        }else{
            $email = array(date('Y-m-d H:i:s'), $db['default']['database'], '数据库备份成功');
        }
        
        //发送邮件
        $this->table->set_heading(array('时间', '数据库名称', '备份结果'));
        $this->table->add_row($email);
        $email_content = $this->table->generate();
        
        send_email(C('email.adminemail'), '数据库备份结果提醒', $email_content);
    }
    
    /**
     * 删除旧的备份文件7天以前
     * @author chaokai@gz-zc.cn
     */
    private function remove_old_bak(){
        
        $file_arr = array();
        //遍历备份目录，取出文件名
        if($handle = opendir($this->db_bakpath)){
            
            while (false !== ($file = readdir($handle))){
                if($file != '.' && $file != '..'){
                    $file_arr[] = array(
                                    'name' => $file,
                                    'm_time' => filemtime($this->db_bakpath.$file)
                    );
                }
            }
            
            closedir($handle);
        }
        
        if(!$file_arr){
            return false;
        }
        foreach ($file_arr as $k => $v){
            $mt_arr[$k] = $v['m_time'];
        }
        //按时间降序重新排序
        array_multisort($mt_arr, SORT_DESC, $file_arr);
        //删除旧的备份文件
        while (count($file_arr) > $this->expire_time){
            unlink($this->db_bakpath.$file_arr[count($file_arr) - 1]['name']);
            array_pop($file_arr);
        }
        
    }
}