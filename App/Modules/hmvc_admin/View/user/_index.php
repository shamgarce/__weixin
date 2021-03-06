<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
	  <title>AdminLTE | General UI</title>
	  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	  <!-- bootstrap 3.0.2 -->
	  <link href="http://cdn.bootcss.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	  <!-- font Awesome -->
	  <link href="http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	  <!-- Theme style -->
	  <link href="/assets/LTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	  <![endif]-->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
<?php W('head');?>

<div class="wrapper row-offcanvas row-offcanvas-left">
	  <!-- Left side column. contains the logo and sidebar -->
	  <?php W('left',[]);?>

	  <!-- Right side column. Contains the navbar and content of the page -->
	  <aside class="right-side">
			<!-- Content Header (Page header) -->
			<?php W('right_content_head',[]);?>
			<?php W('right_content_info',[]);?>

			<!--#include virtual = "/box/Usergroupadd" -->


			<!-- ?php view('../box/Usergroupadd',[]);?>

			<!-- Main content -->
			<section class="content">
				  <!-- h2 class="page-header">Alerts and Callouts</h2 -->

				  <!-- END ALERTS AND CALLOUTS -->

				  <div class="row">


						<div class="col-xs-12">
							  <div class="box box-primary">
									<div class="box-header">
										  <h3 class="box-title">RULE管理</h3>
										  <div class="box-tools">
												<div class="input-group">
													  <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
													  <div class="input-group-btn">
															<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
													  </div>
												</div>
										  </div>
									</div><!-- /.box-header -->
									<div class="box-body table-responsive no-padding">
										  <table class="table table-hover">
												<tr>
													  <th width="60">排序</th>
													  <th width="80">RuleId</th>
													  <th width="100">Rule名</th>
													  <th width="80">标识</th>
													  <th>Desciption</th>
													  <th width="300">操作</th>
												</tr>
												<tr>
													  <td><input name="textfield" type="text" id="textfield" size="7" maxlength="7"></td>
													  <td>123</td>
													  <td>管理员组</td>
													  <td>admin</td>
													  <td>对用户组的的管理</td>
													  <td>

															<a class="btn btn-primary" data-target="#compose-modal" data-toggle="modal">编辑</a>
															<i class="fa fa-star-o"></i>
															<span class="label label-success">Active</span>
															<a class="btn btn-primary">权限</a>
															<a class="btn btn-primary">编辑</a>
													  </td>
												</tr>
												<tr>
													  <td>&nbsp;</td>
													  <td>123</td>
													  <td>&nbsp;</td>
													  <td>Jane Doe</td>
													  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
													  <td>&nbsp;</td>
												</tr>
												<tr>
													  <td>&nbsp;</td>
													  <td>123</td>
													  <td>&nbsp;</td>
													  <td>Bob Doe</td>
													  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
													  <td>&nbsp;</td>
												</tr>

												<tr>
													  <td>&nbsp;</td>
													  <td>123</td>
													  <td>&nbsp;</td>
													  <td>Mike Doe</td>
													  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
													  <td>&nbsp;</td>
												</tr>
												<tr>
													  <td><a class="btn btn-primary shamtest">排序</a></td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
												</tr>
										  </table>
									</div><!-- /.box-body -->


							  </div><!-- /.box -->
						</div>
				  </div>

				  <!-- END TYPOGRAPHY -->
			</section><!-- /.content -->

			<!-- 页脚 -->
			<!--#include virtual = "../sp/right_content_footer.shtml" -->
			<?php W('right_content_footer',[]);?>
	  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<!-- jQuery 2.0.2 -->
<script src="http://cdn.bootcss.com/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="http://cdn.bootcss.com/bootstrap/3.0.3/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="/assets/LTE/js/AdminLTE/app.js" type="text/javascript"></script>

<script type="text/javascript">
	  $(document).ready(function(){
			//调用
			$('.shamtest').click(function(){
				  showAjaxModal('/test2.html','ceshiyi2')
			})

	  })
</script>

</body>
</html>