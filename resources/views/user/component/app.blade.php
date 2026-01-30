<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>BLM7A</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/webApp/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href='{{asset("css/webApp/style.css")}}'>
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('css/webApp/responsive.css') }}">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/webApp/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <style>
/* تصميم كرت المنتج */
.product-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: 0.3s ease-in-out;
  height: 100%;
  display: flex;
  flex-direction: column;
}

/* تأثير عند المرور بالماوس */
.product-card:hover {
  transform: translateY(-5px);
}

/* تنسيق حاوية الصورة */
.product-img {
  width: 100%;
  height: 200px; /* ارتفاع ثابت */
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f9f9f9;
}

/* ضبط مقاسات الصورة لتكون موحدة */
.product-img img {
  max-width: 100%;
  height: 100%;
  object-fit: cover;
}

/* تنسيق محتوى الكرت */
.product-info {
  padding: 15px;
  text-align: center;
}

/* اسم المنتج */
.product-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

/* السعر */
.product-price {
  font-size: 16px;
  color: #28a745;
  font-weight: bold;
}

/* الوصف */
.product-desc {
  font-size: 14px;
  color: #666;
  margin: 10px 0;
}

/* زر الإضافة إلى الطلب */
.add-to-order {
  background-color: #dc3545;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 8px;
  width: 100%;
  transition: background 0.3s ease;
  cursor: pointer;
}

/* عند تعطيل الزر */
.add-to-order:disabled {
  background-color: #6c757d;
  cursor: not-allowed;
}

/* عنوان القسم */
.section-title {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 25px;
  color: #333;
}
</style>

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="navbar-brand" href="{{ route('home') }}"><img src="images/blm7a.png"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}"><span class="padding5"><i class="fa fa-angle-right"></i></span>الرئيسية</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}"><span class="padding5"><i class="fa fa-angle-right"></i></span>من نحن</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}"><span class="padding5"><i class="fa fa-angle-right"></i></span>المطاعم</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('userServices') }}"><span class="padding5"><i class="fa fa-angle-right"></i></span>الماكولات</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}"><span class="padding5"><i class="fa fa-angle-right"></i></span>اتصل بنا</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('orders.view') }}">
                             <span class="padding5"><i class="fa fa-angle-right"></i></span> عرض الطلبات
                         </a>
                     </li>
                     
                    @if (Auth::check())
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm ml-3">
                                    <i class="fa fa-user"></i>  تسجيل خروج
                                </button>
                            </form>
                        </li>
                    @else
                      <form class="form-inline my-2 my-lg-0">
                     <div class="login_bt">
                        <ul>
                           <li><a href="{{ route('logintest') }}">تسجيل دخول</a></li>
                           <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </form>
                    @endif
                  </ul>
                 
               </div>
            </nav>
         </div>
        
        </div>
   @yield('content')
      <!-- header section end -->
      <!-- footer section start -->
 <div class="footer_section layout_padding">
   <div class="container">
      <div class="footer_section_2">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
               <h2 class="useful_text">About</h2>
               <p class="dummy_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, </p>
            </div>
            <div class="col-lg-3 col-sm-6">
               <h2 class="useful_text">Links</h2>
               <div class="footer_menu">
                  <ul>
                     <li class="active"><a href="{{ route('home') }}">Home</a></li>
                     <li><a href="about">About</a></li>
                     <li><a href="#">Softwere</a></li>
                     <li><a href="#">Company</a></li>
                     <li><a href="blog">blog</a></li>
                     <li><a href="testimonial">Testimonial</a></li>
                     <li><a href="contact">Contact</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <h2 class="useful_text">Follow Us</h2>
               <div class="social_icon">
                  <ul>
                     <li><a href="#"><span class="padding_15"><img src="images/facebook-icon.png"></span>Facebook</a></li>
                     <li><a href="#"><span class="padding_15"><img src="images/twitter-icon.png"></span>Twitter</a></li>
                     <li><a href="#"><span class="padding_15"><img src="images/linkedin-icon.png"></span>Linkedin</a></li>
                     <li><a href="#"><span class="padding_15"><img src="images/youtub-icon.png"></span>Youtube</a></li>
                     <li><a href="#"><span class="padding_15"><img src="images/instagram-icon.png"></span>Instagram</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <h2 class="useful_text">Newsletter</h2>
               <div class="form-group">
                  <textarea class="update_mail" placeholder="Enter Your Email" rows="5" id="comment" name="Enter Your Email"></textarea>
                  <div class="subscribe_bt"><a href="#">Subscribe</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
 </div>
 <!-- footer section end -->
 <!-- copyright section start -->
 <div class="copyright_section">
   <div class="container">
      <p class="copyright_text">  b   l   m   7   a   </p>
   </div>
 </div>
 <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/webApp/jquery.min.js"></script>
      <script src="js/webApp/popper.min.js"></script>
      <script src="js/webApp/bootstrap.bundle.min.js"></script>
      <script src="js/webApp/jquery-3.0.0.min.js"></script>
      <script src="js/webApp/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/webApp/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/webApp/custom.js"></script>
      <!-- javascript --> 
   </body>
   @yield('scripts')

</html> 