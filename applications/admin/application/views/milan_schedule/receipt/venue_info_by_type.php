<?php switch($dinner_type_id): ?>
<?php case C('party.wedding.id'):?>
新娘 <mark><?php echo $menu['roles_wife']?></mark> 女士、
新郎 <mark><?php echo $menu['roles_main']?></mark> 先生，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办婚礼，
<?php break;?>

<?php case C('party.birthday.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办生日宴，
<?php break;?>

<?php case C('party.champion.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办升学宴，
<?php break;?>

<?php case C('party.bairiyan.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办百日宴，
<?php break;?>

<?php case C('party.manyuejiu.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办满月酒，
<?php break;?>

<?php case C('party.qiaoqianyan.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办乔迁宴，
<?php break;?>

<?php case C('party.shouyan.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办寿宴，
<?php break;?>

<?php case C('party.nianhui.id'):?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办企业年会，
<?php break;?>

<?php default:?>
<mark><?php echo $menu['roles_main']?></mark> 先生/女士，
在百年婚宴 <mark><?php echo $menu['venue']?></mark> 举办宴会，
<?php break;?>

<?php endswitch;?>
