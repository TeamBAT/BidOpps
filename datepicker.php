
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solicitation</title>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    
  </head>

  <body style="background: #8a8a5c">

    <nav class="navbar navbar-dark bg-primary fixed-top">
      <h3 style="color:#ffff">Bid Opportunities Admin</h3>
      <h3 >behnam</h3>
    </nav>

    <main role="main" class="container">

    <div>

      <div class="row" style="background:#ffff">
       <div class="col pt-1">
       <h2>Solicitation</h2>
       </div>
       <div class="col pt-2" > 
       <button type="button" class="btn btn-success float-right" >Add Solicitation</button>
       </div>
      </div>
    </div>
       
    <div class="row mt-2" style="background:#ffff">
      <ul class="nav nav-tabs mt-2">
      <li class="nav-item">
      <a class="nav-link active" href="#">Active</a>
      </li>
       <li class="nav-item">
       <a class="nav-link" href="#">Link</a>
       </li>
       <li class="nav-item">
       <a class="nav-link" href="#">Link</a>
      </li>
       <li class="nav-item">
       <a class="nav-link" href="#">Link</a>
      </li>
      </ul>
    </div>


    <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        
    </div>
</div>
    
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
  <script>
    $('#datetimepicker1').datetimepicker();
    </script>
</html>
