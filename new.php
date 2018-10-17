<?php session_start();?>

<?php
/**
 * First, download the latest release of PHP wrapper on github
 * And include this script into the folder with extracted files
 */


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
$ovh = new Api($applicationKey, $applicationSecret, $endpoint, $consumer_key); // Consumer Key
/*
$result = $ovh->post('/cloud/project/329b4bd933e64386a25905515381c069/instance', array(
    'flavorId' => '85d24d30-a0c4-4632-8f0f-1091e225bc0b', // Instance flavor id (type: string)
    'groupId' => NULL, // Start instance in group (type: string)
    'imageId' => '1107bbc2-51da-443e-bf99-baaefaa06302', // Instance image id (type: string)
    'monthlyBilling' => false, // Active monthly billing (type: boolean)
    'name' => 'my-test', // Instance name (type: string)
    'networks' => NULL, // Create network interfaces (type: cloud.instance.NetworkParams[])
    'region' => 'BHS1', // Instance region (type: string)
    'sshKeyId' => NULL, // SSH keypair id (type: string)
    'userData' => NULL, // Configuration information or scripts to use upon launch (type: text)
    'volumeId' => NULL, // Specify a volume id to boot from it (type: string)
));

print_r( $result );*/
?>

<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {
         
  $name =  trim($_POST['name']);
  $image_id =  trim($_POST['image_id']);
  $region =  trim($_POST['region']);
  $instance =  trim($_POST['instance']);
  $number =  trim($_POST['number']);

for($m=1;$m<=$number;$m++){

   


     if($number>1){



                    $result = $ovh->post('/cloud/project/329b4bd933e64386a25905515381c069/instance', array(
    'flavorId' => $instance, // Instance flavor id (type: string)
    'groupId' => NULL, // Start instance in group (type: string)
    'imageId' => $image_id, // Instance image id (type: string)
    'monthlyBilling' => false, // Active monthly billing (type: boolean)
    'name' => $name.$m, // Instance name (type: string)
    'networks' => NULL, // Create network interfaces (type: cloud.instance.NetworkParams[])
    'region' => $region, // Instance region (type: string)
    'sshKeyId' => NULL, // SSH keypair id (type: string)
    'userData' => NULL, // Configuration information or scripts to use upon launch (type: text)
    'volumeId' => NULL, // Specify a volume id to boot from it (type: string)
));



              }else{
                

                 $result = $ovh->post('/cloud/project/329b4bd933e64386a25905515381c069/instance', array(
    'flavorId' => $instance, // Instance flavor id (type: string)
    'groupId' => NULL, // Start instance in group (type: string)
    'imageId' => $image_id, // Instance image id (type: string)
    'monthlyBilling' => false, // Active monthly billing (type: boolean)
    'name' => $name, // Instance name (type: string)
    'networks' => NULL, // Create network interfaces (type: cloud.instance.NetworkParams[])
    'region' => $region, // Instance region (type: string)
    'sshKeyId' => NULL, // SSH keypair id (type: string)
    'userData' => NULL, // Configuration information or scripts to use upon launch (type: text)
    'volumeId' => NULL, // Specify a volume id to boot from it (type: string)
));

              }

    // print_r( $result );

}

 $_SESSION['message'] = 'Server Created Successfully';

 sleep(3);
 

            echo "<script>window.location='./'</script>"; 

            exit;




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
  <h2>Create New Server</h2>
  <form action="" method="POST">


    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
    </div>

    <div class="form-group">
      <label for="image">Image:</label>
       <select class="form-control" name="image" id="image" onchange="myImage()">

        <option value="ubuntu">Ubuntu 14.04</option>
     <!--   <option value="65cd6aae-dd3d-4fc7-827c-828739904caa">Ubuntu 14.04 E</option> -->
        <option value="snapshot">vps-ssd-1-bhs1 26/08/2018 18:25(Snapshot)</option>
        
      </select>
    </div>

  <div class="form-group">
      <label for="memory">Region:</label>
      <div id="island_on_image">
       <select class="form-control" id="region_id" name="region" onchange="myFunction()">

       

        <option value="BHS1">Beauharnois</option>
        <option value="DE1">Frankfurt</option>
        <option value="GRA1">Gravelines</option>
        <option value="SBG1">Strasbourg</option>
        <option value="UK1">London</option>
        <option value="WAW1">Warsaw</option>

        
        
      </select>
      </div>
    </div> 

    <div class="form-group">
      <label for="instance">Instance:</label>

      <div id="island">
        <select class="form-control" name="instance"> <option value="ef07a1d1-b947-421f-8144-3eba08672cc9">s1-2-bhs1</option> <option value="550757b3-36c2-4027-b6fe-d70f45304b9c">vps-ssd-1-bhs1</option>  </select>
      </div>
       
    </div>
    
     <div class="form-group">
      <label for="name">Put the Number of servers u want to create:</label>
      <input type="number" class="form-control" id="name" placeholder="Enter the number" name="number" required min="1" value="1" max="200">
    </div>

    <div id="inputhidden">
      <input type="hidden"  name="image_id" value="65cd6aae-dd3d-4fc7-827c-828739904caa">
    </div>

   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


<script type="text/javascript">


function myImage() {
    var y = document.getElementById("image").value;

      if(y=='snapshot'){

          document.getElementById("island_on_image").innerHTML = '<select class="form-control" id="region_id" name="region" onchange="myFunction()"> <option value="BHS1">Beauharnois</option> </select>';

          document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="ef07a1d1-b947-421f-8144-3eba08672cc9">s1-2-snapshot</option> <option value="550757b3-36c2-4027-b6fe-d70f45304b9c">vps-ssd-1-snapshot</option> </select>';

          document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="62633a23-0134-4395-aa9f-d7211a663c39">';


      }else{

        document.getElementById("island_on_image").innerHTML = '<select class="form-control" id="region_id" name="region" onchange="myFunction()"> <option value="BHS1">Beauharnois</option> <option value="DE1">Frankfurt</option> <option value="GRA1">Gravelines</option> <option value="SBG1">Strasbourg</option> <option value="UK1">London</option> <option value="WAW1">Warsaw</option> </select>';

         document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="ef07a1d1-b947-421f-8144-3eba08672cc9">s1-2-bhs1</option> <option value="550757b3-36c2-4027-b6fe-d70f45304b9c">vps-ssd-1-bhs1</option>  </select>';

          document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="65cd6aae-dd3d-4fc7-827c-828739904caa">';

      }

    }
  
  function myFunction() {
    var x = document.getElementById("region_id").value;

    //alert(x);

    if(x=='BHS1'){
        document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="ef07a1d1-b947-421f-8144-3eba08672cc9">s1-2-bhs1</option> <option value="550757b3-36c2-4027-b6fe-d70f45304b9c">vps-ssd-1-bhs1</option>  </select>';

        document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="65cd6aae-dd3d-4fc7-827c-828739904caa">';

    }

    if(x=='DE1'){
        document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="d31419c1-8e1e-48c2-8a4c-28190650c817">s1-2-de1</option>  </select>';

         document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="c6284a63-1278-46cb-835d-1132f1aa20e9">';

    }

    if(x=='GRA1'){
        document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="98c1e679-5f2c-4069-b4da-4a4f7179b758">vps-ssd-1-gra1</option> </select>';

        document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="08ea691a-b07f-4934-879c-eca516304da5">';

    }

    if(x=='SBG1'){
        document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="8400fde0-10ff-45f3-a703-8760f298c83c">s1-2-sbg1</option> <option value="164fcc7e-7771-414f-a607-b388cb7b7aa0">vps-ssd-1-sbg1</option>  </select>';

        document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="5d106256-483a-449e-8240-27fc253b13e7">';

    }

    if(x=='UK1'){
        document.getElementById("island").innerHTML = ' <select class="form-control" name="instance"> <option value="e9d6fb38-9bf0-44ac-adbf-30fee3c96096">s1-2-uk1</option> </select>';

        document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="69246bf9-ef3a-466b-bd9b-921673ec2829">';

    }

    if(x=='WAW1'){
        document.getElementById("island").innerHTML = '<select class="form-control" name="instance"> <option value="3cf2bf37-4e49-411a-93c1-8908ff3e05f0">s1-2-waw1</option>  </select>';

        document.getElementById("inputhidden").innerHTML = '<input type="hidden"  name="image_id" value="1107bbc2-51da-443e-bf99-baaefaa06302">';

    }


  }

</script>

</body>
</html>
