<?php 
  session_start();
  

 ?>



<?php


require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

/**
 * Instanciate an OVH Client.
 * You can generate new credentials with full access to your account on
 * the token creation page
 */
require __DIR__ . '/config.php';



// Information about your web hosting

// Get servers list
$ovh = new Api($applicationKey, $applicationSecret, $endpoint, $consumer_key);



$check = 0;

if ($_SERVER['REQUEST_METHOD']=='POST') {


  $ip =  trim($_POST['ip']);


  $result = $ovh->get('/cloud/project/329b4bd933e64386a25905515381c069/instance', array(
    'region' => NULL, // Instance region (type: string)
));
           

for($i=0;$i<count($result);$i++){ 

 if($result[$i]['ipAddresses'][0]['ip']==$ip){
             $id = $result[$i]['id'];
              $check = 1;

            }

}

if($check == 1){
  
            $result = $ovh->delete('/cloud/project/329b4bd933e64386a25905515381c069/instance/'.$id);
              $_SESSION['message'] = 'Server Deleted Successfully';

           sleep(2);

    //header('location: http://' . $_SERVER['SCRIPT_NAME']); 
    
    

    
    echo "<script>window.location='./'</script>";

    exit;

           }else{
            $_SESSION['red_message'] = 'IP did not match';


    //header('location: http://' . $_SERVER['SCRIPT_NAME']); 

    echo "<script>window.location='./'</script>";
    exit;
           }


            
          }









?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>OVH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">



  <h2>Enter IPv4 to delete a Server</h2>


  <form action="" method="POST">


    <div class="form-group">
      <label for="ip">IP:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter ip" name="ip" required>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>



  
</div>

</body>
</html>
