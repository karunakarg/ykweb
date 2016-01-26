<header class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid expanded-panel">
    <div class="row">
      <div class="navbar-header">
        <div id="logo" class="col-xs-12 col-sm-2 visible-xs visible-sm" style="margin-left:3%">
        <a href="index.php"><img style="margin-top:4%" src="img/yk_logo.png" width="110px" height="30px"/></a>  <!-- LOGO Image -->
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  
      </button>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-search">
        <span class="sr-only">Toggle navigation</span>
        <font color="white"><i class="fa fa-search fa-fw"></i></font>
      </button>
      </div>
    </div>
      <div id="logo" class="col-lg-2 visible-md visible-lg" style="margin-left:8.6%">
        <a href="index.php"><img src="img/yk_logo.png" width="165px" height="45px"/></a>  <!-- LOGO Image -->
      </div>
      <? include('search.php'); ?>
      <nav class="collapse navbar-search" role="navigation">
          <? include('search2.php'); ?>
      </nav>
      <nav class="collapse navbar-collapse" role="navigation">
        <ul class="nav navbar-nav pull-right" style="margin-right:9.3%">
          <li><form action="request.php"><button type="submit" class="navbar-right btn btn-warning navbar-btn">Post a Request</button></form></li>
          <li>&nbsp;&nbsp;</li>
          <li><form action="postad.php"><button type="submit" class="navbar-right btn btn-warning navbar-btn">Post an Ad</button></form></li>
        </ul>
      </nav>
    
  </div>
</header>