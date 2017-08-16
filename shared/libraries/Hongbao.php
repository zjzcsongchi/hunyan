<?php 

/**
 * 生成红包
 * 
 * @author huangjialin@global28.com
 *
 */
class Hongbao{

    
    
    /**
     * 生成红包
     * 
     * @param number $total 总金额
     * @param number $num   生成红包个数 支持随机领取
     * @param number $min   每个人最少能收到金额
     * @return array $return
     */
    public static function generate_hongbao($total=6, $num=1, $min=0.01) {
        $return = array();
        for ($i=1;$i<$num;$i++) {
            $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限
            $money=mt_rand($min*100,$safe_total*100)/100;
            $total=$total-$money;
            $return['res'][$i] = array(
                    'i' => $i,
                    'money' => $money,
                    'total' => $total
            );
        }
        return $return;
    }
    
    
} 
