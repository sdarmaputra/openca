<?php
    include('db.php');
    include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Certificate Authority</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
<?php 
    $page='home'; include('navbar.php');
?>
  <div class="container-fluid">
      <!-- pending certificate -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Pending Certificate(s)</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Submit Date</td>
                        <td>Content</td>
                    </tr>
                </thead>
                <tbody>
        <?php
            $pending = mysqli_query($conn, "SELECT * FROM pending_cert WHERE userpending='".$username."' AND signed=0");
            $pendingc = 0;
            while ($row = mysqli_fetch_row($pending)){
        ?>
                    <tr>
                        <td><?php echo $pendingc+1; ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[3] ?></td>
                    </tr>
        <?php
                $pendingc++;
            }
        ?>          
                </tbody>
            </table>
            <?php if ($pendingc == 0) echo "Empty"; ?>
        </div>
      </div>
      <!-- /pending certificate -->
      
      <!-- signed certificate -->
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Signed Certificate(s)</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Signed Date</td>
                        <td>Content</td>
                    </tr>
                </thead>
                <tbody>
        <?php
            $signed = mysqli_query($conn, "SELECT * FROM signed_cert WHERE usersigned='".$username."' AND active=1");
            $signedc = 0;
            while ($row = mysqli_fetch_row($signed)){
        ?>
                    <tr>
                        <td><?php echo $signed+1; ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[3] ?></td>
                    </tr>
        <?php
                $signed++;
            }
        ?>          
                </tbody>
            </table>
            <?php if ($signedc == 0) echo "Empty"; ?>
        </div>
      </div>
      <!-- /signed certificate -->
    </div>
</body>
</html>