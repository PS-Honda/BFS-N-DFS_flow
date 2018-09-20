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
  var dataTree = new Array();
  function getData2Tree(){ //นำข้อมูลเข้าสู่ต้นไม้
    dataTree.push('root'); //เพิมโหนดราก
    for(var i=1; i<=4; i++){ //ตามจำนวนตึก
      var tmpParent = $('#data'+i).prop('id'); //เก็บ id ตึก ในตัวแปร
      dataTree.push(tmpParent); //เก็บ id ตึก ในต้นไม้
      }
    for(var i=1; i<=4; i++){
      for(var j = 1; j<=3; j++){ //ตามจำนวนห้องต่อ1ตึก
        var tmpChiled = $('#data'+i+'_'+j).prop('id'); //เก็บ id ห้อง ในตัวแปร
        dataTree.push(tmpChiled); //เก็บ id ห้อง ในต้นไม้
      }
    }
  }
  function setTreeToData(data){
    $('#'+data).attr('hidden',true);  //ลบโหนดที่ต้นไม
    $('#'+data+"_data").attr('hidden',false);  //แสดงโนหดที่ da
  }
  function setDataToQueue(data){
    $('#'+data+"_data").attr('hidden',true);  //ลบโหนดที่ต้นไม
    $('#'+data+"_queue").attr('hidden',false);  //แสดงโนหดที่ da
  }
  function setQueueToOutput(data){
    $('#'+data+"_queue").attr('hidden',true);  //ลบโหนดที่ต้นไม
    $('#'+data+"_out").attr('hidden',false);  //แสดงโนหดที่ da
  }
function getToData(i,result,speed){
  var index = i;
  var time = speed;;
  setTreeToData(dataTree[index]);
      setTimeout(function(){
      if(index >= dataTree.length){
        getToQueue(0,result,speed);
      }else{
        index++;
        getToData(index,result,speed);
      }
    },time);
  }
function getToQueue(i,result,speed){
  var index = i;
  var time = speed;
  setDataToQueue(dataTree[index]);
      setTimeout(function(){
      if(index >= dataTree.length){
        getToOut(0,result,speed);
      }else{
       index++;
       getToQueue(index,result,speed);
    }
  },time);
}
function getToOut(i,result,speed){
  var index = i;
  var time = speed;
  setQueueToOutput(dataTree[index]);
  var output = $('#'+dataTree[index]).prop('id');
  if(output == result){
    alert('Find time\'s : '+(index+1));
    return true;
  }else{
      setTimeout(function(){
      $('#'+dataTree[index]+"_out").attr('hidden',true);
      index++;
      getToOut(index,result,speed);
    },time);
  }
}
$('#start').click(function(){//void main
  getData2Tree();//สั่งให้นำข้อมูลเข้า
  var getNode = $('#selectNode').val();
  var speed =   $('#speed').val();
  if(getNode == '' || speed == '' ){
    alert('กรุณาระบุเงื่อนไขให้ครบ');
  }else{
      getToData(0,getNode,speed);
    }
  });
