<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style type="text/css">
*, ::after, ::before { -webkit-box-sizing: border-box; box-sizing: border-box; }
body {  background: #ffffffff; }
  </style>

  <style>

*, ::after, ::before { -webkit-box-sizing: border-box; box-sizing: border-box; }

.loader
 {
   position: fixed;
   left: 0px;
   top: 0px;
   width: 100%;
   height: 100%;
   z-index: 9999;
  -webkit-animation: loader-1 3s linear infinite;
   animation: loader-1 3s linear infinite;
}
@-webkit-keyframes loader-1 {
  0%   { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes loader-1 {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.loader span {
  display: block;
  position: absolute;
  top: 0; left: 0;
  bottom: 0; right: 0;
  margin: auto;
  height: 42px;
  width: 42px;
  clip: rect(16px, 42px, 42px, 0);
  -webkit-animation: loader-2 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
          animation: loader-2 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
}
@-webkit-keyframes loader-2 {
  0%   { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes loader-2 {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.loader span::before {
  content: "";
  display: block;
  position: absolute;
  top: 0; left: 0;
  bottom: 0; right: 0;
  margin: auto;
  height: 42px;
  width: 42px;
  border: 3px solid transparent;
  border-top: 3px solid #3530F0;
  border-radius: 50%;
  -webkit-animation: loader-3 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
  animation: loader-3 1.5s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
}
@-webkit-keyframes loader-3 {
  0%   { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes loader-3 {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.loader span::after {
  content: "";
  display: block;
  position: absolute;
  top: 0; left: 0;
  bottom: 0; right: 0;
  margin: auto;
  height: 42px;
  width: 42px;
  border: 3px solid rgb(53 48 240 / 63%);
  border-radius: 50%;
}

  </style>
</head>
<body>

  <div class="loader center"><span></span></div>

</body>
</html>