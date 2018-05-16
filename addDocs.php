
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.3/css/rowReorder.dataTables.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
  </head>

  <body>
       <?php
       if(!isset($_GET['id'])) header("Location: home.php");
        include_once("action/connection.php");
        include_once 'action/checkLogin.php';
        $permissions = check_login($bd);
        if(!($permissions['administrate'] || $permissions['author'])){
            header("Location: home.php");
        }
        else if($permissions['bid']){
            header("Location: showAvailablebids.php");
        }
          $opportunity_id = mysqli_escape_string($bd, $_GET['id']);
          $_SESSION['opportunity_id'] = $opportunity_id;
          $query = "SELECT status FROM opportunities WHERE id = ".$opportunity_id;
          $result = mysqli_query($bd, $query);
          if($result){
            $row = mysqli_fetch_assoc($result);
            $status = $row['status'];
            if($status != 'Drafted'){
              echo "About to go home.";
              header("location: home.php");
            }
          }
          else{
            echo "Could not contact database.";
          }
       ?>
        <nav class="navbar fixed-top" style="background-color:#20a8f7;">
            <a href="home.php" style="text-decoration:none;"><h2 class="navbar-brand" style="font-size:30px;font-family:'Nunito';color:white;"><i class="fa fa-home"></i> Bid Opportunities Admin</h2></a>
         <div class="dropdown pr-5">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <?php echo  $_SESSION['SESS_FIRST_NAME']   ?>
             <span class="caret"></span>
             </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
             <li><a href="action/adminLogout.php">Logout</a></li>
             </ul>
          </div>  
        </nav> <br/>

    <main role="main" class="container">
            
    

      <div class="row border-bottom" style="background-color:#20a8f7;">
         <div class="col pt-1">
           <h2 style="color:white;font-family:'Nunito';color:white;">Documents</h2>
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
                    <input type="file" name="file[]" id="file"  class="form-control" multiple required accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text"><i class="fa fa-upload"></i><span>&nbsp;</span>Upload documents</button>
                    </div>
                </div>
          </form>
          <p>The maximum file size is 10 MB(or 30 MB total for all files uploaded at the same time). Only files with the following extensions are allowed: .doc, .docx, .xls, .xlsx, .ppt, .pptx, and .pdf. </p>
          <table id="example" class="table table-striped table-bordered pt-3" style="width:100%">
        <thead>
            <tr>
                <th>Seq.</th>
                <th>Subheading</th>
                <th>Document Title</th>
                <th>Posted Date</th>
                <th>Id</th>
                <th>File Name</th>
                <th>Order</th>
            </tr>
        </thead>
    </table>
    <small id="tableHelp" class="form-text text-muted">
        Drag and drop files by the Document Title to re-order. Click anywhere else on a file to edit information about it.
    </small>
          <a class="btn btn-primary mb-2 float-right" href="opportunity.php?id=<?=$opportunity_id?>" role="button" id="next">Next  <i class="fas fa-angle-double-right"></i></a>
        </div>
     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <table id="example1" class="table table-striped table-bordered pt-3" style="width:100%">
            <thead>
              <tr>
                <th>Subheading</th>
                <th>Document Title</th>
                <th>Posted Date</th>
                <th>File View</th>
              </tr>
            </thead>
          </table>

     </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <form id="UpdateDocsInfo" action="">
                        <div class="form-group">
                          <label for="fileName">Filename</label>
                          <input type="text" class="form-control" id="fileName" disabled>
                          
                        </div>
                        <div class="form-group required">
                                <label for="subheading" class="control-label">Subheading</label>
                                <select class="form-control" id="subheading">
                                 <option value="1">Solicitation Documents</option>
                                 <option value="2">Addenda</option>
                                 <option value="3">Required</option>
                                 <option value="4">Exhibits</option>
                                </select>
                                
                        </div>
                        <div class="form-group required">
                                    <label for="docTitle" class="control-label">Document Title</label>
                                    <input type="text" class="form-control" id="docTitle" placeholder="Document Title">
                                    
                        </div>
                        <div class="form-group required">
                                <label for="datetimepicker1" class="control-label">Posted Date</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                     <input type="text" name="Pdate" id="PostedDate" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                     <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                         <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                     </div>
                                 </div>
                 
                                </div>
                        <div class="form-group">
                          <input type="hidden" name="priority" id="priority"/>
                        </div>
                       
                      
                        </div>
                        <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveDoc"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary mr-auto " data-dismiss="modal">Cancel</button>
                    
                    <button type="button" class="btn btn-danger" id="DeleteDoc"><i class="fa fa-trash"></i> Delete</button>
                </form>
        </div>
      </div>
    </div>
  </div>
    
    
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js"></script>
    <script>
        
        $(document).ready(function (e) {
            var SelectedRw;
            var updateRw;
            $('#datetimepicker1').datetimepicker({
                defaultDate: moment().startOf('day')
            });
            $('#datetimepicker2').datetimepicker({
                defaultDate: moment().startOf('day')
            });
        var events = $('#events');
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
        var File_Ex_Error = 0;
        while ( i < fl) {
        // localize file var in the loop
        var file = files[i];
        fileExtension=(file.name).split('.').pop();
        if(jQuery.inArray( fileExtension, arr )!=-1)
         {
            alert(file.size);
            alert("correct file EX");
         }
        else{
            File_Ex_Error++;
        }
        formData.append('file[]', file);
        i++;
        } 
        formData.append('id', <?=$opportunity_id?>);
        if(File_Ex_Error==0){   
        $.ajax({
        url: "action/submitDocs.php", // Url to which the request is send
        type: "POST",    
        data: formData, 
        contentType: false,
        cache: false,      
        processData:false, 
        success: function(data)   // A function to be called if request succeeds
           {
           alert(data);
           $("#file").val('');
           $('#example').DataTable().ajax.reload();
           $('#example1').DataTable().ajax.reload();
           }
           });
           }
           else{alert("you chose file with not acceptable extension")}
        }));
        
       var table= $('#example').DataTable( {
            "serverSide": true,
            "paging":   false,
            "select": true,
            "rowReorder": true,
            "order": [[ 6, "asc" ]],
            "ajax": "action/doc_processing.php",
            "columnDefs": [
              {
                "targets": [6,0,4,1],
                "visible": false,
                "searchable": false
              },{
                    "bSortable": false,
                    "aTargets": ["group"]
                }
              ],
              "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if(group == null) group = "No Subheading";
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5"><h5>'+group+'</h5></td></tr>'
                    );

                    last = group;
                }
            } );
        }
       } );
       table.on( 'row-reordered', function ( e, diff, edit ) {
        let result = "Reorder started on: " + edit.triggerRow.data()[0];
        //Allows for reordering tables
         table.reDraw();
            //alert(diff[0].newData);
            //var ien=diff.length;
            //alert(diff[0].oldData);
        });
       var table1= $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "paging":   false,
        "ajax": "action/docView.php",
        "columnDefs": [
            {
                "targets": [ 3 ],
                "date":"directory",
                "render": function(data, type, row, meta){
                    if(type === 'display'){
                    data = '<a href="' + data + '">' + data + '</a>';
                    }
            
                    return data;
                    }
            }
        ]
       });
       $('#example tbody').on( 'click', 'tr', function () {
          
        if ( $(this).hasClass('selected') ) {

            $(this).removeClass('selected');
            //alert(table.row( this ).index());

        }
        else if( !$(this).hasClass('group') ){
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rowData = table.row( this ).data();
            $('#exampleModal').modal('toggle');
            var ta = document.getElementById('fileName');
            $("#subheading select").val(rowData[1]);
            $("#docTitle").val(rowData[2]);
            //$("#PostedDate").val(rowData[2]);
            $("#priority").val(rowData[0]);
            ta.value=rowData[5];
            updateRw=rowData[4];
            SelectedRw=rowData[5];
        }
        
        });
         $("#DeleteDoc").click(function(e) {
           e.preventDefault();
           $.ajax({
              type: "POST",
              url: "action/adminFileDelete.php",
              data: ({ 
              id: SelectedRw
              }),
             success: function(result) {
             alert(result);
             $('#exampleModal').modal('hide');
             $('#example').DataTable().ajax.reload();
             $('#example1').DataTable().ajax.reload();
             },
             error: function(result) {
              alert(result);
              }
            });
          });
          $("#saveDoc").click(function(e) {
             e.preventDefault();
             var id = updateRw;
             var subheading = $( "#subheading option:selected" ).text();
             var docTitle = $("#docTitle").val();
             var Pdate = $("#PostedDate").val();

             // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'id='+ id + '&subheading='+ subheading + '&docTitle='+ docTitle + '&Pdate='+ Pdate;
          
              // AJAX Code To Submit Form.
              $.ajax({ 
                
              type: "POST",
              url: "action/adminFileUpdate.php",
              data: dataString,
              cache: false,
              success: function(result){
              alert(result);
              $('#exampleModal').modal('hide');
              $('#example').DataTable().ajax.reload();
              $('#example1').DataTable().ajax.reload();
              }
            });

          });  
         $("#next").click(function(){
          var priority = [];
          table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
              var key = this.data()[4];
              var value = this.data()[0];
              var subheading= this.data()[1];
              // ... do something with data(), or this.node(), etc
              priority.push({id:key,priority:value,subheading:subheading});
            } );
            var jsonString = JSON.stringify(priority);
            //alert(priority.length)
            //for(i=0;i<priority.length;i++){
              //alert("ID:- "  + priority[i].id + " Priority:- "  + priority[i].priority + " subheading:- "  + priority[i].subheading);
            //};
            $.ajax({
                type: "POST",
                url: "action/updatePriority.php",
                data: {data : jsonString},
                cache: false,
                success: function(result){
                 alert("All files uploaded");
                }
              });
         });
         });
       
    </script>
  </body>
</html>
