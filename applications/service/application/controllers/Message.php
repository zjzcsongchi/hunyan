<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Message extends MY_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model([
            'Model_message' => 'Mmessage',
            'Model_message_info' => 'Mmessage_info'
        ]);
    
    }
    
    
    /**
     * 写入站内消息
     * @author jianming@gz-zc.cn
     */
    public function add(){
        $data = $this->input->post('data');           

        if(empty($data['title'])){
            $this->return_failed('', array('msg' => '消息标题不能为空', 'code' => 1));
        }

        if(empty($data['content'])){
            $this->return_failed('', array('msg' => '消息内容不能为空', 'code' => 2));
        }

        if(empty($data['receiver'])){
            $this->return_failed('', array('msg' => '消息接收者不能为空', 'code' => 3));
        }

        $message_data = array('title' => $data['title'], 'content' => $data['content']);
        $message_data['create_time'] = $message_data['update_time'] = date('Y-m-d H:i:s');

        //写入t_message表
        $id = $this->Mmessage->create($message_data);
        if($id) {
            //写入t_message_info表
            $info_data['message_id'] = $id;
            $info_data['receiver'] = $data['receiver'];
            $info_data['create_time'] = date('Y-m-d H:i:s');
            $this->Mmessage_info->create($info_data);

            $this->return_success(array('msg' => '写入站内消息成功！'));
        } else {
            $this->return_failed();
        }
    }

}
