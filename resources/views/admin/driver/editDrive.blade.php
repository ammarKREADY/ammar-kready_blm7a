<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style type="text/css">
        input[type='text']{}
        .table_deg{
            text-align: center;
            margin-top: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
        }
        th{
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        td{
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 style="color: cadetblue;text-align: center">تعديل سائق</h1>
          <br>
          <form action="{{ route('driver.update', ['id' => $driver->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div >
              <div class="form-group">
                  <h4>الاسم</h4>
                  <input style="width: 500px"  value="{{$driver->user->name}}" required type="text" name="name" class="form-control">
                 
              </div>
              <div class="form-group">
               <h4>الايميل</h4>
               <input style="width: 500px" value="{{$driver->user->email}}" required type="email" name="email" class="form-control">
           </div>
           <div class="form-group">
            <h4>كلمة المرور الجديدة</h4>
            <input style="width: 500px"  type="password" name="password" class="form-control">
        </div>
           <div class="form-group">
            <h4>رقم الهاتف</h4>
            <input style="width: 500px" required type="number" value="{{$driver->user->phone}}" name="phone" class="form-control">
        </div>
        <div class="form-group">
         <h4>المدينة</h4>
       <select class="form-control"  style="width: 500px" name="city_id">
        <option hidden value="{{$driver->city->id}}">{{$driver->city->name}}</option>
        @foreach ($city as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
       </select>
     </div>
     <div class="form-group">
      <h4>وسيلة التوصيل</h4>
    <select class="form-control"  style="width: 500px" name="vehicle">
      <option hidden value="{{$driver->vehicle}}">{{$driver->vehicle}}</option>
         
      <option value="car">car</option>
         <option value="motor">motor</option>
         <option value="bicycle">bicycle</option>
    </select>
  </div>
  <div class="form-group">
   <h4> وقت بدء الدوام</h4>
   <input style="width: 500px"  value="{{$driver->start_jop}}" required type="time" name="start_jop" class="form-control">
</div>
<div class="form-group">
 <h4> وقت انتهاء الدوام</h4>
 <input style="width: 500px"  value="{{$driver->end_jop}}" required type="time" name="end_jop" class="form-control">
</div>
<div class="form-group">
 <h4> كلفة التوصيل</h4>
 <input style="width: 500px" value="{{$driver->driver_cost}}" required type="number" name="driver_cost" class="form-control">
</div>
<div class="form-group">
 <h4>  الراتب</h4>
 <input style="width: 500px"  value="{{$driver->salary}}" required type="number" name="salary" class="form-control">
</div>
            </div>
            <input class="btn btn-primary" type="submit" value="تعديل السائق">
          </form>

       
        </div>
      </div>
    </div>

    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
    <script>
      function handleClickImage(inputId) {
        document.getElementById(inputId).click();
      }
    </script>
  </body>
</html>
