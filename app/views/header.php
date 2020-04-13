<?php
    require_once 'const/const.php';
    $content = '';
    if(isset($_REQUEST['content'])) $content = $_REQUEST['content'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PraDepois - O fiado ao contrário</title>
        <link rel="icon" href="<?php echo path::ROOT; ?>imgs/favicon.png">
        <!-- NO CACHE -->
        <meta http-equiv="Cache" content="no-cache">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo path::ROOT; ?>js/jquery-3.3.1.min.js"></script>
        <!-- css -->
        <!--link rel="stylesheet" type="text/css" href="css/default.css" /-->

    </head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap');
        * {
            margin: 0;
            padding:0;
            outline: 0;
            box-sizing: border-box; /* para nao aumentar o div quando aplicado o padding ou margin */
        }
        
        html, body{
            height: 100%;
        }
        
        body, input, button, select{
            font-family: Montserrat,Arial,Helvetica,sans-serif;
            color: #4f515d;
        }
        
        body{
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }

        a{
            text-decoration: none;
            color: #1ed3aa; 
        }

        h1, h2{
            font-size: 40px;
            font-weight: 800;
            color: #1ed3aa;
            margin-bottom: 20px;
        }
        #app{
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        
        #content{
            margin: auto;
            width: 100%;
            max-width: 750px;
            padding: 40px;
        }

        #modal_service{
            display: none;
            position: fixed; top: 0; left: 0; height: 100%; width: 100%;
            background-color: #fff;
        }

        #modal_service div{
            margin: 0 auto;
            margin-top: 50px;
            max-width: 300px;
        }
        
        #wait{
            display: none;
            margin: 0;
        }
        
        #wait, #wait span{
            position: fixed; top: 0; left: 0; height: 100%; width: 100%; 
        }
        
        #wait span{
            background-color: #fff; filter:opacity(alpha=60);-moz-opacity:0.6; opacity:0.6;
        }
        #wait img{
            height: 32px;
        }

        input, button, select{
            font-size: 16px;
            width: 100%;
            padding: 20px;
            border: 0;
        }
        
        input, select{
            color: #1ed3aa;
            border-bottom: 1px solid #e9e9e9;
        }

        input:focus { 
            border-bottom: 2px solid #1ed3aa;
        }

        .inputError { 
            border-bottom: 2px solid #dd137b;
        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #c8c8c8;
            opacity: 1; /* Firefox */
        }

          :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #c8c8c8;
          }

          ::-ms-input-placeholder { /* Microsoft Edge */
            color: #c8c8c8;
          }

        button {
            cursor: pointer;
            background-color: #1ed3aa;
            color: #fff;
        }
       
        #modal{

            position: fixed;
            top: -130px;
            right: -460px;
            width: 100%;
            max-width: 450px;
            height: 120px;

            padding: 20px;
            line-height: 26px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            transition: right 0.5s, top 0.5s;
            transition-timing-function: ease-in-out;
        }
        
        #modal strong{
            margin-right: 10px;
        }
        #modal .close{
            position: absolute;
            top: 10;
            right: 20;
            font-size: 40px;
        }        
        .error{
            background-color: #dd137b;
            color: #fff;
        }
        .success, .active{
            background-color: #1ed3aa;
            color: #fff;
        }
        .warning{
            background-color: #f8ea5a;
            color: #000;
        }
        
        span {
            display: none;
            font-size: small;
            color: #dd137b;
        }
        #tab_nav{
            width: 100%; height: 64px; border-bottom: 2px solid #e8e8ea; display: flex;flex-direction: row;
        }
        #tab_nav .tab{
            width: 150px; height: 64px; display: flex; align-items: center;justify-content: center;
        }
        #tab_nav .selected{
            border-bottom: 2px solid #1ed3aa;
            
        }
        #tab_nav .selected a{
            font-weight: bold; 
            color: #4f515d;
        }
        .data{
            width: 100%; border-bottom: 1px solid #e8e8ea; display: flex;flex-direction: row; align-items: center; justify-content: space-between; padding: 15px;
        }
        input[type="number"] {
  -webkit-appearance: textfield;
  -moz-appearance: textfield;
  appearance: textfield;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
}

.number-input {
  border: 1px solid #ddd;
  display: inline-flex;
}

.number-input,
.number-input * {
  box-sizing: border-box;
}

.number-input button {
  outline:none;
  -webkit-appearance: none;
  background-color: transparent;
  border: none;
  align-items: center;
  justify-content: center;
  width: 16px;
  height: 24px;
  cursor: pointer;
  margin: 0;
  position: relative;
}

.number-input button:before,
.number-input button:after {
  display: inline-block;
  position: absolute;
  content: '';
  width: 1rem;
  height: 2px;
  background-color: #4f515d;
  transform: translate(-50%, -50%);
}
.number-input button.plus:after {
  transform: translate(-50%, -50%) rotate(90deg);
}

.number-input input[type=number] {

  max-width: 46px;
  padding: 1px;
  border: solid #ddd;
  border-width: 0 1px;
  font-size: 16px;
  height: 40px;
  font-weight: bold;
  text-align: center;
}
#logo-dashboard{
    display: block;
}
@media only screen and (max-width: 500px) {
    #logo-dashboard{
    display: none;
}
            }

    </style>
    <div id="app">
        <div id="content">