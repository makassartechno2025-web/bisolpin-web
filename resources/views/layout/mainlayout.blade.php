
<!DOCTYPE html>
@if(!Route::is(['index-rtl']))
<html lang="en">
@endif
@if(Route::is(['index-rtl']))
<html lang="en" dir="rtl">
@endif    
<head>
    <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Bisolpin adalah platform bimbingan belajar praktis, efisien, dan komprehensif. Dapatkan layanan les privat, kursus IT, dan edukasi terbaik.">
		<meta name="keywords" content="bisolpin, bimbingan belajar, les privat, kursus online, edukasi">
		<meta name="author" content="Bisolpin">
		
		<title>Bisolpin | Bimbingan Belajar Praktis & Komprehensif</title>

    @include('layout.partials.head')
</head>

@if (!Route::is(['index-5','index-6']))
<body>
@endif
  
    @if (Route::is(['index-5','index-6']))

    <body class="home-five">
    @endif
    
    @if (Route::is(['error-404', 'error-500', 'under-construction']))

        <body class="error-page">
    @endif

    @if (Route::is(['coming-soon']))

        <body class="error-page comming-soon-pg">
    @endif

    @if (Route::is(['student-messages','instructor-chat']))
    <body class="chat-page main-chat-blk">
    @endif
    @if (Route::is(['student-messages','instructor-chat']))
    <div class="main-wrapper chat-wrapper">
        @endif
    <!-- Main Wrapper -->
    @if (!Route::is(['login', 'register', 'register-user', 'student-messages','instructor-chat','index-6']))
        <div class="main-wrapper">
    @endif
    @if (Route::is(['index-3']))
    <div class="home-3">
    @endif
    @if (Route::is(['index-4']))
    <div class="home-4">
    @endif
    @if (Route::is(['login', 'register', 'register-user']))
        <div class="main-wrapper log-wrap">
    @endif
    @if (Route::is(['index-6']))
    <div class="main-wrapper index-six">
    @endif
    @if (
        !Route::is([
            'coming-soon',
            'error-404',
            'error-500',
            'forgot-password',
            'login',
            'new-password',
            'register-step-five',
            'register-step-four',
            'register-step-one',
            'register-step-three',
            'register-step-two',
            'register',
            'register-user',
            'under-construction',
            'verification-code',
            'view-invoice',
            'lock-screen',
            'otp',
            'reset-password',
            'set-password'
        ]))
        @include('layout.partials.header')
    @endif
    @yield('content')
    @if (
        !Route::is([
            'coming-soon',
            'error-404',
            'error-500',
            'forgot-password',
            'login',
            'new-password',
            'register-step-five',
            'register-step-four',
            'register-step-one',
            'register-step-three',
            'register-step-two',
            'register',
            'register-user',
            'under-construction',
            'verification-code',
            'lock-screen',
            'otp',
            'set-password',
            'reset-password'
        ]))
        @include('layout.partials.footer')
    @endif
    @if (Route::is(['index-3','index-4']))
    </div>
    @endif
   </div>
    <!-- /Main Wrapper -->
    @component('components.modalpopup')
    @endcomponent

    @include('layout.partials.footer-scripts')

</body>

</html>