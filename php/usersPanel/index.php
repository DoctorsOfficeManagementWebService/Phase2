<!DOCTYPE html>
<?php $start='http://localhost:8080/api'; ?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Docker Project| Doctor Office Management</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="wrapper">

<img src="css/logo.png" width="150" height="auto" >
<h1 style="color:white;">Docker project: Doctor Office Management</h1>
  <div class="table">
    
    <div class="row header blue">
      <div class="cell">
        row
      </div>
      <div class="cell">
        Tag
      </div>
      <div class="cell">
        Api
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        1
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getdate'; ?>" target="_blank" >Api.php?apicall=getdate</a>
      </div>
    </div>
	
    <div class="row">
      <div class="cell">
        2
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=searchlistdoctors&city=تهران&proficiency=چشم&education=تخصص'; ?>" target="_blank" >Api.php?apicall=searchlistdoctors&city=تهران&proficiency=چشم&education=تخصص</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        3
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getlistdoctors&city=تهران&proficiency=چشم&education=تخصص'; ?>" target="_blank" >Api.php?apicall=getlistdoctors&city=تهران&proficiency=چشم&education=تخصص</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        4
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=visitreserve'; ?>" target="_blank" >Api.php?apicall=visitreserve</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        5
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=searchdoctor&doctor_name=علی&medical_sys_num=12345'; ?>" target="_blank" >Api.php?apicall=searchdoctor&doctor_name=علی&medical_sys_num=12345</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        6
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getdoctor&doctor_name=علی&medical_sys_num=12345'; ?>" target="_blank" >Api.php?apicall=getdoctor&doctor_name=علی&medical_sys_num=12345</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        7
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=addtowishlist'; ?>" target="_blank" >Api.php?apicall=addtowishlist</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        8
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=commenttodoctor'; ?>" target="_blank" >Api.php?apicall=commenttodoctor</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        9
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getcommentsclient&client_code=1003'; ?>" target="_blank" >Api.php?apicall=getcommentsclient&client_code=1003</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        10
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getcommentsclient&client_code=1003'; ?>" target="_blank" >Api.php?apicall=getcommentsclient&client_code=1003</a>
      </div>
    </div>
   
    <div class="row">
      <div class="cell">
        11
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getwishlist&client_code=1003'; ?>" target="_blank" >Api.php?apicall=getwishlist&client_code=1003</a>
      </div>
    </div>    
  
    <div class="row">
      <div class="cell">
        12
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=updateuserinfo'; ?>" target="_blank" >Api.php?apicall=updateuserinfo</a>
      </div>
    </div>  
  
    <div class="row">
      <div class="cell">
        13
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getwishlist&client_code=1003'; ?>" target="_blank" >Api.php?apicall=getwishlist&client_code=1003</a>
      </div>
    </div>  
  
    <div class="row">
      <div class="cell">
        14
      </div>
      <div class="cell">
	  
      </div>
      <div class="cell">
        <a href="<?php echo $start.'/Api.php?apicall=getwishlist&client_code=1003'; ?>" target="_blank" >Api.php?apicall=getwishlist&client_code=1003</a>
      </div>
    </div>  	
	
  </div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  
</body>
</html>
