<?php include "include/htmlParts.php"; ?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php getHeader(); ?>
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
		<?php getMenu(); ?>
    <!-- left side end-->
    
    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<?php  getSupBar(); ?>
			<!--notification menu end -->
			</div>
	<!-- //header-ends -->
			<div id="page-wrapper">
				<div class="graphs">
					<h3 class="blank1">Compose Mail</h3>
					<div class="xs">
						<div class="col-md-4 email-list1">
							<ul class="collection">
								<li class="collection-item avatar email-unread">
								  <i class="fa fa-users icon_1"></i>
								  <div class="avatar_left">
									<span class="email-title">Social</span>
									<p class="truncate grey-text ultra-small">Lorem Ipsum is simply dummy text of.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="new badge1 blue">4</span></a>
								  <div class="clearfix"> </div>
								</li>
								<li class="collection-item avatar email-unread">
								  <i class="fa fa-exclamation-circle icon_2"></i>
								  <div class="avatar_left">
									<span class="email-title">Updates</span>
									<p class="truncate grey-text ultra-small">It is a long established fact that a reader.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="new badge1 red">4</span></a>
								  <div class="clearfix"> </div>
								</li>
								<li class="collection-item avatar email-unread">
								  <i class="fa fa-tag icon_3"></i>
								  <div class="avatar_left">
									<span class="email-title">Promotions</span>
									<p class="truncate grey-text ultra-small">There are many variations of passages.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="new badge1 blue1">4</span></a>
								  <div class="clearfix"> </div>
								</li>
								<li class="collection-item avatar email-unread">
								  <i class="icon_4">G</i>
								  <div class="avatar_left">
									<span class="email-title">Gmail</span>
									<p class="truncate grey-text ultra-small">Sed ut perspiciatis unde omnis iste.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="blue-text ultra-small">2:15 pm</span></a>
								  <div class="clearfix"> </div>
								</li>
								<li class="collection-item avatar email-unread">
								  <i class="icon_4 icon_5">F</i>
								  <div class="avatar_left">
									<span class="email-title">Facebook</span>
									<p class="truncate grey-text ultra-small">But I must explain to you how.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="blue-text ultra-small">2:15 pm</span></a>
								  <div class="clearfix"> </div>
								</li>
								<li class="collection-item avatar email-unread email_last">
								  <i class="icon_4 icon_6">T</i>
								  <div class="avatar_left">
									<span class="email-title">Twitter</span>
									<p class="truncate grey-text ultra-small">At vero eos et accusamus et iusto odio.</p>
								  </div>
								  <a href="#!" class="secondary-content"><span class="blue-text ultra-small">2:15 pm</span></a>
								  <div class="clearfix"> </div>
								</li>
							</ul>
							<div class="content-box  mrg15B">
							  <div class="content-box-wrapper text-center">
								<h4 class="content-box-header">
								Chat
								<small>(Online friends)</small>
								</h4>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/1.png" alt="">
									<div class="small-badge bg-red"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/3.png" alt="">
									<div class="small-badge bg-red"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/4.png" alt="">
									<div class="small-badge bg-green1"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/5.png" alt="">
									<div class="small-badge bg-orange"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/1.png" alt="">
									<div class="small-badge bg-red"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/4.png" alt="">
									<div class="small-badge bg-green1"></div>
								</div>
								<div class="status-badge mrg10A">
									<img class="img-circle" width="40" src="images/3.png" alt="">
									<div class="small-badge bg-orange"></div>
								</div>
							  </div>
							</div>
						</div>
						<div class="col-md-8 inbox_right">
							<div class="Compose-Message">               
								<div class="panel panel-default">
									<div class="panel-heading">
										Compose New Message 
									</div>
									<div class="panel-body panel-body-com-m">
										<div class="alert alert-info">
											Please fill details to send a new message
										</div>
										<form class="com-mail">
											<hr>
												<label>Enter Recipient Name : </label>
												<input type="text" class="form-control1 control3">
												<label>Enter Subject :  </label>
												<input type="text" class="form-control1 control3">
												<label>Enter Message : </label>
												<textarea rows="6" class="form-control1 control2"></textarea>
											<hr>
											<input type="submit" value="Send Message">
										</form>
									</div>
								 </div>
							  </div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a></p>
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>