$('#refresh').click(function(){
  for(var data = 0; data<dataTree.length;data++){
      $('#'+data).attr('hidden',true);
      $('#'+data+"_data").attr('hidden',true);
      $('#'+data+"_queue").attr('hidden',true);
        }

});

});
</script>
<style>
.output{
  background-color: lightgreen;
  padding-top: 60px;
}
.queue{

  background-color: lightblue;
  padding-top: 60px;
  margin-left: 100px;
}
.data{

  background-color: lightyellow;
  padding-top: 60px;
  margin-left: 100px;
}
/* .data-out{
  visibility: hidden;
}
.data-queue{
  visibility: hidden;
}
.data-data{
  visibility: hidden;
} */
</style>
</head>
<body style="background-color:#e6f7ff;">
  <br>
  <div class="container text-center">
    <h1>โปรแกรมจำลองการทำงานของอัลกอริทึม Breadth First Search</h1>
    <div class="row">
    <div class="col-lg-4">
    <select name="selectNode" id="selectNode" class="form-control">
      <option value="">*****เลือกห้องที่ต้องการค้นหา******</option>
      <option value="data1_1">ห้องคอม</option>
      <option value="data1_2">ห้องแลป</option>
      <option value="data1_3">ห้องทดลอง</option>
      <option value="data2_1">ห้องภาษา</option>
      <option value="data2_2">ห้องดนตรี</option>
      <option value="data2_3">ห้องศิลป์</option>
      <option value="data3_1">ห้องโลจิสติก</option>
      <option value="data3_2">ห้องคอม</option>
      <option value="data3_3">ห้องบัญชี</option>
      <option value="data4_1">ห้อง</option>
      <option value="data4_2">ROOM</option>
      <option value="data4_3">ห้องนั่งเล่น</option>
    </select>
  </div>
    <div class="col-lg-4">
    <select name="speed" id="speed" class="form-control">
      <option value="">*****เลือกความเร็วในการค้นหา******</option>
      <option value="100">  .1 วินาที </option>
      <option value="500">  .5 วินาที </option>
      <option value="1000">  1 วินาที </option>
    </select>
  </div>
    <button type="button" class="btn btn-danger" id="refresh">Clear</button>
    <button type="button" class="btn btn-primary" id="start">BFS Start</button>
  </div>
  <br>
  <div class="row">
    <button type="button" class=" btn-success" id="root">มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</button>
  </div>
  <br><br><br>
  <div class="row text-left">
    <button type="button" class="" id="data1" style="margin-left:10%;background-color:yellow;">ตึกวิทยาศาสตร์ </button>
    <button type="button" class="" id="data2" style="margin-left:10%;background-color:blue;color:white;">ตึกมนุษย์ศาสตร์และสังคมศาสตร์ </button>
    <button type="button" class="" id="data3" style="margin-left:10%;background-color:purple;color:white;">ตึกวิทยาการจัดการ</button>
    <button type="button" class="" id="data4" style="margin-left:10%;background-color:skyblue;">ตึกครุศาสตร์ </button>
  </div>
    <br><br><br>
  <div class="row text-left">
    <button type="button" class="" id="data1_1" style="background-color:yellow;">ห้องคอม</button>
    <button type="button" class="" id="data1_2" style="background-color:yellow;">ห้องแลป </button>
    <button type="button" class="" id="data1_3" style="background-color:yellow;">ห้องทดลอง</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="" id="data2_1" style="background-color:blue;color:white;">ห้องภาษา</button>
    <button type="button" class="" id="data2_2" style="background-color:blue;color:white;">ห้องดนตรี</button>
    <button type="button" class="" id="data2_3" style="background-color:blue;color:white;">ห้องศิลป์</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="" id="data3_1" style="background-color:purple;color:white;">ห้องโลจิสติก</button>
    <button type="button" class="" id="data3_2" style="background-color:purple;color:white;">ห้องคอม</button>
    <button type="button" class="" id="data3_3" style="background-color:purple;color:white;">ห้องบัญชี</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="" id="data4_1" style="background-color:skyblue;">ห้อง</button>
    <button type="button" class="" id="data4_2" style="background-color:skyblue;">ROOM</button>
    <button type="button" class="" id="data4_3" style="background-color:skyblue;">ห้องนั่งเล่น</button>
  </div>
  <br><br>
  <div class="row">
    <h1 class="text-center text-primary">การเข้าคิว</h1>
    <div class="row">
      <div class="output col-lg-3">
            <p> output </p>
          <button type="button" class=" btn-success data-out" id="root_out"  hidden>มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</button>
          <button type="button" class="  data-out" id="data1_out" hidden  style=" background-color:yellow;">ตึกวิทยาศาสตร์ </button>
          <button type="button" class="  data-out" id="data2_out" hidden style=" background-color:blue;color:white;">ตึกมนุษย์ศาสตร์และสังคมศาสตร์ </button>
          <button type="button" class="  data-out" id="data3_out" hidden  style=" background-color:purple;color:white;">ตึกวิทยาการจัดการ</button>
          <button type="button" class="  data-out" id="data4_out" hidden style=" background-color:skyblue;">ตึกครุศาสตร์ </button>
          <button type="button" class="  data-out" id="data1_1_out" hidden style="background-color:yellow;">ห้องคอม</button>
          <button type="button" class="  data-out" id="data1_2_out" hidden style="background-color:yellow;">ห้องแลป </button>
          <button type="button" class="  data-out" id="data1_3_out" hidden style="background-color:yellow;">ห้องทดลอง</button>
          <button type="button" class="  data-out" id="data2_1_out" hidden style="background-color:blue;color:white;">ห้องภาษา</button>
          <button type="button" class="  data-out" id="data2_2_out" hidden style="background-color:blue;color:white;">ห้องดนตรี</button>
          <button type="button" class="  data-out" id="data2_3_out" hidden style="background-color:blue;color:white;">ห้องศิลป์</button>
          <button type="button" class="  data-out" id="data3_1_out" hidden style="background-color:purple;color:white;">ห้องโลจิสติก</button>
          <button type="button" class="  data-out" id="data3_2_out" hidden style="background-color:purple;color:white;">ห้องคอม</button>
          <button type="button" class="  data-out" id="data3_3_out" hidden style="background-color:purple;color:white;">ห้องบัญชี</button>
          <button type="button" class="  data-out" id="data4_1_out" hidden style="background-color:skyblue;">ห้อง</button>
          <button type="button" class="  data-out" id="data4_2_out" hidden style="background-color:skyblue;">ROOM</button>
          <button type="button" class="  data-out" id="data4_3_out" hidden style="background-color:skyblue;">ห้องนั่งเล่น</button>
      </div>
      <div class="queue col-lg-5">
            <p> queue</p>
        <button type="button" class="   btn-success data-queue" id="root_queue"hidden >มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</button>
        <button type="button" class="  data-queue" id="data1_queue" hidden  style=" background-color:yellow;">ตึกวิทยาศาสตร์ </button>
        <button type="button" class="  data-queue" id="data2_queue" hidden style=" background-color:blue;color:white;">ตึกมนุษย์ศาสตร์และสังคมศาสตร์ </button>
        <button type="button" class="  data-queue" id="data3_queue" hidden  style=" background-color:purple;color:white;">ตึกวิทยาการจัดการ</button>
        <button type="button" class="  data-queue" id="data4_queue"  hidden style=" background-color:skyblue;">ตึกครุศาสตร์ </button>
        <button type="button" class="  data-queue" id="data1_1_queue" hidden style="background-color:yellow;">ห้องคอม</button>
        <button type="button" class="  data-queue" id="data1_2_queue" hidden style="background-color:yellow;">ห้องแลป </button>
        <button type="button" class="  data-queue" id="data1_3_queue" hidden style="background-color:yellow;">ห้องทดลอง</button>
        <button type="button" class="  data-queue" id="data2_1_queue" hidden style="background-color:blue;color:white;">ห้องภาษา</button>
        <button type="button" class="  data-queue" id="data2_2_queue" hidden style="background-color:blue;color:white;">ห้องดนตรี</button>
        <button type="button" class="  data-queue" id="data2_3_queue" hidden style="background-color:blue;color:white;">ห้องศิลป์</button>
        <button type="button" class="  data-queue" id="data3_1_queue" hidden style="background-color:purple;color:white;">ห้องโลจิสติก</button>
        <button type="button" class="  data-queue" id="data3_2_queue" hidden style="background-color:purple;color:white;">ห้องคอม</button>
        <button type="button" class="  data-queue" id="data3_3_queue" hidden style="background-color:purple;color:white;">ห้องบัญชี</button>
        <button type="button" class="  data-queue" id="data4_1_queue" hidden style="background-color:skyblue;">ห้อง</button>
        <button type="button" class="  data-queue" id="data4_2_queue" hidden style="background-color:skyblue;">ROOM</button>
        <button type="button" class="  data-queue" id="data4_3_queue" hidden style="background-color:skyblue;">ห้องนั่งเล่น</button>
      </div>
      <div class="data col-lg-2">
            <p> input </p>
        <button type="button" class="  btn-success data-data" id="root_data"hidden >มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</button>
        <button type="button" class="  data-data" id="data1_data" hidden style="background-color:yellow;">ตึกวิทยาศาสตร์ </button>
        <button type="button" class="  data-data" id="data2_data" hidden style=" background-color:blue;color:white;">ตึกมนุษย์ศาสตร์และสังคมศาสตร์ </button>
        <button type="button" class="  data-data" id="data3_data" hidden style=" background-color:purple;color:white;">ตึกวิทยาการจัดการ</button>
        <button type="button" class="  data-data" id="data4_data" hidden style=" background-color:skyblue;">ตึกครุศาสตร์ </button>
        <button type="button" class="  data-data" id="data1_1_data" hidden style="background-color:yellow;">ห้องคอม</button>
        <button type="button" class="  data-data" id="data1_2_data" hidden  style="background-color:yellow;">ห้องแลป </button>
        <button type="button" class="  data-data" id="data1_3_data" hidden style="background-color:yellow;">ห้องทดลอง</button>
        <button type="button" class="  data-data" id="data2_1_data" hidden style="background-color:blue;color:white;">ห้องภาษา</button>
        <button type="button" class="  data-data" id="data2_2_data" hidden style="background-color:blue;color:white;">ห้องดนตรี</button>
        <button type="button" class="  data-data" id="data2_3_data" hidden style="background-color:blue;color:white;">ห้องศิลป์</button>
        <button type="button" class="  data-data" id="data3_1_data" hidden style="background-color:purple;color:white;">ห้องโลจิสติก</button>
        <button type="button" class="  data-data" id="data3_2_data" hidden style="background-color:purple;color:white;">ห้องคอม</button>
        <button type="button" class="  data-data" id="data3_3_data" hidden style="background-color:purple;color:white;">ห้องบัญชี</button>
        <button type="button" class="  data-data" id="data4_1_data" hidden style="background-color:skyblue;">ห้อง</button>
        <button type="button" class="  data-data" id="data4_2_data" hidden style="background-color:skyblue;">ROOM</button>
        <button type="button" class="  data-data" id="data4_3_data" hidden style="background-color:skyblue;">ห้องนั่งเล่น</button>
      </div>
    <div>
  <div>
</div>
</body>
</html>
