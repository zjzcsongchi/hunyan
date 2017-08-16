<?php 
/**
 * 消费清单表
 * @author chaokai@gz-zc.cn
 */
class Model_consume_list extends MY_Model{

	public function __construct(){
		parent::__construct('t_consume_list');

		$this->load->model(array(
			'Model_dinner' => 'Mdinner'
			));
	}

	/**
	 * 根据年月查询消费订单数量
	 * @author chaokai@gz-zc.cn
	 */
	public function get_count(){

		$field = 'solar_time';
        $start_year = 2016;
        $year = date('Y');
        $end_year = $year+2;

        //已填写消费清单的订单
        $consume_list = $this->get_lists('dinner_id', array('is_del' => 0));
        $dinner_ids = array_column($consume_list, 'dinner_id');

        $where = array(
            'is_del' => 0,
            'solar_time >=' => ($start_year) . '-01-01',
            'solar_time <=' => ($end_year) . '-12-31' ,
            'not_in' => array(
                'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
            ),
            'in' => array(
            	'id' => $dinner_ids
            )
        );
        $list = $this->Mdinner->get_lists($field, $where);
        
        $result = array();
        foreach($list as $k => $v)
        {
            $date = date('Ym', strtotime($v['solar_time']));
            
            if(isset($result[$date]))
            {
                $result[$date] ++;
            }
            else
            {
                $result[$date] = 1;
            }
        }
        
        return $result;
	}

	/**
     * 搜索订单信息
     * @author chaokai@gz-zc.cn
     */
    public function search_consume_list($name = '', $mobile = '', $where_param = array()){
        
        //搜索订单表
        $dinner_list = $this->Mdinner->search_dinner_list($name, $mobile, $where_param);
        if(empty($dinner_list)){
        	return false;
        }
    
    	return $this->consume_with_dinner($dinner_list, $where_param);
    }

    /**
     * 获取订单列表
     * @author chaokai@gz-zc.cn
     */
    public function get_consume_list($year, $month, $day='', $where_param=[]){

        //搜索订单表
        $dinner_list = $this->Mdinner->get_dinner_list($year, $month, $day);
        if(empty($dinner_list)){
        	return false;
        }
        return $this->consume_with_dinner($dinner_list, $where_param);

    }

    /**
     * 根据搜索到的宴会订单查询消费清单列表
     * @author chaokai@gz-zc.cn
     */
    private function consume_with_dinner($dinner_list, $where_param){
    	//过滤订单
        $dinner_ids = array_column($dinner_list, 'id');
        $where = array(
        	'in' => ['dinner_id' => $dinner_ids],
        	'is_del' => 0
        );
        $where = array_merge($where, $where_param);
        $field = 'id,dinner_id,menus_count,menus_fee,all_fee,preferentail_fee,actual_fee,create_time,sign_time,checkout_time,is_pay,is_addeat,is_half,remark';
        # 按日期排序
        $order_by = array('id' => 'asc');

        $list = $this->get_lists($field, $where, $order_by);
        # 订单按照dinner表重排
        foreach ($dinner_list as $k => $v) {
            foreach ($list as $key => $value) {
        		if($value['dinner_id'] == $v['id']){
                    $lists[$k] = $value;
        			$lists[$k]['dinner_info'] = $v;
        		}
        	}
        }
        return $lists;
    }
}