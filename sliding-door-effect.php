<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
  font-family: 'Roboto', sans-serif;
  background-color: #eee;
}

.stage {
  background: #fff;
  width: 100%;
  /* margin: 4em auto; */
  /* border: 15px solid #333; */
  box-shadow: 1px 4px 11px #aaa, inset 1px 3px 6px #ccc;
  padding: 1em 0 3em;
  position: relative;
}

.stage-content {
  background-repeat: no-repeat;
  background-size: contain;
  background-position: center;
  padding-top: 56.25%;
  content: 'Wel';
  color:green;
  background-image: url('dist/img/door-logo.png');
  /* background-image: url('dist/img/1179514.gif'); */
}

.stage-content:after {
  content: 'Go To ';
  text-align: center;
  display: block;
  text-transform: uppercase;
  transform: translateY(0.5em);
  font-size: 2.1em;
  padding-top:-300px;
}

.curtain-container {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

.curtain-panel {
  display: flex;
  height: 100%;
  width: 100%;
  cursor: pointer;
  overflow: hidden;
}

.curtain-panel .curtain {
  width: 50%;
  background-color: #223260;
  position: relative;
  transition: transform 2.5s ease-out;
  display: flex;
  align-items: center;
  overflow: hidden;
  
}

.curtain-panel .curtain:before {
  content: attr(data-title);
  text-align: center;
  width: 100%;
  position: absolute;
  /* top: %; */
  line-height: 0;
  font-size: 1.1em;
  text-shadow: 1px 1px 3px #ccc;
  
}

.curtain-panel .left-curtain:before {
  left: 0;
  margin-left:415px;
  font-size:50px;
  color:white;
  content: 'Wel';
}

.curtain-panel .right-curtain:before {
  right: 0;
  margin-right:405px;
  font-size:50px;
  color:white;
  content: 'Come';
}

.curtain-panel .curtain:after {
  content: '';
  background-size: 20px 20px;
  background-image: radial-gradient(circle at 10px -5px, rgba(0, 0, 0, 0) 12px, #fff 13px);
  display: block;
  height: 10px;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
}

.curtain-trigger {
  visibility: hidden;
  position: absolute;
  
}

.curtain-trigger:checked ~ .left-curtain {
  transform: translateX(calc(-100% + 2em));
}

.curtain-trigger:checked ~ .right-curtain {
  transform: translateX(calc(100% - 2em));
}


.button-content {
  position: absolute;
  top: 65%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: green;
  font-size: 24px; /* Adjust the font size as needed */
}

.image-link {
  display: block; /* Make the entire container clickable */
  text-decoration: none; /* Remove default link styling */
}

    </style>
</head>
<body>
<div class="stage">
  <div class="stage-content">
  <div class="button-container">

</div>

  </div>
  <label class="curtain-container">
    <div class="curtain-panel">
      <input type="checkbox" class="curtain-trigger" />
      <div class="left-curtain curtain" data-title=""></div>
      <div class="right-curtain curtain" data-title=""></div>
      <div class="button-container">

</div>

    </div>
   
  </label>
  
  <a href="http://10.0.8.183/vac/" >
      
      <span class="button-content" style="color:#223260;">Click Here</span>
   
  </a>
</div>
</body>
</html>