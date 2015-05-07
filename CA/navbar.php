<?php if ($usertype == 1){ ?>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Certificate Authority</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
        	<li class="<?php if ($page == 'home') echo 'active'; ?>"><a href="index.php">Home</a></li>
	        <li class="<?php if ($page == 'csr') echo 'active'; ?>"><a href="req_csr.php">CSR</a></li>
	        <li class="<?php if ($page == 'sign') echo 'active'; ?>"><a href="sign_csr.php">Sign</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i>Welcome, <?php echo $username; ?></i></a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

<?php } ?>
