
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solicitation</title>

    <!-- Bootstrap core CSS -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
  </head>

  <body style="background: #8a8a5c">
       <?php   session_start();    ?>
        <nav class="navbar navbar-dark bg-primary fixed-top">
         <h3 class="navbar-brand">Bid Opportunities Admin</h3>
         <div class="dropdown pr-5">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <?php echo  $_SESSION['SESS_FIRST_NAME']   ?>
             <span class="caret"></span>
             </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
             <li><a href="action/adminLogout.php">Logout</a></li>
             </ul>
          </div>  
        </nav>

    <main role="main" class="container">

    

      <div class="row border-bottom" style="background:#d6d6c2">
         <div class="col pt-1">
           <h2>Documents</h2>
           </div>
         
      </div>
    
       
<div class="row justify-content-center pt-3" style="background:#ffff">
  <ul class="col-sm-10 nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">View</a>
    </li>
  </ul>
</div>

<div class="row justify-content-center pt-4" style="background:#ffff">
 <div class="tab-content col-sm-10" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         <form class="needs-validation" id="uploadimage" action="" enctype="multipart/form-data">  
            <label for="fileUpload">Select one or more files</label>
			        <div class="input-group date" id="fileUpload" data-target-input="nearest">
                    <input type="file" name="file[]" id="file"  class="form-control" multiple required/>
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text"><i class="fa fa-upload"></i><span>&nbsp;</span>Upload documents</button>
                    </div>
                </div>
          </form>
          <p>The maximum file size is 10 MB(or 30 MB total for all files uploaded at the same time). Only files with the following extensions are allowed: .doc, .docx, .xls, .xlsx, .ppt, .pptx, and .pdf. </p>
          <table id="example" class="table table-striped table-bordered pt-3" style="width:100%">
        <thead>
            <tr>
                <th>File Name</th>
                <th>File Type</th>
                <th>File Size</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>File Name</th>
                <th>File Type</th>
                <th>File Size</th>
            </tr>
        </tfoot>
    </table>
        
        </div>
     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute laboris nisi. Labore labore veniam irure irure ipsum pariatur mollit magna in cupidatat dolore magna irure esse tempor ad mollit. Dolore commodo nulla minim amet ipsum officia consectetur amet ullamco voluptate nisi commodo ea sit eu.
     </div>
    </div>
</div>


    
    
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function (e) {
        
        $("#uploadimage").on('submit',(function(e) {
        e.preventDefault();
        $("#message").empty();
        var fileInput = document.querySelector("#file");
        var files = fileInput.files;
        // cache files.length 
        var fl = files.length;
        var i = 0; 
        var arr = [ "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf" ];
        var formData = new FormData();
        while ( i < fl) {
        // localize file var in the loop
        var file = files[i];
        fileExtension=(file.name).split('.').pop();
        if(jQuery.inArray( fileExtension, arr )!=-1)
        {alert("correct file EX")}
        formData.append('file[]', file);
        i++;
        }    
        $.ajax({
        url: "action/submitDocs.php", // Url to which the request is send
        type: "POST",    
        data: formData, 
        contentType: false,
        cache: false,      
        processData:false, 
        success: function(data)   // A function to be called if request succeeds
           {
           $("#message").html(data);
           $("#file").val('');
           $('#example').DataTable().ajax.reload();
           }
           });
        }));

        $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "action/doc_processing.php"
       } );
        })
    </script>
  </body>
</html>
