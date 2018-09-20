<?php
include('db_connect.php');
$getAmps = $conn->query("SELECT * FROM  amphures  WHERE  PROVINCE_ID  = 5");
$getDist = $conn->query("SELECT * FROM districts WHERE PROVINCE_ID = 5 ORDER BY AMPHUR_ID asc");
$dis = $conn->query("SELECT * FROM districts WHERE PROVINCE_ID = 5 ORDER BY AMPHUR_ID asc");
$arrayAMP = array();
$arrayDIS = array();
$i=0;
while($temp = $getAmps->fetch_assoc()){
  	array_push($arrayAMP,array('ampID'=>$temp['AMPHUR_ID'],'ampName'=>$temp['AMPHUR_NAME']));
    $i++;
}
$j=0;
while($tmp = $getDist->fetch_assoc()){
  	array_push($arrayDIS,array('ampID'=>$tmp['AMPHUR_ID'],'distID'=>$tmp['DISTRICT_ID'],'distName'=>$tmp['DISTRICT_NAME']));
    $j++;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ยินดีต้อนรับ</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var dataTree = new Array('root');
  for(var i = 1; i<=16;i++ ){
    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    $('#'+i).css('background-color', '#'+randomColor);
    for(var j = 1; j<=210;j++){
      $('#'+i+'_'+j).css('background-color', '#'+randomColor);
    }
  }
for(var i = 1; i<=16;i++ ){
  var tmpParent = $('#'+i).attr('id');
  dataTree.push(tmpParent);
}
  for(var j = 1 ; j<=210;j++){
    for(var i = 1; i<=16;i++ ){
    var tmpChiled = $('#'+i+'_'+j).attr('id');
    dataTree.push(tmpChiled);
  }
}
function findTree(find,speed){
  //alert('para 1'+find+' para 2 '+speed);
    var x =  setInterval(function () {
        for(var i = 0; i < dataTree.length; i++){
          var getID = dataTree[i];
          setTimeout(changeColor(getID),1000);
            if($('#'+getID).val() == find){
              $('#'+getID).css('background-color','green');
              alert('ค้นหาไปทั้งหมด : '+i+' ครั้ง');
              clearInterval(x);
              break;
            }
          }
        }, speed);
      }
  function changeColor(id){
    $('#'+id).css('background-color','red');
  }
$('#start').click(function(){
  var getNode = $('#selectDis').val();
  var speed = $('#speed').val();
  alert('ความเร็ว : '+speed);
  var result = findTree(getNode,speed);
//  if(result){alert('ค้นหาสำเร็จ');}else{alert('ค้นหาไม่สำเร็จ');}
});
});
</script>
</head>
<body style="background-color:#e6f7ff;">
  <br>
  <div class="container text-center">
    <h1>โปรแกรมจำลองการทำงานของอัลกอริทึม Breadth First Search</h1>
    <div class="col-lg-4">
    <select name="selectDis" id="selectDis" class="form-control">
      <option value="">*****เลือกตำบลที่ต้องการค้นหา******</option>
      <?php while ($row = $dis->fetch_assoc()) { ?>
        <option value="<?=$row['DISTRICT_ID']?>"><?=$row['DISTRICT_NAME']?></option>
    <?php  }  ?>
    </select>
  </div>
    <div class="col-lg-4">
    <select name="speed" id="speed" class="form-control">
      <option value="">*****เลือกความเร็วในการค้นหา******</option>
      <option value="10"> .01 วินาที </option>
      <option value="100">  .1 วินาที </option>
      <option value="500">  .5 วินาที </option>
      <option value="1000">  1 วินาที </option>
    </select>
  </div>
      <button type="button" class="btn btn-primary" id="start">BFS Start</button>
  </div>
  <div class="col-lg-2 ">  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <button type="button" class="btn btn-success" id="root">พระนครศรีอยุธยา</button>
  </div>
  <br>
  <div class="col-lg-10">
    <?php $id = 1;  for($k=0;$k<$i;$k++){ ?>
      <div class="row">
        <div class="col-lg-2">
        <button type="button" class="btn"  id="<?=$id?>" style="color:white;" value="<?=$arrayAMP[$k]['ampID']?>"><?=$arrayAMP[$k]['ampName']?></button>
        </div>
        <div class="col-lg-10">
      <?php $ids = 1;  for($l=0;$l<$j;$l++){
        if($arrayAMP[$k]['ampID'] == $arrayDIS[$l]['ampID'] ){
          ?>
        <button type="button" class="btn"  id="<?=$id."_".$ids?>" style="color:white;" value="<?=$arrayDIS[$l]['distID']?>"><?=$arrayDIS[$l]['distName']?></button>
      <?php $ids++; }}?>
          </div>
      </div>
        <br>
      <?php $id++; }?>
    </div>
</body>
</html>
