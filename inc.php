<?
include_once('kart/sqlcon.php');
include_once('kart/kartlib.php');
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('Asia/Calcutta');
}
if (!isset($_SESSION['ip'])) { // if new user
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}
?>
<link rel="icon" type="image/png" href="favicon.png">
<meta name="generator" content="YourKart" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/yourkart.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/bootstrap-material-design.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/ripples.min.css" rel="stylesheet">
        <link href="" rel="stylesheet">

<!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> -->

<style type="text/css">
<!--
body{
font-family:Arial, Helvetica, sans-serif; 
font-size:13px;
}
.info, .success, .warning, .error, .validation {
border: 1px solid;
margin: 10px 0px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;
}
.info {
color: #00529B;
background-color: #BDE5F8;
background-image: url('images/info.png');
}
.success {
color: #4F8A10;
background-color: #DFF2BF;
background-image:url('images/success.png');
}
.warning {
color: #9F6000;
background-color: #FEEFB3;
background-image: url('images/warning.png');
}
.error {
color: #D8000C;
background-color: #FFBABA;
background-image: url('images/error.png');
}
-->
html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
</style>
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
            body {
	padding-top:50px;
}

#masthead {
	min-height:250px;
}

#masthead h1 {
	font-size: 30px;
	line-height: 1;
  	padding-top:20px;
}

#masthead .well {
	margin-top:8%;
}

@media screen and (min-width: 768px) {
	#masthead h1 {
		font-size: 50px;
	}
}

.navbar-bright {
	background-color:#111155;
    color:#fff;
}

.affix-top,.affix{
	position: static;
}

@media (min-width: 979px) {
  #sidebar.affix-top {
    position: static;
  	margin-top:20px;
  	width:228px;
  }
  
  #sidebar.affix {
    position: fixed;
    top:70px;
    width:228px;
  }
}

#sidebar li.active {
  	border:0 #eee solid;
  	border-right-width:4px;
}


        </style>


<script type="text/javascript">
 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-37757719-1']);
_gaq.push(['_trackPageview']);
					
 (function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();
</script>
