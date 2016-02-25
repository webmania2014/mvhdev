<!-- Main content starts -->
		<div class="content">
			

			<!-- Main bar -->
			<div class="mainbar">
				<!-- Page heading -->
				<div class="page-head-block">
					<div class="page-head">
						<h2>Settings</h2>
					</div><!--/ Page heading ends -->
					<!-- Breadcrumb -->
					<div class="bread-crumb">
						<a href="index.html"><i class="fa fa-cog"></i> Settings</a>
						<!-- Divider -->
						<span class="divider">/</span> 
						<a href="#" class="bread-current">User</a>
						<span class="divider">/</span> 
						<a href="#" class="bread-current">Add new user</a>
					</div>
				</div>

				<!-- Matter -->
				<div class="matter">
					<div class="container-fluid">
					   	<div class="row">
						
							<div class="col-md-8">
								
								<div class="widget">
									<div class="widget-head">
										<ul id="myTab" class="nav nav-tabs">
											<li class="active myclass"><a href="#profie" data-toggle="tab" id='profie1'>Profie</a></li>
											<li class="myclass"><a href="#user" data-toggle="tab">User</a></li>
											<li class="myclass"><a href="#language" data-toggle="tab">Language</a></li>
											<li class="myclass"><a href="#subject" data-toggle="tab">Subject areas</a></li>
											<li class="myclass"><a href="#software" data-toggle="tab">Software</a></li>
											<li class="myclass" id='test'><a href="#templates" data-toggle="tab">Templates</a></li>
										</ul>
									</div>
										<!--/ ADD NEW USER start -->
									<div class="widget-content tab-pane fade in active" id="profie">
										<br>
										<form role="form">
											<div class="form-group">
												<label for="exampleInputEmail1">Last name:</label>
												<input type="text" class="form-control" id="last_name" name="last_name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1"> First name:</label>
												<input type="text" class="form-control" id="first_name" name="first_name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Position:</label>
												<input type="text" class="form-control" id="position" name="position">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Email:</label>
												<input type="text" class="form-control" id="email" name="email">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Username:</label>
												<input type="text" class="form-control" id="username" name="username">
											</div>
																			   
											<div class="clearfix"></div>
											
											<div class="form-group col-xs-6 no-left-padd">
												<label for="exampleInputEmail1">Password</label>
												<input type="text" class="form-control" id="password" name="password">
											</div>

											<div class="form-group col-xs-6 no-right-padd">
												<label for="exampleInputEmail1">Reenter password for verification</label>
												<input type="text" class="form-control" id="re_password" name="re_password">
											</div>
											
											<div class="form-group"> 
												<button type="submit" class="btn btn-default">Delete User</button><br><br>
												<button type="submit" class="btn btn-default">Save</button>
												<button type="submit" class="btn btn-default">Cancel</button>
											</div>
										</form>					
									
									</div><!--/ ADD NEW USER end -->
									
											<!--/ Edit profie start -->
									<div class="widget-content tab-pane fade" id="user">
										<form role="form">
											<div class="form-group">
												<label for="exampleInputEmail1">Last name:</label>
												<input type="text" class="form-control" id="last_name" name="last_name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1"> First name:</label>
												<input type="text" class="form-control" id="first_name" name="first_name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Position:</label>
												<input type="text" class="form-control" id="position" name="position">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Email:</label>
												<input type="text" class="form-control" id="email" name="email">
											</div>
								
											<div class="form-group"> 
												<button type="submit" class="btn btn-default">Save</button>
												<button type="submit" class="btn btn-default">Cancel</button>
											</div>
										</form>				
										
									</div><!--/ Edit profie end --> 
									
									<!--/ Edit password start -->
									
									<div class="widget-content tab-pane fade" id="language">
										<br>
										<form role="form">
											<div class="form-group col-xs-6 no-left-padd">
												<label for="exampleInputEmail1">Password</label>
												<input type="text" class="form-control" id="password" name="password">
											</div>

											<div class="form-group col-xs-6 no-right-padd">
												<label for="exampleInputEmail1">Reenter password for verification</label>
												<input type="text" class="form-control" id="re_password" name="re_password">
											</div>
											
											<div class="form-group"> 
												<button type="submit" class="btn btn-default">Save</button>
												<button type="submit" class="btn btn-default">Cancel</button>
											</div>
										</form>	
										
									</div><!--/ Edit password end -->
										
										<!--/ Profi User start -->
									<div class="widget-content tab-pane fade" id="subject">
										<br>
										<form role="form">
											<button type="submit" class="btn btn-default ">Add new user</button>
										</form>
										<br><br>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Name</th>
													<th>Surname</th>
													<th>Username</th>
													<th>Position</th>
													<th></th>
												   
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Name_1</td>
													<td>Surname_1</td>
													<td>Username_1</td>
													<td>Position_1</td>
													<td>Edit_1</td>
												</tr>
												<tr>
													<td>Name_2</td>
													<td>Surname_2</td>
													<td>Username_2</td>
													<td>Position_2</td>
													<td>Edit_2</td>
												</tr>
											</tbody>
										</table>
										<br>
									</div>
									<div class="widget-content tab-pane fade" id="software">
									<br><br>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Software</th>
													<th>Version</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Accros</td>
													<td>6</td>
												</tr>
												<tr>
													<td>trados</td>
													<td>Studio 2014</td>
												</tr>
												<tr>
													<td>Transit</td>
													<td>Next</td>
												</tr>
												<tr>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<br>
										
									</div>
									<div class="widget-content tab-pane fade" id="templates">
																<br>
										<form role="form">
											<button type="submit" class="btn btn-default ">Add templates</button>
										</form>
										<br><br>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Title</th>
													<th>Language Combination</th>
													<th>Subject areas</th>
													<th>Files</th>
													<th></th>
												   
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Template English 1</td>
													<td>DE>EN</td>
													<td>Medical technologie</td>
													<td>Download</td>
													<td>edit</td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<br>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div><!--/ Matter ends -->
			</div><!--/ Mainbar ends -->	    	
			<div class="clearfix"></div>
		</div><!--/ Content ends -->