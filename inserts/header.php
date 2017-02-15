
<script type="text/javascript">
  function logOut() {
    document.cookie = "PHPSESSID=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  }
</script>
<nav class="navbar navbar-inverse " style = "margin-bottom: 0px">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href ="/">Carpool</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id=".navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        <!-- <li><a href="/carpool.php">Carpool</a></li> -->
        <li><a href="/about.html">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a id = "logout-button" href="/login.php" onclick = "logOut();">Log Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
