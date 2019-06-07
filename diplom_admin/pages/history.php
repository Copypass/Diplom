<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once("../config.php");
if(!isset($_SESSION["id"]))
{
	header("Location:../index.php");
}
?>
<html>
    
    <head>
        <title>Forms</title>
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
	var timerId = setTimeout(loadDoc(), 1000);
	function loadDoc() {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {	

		  document.getElementById("history").innerHTML = this.responseText;
		  clearTimeout(timerId);
		  timerId = setTimeout(function(){ loadDoc()}, 1000);
		}
	  };
	  xhttp.open("GET", "history_update.php", true);
	  xhttp.read();
	}
	</script>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Панель управления СКУД</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo $_SESSION["login"]; ?><i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="../index.php?act=exit">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <a href="index.html"><i class="icon-chevron-right"></i> Главная</a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="icon-chevron-right"></i> Настройка системы</a>
                        </li>
                        <li>
                            <a href="stats.html"><i class="icon-chevron-right"></i>История</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="icon-chevron-right"></i>Настройка прав</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="icon-chevron-right"></i>Доступ к панели</a>
                        </li>
                    </ul>
                </div>
                <!--/span-->
                <div class="span9" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Главная страница</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal">
                                      <fieldset>
                                        <legend>История доступа</legend>
										<div class="row-fluid">
											<!-- block -->
											<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left">Form Example</div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<form class="form-horizontal">
														  <fieldset>
															<legend>Form Components</legend>
															<div class="control-group">
															  <label class="control-label" for="typeahead">Text input </label>
															  <div class="controls">
																<input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
																<p class="help-block">Start typing to activate auto complete!</p>
															  </div>
															</div>
															<div class="control-group">
															  <label class="control-label" for="date01">Date input</label>
															  <div class="controls">
																<input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
																<p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
															  </div>
															</div>
															<div class="control-group">
															  <label class="control-label" for="optionsCheckbox">Checkbox</label>
															  <div class="controls">
																<label class="uniform">
																  <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
																  Option one is this and that&mdash;be sure to include why it's great
																</label>
															  </div>
															</div>
															<div class="control-group">
															  <label class="control-label" for="select01">Select list</label>
															  <div class="controls">
																<select id="select01" class="chzn-select">
																  <option>something</option>
																  <option>2</option>
																  <option>3</option>
																  <option>4</option>
																  <option>5</option>
																</select>
															  </div>
															</div>
															<div class="control-group">
															  <label class="control-label" for="multiSelect">Multicon-select</label>
															  <div class="controls">
																<select multiple="multiple" id="multiSelect" class="chzn-select span4">
																  <option>Alabama</option><option>Alaska</option><option>Arizona</option><option>Arkansas</option><option>California</option><option>Colorado</option><option>Connecticut</option><option>Delaware</option><option>District Of Columbia</option><option>Florida</option><option>Georgia</option><option>Hawaii</option><option>Idaho</option><option>Illinois</option><option>Indiana</option><option>Iowa</option><option>Kansas</option><option>Kentucky</option><option>Louisiana</option><option>Maine</option><option>Maryland</option><option>Massachusetts</option><option>Michigan</option><option>Minnesota</option><option>Mississippi</option><option>Missouri</option><option>Montana</option><option>Nebraska</option><option>Nevada</option><option>New Hampshire</option><option>New Jersey</option><option>New Mexico</option><option>New York</option><option>North Carolina</option><option>North Dakota</option><option>Ohio</option><option>Oklahoma</option><option>Oregon</option><option>Pennsylvania</option><option>Rhode Island</option><option>South Carolina</option><option>South Dakota</option><option>Tennessee</option><option>Texas</option><option>Utah</option><option>Vermont</option><option>Virginia</option><option>Washington</option><option>West Virginia</option><option>Wisconsin</option><option>Wyoming</option>
																</select>
																<p class="help-block">Start typing to activate auto complete!</p>
															  </div>

															</div>
															<div class="control-group">
															  <label class="control-label" for="fileInput">File input</label>
															  <div class="controls">
																<input class="input-file uniform_on" id="fileInput" type="file">
															  </div>
															</div>
															<div class="control-group">
															  <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
															  <div class="controls">
																<textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
															  </div>
															</div>
															<div class="form-actions">
															  <button type="submit" class="btn btn-primary">Save changes</button>
															  <button type="reset" class="btn">Cancel</button>
															</div>
														  </fieldset>
														</form>

													</div>
												</div>
											</div>
											<!-- /block -->
										</div>
                                      </fieldset>
                                    </form>
								</div>
                            </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; copypasta</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <link href="../vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="../vendors/jquery-1.9.1.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendors/jquery.uniform.min.js"></script>
        <script src="../vendors/chosen.jquery.min.js"></script>
        <script src="../vendors/bootstrap-datepicker.js"></script>

        <script src="../vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="../vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="../vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="../vendorsassets/form-validation.js"></script>
        
	<script src="../vendorsassets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>