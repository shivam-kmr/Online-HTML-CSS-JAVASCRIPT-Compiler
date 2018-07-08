<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Welcome <?php echo $row['userName']; ?>- LinkedWith</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><?php echo $row['userName']; ?>'s Home</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userEmail']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="http://www.linkedwith.ml">Linked With</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tutorials <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="https://www.w3schools.com/html/">HTML</a></li>
                                    <li><a href="https://www.w3schools.com/css/">CSS</a></li>
                                    <li><a href="https://www.w3schools.com/js/default.asp">JavaScript</a></li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="http://www.linkedwith.ml/blogs">Blogs!</a>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
<style>
	body{
		margin: 0;padding: 0;width: 100%;height: 100%;
	}
	#container{
		height: 100%;width:auto; white-space: nowrap;overflow: hidden;position: relative;
	}
	#htmleditor{
		height: 100%;min-height: 50vh;width:33%;display: inline-block;
	}
	#csseditor{
		height: 100%;min-height: 50vh;width:33%;display: inline-block;
	}
	#jseditor{
		height: 100%;min-height: 50vh;width:33%;display: inline-block;
	}
	#htmltext{
		width:33%;display: inline-block;text-align: center;background-color:white;
	}
	#result{
                background-color:white;
		position: absolute;
		bottom: 0;
		width: 100%;
		height: 40%;
                
	}

</style>
<body><br><br>
<div id="container">
	<div id="htmltext">HTML</div>
	<div id="htmltext">CSS</div>
	<div id="htmltext">JavaScript&emsp;&emsp;&emsp;<a href="help.html">Help?</a></div>
</div>	

<div id="container">
	<div id="htmleditor"></div>
	<div id="csseditor"></div>
	<div id="jseditor"></div>
</div>
<iframe id="result" frameborder="10"></iframe>
<!--Jquery script code-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- ACE editor cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
	function update(){
		var res = document.getElementById('result').contentWindow.document;
		res.open();
		res.write(eh.getValue());
		res.write('<style>'+ec.getValue()+'</style>');
		res.write('<body>' +ej.getValue() + '</body>');
		res.close;
	}
	function seteditor(){
		//for the html editor
		window.eh = ace.edit("htmleditor");
		eh.setTheme("ace/theme/clouds_midnight");//selecting monokoi theme
		eh.session.setMode("ace/mode/html");

		//for the css editor
		window.ec = ace.edit("csseditor");
		ec.setTheme("ace/theme/clouds_midnight");//selecting monokoi theme
		ec.session.setMode("ace/mode/css");


		// for the js editor
		window.ej = ace.edit("jseditor");
		ej.setTheme("ace/theme/clouds_midnight");//selecting monokoi theme
		ej.session.setMode("ace/mode/js");




		eh.getSession().on('change',function(){update();});
		ec.getSession().on('change',function(){update();});
		ej.getSession().on('change',function(){update();});
	}
	seteditor();
	update();

</script>
        
        
        
        
    </body>

</html>