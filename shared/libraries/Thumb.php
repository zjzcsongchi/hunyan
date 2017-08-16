<?php 

class Thumb
{    
    
    /**
     * 
     * @param $im 需要压缩的图片路径
     * @param $maxwidth 需要压缩的最大宽度
     * @param $maxheight 需要压缩的最大高度
     * @param $name 压缩后图片名称
     * @param $filetype 图片后缀
     * 
     */
    public function resizeimg($im, $maxwidth ,$maxheight, $name){
    
        //将图片作为画布
        $ename = getimagesize($im);
        $ename=explode('/',$ename['mime']);
        $ext=$ename[1];
        switch ($ext) {
            case "jpeg" :
                $im = imagecreatefromjpeg($im);
                $filetype = $ext;
                break;
            case "jpg" :
                $im = imagecreatefromjpeg($im);
                $filetype = $ext;
                break;
            case "gif" :
                $im = imagecreatefromgif($im);
                $filetype = $ext;
                break;
            case "wbmp" :
                $im = imagecreatefromwbmp($im);
                $filetype = $ext;
                break;
            case "png" :
                $im = imagecreatefrompng($im);
                $filetype = $ext;
                break;
        }
        
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);
        
        if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
        {
            if($maxwidth && $pic_width>$maxwidth)   //原图宽度大于最大宽度
            {
                $widthratio = $maxwidth/$pic_width;
                $resizewidth_tag = true;
            }else{
                $resizewidth_tag = false;
            }
    
            if($maxheight && $pic_height>$maxheight) //原图高度度大于最大高度
            {
                $heightratio = $maxheight/$pic_height;
                $resizeheight_tag = true;
            }else{
                $resizeheight_tag = false;
            }
    
            if($resizewidth_tag && $resizeheight_tag)   //如果新图片的宽度和高度都比原图小
            {
                if($widthratio<$heightratio)        //那个比较小就说明它的长度要长，就取哪条，以长边为准缩放保证图片不被压缩
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }
    
            if($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;
    
            $newwidth = $pic_width * $ratio;            //原图的宽度*要缩放的比例
            $newheight = $pic_height * $ratio;          //原图高度*要缩放的比例
    
            //3:1压缩
            //             $newwidth = $pic_width * 0.3333;
            //             $newheight = $pic_height * 0.3333;
    
            if(function_exists("imagecopyresampled"))
            {
                $newim = imagecreatetruecolor($newwidth,$newheight);    //生成一张要生成的黑色背景图 ，比例为计算出来的新图片比例
                imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);  //复制按比例缩放的原图到 ，新的黑色背景中。
            }
            else
            {
                $newim = imagecreate($newwidth,$newheight);
                imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
    
            $name = $name.'.'.$filetype;
            imagejpeg($newim,$name);
            imagedestroy($newim);
            return $name;
        }
        else
        {
            $newwidth = $pic_width * 1;            //原图的宽度*要缩放的比例
            $newheight = $pic_height * 1;
            if(function_exists("imagecopyresampled"))
            {
                $newim = imagecreatetruecolor($newwidth,$newheight);    //生成一张要生成的黑色背景图 ，比例为计算出来的新图片比例
    
                imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);  //复制按比例缩放的原图到 ，新的黑色背景中。
            }
            else
            {
                $newim = imagecreate($newwidth,$newheight);
                imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
    
            //原图宽和高都比规定的宽高都小
            $name = $name.'.'.$filetype;
            imagejpeg($im,$name);
            return $name;
        }
    }
    
    
    /**
     *水印
     *
     * @param $im 需要加水印的有效图片路径
     * @param $filetype 加水印后图片后缀
     * @param $name 加水印后图片名称
     * @param $water_img 水印图片
     *
     */
    public function shuiyin($im, $name, $water_img, $direction){
        //将图片作为画布
        $ename = getimagesize($im);
        $ename=explode('/',$ename['mime']);
        $ext=$ename[1];
    
        switch ($ext) {
            case "jpeg" :
                $img = imagecreatefromjpeg($im);
                $filetype = $ext;
                break;
            case "jpg" :
                $img = imagecreatefromjpeg($im);
                $filetype = $ext;
                break;
            case "gif" :
                $img = imagecreatefromgif($im);
                $filetype = $ext;
                break;
            case "wbmp" :
                $img = imagecreatefromwbmp($im);
                $filetype = $ext;
                break;
            case "png" :
                $img = imagecreatefrompng($im);
                $filetype = $ext;
                break;
        }
        //获取图片宽高
        $pic_width = imagesx($img);
        $pic_height = imagesy($img);
        $watermark = imagecreatefrompng($water_img);
        
        $water_width = imagesx($watermark);
        $water_height = imagesy($watermark);
        //左上角
        //     	imagecopy($img,$watermark,0,0,0,0,128,35);
        
        //右下角
        if($direction == 1){
//             imagecopy($img,$watermark,$pic_width-250,$pic_height-120,0,0,250,120);
            imagecopy($img,$watermark,$pic_width-213,$pic_height-115,0,0,193,100);
        }else{
            imagecopy($img,$watermark,30,0,0,0,$water_width,$water_height);
            imagecopy($img,$watermark,($pic_width)*2/3,($pic_height)*1/3,0,0,$water_width,$water_height);
        }
            	
        
        //居中
//         imagecopy($img,$watermark,($pic_width-130)/2,($pic_height-40)/2,0,0,261,190);
        //     	imagecopymerge($img,$watermark,0,0,0,0,128,35,100);
        
        $name= $name.'.'.$filetype;
        imagejpeg($img, $name);
        return $name;
        //销毁图像
        imagedestroy($img);
    }
    
    
    public function shuiyin1($im, $filetype, $name){
        //将图片作为画布
        $ename = getimagesize($im);
        $ename=explode('/',$ename['mime']);
        $ext=$ename[1];
    
        switch ($ext) {
            case "jpeg" :
                $img = imagecreatefromjpeg($im);
                break;
            case "jpg" :
                $img = imagecreatefromjpeg($im);
                break;
            case "gif" :
                $img = imagecreatefromgif($im);
                break;
            case "wbmp" :
                $img = imagecreatefromwbmp($im);
                break;
            case "png" :
                $img = imagecreatefrompng($im);
                break;
        }
    
    
    
        $stamp = imagecreatetruecolor(120, 50);
        //         imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
        imagefilledrectangle($stamp, 0, 0, 125, 75, 0xFFFFFF);
        imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
        //         $im = imagecreatefromjpeg('photo.jpeg');
        imagestring($stamp, 5, 15, 15, 'bainian.com', 0x0000FF);
        imagestring($stamp, 3, 15, 32, '(c) 2016-7', 0x0000FF);
    
        // 设置水印图像的位置和大小
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
    
        // 以 50% 的透明度合并水印和图像
        imagecopymerge($img, $stamp, imagesx($img) - $sx - $marge_right, imagesy($img) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);
    
        // 将图像保存到文件，并释放内存
        $name='sy_'.$name;
        imagejpeg($img, $name);
        return $name;
        //         imagepng($img, 'photo_stamp.png');
        imagedestroy($img);
    
    }
    
    

 }