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
          <h1 style="color: cadetblue">اضافة اطباق</h1>
          <br>
          <form action="{{ route('food.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">
              <div class="form-group">
                  <h4>الاسم </h4>
                  <input required type="text" name="name" class="form-control">
              </div>
              <div class="form-group">
               <h4> السعر</h4>
               <input required type="number" name="price" class="form-control">
           </div>
           <div class="form-group">
            <h4> الوصف</h4>
            <input required type="text" name="description" class="form-control">
        </div>
           <div class="form-group">
            <h4>التصنيف</h4>
          <select class="form-control"  style="width: 500px" name="category_id">
           @foreach ($category as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>
           @endforeach
          </select>
        </div>
        <div class="form-group">
         <h4>المطعم</h4>
       <select class="form-control"  style="width: 500px" name="restaurant_id">
        @foreach ($resturant as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
       </select>
     </div>
              <div class="form-group">
                <h4>الصورة</h4>
                <input required type="file" name="image[]" class="form-control">
              </div>
            </div>
            <input class="btn btn-primary" type="submit" value="إضافة التصنيف">
          </form>

          <table style="width: 100%" class="table_deg">
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>السعر</th>
                <th>الوصف</th>
                <th>التصنيف</th>
                <th>المطعم</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($food as $service)
            <tr>
              <form action="{{ route('food.edit', ['id' => $service->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <td>
                  <img onclick="handleClickImage('{{ 'image'.$service->id }}')" src="{{ route('getImage', ['id' => $service->image->id, 'file_name' => $service->image->file_name]) }}" width="100" height="100" style="display: block; margin-bottom: 10px;">
                  <input type="file" hidden id="{{ 'image'.$service->id }}" name="image[]">
                </td>
                <td>
                  <input type="text" name="name" value="{{ $service->name }}" required class="form-control">
                </td>
                <td>
                 <input type="number" name="price" value="{{ $service->price }}" required class="form-control">
               </td>
               <td>
                <input type="text" name="description" value="{{ $service->description }}" required class="form-control">
              </td>
               <td>
                 <div class="form-group">
               <select class="form-control"  style="width: 500px" name="category_id">
                @foreach ($category as $item)
        <option hidden value="{{$service->category->id}}">{{$service->category->name}}</option>

                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               </select>
             </div>
              </td>
              <td>
               <div class="form-group">
             <select class="form-control"  style="width: 500px" name="restaurant_id">
              @foreach ($resturant as $item)
      <option hidden value="{{$service->restaurant->id}}">{{$service->restaurant->name}}</option>

                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
             </select>
           </div>
            </td>
                <td>
                  <input class="btn btn-success" type="submit" value="تعديل">
                </td>
                
              
              </form>
              <td>
                <form action="{{ route('food.delete', ['id' => $service->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input class="btn btn-primary" type="submit" value="حذف">
                </form>
              </td>
            </tr>
            @endforeach
          </table>
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
