<div class="header_bg">
	<div class="container">
		<div class="row header">
			<div class="logo navbar-left">
				<h1><a href="#"><?= $this->Html->image('qmemo.png') ?></a></h1>
			</div>
			<!--div class="h_search navbar-right">
				<form>
					<input type="text" class="text" value="Enter text here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter text here';}">
					<input type="submit" value="search">
				</form>
			</div-->
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row h_menu">
		<nav class="navbar navbar-default navbar-left" role="navigation">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <!--li class="active"><a href="index.html">Home</a></li>
		        <li><a href="technology.html">Technologies</a></li>
		        <li><a href="about.html">About</a></li>
		        <li><a href="blog.html">Blog</a></li>
		        <li><a href="contact.html">Contact</a></li-->
		        <li class="qmenu"><?= $this->Html->link('Home', ['controller' => 'notes', 'action' => 'home'], ['escape' => false]) ?></li>
		        <li class="qmenu"><?= $this->Html->link('Notes', ['controller' => 'notes', 'action' => 'add'], ['escape' => false]) ?></li>
		        <!--li class="qmenu"><?= $this->Html->link('History', ['controller' => 'notes', 'action' => 'index'], ['escape' => false]) ?></li-->
		      </ul>
		    </div><!-- /.navbar-collapse -->
		    <!-- start soc_icons -->
		</nav>
		<div class="soc_icons navbar-right">
			<ul class="list-unstyled text-center">
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
			</ul>	
		</div>
	</div>
</div>