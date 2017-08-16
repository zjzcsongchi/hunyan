<div class="calendar_wrap">
<button class="calendar_close" onclick="calendar_close()">X</button>
<script src="<?php echo css_js_url('zzsc.js', 'admin')?>"></script>

<div id="cld" class="content">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="datetable">
    <thead>
    <tr>
      <td colSpan=7><span>公历</span>
        <select name="SY" id="sy" onchange="changeCld();" style="font-SIZE: 9pt">
        <script>
            for(i=1900;i<2050;i++) document.write('<option>'+i);
        </script>
         </select><span>年</span>
         <select name="SM" id="sm" onchange="changeCld();" style="font-SIZE: 9pt">
        <script>
            for(i=1;i<13;i++) document.write('<option>'+i);
        </script>
        </select><span>月</span>
        </font><span id="GZ"></span>
      </td>
    </tr>
    </thead>
    <tbody>
    <tr style="background:#eee;">
      <td width="54">日</td>
      <td width="54">一</td>
      <td width="54">二</td>
      <td width="54">三</td>
      <td width="54">四</td>
      <td width="54">五</td>
      <td width="54">六</td>
    </tr>            
    <script>
    var gNum;
    for(i=0;i<6;i++) {
       document.write('<tr align="center">');
       for(j=0;j<7;j++) {
          gNum = i*7+j;
          document.write('<td id="GD' + gNum +'"><font id="SD' + gNum +'" size=2 face="Arial Black"');
          if(j == 0) document.write('color="red"');
          if(j == 6) document.write('color="#000080"');
          document.write('></font><br/><font id="LD' + gNum + '" size=2 style="font-size:9pt"></font></td>');
       }
       document.write('</tr>');
    }
   </script>
   </tbody>
</table>
</div>

<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
</div>
</div>
<script type="text/javascript">
   (function(){
		initial();
   })();
   function calendar_close(){
		var box = document.getElementsByClassName('calendar_wrap');
		box[0].style.display="none";
   }
</script>