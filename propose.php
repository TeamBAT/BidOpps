<?php
    include_once 'action/connection.php';
    
    if(isset($_GET['id'])){
        $editMode = true;
        $opportunity_id = mysqli_real_escape_string($bd, $_GET['id']);
        
        $query = "SELECT * FROM opportunities WHERE id=".$opportunity_id;
        
        $result = mysqli_query($bd, $query);
        if($result){
            $opportunity = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if($opportunity['status'] != 'Drafted') header("Location: /home.php");
        }else{ 
            header("Location: /home.php");
        }
    }
    else {
        $editMode = false;
    }
?>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.3.3/cleave.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
        <!-- Custom styles for this template -->
        <link href="CSS/home.css" rel="stylesheet">

    </head>

    <body style="background: #8a8a5c">
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
                    <form class="container" novalidate action="action/submitOpportunity.php" method="POST" id="submitForm">

                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="id-number">Number <font color="red">(required)</font></label>
                                <input type="text" class="form-control id-number" <?php if($editMode):?>value="<?=$opportunity['number']?>"<?php else:?> placeholder="2018-5555"<?php endif;?> maxlength="9" name="id-number" id="id-number" required>
                            </div>
                            <div class="form-group col-sm-7">
                                <label for="title">Title <font color="red">(required)</font></label>
                                <input type="text" class="form-control" <?php if($editMode):?>value="<?=$opportunity['title']; endif;?>" placeholder="Bid Opportunity Solicitation" name="title" id="title" required>
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
                                    <select class="form-control" name="category" id="category" required>
                                        <option disabled selected value> -- Select an Option -- </option>
                                        <option <?=($opportunity['category'] == "Actuarial Services")? "selected" : ""?>>Actuarial Services</option>
                                        <option <?=($opportunity['category'] == "Architecture & Engineering")? "selected" : ""?>>Architecture & Engineering</option>
                                        <option <?=($opportunity['category'] == "Construction")? "selected" : ""?>>Construction</option>
                                        <option <?=($opportunity['category'] == "Consulting")? "selected" : ""?>>Consulting</option>
                                        <option <?=($opportunity['category'] == "Health")? "selected" : ""?>>Health</option>
                                        <option <?=($opportunity['category'] == "Information Technology")? "selected" : ""?>>Information Technology</option>
                                        <option <?=($opportunity['category'] == "Investments (Non-Manager)")? "selected" : ""?>>Investments (Non-Manager)</option>
                                        <option <?=($opportunity['category'] == "Legal Services - Outside Counsel")? "selected" : ""?>>Legal Services - Outside Counsel</option>
                                        <option <?=($opportunity['category'] == "Mailing")? "selected" : ""?>>Mailing</option>
                                        <option <?=($opportunity['category'] == "Miscellaneous")? "selected" : ""?>>Miscellaneous</option>
                                        <option <?=($opportunity['category'] == "Photography/Video Services")? "selected" : ""?>>Photography/Video Services</option>
                                        <option <?=($opportunity['category'] == "Printing/Reproduction/Graphic Design")? "selected" : ""?>>Printing/Reproduction/Graphic Design</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="description">Description <font color="red">(required)</font></label>
                                    <div class="invalid-feedback">
                                        Please enter a description.
                                    </div>
                                    <textarea class="input-block-level" name="description" id="summernote" required><?=($editMode)? $opportunity['description'] : ""?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-row" >
                            <a class="btn btn-danger pl-6" href="home.php" role="button"><i class="fas fa-ban"></i> Cancel</a>
                            <button type="submit" id="toDocs" class="btn btn-primary pl-6"><i class="far fa-save"></i> Save and Continue</button>
                            <button type="submit" id="toPreview" class="btn btn-success pl-6"><i class="fas fa-eye"></i> Save and Preview</button>
                        </div>
                    </form>
                </div>
            </div>

        </main><!-- /.container -->

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script>
            $(document).ready(function () {
                //Settings for page initialization
                <?php if($editMode):?>
                    var date = <?= json_encode($opportunity['final_filing_date'])?>;
                    $('#datetimepicker1').datetimepicker({
                        defaultDate: date
                    });
                <?php else: ?>
                    $('#datetimepicker1').datetimepicker({
                        defaultDate: moment().startOf('day').add(15, 'hours')
                    });
                <?php endif;?>

                $('#summernote').summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ],
                    placeholder: 'Description',
                    tabsize: 2,
                    disableResizeEditor: true,
                    height: 250
                });
                
                var cleave = new Cleave('.id-number', {
                    delimiter: '-',
                    blocks: [4, 4],
                    numericOnly: true
                });
                
                //JavaScript for disabling form submissions if there are invalid fields
                $("#toDocs").click(function(event) {
                    event.preventDefault();

                    // Fetch form to apply custom Bootstrap validation
                    var form = $("#submitForm");

                    if (form[0].checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }else{
                        var url = form.attr('action');
                        var data = form.serialize() + "&edit=" + <?=json_encode($editMode);?> + "<?php if($editMode): echo "&id=".$opportunity_id; else: echo "''"; endif;?>";
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: url,
                            data: data,
                            success: function(response){
                                alert(response[0].message);
                                if(!response[0].error){
                                    window.location = "/addDocs.php?id="+response[0].id;
                                }
                            }
                        });
                    }
                    form.addClass('was-validated');
                });
                
                $("#toPreview").click(function(event) {
                    event.preventDefault();
                    // Fetch form to apply custom Bootstrap validation
                    var form = $("#submitForm");

                    if (form[0].checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }else{
                        var url = form.attr('action');
                        var data = form.serialize() + "&edit=" + "<?=json_encode($editMode);?>" + "<?php if($editMode): echo "&id=".$opportunity_id; else: echo "''"; endif;?>";
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: url,
                            data: data,
                            success: function(response){
                                alert(response[0].message);
                                if(!response[0].error){
                                    window.location = "/opportunity.php?id="+response[0].id;
                                }
                            }
                        });
                    }
                    form.addClass('was-validated');
                });
                
            });
           
        </script>
    </body>

</html>
