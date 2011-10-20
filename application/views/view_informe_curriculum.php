<?php 
/**
 * Este archivo pertenece a la vista del informe de curriculums.
 **/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/jquery-ui-1.8.16.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/global.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/flexigrid/flexigrid.pack.css')?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url("images/src/favicon.ico")?>" />

<script type="text/javascript">

	
</script>

<script type="text/javascript" src="<?php echo site_url('js/libs/jquery-1.6.2.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/libs/jquery-ui.min-1.8.16.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/libs/json2.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/src/utils.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/src/exportPDF.js')?>"></script>

<script type="text/javascript" src=" <?php echo site_url('js/flexigrid/flexigrid.pack.js')?>"></script>	
<script type="text/javascript" src=" <?php echo site_url('js/src/view_informe_curriculum.js')?>"></script>

<title>FindResources </title>
</head>
<body>

<?php include("toolbar.php"); ?>
	<div class="layout">
		
		<!-- HEADER -->
		<div class="hd">
			
		</div>
		<!-- end HEADER -->
		
		<!-- CONTENT -->
		<div class="content">
			<h1>Informe de curriculums existentes</h1>	
	
			<div class="CL">
				<div class="info clearfix block">

					<div id="curriculumGridContainer" style="float:left">
						<table id="curriculumGrid">	</table>
					</div>

				</div>
			</div>
		</div>
	</div>
<?php include("footer.php"); ?>


</body>
</html>
