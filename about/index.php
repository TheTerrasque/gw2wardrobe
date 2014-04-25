<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GuildWars2 Wardrobe</title>
		
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom style -->
		<link href="../css/style.css" rel="stylesheet">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body>
		<?php
			include('../db/config.php');
			include('../includes/header.php');
			include('../includes/data.php');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<div class="affixContainer affixSmall">
						<div id="menu" class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h5>Menu</h5>
								</div>
								
								<ul class="list-group">
									<li class="list-group-item">
										<a href="#welcome">GuildWars2 Wardrobe</a>
									</li>
									<li class="list-group-item">
										<a href="#features">Features</a>
									</li>
									<li class="list-group-item">
										<a href="#author">Author</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-8">
					<div id="welcome">
						<h1>GuildWars2 Wardrobe</h1>
						<p>Welcome to GuildWars2 Wardrobe! This is an online tool that will help you guys figure out how to get your dirty, little hands on all the armor and weapon items this game has to offer. It all started when I asked <a href="http://www.reddit.com/r/Guildwars2/comments/22e0mm/what_kind_of_online_tool_do_you_miss/">Reddit what kind of online tool they would like to see made</a>. The overwhelming 6 upvotes made me appreciate the great community <a href="http://www.reddit.com/r/guildwars2/">/r/GuildWars2</a> is! A friendly user named <a href="http://www.reddit.com/user/Moonfishie">/u/Moonfishie</a> came up with this great suggestion.</p>
						<blockquote>
							<p>When the new wardrobe UI comes out, I'd love to go to a site/app that lets me click a slot in the wardrobe to display info on how that skin is obtained.</p>
							<footer><a href="http://www.reddit.com/user/Moonfishie">/u/Moonfishie</a></footer>
						</blockquote>
						<p>I thought this was a great idea, and quickly started the development. This tool is built on <a href="http://getbootstrap.com/">Twitter Bootstrap</a>, <a href="http://jquery.com/">jQuery</a>, <a href="http://knockoutjs.com/index.html">Knockout JS</a>, <a href="https://github.com/zeroclipboard/zeroclipboard">ZeroClipboard</a>, and <a href="http://wiki.guildwars2.com/wiki/API:Main">GuildWars2's official API</a>.</p>
					</div>
					
					<div id="features">
						<h1>Features</h1>
						<h3>Implemented features <small>Features that are currently live on the site.</small></h3>
						
						<ul>
							<li>
								Wardrobe
								<ul>
									<li>
										View items
										<ul>
											<li>Using GuildWars2's official API, all unique armor and weapon skins are fetched from the API, stored in a local database, and displayed in categories.</li>
										</ul>
									</li>
									<li>Search for items</li>
									<li>
										See details
										<ul>
											<li>When clicking an item, details will be pulled from GuildWars2's official API and displayed.</li>
											<li>If there is a page on the official wiki about the currently selected item, there will a link to that page.</li>
											<li>If the official wiki page of the currently selected item contains either a recipe or information on how to acquire the item, the according information will be pulled and displayed with the rest of the item details.</li>
											<li>Thanks to ArenaNet for giving me the opportunity to steal the code they use to generate the ingame link codes.</li>
											<li>Through just one click, users are able to copy chat codes for the currently displayed item.</li>
										</ul>
									</li>
									<li>
										Tracker
										<ul>
											<li>By clicking "Add to tracker" in the item details, the currently selected item will be added to the tracker.</li>
											<li>The tracker will allow users to store particular items of interest and easily acquire the item details by clicking the item in the tracker.</li>
											<li>If you by any chance are using Internet Explorer 7 or earlier, and refuse to upgrade, you deserve the unhappiness the lack of the tracker will bring you.</li>
											<li>Through just one click, users are able to copy all the chat codes for the items in the tracker.</li>
										</ul>
									</li>
									<li>
										Local Storage
										<ul>
											<li>GuildWars2 Wardrobe uses Local Storage by default, but in <em>Tools > Clear Local Storage</em>, users can force the tool to not use Local Storage.</li>
											<li>All items will be stored in the Local Storage.</li>
											<li>The tracker information is stored in the web browsers localStorage, which is supported by all the major browsers. There is no support for Internet Explorer 7 and earlier.</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						
						<h3>Upcoming features <small>Features I would like to add in the future.</small></h3>
						<ul>
							<li>Various design improvements.</li>
							
							<li>
								Passion for Fashion
								<ul>
									<li>
										A subpage of GuildWars2 Wardrobe that will allow the community to show off their great passion for fashion!
										<ul>
											<li>Name your fashion.</li>
											<li>Upload a picture.</li>
											<li>Select armor pieces from a list.</li>
										</ul>
									</li>
									<li>
										Browse and vote
										<ul>
											<li>Browse Passion for Fashion entries as painless as stalking your crush on Facebook.</li>
											<li>Be able to sort Passion for Fashion by armor weight, votes and more.</li>
											<li>Vote for your favorite fashion designers.</li>
										</ul>
									</li>
								</ul>
							</li>
							
							
						</ul>
					</div>
					
					<div id="author">
						<h1>The author</h1>
						
						<img class="pull-left" src="../img/author.png" />
						
						<p>Let's not be strangers, so allow me to talk a little bit about me. My name is Christian Grimsgaard. I am a 23 year old guy from Norway with a bachelor's degree in Web Development from <a href="www.hig.no">Gjøvik University College</a>. I am currently studying for a master's degree in Interaction Design, but as this study does not involve any development, I crave for fun side projects once in a while. Other than the typical nerdy computer stuff, I love diving and golfing, and I have in many occations proved to be a social guy. I tell terrible jokes, and I'm a huge fan of movies and TV shows. I naturally identify myself with <a href="http://www.imdb.com/name/nm0002071/">Will Ferrell</a>, the most handsome actor of them all.</p>
						<p>If you would like to contact me for some reason, you can either <a href="mailto:mail (at) christiangrimsgaard.net">mail me</a> or whisper me ingame (IGN: nightzirch.3126, main character is Elriwun Awesome).</p>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="affixContainer affixSmall">
						<div id="resources" class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h5>Resources</h5>
								</div>
								
								<ul class="list-group">
									<li class="list-group-item">
										<a href="https://github.com/nightzirch/gw2wardrobe/commits/master">GuildWars2 Wardrobe on GitHub</a>
									</li>
									<li class="list-group-item">
										<a href="http://www.reddit.com/r/Guildwars2/comments/233svc/tool_announcing_gw2wardrobecom/">Reddit: "Announcing gw2wardrobe.com!"</a>
									</li>
									<li class="list-group-item">
										<a href="http://www.reddit.com/r/Guildwars2/comments/22e0mm/what_kind_of_online_tool_do_you_miss/">Reddit: "What kind of online tool do you miss?"</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			include('../includes/modals.php');
			include('../includes/footer.php');
		?>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
		<script src="../js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
		<!-- Knockout JS -->
		<script src="../js/knockout-3.1.0.js"></script>
		<!-- Custom Script -->
		<script src="../js/script.js"></script>
		
		
	</body>
</html>