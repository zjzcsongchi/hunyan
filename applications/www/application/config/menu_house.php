<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    'menu' => array(
        '房产管理' => array(
            'code' => 'house_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/marketcontrol',
                    '销控管理'
                ),
                array(
                    '/houses',
                    '楼盘管理'
                ),
                array(
                    '/bulldings',
                    '楼栋管理'
                ),
                array(
                    '/units',
                    '单元管理'
                ),
/*                 array(
                    '/floors',
                    '楼层管理'
                ),
 */                array(
                    '/housemodel',
                    '户型管理'
                ),
                array(
                    '/rooms',
                    '房屋管理'
                ),
              array(
                    '/propertytype',
                    '物业类型管理'
                ),
                array(
                    '/character',
                    '楼盘特色管理'
                ),
                array(
                    '/houseorder',
                    '客户管理'
                ),
                array(
                    '/purchase',
                    '购房管理'
                ),
                array(
                    '/allowanceapply',
                    '申请管理'
                ),
                            
            )
        )
    ) 
);