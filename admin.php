<?php
session_start();
error_reporting(0);


$con=mysqli_connect("localhost","root","","oas");
 
if($_REQUEST["srchk"]!="")
{
    $id = $_REQUEST["srchk"];
    $ra = mysqli_query($con, "select s_name from t_user_data where s_id = '$id'");
    echo mysqli_fetch_array($ra)[0];
    die();
}



if(!isset($con))
{
    die("Database Not Found");
}

$txtname=$_REQUEST["txtname"];
$txteml=$_REQUEST["txteml"];
$pass=$_REQUEST["pass"];
$txtid=$_REQUEST["txtid"];

$q=mysqli_query($con,"select ad_name from t_admin where ad_id='".$_SESSION['ad']."'");
$n=  mysqli_fetch_assoc($q);
$adname= $n['ad_name'];

if(isset($_REQUEST["admcreate"]))
{
    if($txtid == "")
    $txtid = AdminCode();
    
    $sql  = "insert into t_admin values(";
    $sql .= "'" . $txtid . "',";
    $sql .= "'" . $txtname . "',";
    $sql .= "'" . $pass . "',";
    $sql .= "'" . $txteml . "')";
	
  
    
    
    mysqli_query($con, $sql);
    echo "Your ID is ".$txtid;
     
}
 function AdminCode()
  {
      $con = mysqli_connect("localhost", "root", "", "oas");
      $rs  = mysqli_query($con,"select CONCAT('AD',LPAD(RIGHT(ifnull(max(ad_id),'AD000'),3) + 1,3,'0')) from t_admin");
      return mysqli_fetch_array($rs)[0];
  }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
       <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/admform.css"></link>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
       <!--autosearch--> 
       
       <script type="text/javascript" src="jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.8.2.custom.min.js"></script> 
       <link href="css/css.css" rel="stylesheet" type="text/css" />
        
    <!--search table-->       
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readID.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectid(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
     
       <script>
            
            $(document).ready(function()
{
	$('#searchtb').keyup(function()
	{
		searchTable($(this).val());
	});
});

function searchTable(inputVal)
{
	var table = $('#tblData');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();
				else $(row).hide();
		}
	});
}

            </script>
                    
      <script type="text/javascript"> 

$(function() {

$("#search1").autocomplete({
source: "global_search.php",
minLength: 2,
select: function(event, ui) {
var getUrl = ui.item.id;
if(getUrl != '#') {
    
    var kk = $("#search1").val();
    $.ajax({
        type : "GET",
        cache : false,
        url : "admin.php",
        data : {
            srchk : kk
        },
        success : function(response) {
           // alert(response);
            $("#searhid1").val(response);
        }
    });
    
}
},

html: true, 
//    showname showomr submitmarks

});

});
</script>


<script type="text/javascript"> 

$(function() {

$("#search2").autocomplete({
source: "global_search.php",
minLength: 2,
select: function(event, ui) {
var getUrl = ui.item.id;
if(getUrl != '#') {
    
    var kk = $("#search2").val();
    $.ajax({
        type : "GET",
        cache : false,
        url : "admin.php",
        data : {
            srchk1 : kk
        },
        success : function(response) {
         // alert(response);
          $("#showomr").val(response);
        }
    });
    
}
},

html: true, 
//    showname showomr submitmarks

});

});
</script>

  
    </head>
    <body style="background-image:url(./images/inbg.jpg) ">
<?php  

include 'adminsession.php';

