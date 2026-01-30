<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Document</title>
 <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
  <!-- font css -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/webApp/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">

<form method="POST" action="{{ route('register') }}">
 @csrf
			<h1>إنشاء حساب</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>أو استخدم بريدك الإلكتروني للتسجيل</span>
			<input id="name"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="الاسم"/>
			<input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="البريد الاكتروني"/>
			<input id="password" class="block mt-1 w-full"
   type="password"
   name="password"
   required autocomplete="new-password" placeholder="كلمة المرور"/>
			<button>تسجيل جديد</button>
		</form>
	</div>
	<div class="form-container sign-in-container">


		<form method="POST" action="{{ route('login') }}">
   @csrf
			<h1>تسجيل الدخول</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span> استخدم حسابك</span>
			<input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"placeholder="البريد الالكتروني" />
			<input id="password" 
   type="password"
   name="password"
   required autocomplete="current-password" placeholder="كلمة المرور"/>
			<a href="#">هل نسيت كلمة المرور ؟</a>
			<button>تسجيل الدخول</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>" مرحبًا بعودتك "</h1>
				<p>للبقاء على اتصال معنا، يرجى تسجيل الدخول باستخدام معلوماتك الشخصية</p>
				<button class="ghost" id="signIn">تسجيل الدخول</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>مرحبًا صديقي</h1>
				<p>أدخل معلوماتك الشخصية وابدأ رحلتك معنا</p>
				<button class="ghost" id="signUp">سجّل الآن</button>
			</div>
		</div>
	</div>
</div>


</body>
<script>
 const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</html>