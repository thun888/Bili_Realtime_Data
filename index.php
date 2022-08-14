<?php


require('database.php');
require('controller.php');

// 禁止未授权的访问
    if(!$usr){
     print("What?!<br>无用户信息<br>请检查是否带全参数");
     return http_response_code(404);
    }

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title id="name"><?php echo "数据统计 - $nick  " ?></title>
		<link rel="icon" href="https://raw.thun888.xyz/thun888/asstes/master/files/Bili_Realtime_Data/bili.ico">
		
		<!--两种主题-->
		<link href="light.css" rel="stylesheet">
		<!--<link href="dark.css" rel="stylesheet">-->
	
		<!--自动刷新-->
		<script>
	        setTimeout('refresh()','<?php echo $refreshtime?>'); 
            function refresh(){ 
                window.location.reload();
            }
        if ('serviceWorker' in navigator) {
            try {
                navigator.serviceWorker.register('sw.js');
                console.log('SW registered');
            } catch (error) {
                console.log('SW reg failed');
            }
        }
	    </script>
	</head>
	<body>
	   
	    
	    <!--时钟与日期-->
        
        <!--<p id="time" style="text-align:center;font-size:90px;margin:-10px 1px 1px 1px;font-family:font2;"><?php echo $showtime=date("H:i");?></p>-->
        <p style="text-align:center;font-size:22px;margin:-12px 3px 2px 3px;font-family:font2;"><?php echo $showtime=date("Y年m月d日");?><?php echo $showtime=date("H:i");?></p>
	    
        <div class="fansNum" style="margin:4% auto">
            <p class="realTimeFans"><?php echo " @$nick  实时粉丝" ?></p>
            <p class="realTimeFansNum"><?php echo number_format($fans); ?></p>
            <p class="incFans" style="text-align:center;">日涨粉: <a class="incFansNum";><?php echo number_format($newfans)?></a style="color:white">&emsp;月涨粉: <a class="incFansNum";><?php echo number_format($newfansmonth)?></a></p>
            
        </div>
        
        <?php for($vlist=$num;$vlist<$vnum;$vlist++){?>
        <hr>
        <div class="dataList">
            <p><a ><?php echo $dataHotGate[$vlist] ?></a><a style="vertical-align:middle;"><?php echo $title[$vlist] ?></a></p>
            <p style="color:#666666"><a style="vertical-align:middle;"><?php echo $time[$vlist] ?></a></p>
            <p style="text-align:center;margin:-1% 1%">播放：<a class="play">
                <?php
                if ($totalPlay[$vlist] > 10000){
                    echo round(floatval($totalPlay[$vlist]/10000),2)."w";
                }else{
                    echo round(floatval($totalPlay[$vlist]),2);
                }
                ?>
                </a>
            &emsp; 在线：<a style="color:#00E676;font-size:30px"><?php echo "$online[$vlist]" ?></a></p><br>
            
            <p class="dataCaption">
            点赞: <a class="triCombo";><?php echo $like[$vlist] ?></a>
            &nbsp; 投币: <a class="triCombo"><?php echo $coin[$vlist]?></a>
            &nbsp; 收藏: <a class="triCombo"><?php echo $fav[$vlist] ?></a><br></p>
            
            <p class="dataCaption">
            赞率: <a class="triCombo";><?php echo $likeRatio[$vlist] ?></a>
            &nbsp; 币率: <a class="triCombo"><?php echo $coinRatio[$vlist] ?></a>
            &nbsp; 收率: <a class="triCombo"><?php echo $favRatio[$vlist] ?></a><br></p>
        </div> 
        <?php }?>
         <script>
         next_url = "<?php echo "/?usr=".$usr."&num=".$vnum ;?>";
         up_url = "<?php $upnum= $vnum-$totalVideo*2;echo "/?usr=".$usr."&num=".$upnum;?>";
            function nextPage(){
                document.getElementById("next").innerText="Wait...ヾ(•ω•`)o"
                window.open(next_url,"_self");
            }
            function upPage(){
                document.getElementById("up").innerText="Wait...ヾ(•ω•`)o"
                window.open(up_url,"_self");
            }
         </script>
        <div style="text-align:center;">
            
         <?php 
            if ($vnum!=$totalVideo&&false==$allwatch){
                $page=$vnum/3-1;
                echo "<button type='button' id='up' class='button' onclick='upPage()'>上一页(第".$page."页)</button>";
            }
            if ($vnum!=$totalVideo&&false==$allwatch){
                $page=$vnum/3;
                echo "<button type='button' id='next' class='button' onclick='nextPage()'>下一页(第".$page."页)</button>";
            }elseif ($vnum=$totalVideo&&false==$allwatch){
                echo "<button type='button' id='next' class='button' onclick='nextPage()'>下一页(第1页)</button>";
            }else{
                echo "<button type='button' class='button' onclick='window.history.back()' id='next'>到底了( *︾▽︾)</button>"; 
            }
            ?>
        </div>

       
	</body>
	
	</html>