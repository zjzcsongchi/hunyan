<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Search extends MY_Controller{
    
    static  $search_server;
    static $search_port;
    static $connect_timeout;
    static $instance        = null; //单例对象
    
    public function __construct(){
        parent::__construct();
        static::$search_server = C('search.host');
        static ::$search_port = C('search.port');
        static :: $connect_timeout = C('search.timeout');
    
    }
    /**
     * 搜索引擎入口
     * @author yuanxiaolin@global28.com
     * @method get|post
     * @param  string $index 指定的搜索资源
     * @param  string $keyword 搜索关键字
     * @throws Exception 
     * @return json
     */
    public function entrance(){
        try
        {
            $index = $this->input->get_post('index');
            $keyword = $this->input->get_post('keyword');
            //过滤条件
            $filter = $this->input->get_post('filter');
            //范围过滤
            $filter_range = $this->input->get_post('filter_range');
            //排序
            $sort = $this->input->get_post('sort');
            $page = $this->input->get_post('page') ?: 1;
            $page_size = $this->input->get_post('size') ?: 10;
            
//             call_user_func_array( array( $this,'search' ), array($service, $keyword,$page,$page_size));
            $this->search($index, $keyword, $page, $page_size, $filter, $filter_range, $sort);
        }
        catch(Exception $e)
        {
            $this->return_failed($e->getMessage());
        }
    
    }
    /**
     * 新闻搜索
     * @author yuanxiaolin@global28.com
     * @param string $$keyword 搜索关键字
     * @return return_type
     */
    public function search($index, $keyword, $page, $page_size, $filter = '', $filter_range = '', $sort = ''){
        $client = static::init_service();
        //搜索资讯文章增加权重搜索
        if($index == 'news'){
            $client->setRankingMode (SPH_RANK_PROXIMITY_BM25);
            $client->setFieldWeights(array('title' => 4, 'summary' => 3, 'agency' => 2, 'content' => 1));
            $client->setSortMode (SPH_SORT_EXPR,'@weight');
        }
        $client->setLimits(($page-1)*$page_size, intval($page_size), 100);
        //数值过滤
        if($filter && is_array($filter)){
            foreach ($filter as $k => $v){
                !$client->setFilter($k, [intval($v)]) && $this->return_failed('filter set failed');
            }
        }
        //范围过滤
        if($filter_range && is_array($filter_range)){
            foreach ($filter_range as $k => $v){
                !$client->setFilterRange($k, $v['min'], $v['max']) && $this->return_failed('filter range set failed');
            }
        }
        //排序
        if($sort && is_array($sort)){
            foreach ($sort as $k => $v){
                !$client->setSortMode(SPH_SORT_EXTENDED, $k.' '.$v) && $this->return_failed('sort set error');
            }
        }
        //关键字为空查询所有
        if(empty(trim($keyword))){
            $client->setMatchMode(SPH_MATCH_FULLSCAN);
        }
        $result = $client->query($keyword, $index);
        if($result && !empty($result['matches']))
        {
            $data = array_column($result['matches'], 'id');
            $total = $result['total_found'];
            $this->return_success($data, $total);
        }else{
            $this->return_failed('no search result');
        }
    
    }
    
    /**
     * 初始化单例对象
     * @author yuanxiaolin@global28.com
     * @throws Exception
     * @return SphinxClient|object
     */
    public static function init_service(){
        
        if(!is_null(static::$instance))
        {
            return static::$instance;
        }
        
        $client = new SphinxClient();
        if(!$client)
        {
            throw new Exception('can not be instanced for sphinxclient');
        }
        $client->setServer(static::$search_server, static::$search_port);
        $client->setConnectTimeout(static::$connect_timeout);
        $client->setArrayResult(true);
        $client->setMatchMode(SPH_MATCH_ALL);
        //go on setting ...
        return $client ;
        
    }
}