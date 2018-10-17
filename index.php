<?php session_start();?>
<?php
/**
 * # Instantiate. Visit https://api.ovh.com/createToken/index.cgi?GET=/me
 * to get your credentials
 */
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;


// Informations about your application


require __DIR__ . '/config.php';

// Information about your web hosting

// Get servers list
$ovh = new Api($applicationKey, $applicationSecret, $endpoint, $consumer_key);

// $result = $ovh->get('/cloud/project');

// print_r( $result );

// echo "<pre>";

// $result = $ovh->get('/me');

// print_r( $result );

// echo "<pre>";

// $result = $ovh->get('/cloud/project/329b4bd933e64386a25905515381c069');

// print_r( $result );

 // echo "<pre>";
$result = $ovh->get('/cloud/project/329b4bd933e64386a25905515381c069/instance', array(
    'region' => NULL, // Instance region (type: string)
));
// print_r( $result );
// exit;
// echo "<pre>";

// $result = $ovh->get('/cloud/project/329b4bd933e64386a25905515381c069/acl');

// print_r( $result );
?>
<?php
/**
 * First, download the latest release of PHP wrapper on github
 * And include this script into the folder with extracted files
 */
// require __DIR__ . '/vendor/autoload.php';
// use \Ovh\Api;

// /**
//  * Instanciate an OVH Client.
//  * You can generate new credentials with full access to your account on
//  * the token creation page
//  */
// $ovh = new Api( 'ZUuUHjHEJ1x7bsgR',  // Application Key
//                 '2hbjIj5FvL1nq6kowXVTCutALfI0kKn8',  // Application Secret
//                 'ovh-ca',      // Endpoint of API OVH Europe (List of available endpoints)
//                 'z5WQWEXlbZNz9zc01nQZgcb42DZuB3Hf'); // Consumer Key

// $result = $ovh->get('/cloud/createProjectInfo');

// echo "<pre>";

// print_r( $result );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>OVH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

  <style type="text/css">

  @media only screen and (max-width: 400px) {
   
    .pull-right {
    float: none!important;
}
}

  </style>

</head>
<body>

<div class="container">

<?php 

  if(isset($_SESSION['message'])){ ?>
  <div class="alert alert-success" role="alert">

<center> <strong><?php echo $_SESSION['message']; ?></strong> </center>
 </div>

  <?php session_destroy(); }

 ?>  

<?php 

  $output = '';

  if(isset($_SESSION['red_message'])){ ?>
  <div class="alert alert-danger" role="alert">

<center> <strong><?php echo $_SESSION['red_message']; ?></strong> </center>
 </div>

  <?php session_destroy(); }

 ?>
 
    
<div class="pull-left"> <h2>OVH</h2>

    <p>Servers:(<a href="new.php">Add a Server</a>)</p> 
    
    <p><a href="delete.php">Click Here</a> to Delete Server</p>
    
    </div>

  <center><div class="pull-right">
   <a href="ip.txt" class="btn btn-info" role="button" style="    margin-top: 30px;
    " download>Export all IPs to TXT File</a>
  </div></center>
  
</div><br>


	<div class="container">
	   <table class="table table-bordered" id="myTable">
	      <thead>

	         <tr>
	            <th>Name</th>
	            <th>Region</th>
	            <th>IPv4</th>
	            <!--<th>IPv6</th>-->
	         </tr>



	     

	       

	      </thead>
	      <tbody>
        <?php  

$output = '';

    for($i=0;$i<count($result);$i++){ ?>

     <tr>

            <td><?php echo $result[$i]['name']; ?></td>
            <td><?php echo $result[$i]['region']; ?></td>
            <td><?php echo $result[$i]['ipAddresses'][0]['ip'];

            $output.=$result[$i]['ipAddresses'][0]['ip']." \n";

             ?></td>
          <!--  <td><?php //echo $result[$i]['ipAddresses'][1]['ip']; ?></td> -->
       
          </tr>







<?php }


 ?>
	      </tbody>
	   </table>
	</div>
<?php 

  $myfile = fopen("ip.txt", "w")  ;


fwrite($myfile, $output);
fclose($myfile);


 ?>


 <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

  <script type="text/javascript">



    $(document).ready( function () {
    
   $('#myTable').dataTable( {
  "pageLength": 100,
  dom: 'Blfrtip',
        buttons: [
             
            {
                extend: 'csv',
                text: 'Export Filtered IPs to CSV File',
                exportOptions: {
                    columns: [ 2 ]
                }
            }
        ]
} );




} );

 





    </script>

</body>
</html>