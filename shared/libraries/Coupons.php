<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 生成优惠券
 * 
 * @author huangjialin@global28.com
 *
 */
class Coupons{

    /**
     * 生成一个优惠券
     * 
     * @param number $length    优惠券码长度
     * @param string $prefix    优惠券码前缀
     * @param string $suffix    优惠券码后缀
     * @param boolean $numbers   是否含数字
     * @param boolean $letters   是否含有字母
     * @param boolean $symbols   是否含有其他特俗字符
     * @param boolean $random_register   是否包括小写字母
     * @param string $mask  返回格式
     * @return string
     */
    public static function generate($length=6, $prefix='', $suffix='', $numbers=true, $letters=true, $symbols=false, $random_register=false, $mask='') {
        $numbers_a   = array(0,1,2,3,4,5,6,7,8,9);
        $lowercase = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m');
        $uppercase = array('Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M');
        $symbols_a = array('`','~','!','@','#','$','%','^','&','*','(',')','-','_','=','+','\\','|','/','[',']','{','}','"',"'",';',':','<','>',',','.','?');
    
        $string = Array();
        $coupon = '';
        if ($letters) {
            if ($random_register) {
                $string = array_merge($string, $lowercase, $uppercase);
            } else {
                $string = array_merge($string, $uppercase);
            }
        }
        
        if ($numbers) {
            $string = array_merge($string, $numbers_a);
        }
    
        if ($symbols) {
            $string = array_merge($string, $symbols_a);
        }
    
        if ($mask) {
            for ($i=0; $i < strlen($mask); $i++) {
                if ($mask[$i] === 'X') {
                    $coupon .= $string[rand(0, count($string)-1)];
                } else {
                    $coupon .= $mask[$i];
                }
            }
        } else {
            for ($i=0; $i < $length ; $i++) {
                $coupon .= $string[rand(0, count($string)-1)];
            }
        }
    
        return $prefix . $coupon . $suffix;
    }
    
    
    /**
     * 生成多个优惠券码
     * 
     * @param number $no_of_coupons 优惠券码个数
     * @param number $length
     * @param string $prefix
     * @param string $suffix
     * @param boolean $numbers
     * @param boolean $letters
     * @param boolean $symbols
     * @param boolean $random_register
     * @param string $mask  
     * @return multitype:
     */
    public static  function generate_coupons($no_of_coupons=1, $length=6, $prefix='', $suffix='', $numbers=true, $letters=true, $symbols=false, $random_register=false, $mask='') {
        $coupons = array();
        for ($i = 0; $i < $no_of_coupons; $i++) {
            $tenp = '';
            $temp = self::generate($length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
            array_push($coupons, $temp);
        }
        return $coupons;
    }
    
    
    /**
     * 优惠券码生成excel
     * 
     * @param number $no_of_coupons
     * @param number $length
     * @param string $prefix
     * @param string $suffix
     * @param boolean $numbers
     * @param boolean $letters
     * @param boolean $symbols
     * @param boolean $random_register
     * @param string $mask
     * 
     */
    public static function generate_coupons_to_xls($no_of_coupons=1, $length=6, $prefix='', $suffix='', $numbers=true, $letters=true, $symbols=false, $random_register=false, $mask='') {
        header("Content-Type: application/vnd.ms-excel");
        echo 'Coupon Codes' . "\t\n";
        for ($i = 0; $i < $no_of_coupons; $i++) {
            $tenp = '';
            $temp = self::generate($length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
            echo $temp . "\t\n";
        }
        header("Content-disposition: attachment; filename=coupons.xls");
    }
} 
