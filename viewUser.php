<?php

$connect = mysqli_connect("localhost","root","root","bidopps_db");

if(!$connect) {
    
    die('Could not connect: ' . mysql_error());
    
}

$db_selected = mysqli_select_db($connect,"bidopps_db");

$query = "select * from (users JOIN administrators ON users.id = administrators.user_id) order by id asc";

$permissionsQuery = "select * from permissions JOIN administrators ON administrators.user_id = permissions.user_id order by administrators.user_id asc";

$result = mysqli_query($connect,$query);
if(!$result) echo "User query failed: " . mysqli_error($connect);

$resultPermission = mysqli_query($connect,$permissionsQuery);
if(!$resultPermission) echo "Permission query failed: " . mysqli_error($connect);
?>

<html>

    <head>
    
        <title> View Users </title>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"> 
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="jquery.tabledit.js"></script>    
        
        
    </head>
    
    <body>
        
        <nav class="navbar navbar-dark bg-primary">
            <!-- Navbar content -->
            
            
        </nav>
    
    <div class="container-fluid">
    
        <br/> <br/>
        
        <!-- Image and text -->
        
        
        <div class="table-responsive">
    
        <table id="editable_table" class="table table-bordered table-striped">
    
            <thead>
    
                <tr>
                    
                    <th> ID</th>
                    <th> Email </th>
                    <th> Password </th>
                    <th> Join Date </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    
                
                </tr>
    
            </thead>
            
            <tbody>
            
            <?php
            
            while($row = mysqli_fetch_array($result)) {
                
                echo '
                
                <tr>
                
                    <td> '.$row["id"].' </td>
                    <td> '.$row["email"].'  </td> 
                    <td> '.$row["password"].'  </td> 
                    <td> '.$row["join_date"].'  </td>
                    <td> '.$row["firstname"].'  </td> 
                    <td> '.$row["lastname"].'  </td> 
                
                </tr>
                
                ';
                
            }
            
            ?>
                
        </tbody>
    
        </table>  <br>

        <table id="editable_tablePermissions" class="table table-bordered table-striped">
    
            <thead>
    
                <tr>
                    
                    <th> ID</th>
                    <th> Administrate </th>
                    <th> Author </th>
                    <th> Review </th>
                    <th> Approve </th>
                    <th> Screen </th>
                    <th> Evaluate </th>
                    <th> Finalize </th>
                    <th> Bid </th>
                
                </tr>
    
            </thead>
            
            <tbody>
            
            <?php
            
            while($rowp = mysqli_fetch_array($resultPermission)) {
                
                echo '
                
                <tr>
                
                    <td> '.$rowp["user_id"].' </td>
                    <td> '.$rowp["administrate"].'  </td> 
                    <td> '.$rowp["author"].'  </td> 
                    <td> '.$rowp["review"].'  </td>
                    <td> '.$rowp["approve"].'  </td> 
                    <td> '.$rowp["screen"].'  </td> 
                    <td> '.$rowp["evaluate"].'  </td> 
                    <td> '.$rowp["finalize"].'  </td> 
                    <td> '.$rowp["bid"].'  </td> 
                
                </tr>
                
                ';
                
            }
            
            ?>
                
        </tbody>
    
        </table>

            
        </div>
        
    </div>
    
    </body>
    
</html>

<script>  
    
$(document).ready(function(){  
    
     $('#editable_table').DataTable();
    
     $('#editable_tablePermissions').DataTable();
     
    $('#editable_table').Tabledit({
      url:'viewUserDisplay.php',
      columns:{
       identifier:[0, "id"],
       editable:[[1, 'email'],[2,'password'],[3,'join_date'],[4, 'firstname'], [5, 'lastname']]
      },
      restoreButton:false
     });
    
    
     $('#editable_tablePermissions').Tabledit({
      url:'viewUserDisplayPermissions.php',
      columns:{
       identifier:[0, "user_id"],
       editable:[[1, 'administrate'],[2,'author'],[3,'review'],[4, 'approve'], [5, 'screen'],[6, 'evaluate'],[7, 'finalize'],[8, 'bid']]
      },
      restoreButton:false
      
     });
 
});  
    
 </script>

