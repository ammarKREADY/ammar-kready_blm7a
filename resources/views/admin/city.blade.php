<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">




        input[type='text']{

        }
        .table_deg{
            text-align: center;
            margin-top: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
        }
        th{
            background-color: skyblue;
            padding: 15px;
            font-size:20px;
            font-weight:bold;
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
    <!---header--->
    @include('admin.header')
    <!---endheader---->
    <!---sidebar-->
    @include('admin.sidebar')
    <!---endside-->
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h1 style="color: cadetblue">اضافة مدينة</h1>
            <br>
            <form action="{{ route('city.store') }}" method="post" enctype="multipart/form-data">
             @csrf
             <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">

              <!-- -->
              <div class="form-group">
                  <h4>اسم المدينة</h4>
                  <input type="text" name="name" class="form-control">
              </div>
             </div>
        <input class="btn btn-primary" type="submit" value="إضافة مدينة" >

            </form>
   
    <table style="width: 100%" class="table_deg">
                <tr>
                    <th> الاسم</th>
                  
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($city as $service)
                <tr>
                 <form action="{{ route('city.edit', ['id'=>$service->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <td>
                   <input type="text" name="name" value="{{ $service->name}}" class="form-control">
                  </td>
                  <td>
                   <input class="btn btn-success" type="submit" value="تعديل" >
                  </td>
                 </form>
                 <td>
                  <form action="{{ route('city.delete', ['id'=>$service->id]) }}" method="post" enctype="multipart/form-data">
                   @csrf
                   <input class="btn btn-primary" type="submit" value="حذف" >

                  </form>
                 </td>
                </tr>
                @endforeach
             
            </table>
</div>





</form>



          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>
