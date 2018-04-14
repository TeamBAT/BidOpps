
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Solicitation</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
        <!-- Custom styles for this template -->
        <link href="CSS/home.css" rel="stylesheet">

    </head>

    <body style="background: #8a8a5c">
        <?php session_start(); ?>
        <nav class="navbar navbar-dark bg-primary fixed-top">
            <h3 class="navbar-brand">Bid Opportunities Admin</h3>
            <div class="dropdown pr-5">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php echo $_SESSION['SESS_FIRST_NAME'] ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="action/adminLogout.php">Logout</a></li>
                </ul>
            </div>  
        </nav>

        <main role="main" class="container">
            <div class="card">
                <div class="card-header">Create Opportunity</div>
                <div class="card-body">
                    <form class="needs-validation" id="proposeForm" action="action/submitOpportunity.php" method="POST">

                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="id-number">Number <font color="red">(required)</font></label>
                                <input type="text" class="form-control" placeholder="2018-5555" maxlength="9" name="id-number" id="id-number" required>
                            </div>
                            <div class="form-group col-sm-7">
                                <label for="title">Title <font color="red">(required)</font></label>
                                <input type="text" class="form-control" placeholder="Bid Opportunity Solicitation" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-sm-5">

                                <div class="form-group">
                                    <label for="datetimepicker1">Final Filing Date <font color="red">(required)</font></label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type">Opportunity Type <font color="red">(required)</font></label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option>Solicitation</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">Category <font color="red">(required)</font></label>
                                    <select class="form-control" name="category" id="category">
                                        <option>Actuarial Services</option>
                                        <option>Architecture & Engineering</option>
                                        <option>Construction</option>
                                        <option>Consulting</option>
                                        <option>Health</option>
                                        <option>Information Technology</option>
                                        <option>Investments (Non-Manager)</option>
                                        <option>Legal Services - Outside Counsel</option>
                                        <option>Mailing</option>
                                        <option>Miscellaneous</option>
                                        <option>Photography/Video Services</option>
                                        <option>Printing/Reproduction/Graphic Design</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="description">Description <font color="red">(required)</font></label>
                                    <textarea class="input-block-level" name="description" id="summernote" required></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-row" >
                            <button type="button" class="btn btn-primary pl-6" id="saveB">Save</button>
                            <a class="btn btn-danger pl-6" href="home.php" role="button">Cancel</a>   
                        </div>
                    </form>
                </div>
            </div>

        </main><!-- /.container -->

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script>
            $(document).ready(function () {

                //Settings for datetimepicker and summernote editor
                $('#datetimepicker1').datetimepicker({
                    defaultDate: moment().startOf('day').add(15, 'hours')
                });

                $('#summernote').summernote({
                    placeholder: 'Description',
                    tabsize: 2,
                    disableResizeEditor: true,
                    height: 250
                });
            $("#saveB").click(function(e) {
               
            var number= $("#id-number").val();
             // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'id='+ number;
              // AJAX Code To Submit Form.
              $.ajax({ 
                
              type: "POST",
              url: "action/checkSolicitationId.php",
              data: dataString,
              cache: false,
              success: function(result){
                if(result == "OK"){
                    alert("This number already exists");
                }
                else{
                    $("#proposeForm").submit()
               }
               
             
              }
            });
            });
            });
            // JavaScript for disabling form submissions if there are invalid fields
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

        </script>
    </body>


</html>