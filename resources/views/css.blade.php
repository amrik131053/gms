<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Guru Kashi University</title>
    <link rel="icon" type="image/png" sizes="16x16" href="admin/img/favicon-32x32.png">
      <!-- Standard Favicon -->
      <link rel="icon" type="image/png" sizes="32x32" href="admin/img/favicon-32x32.png">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="admin/img/apple-touch-icon.png">
    <!-- Android Chrome Icon -->
    <link rel="icon" type="image/png" sizes="192x192" href="admin/img/android-chrome-192x192.png">
    <!-- CSS files -->
    <link href="{{ asset('admin/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
  
<style>
  .full-screen-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8); /* Light semi-transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it's on top of other elements */
}

/* Spinner styles */
.loader {
    border: 6px solid rgba(0, 0, 0, 0.1); /* Light grey border */
    border-top: 6px solid #3498db; /* Blue color for the spinner */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite; /* Animation */
}

/* Keyframes for the spinning effect */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.progress-container-vertical {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding-left: 40px; /* Space for lines */
    position: relative;
}

.progress-container-vertical::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    height: 100%;
    width: 2px;
    background-color: #223260; /* Line between steps */
}

.step {
    position: relative;
    width: 100%;
    padding: 10px 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-left: 15px;
}

.step.active {
    color: #28a745;
}

.step.completed {
    color: green;
}

.step.rejected {
    color: #a62535;
}

.step.disabled {
    color: #aaa;
}

.step.hidden {
    display: none;
}

.verification-date {
    font-size: 12px;
    color: #555;
    margin-top: 5px;
}

.step::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 10px;
    height: 12px;
    width: 12px;
    border-radius: 50%;
    border: 2px solid #ddd;
    background-color: #fff;
}

.step.active::before {
    background-color: #28a745;
    border-color: #28a745;
}

.step.completed::before {
    background-color: green;
    border-color: green;
}

.step.rejected::before {
    background-color: #a62535;
    border-color: #a62535;
}

.step.disabled::before {
    background-color: #e0e0e0;
    border-color: #e0e0e0;
}
</style>
  </head>
  <body class="{{ request()->is('/') || request()->is('/login') || request()->is('/forgotpassword') ? '' : 'layout-fluid' }}">
    @include('modals')
  <div id="fullScreenLoader" class="full-screen-loader" style="display:none;">
    <div class="loader"></div>
</div>