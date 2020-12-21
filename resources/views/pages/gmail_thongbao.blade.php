@extends('layout_ql_bd')
@section('us_content') 


Cám ơn đã sử dụng dịch vụ của chúng tôi, vui lòng xem lại thông tin bạn đã hẹn: 
link bds: <a href="{{URL::to('/chi-tiet-bds/'.$idbd )}}">Xem bài đăng bất động sản</a>

               

                <h3 class="h4 text-black widget-title mb-3">Đặt lịch hẹn</h3>
              <span class="rounded"><?php
                  $message=Session::get('message');
                    if($message)
                    {
                    echo $message;
                    Session::put('message',null);
                    }
              ?></span>
             
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" onkeyup="KT_name(this.value)" id="name" name="tenkh" class="form-control">
                  <small id="mes_name" class="text-danger"></small>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" onkeyup="KT_email(this.value)" id="email" name="emailkh" class="form-control">
                   <small id="mes_email" class="text-danger"></small>
                </div>
                <div class="form-group">
                  <label for="phone">Số điện thoại</label>
                  <input type="text" onkeypress='return event.charCode >= 47 && event.charCode <= 57' onkeyup="KT_sodienthoai(this.value)" name="sdtbd" class="form-control"  id="sodienthoai" placeholder="Số điện thoại" maxlength="10">
                  <small id="ersodienthoai" class="text-danger"></small>
                </div>

                <div class="form-group">
                  <label for="email">Thời gian</label>
                  <input type="datetime-local"  id="date" onchange="KT_date(this.value)"  name="thoigianhen" class="form-control">
                  <small id="erdate" class="text-danger"></small>
                </div>
                <div>
                  <input hidden="" id="trangthai" type="text" name="trangthai_lh" value="0"  id="phone" class="form-control">
                </div>
                <div>
                  <input hidden="" id="idbd" type="text" name="idbd"  id="phone" class="form-control">
                </div>
                <p id="demo13"></p>
                <menu>
                  <center><button type="btn"  id="updateDetails"  onclick="add_lh()" name="add_binhluan" class="btn btn-primary" >Đặt lịch</button></center>
                </menu>
                 <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script type="text/javascript">

       
      function KT_name(){
              var name1= $('#name').val();
              if(name1=='')
              {
                flag=1;
                $('#mes_name').html('Không được bỏ trống')

              }else
              {
                $('#mes_name').html('')
              }
              
            }
      function KT_email(){
         var email1= $('#email').val();
          if(email1=='')
            {
              flag=1;
              $('#mes_email').html('Không được bỏ trống')
            }else{
              $('#mes_email').html('')
            } 
      }

      function KT_sodienthoai(sdt)
        {
            if(sdt.length<10 || sdt.length>10)
            {
                $('#ersodienthoai').html('Số điện thoại gồm 10 số');
            }
            else
            {
                $('#ersodienthoai').html('');
            }

        }
        function KT_date()
        {
          var date1= $('#date').val();
          var date2 = new Date(date1);
          var today = new Date();  
          //console.log(date2);
          if(date2 < today)
          {
            $('#erdate').html('Ngày hẹn phải là tương lai');
          }
          else
          {
            $('#erdate').html('');
          }
        }
        function add_lh()
            { var flag=0;
              var name1= $('#name').val();
              var email1= $('#email').val();
              var idbd1=$('#idbd').val();
              var trangthai1=$('#trangthai').val();
              var phone1=$('#sodienthoai').val();
              var date1=$('#date').val();
               if(name1=='')
              {
                flag=1;
                $('#mes_name').html('Không được bỏ trống')

              }else
              {
                $('#mes_name').html('')
              }
              if(email1=='')
              {
                flag=1;
                $('#mes_email').html('Không được bỏ trống')
              }else{
                $('#mes_email').html('')
              } 
              if(phone1=='')
              {
                flag=1;
                $('#ersodienthoai').html('Không được bỏ trống')
              }else{
                $('#ersodienthoai').html('')
              } 
             
              if(flag == 1)
              { 
              } 
              else{
//var updateButton = document.getElementById('updateDetails');
var favDialog = document.getElementById('favDialog');
var outputBox = document.querySelector('output');
var confirmBtn = document.getElementById('confirmBtn');

//updateButton.addEventListener('click', function onOpen() {
  function TaoSoNgauNhien(min, max){
            return Math.floor(Math.random() * (max - min)) + min;
        }
    const a = TaoSoNgauNhien(1001, 9999);
    $('#maotp').html(a);
 
  if (typeof favDialog.showModal === "function") {
    favDialog.showModal();
    var idopt = ($('#maotp').html());
    var email2= $('#email').val();

    $.ajax({
              type: "POST",
               url: "http://127.0.0.1:8000/otp-mail",
              data: {maotp:idopt, emailkh:email2},
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

              dataType: "json",
              success: function (response) 
                   {
                    //alert(response['mes']);
                    }
              });


  } else {
    alert("The <dialog> API không được hỗ trợ bởi trình duyệt nè");
  }
//});
//const abc = $('#otp').html(); 
var idopt = ($('#maotp').html());
var text = document.getElementById('otp');

confirmBtn.addEventListener('click', function onSelect() {
  if(text.value== idopt ){
  $('#demo13').html('Mã OTP hợp lệ')
  confirmBtn.value =idopt.value;
          $.ajax({
              type: "GET",
              url: "http://127.0.0.1:8000/save-lichhen",
              data: {tenkh : name1, emailkh: email1, idbd: idbd1,trangthai_lh: trangthai1, sdtkh:phone1 , thoigianhen: date1},
              dataType: "json",
              success: function (response) 
                   {
                    alert(response['mes']);
                    }
              });
  
}else{
  $('#demo13').html('Mã OTP không hợp lệ')
  }
});
favDialog.addEventListener('close', function onClose() {
  outputBox.value = favDialog.returnValue;
});
              
            }
          }
        </script>
@endsection