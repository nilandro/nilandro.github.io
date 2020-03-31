  
<!DOCTYPE html>
<?php
set_time_limit(2000);
//generic php function to send GCM push notification
function sendPushNotificationToGCM($message , $key)
{
    //Google cloud messaging GCM-API url
    $url    = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to'   => "/topics/newapp",
        'data' => $message,
    );
    // Google Cloud Messaging GCM API Key
    //        define("GOOGLE_API_KEY", "");
    $headers = array(
        'Authorization: key=' . $key,
        'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === false) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
?>


<?php

set_time_limit(2000);
header('Content-Type: text/html; charset=utf-8');

$max    = "";
$idddd  = 0;
$status = "";

	if (!empty($_GET["push"]) && !empty($_POST["name"])) {

    ini_set('max_execution_time', 3000);
   
    $name  = $_POST["name"];
    $topic = $_POST["topic"];
    $url   = $_POST["url"];
    $image   = $_POST["image"];
    $checkbox1 = $_POST["chkl"];


	    if(isset($_POST['chkl'])){
		  if (is_array($_POST['chkl'])) {
		    foreach($_POST['chkl'] as $value){
		       $message    = array( "image"=>$image, "name" => $name, "topic" => $topic, "url" => $url, "mt" => "3");
	           $pushStatus = sendPushNotificationToGCM($message ,$value);
	           $status     = json_decode($pushStatus, true);
		    }
		  } 
		}

}

function gen_string($string, $max)
{
    $tok    = strtok($string, ' ');
    $string = '';
    while ($tok !== false && strlen($string) < $max) {
        if (strlen($string) + strlen($tok) <= $max) {
            $string .= $tok . ' ';
        } else {
            break;
        }

        $tok = strtok(' ');
    }
    return trim($string) . '...';
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>CreativeNotification</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/narrow-jumbotron/narrow-jumbotron.css" rel="stylesheet">
 
<style>
.container{
background-color: #f3f3f3;
    padding: 20px 20px;
    border-radius: 15px;    
}
.jumbotron{
    padding: 1rem 1rem;
    margin-bottom: 0rem;
    border-radius: .3rem;
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;  
}
.marketing {
    margin: 1rem 0;
}
.jumbotron h1 {
    font-size: 26px;
}
.header h3 {
    color: #4d3672 !important;
}
</style>
 </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            
            <li class="nav-item">
              <a class="nav-link" href="">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">News</a>
            </li>
      <li class="nav-item">
              <a class="nav-link active" href="">Notification</a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">Creative</h3>
      </div>

      <div class="jumbotron">
        <h1>CreativeNOTIFICATION</h1>        
      </div>

      <div class="row marketing">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <form method="post" action="fcmapp.php/?push=1">
      
      <div class="form-group">
           <label for="exampleTextarea">Name</label>
               <textarea rows="1" name="name" cols="23" placeholder="Name" class="form-control" id="exampleTextarea" rows="1"></textarea>
          </div>
           
          <div class="form-group">
           <label for="exampleTextarea">Topic</label>
               <textarea rows="2" name="topic" cols="23" placeholder="Topic" class="form-control" id="exampleTextarea" rows="2"></textarea>
          </div>

        <div class="form-group">
           <label for="exampleTextarea">Url</label>
               <textarea rows="1" name="url" cols="23" placeholder="Url" class="form-control" id="exampleTextarea" rows="1"></textarea>
          </div>

           <div class="form-group">
           <label for="exampleTextarea">Image Url</label>
               <textarea rows="1" name="image" cols="23" placeholder="Image Url" class="form-control" id="exampleTextarea" rows="1"></textarea>
          </div>
                 
         <div class="form-group">

            <br>
            <input type="checkbox" name="chkl[ ]" value="AAAAPIykg1w:APA91bGE__qzXcOqV-K0VV5nCWahwdm0aJYZ7WK47vATbcTHaS3RoqEoUqIfdwp_TGcsDHmWTTW-_lL4HDS-FnlK83YNK3z0fP_xyC7NyB-xDO4zFgQ0Bo8e-ex91lARpMstMHbMOcIF">Story<br />  

            <input type="checkbox" name="chkl[ ]" value="">तुकाराम गाथा<br />  

            <input type="checkbox" name="chkl[ ]" value="">श्री शिवलीलामृत<br />  

            <input type="checkbox" name="chkl[ ]" value="">गुरुचरित्र<br />  

            <input type="checkbox" name="chkl[ ]" value="">भगवदगीता<br /> 

            <input type="checkbox" name="chkl[ ]" value="">श्री नवनाथ भक्तिसार<br />  

            <input type="checkbox" name="chkl[ ]" value="">श्री एकनाथ भागवत<br />  

            <input type="checkbox" name="chkl[ ]" value="">भजन<br />  

            <input type="checkbox" name="chkl[ ]" value="">उपासना<br /> 

            <br> 
        
          </div>

      <div class="form-group">
      <input type="submit"  class="btn btn-lg btn-success" value="Send Push Notification via GCM" name="sub"/>
      </div>
        </form>
        <p><h3><?php echo json_encode($status); ?></h3></p>
        </div>
      </div>

      <footer class="footer">
        <p style="text-align: center;">&copy; Company 2020 Developed by <a href=""target="_blank" >Creativeandro </a></p>
      </footer>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