?>
      <form id="admin" action="admin.php" method="post">
            <div class="container-fluid">    
                <div class="row">
                  <div class="col-sm-12">
                        <img src="images/gdcg.jpg" width="100%" style="box-shadow: 0px 5px 5px #999999; "></img>
                  </div>
                 </div>    
             </div>
          
            <div class="container-fluid" id="dmid">    
                <div class="row">
                  <div class="col-sm-12">
                    
                      
                         <font style="color:white; font-family: Verdana;  font-size:20px;">
                <p align="justify"><?php echo "Welcome, $adname   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Administration Cell </b>"?></p> </font>
                  </div>
                 </div>    
             </div>
          
             <div class="container">
                    <ul class="nav nav-tabs" >

                        <li class="active"><a data-toggle="tab" href="#viewapp">View Applications</a></li>
                        <li><a data-toggle="tab" href="#adadmin">Add New Manager</a></li>
                        <li><a  href="adlogout.php">Logout</a></li> 
                      
                        <li>
                                 <input type="text" id="searchtb" name="searchtb" placeholder="Search" class="form-control" 
                           style="margin-top:5px;margin-left:300px;width:300px;">
                        </li>
                    </ul>
                    <div class="tab-content">
                       <div id="viewapp" class="tab-pane fade in active">
                         
                          
                           <?php
	

		$rs1 = mysqli_query($con,"select * from t_user_data");
		
           
                echo '<table class="table table-striped" id="tblData">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>NAME</th>";
                echo "<th>DATE OF BIRTH</th>";
                echo "<th>EMAIL ID</th>";
                echo "<th>CONTACT NO.</th>";
                echo "<th>SIGNUP DATE</th>";
                echo "<tr>";
                echo "</thead>";
                echo "<tbody>";
		while($ar = mysqli_fetch_array($rs1))
                {
               echo "<tr>";
              
                echo "<td><a href='viewform.php?id=".$ar[0]."'>" . $ar[0] . "</a></td>";
                echo "<td>" . $ar[3] . "</td>";
                echo "<td>" . $ar[2] . "</td>";
                echo "<td>" . $ar[4] . "</td>";
                echo "<td>" . $ar[5] . "</td>";
                echo "<td>" . $ar[6] . "</td>"; 	
				 	
        /*      echo "<td> <a href='admin.php?id=".$ar[0]."'>
                     <input type='button' value='Approve' name='Approve' class='toggle btn btn-primary'> </a></td>";
			    echo "<td> <a href='admin.php?id=".$ar[0]."'>
                     <input type='button' value='Reject' name='Reject' class='toggle btn btn-primary'> </a></td>";
			*/
			
	echo"<td>
			 <a href='appr.php?id=".$ar[0]."'> <button class='add_field_button'  style='background-color:transparent;border:none;' 
                   name='appr' id='appr' >
                   <img src='./images/Tick.png' width='20px'></img></button> </a> 
		</td>";
                
    echo "<td>                
										      <button class='add_field_button' style='background-color:transparent;border:none;'                   name='disapp' id='disapp'>
                    <img src='./images/cross.png' width='20px'></img></button> </td>";          
		     echo "</tr>"; 
		  
				}
		      
		
                echo "</tbody>";
                echo "</table>";
	?>

             </div>

                     
                      <div id="adadmin" class="tab-pane fade">
                        <div class="row">
                                <div class="col-sm-12"> 
                                   
                                            <h3>New Manager Details</h3>
                                <input type="text" id="txtname"  name="txtname" class="form-control" style="width:200px;margin-left:32px;" placeholder="Name"><br>
                 <input type="text" id="txteml"  name="txteml" class="form-control" style="width:200px;margin-left:32px;" placeholder="Email ID"><br>
                 <input type="password" id="pass"  name="pass" class="form-control" style="width:200px;margin-left:32px;" placeholder="Password"><br>
                                            <input type="submit" value="Create" name="admcreate" class="toggle btn btn-primary" style="margin-left:102px;"/> <br>
                                            <hr><hr>                          
                                            <h3>Existing  Managers</h3>
                                                
                                             <?php
	
		
		
		$rs2 = mysqli_query($con,"select * from t_admin");
		
           
                echo '<table class="table table-striped">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>NAME</th>";
                echo "<th>EMAIL ID</th>";
				echo "<th>Password</th>";
                
                echo "<tr>";
                echo "</thead>";
                echo "<tbody>";
		while($ar = mysqli_fetch_array($rs2))
		{
                       echo "<tr>";
                        echo "<td>" . $ar[0] . "</td>";
						echo "<td>" . $ar[1] . "</td>";
                        echo "<td>" . $ar[3] . "</td>";
						echo "<td>" . $ar[2] . "</td>";
					
                    echo "</tr>";
		}
                echo "</tbody>";
                echo "</table>";
	?>
                   


                            <input type="hidden" id="txtid"  name="txtid" >
                           <input type="hidden" id="txtpwd" name="txtpwd">

                           
                                </div>
                                </div>    
                            </div>
                        </div>
                  </div>    
             </form>                 
    </body>
</html>
