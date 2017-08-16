<?php
/**
 * memcache缓存操作类
 * @author mochaokai@global28.com
 * 
 */
class Mymemcache{
    
    static $handle = null;
    /**
     * 初始化
     * @author mochaokai
     */
    public static function init(){
        if(static :: $handle == null){
            static ::$handle = new Memcached();
            static :: $handle->addServer(C('mymemcached.url'), C('mymemcached.port'));
//             static :: $handle->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
            if(isset($_SERVER['CI_ENV'])){
                static :: $handle->setSaslAuthData(C('mymemcached.username'), C('mymemcached.password'));
            }
        }
        return static ::$handle;
    }
    
    /**
     * 获取
     * @param string $key
     */
    public static function get($key=''){
        $nomemcache = C('nomemcache');
        $count = 0;
        str_replace($nomemcache, '', $key, $count);
        if($count > 0){
            return false;
        }
        $connect = static :: init();
        if(empty($key)){
            return $connect->getAllKeys();
        }elseif(is_array($key)){
            return $connect->getMulti($key);
        }
        return $connect->get($key);
    }
    
    /**
     * 设置
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value, $time){
        $nomemcache = C('nomemcache');
        $connect = static :: init();
        $count = 0;
        str_replace($nomemcache, '', $key, $count);
        //如果包含增加、更新、删除操作，对包含接口地址的缓存进行删除操作
        if($count > 0){
            $all_keys = $connect->getAllKeys();
            $apistring = substr($key, 0, strrpos($key, '/'));
            $exist_keys = array();
            if(!empty($all_keys)){
                foreach ($all_keys as $value){
                    if(strpos($value, $apistring) !== false){
                        $exist_keys[] = $value;
                    }
                }
            }
            if(!empty($exist_keys)){
                static :: delete($exist_keys);
            }
            return false;
        }
        return $connect->set($key, $value, $time);
    }
    
    /**
     * 清空
     * @param mixed $key
     * @author mochaokai
     */
    public static function delete($key=''){
        $connect = static :: init();
        //如果传的是数组，执行deleteMulti方法
        if(empty($key)){
//             return $connect->deleteMulti(static :: get());
               return $connect->flush();
        }elseif(is_array($key)){
            return $connect->deleteMulti($key);
        }
        return $connect->delete($key);
    }
}