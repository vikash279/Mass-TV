<!DOCTYPE html>
<!-- 
Template Name: Movie Pro
Version: 1.0.0
Author: Webstrot

--><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
   <html lang="zxx">
    <!--[endif]-->
    <head>
        <meta charset="utf-8">
        <title>Mass TV</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="Mass TV">
        <meta name="keywords" content="Mass TV">
        <meta name="author" content="">
        <meta name="MobileOptimized" content="320">
        <!--Template style -->
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-animate.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-bootstrap.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-font-awesome.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-fonts.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-flaticon.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-owl.carousel.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-owl.theme.default.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-dl-menu.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-nice-select.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-magnific-popup.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-venobox.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/rs_slider-layers.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/rs_slider-navigation.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/rs_slider-settings.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-style.css')!!}">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/assets/website/css/css-responsive.css')!!}">
        <link rel="stylesheet" id="theme-color" type="text/css" href="{!!asset('public/assets/website/css/html-#')!!}">
        <!-- favicon links -->
        <link rel="shortcut icon" type="image/png" href="{!!asset('public/assets/image/logo111.jpeg')!!}">
        <script src="{!!asset('public/assets/website/js/2541848--google_analytics_auto.js')!!}"></script></head><body>
	<!-- preloader Start -->
	<div id="preloader">
		<div id="status">
			<img src="{!!asset('public/assets/website/images/Comp-2.gif')!!}" id="preloader_image" alt="loader"></div>
	</div>
	<!-- color picker start -->
	<!--<div id="style-switcher">-->
	<!--  <div>-->
	<!--	<h3>Choose Color</h3>-->
	<!--	<ul class="colors"><li>-->
	<!--		<p class="colorchange" id="color"></p>-->
	<!--	  </li>-->
	<!--	  <li>-->
	<!--		<p class="colorchange" id="color2"></p>-->
	<!--	  </li>-->
	<!--	  <li>-->
	<!--		<p class="colorchange" id="color3"></p>-->
	<!--	  </li>-->
	<!--	  <li>-->
	<!--		<p class="colorchange" id="color4"></p>-->
	<!--	  </li>-->
	<!--	  <li>-->
	<!--		<p class="colorchange" id="color5"></p>-->
	<!--	  </li>-->
	<!--	  <li>-->
	<!--		<p class="colorchange" id="style"></p>-->
	<!--	  </li>-->
	<!--	</ul></div>-->
	<!--  <div class="bottom"> <a href="html.html" class="settings"><i class="fa fa-gear"></i></a> </div>-->
	<!--</div>-->
	<!-- color picker end --> 
	<!-- prs navigation Start -->
	<div class="prs_navigation_main_wrapper">
		<div class="container-fluid">
			<div id="search_open" class="gc_search_box">
				<input type="text" placeholder="Search here"><button><i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</div>
			<div class="prs_navi_left_main_wrapper">
				<div class="prs_logo_main_wrapper">
					<a href="{{ url('index')}}">
						<img src="{!!asset('public/assets/image/logo111.jpeg')!!}" alt="logo" height="80px" width="100px"></a>
				</div>
				<div class="prs_menu_main_wrapper">
					<nav class="navbar navbar-default"><div id="dl-menu" class="xv-menuwrapper responsive-menu">
							<button class="dl-trigger">
								<img src="{!!asset('public/assets/website/images/header-bars.png')!!}" alt="bar_png"></button>
							<div class="prs_mobail_searchbar_wrapper" id="search_button">	<i class="fa fa-search"></i>
							</div>
							<div class="clearfix"></div>
							<ul class="dl-menu">
							    <li class="parent"><a href="{{ url('index')}}">Home</a>
									<!--<ul class="lg-submenu"><li><a href="#">Index-I</a></li>-->
									<!--	<li><a href="#">Index-II</a></li>-->
									<!--	<li><a href="#">Index-III</a></li>-->
									<!--	<li><a href="#">Index-IV</a></li>-->
									<!--</ul>-->
								</li>
								<li class="parent megamenu"><a href="#">Upcoming Series</a>
									<ul class="lg-submenu">
									    <li><a href="html.html">Upcoming Series</a>
											<ul class="lg-submenu"><li class="ar_left"><i class="fa fa-film"></i><a href="#">Bajiro Mastani</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Drishyam</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Queen</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Wanted</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Veer</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Jannat</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Baaghi</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Baaghi-2</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Ki &amp; Ka</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Kahaani</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Jab We Met</a>
												</li>
											</ul>
										</li>
										<li><a href="html.html">Popular Kannada Movies</a>
											<ul class="lg-submenu"><li class="ar_left"><i class="fa fa-film"></i><a href="#">Zoom</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Kirik Party</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Mahakali</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">karvva</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Ishtakamya</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Jigarthanda</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Abhimani</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Priyanka</a>
												</li>
											</ul></li>
										<li><a href="html.html">Popular Bengali Movies</a>
											<ul class="lg-submenu"><li class="ar_left"><i class="fa fa-film"></i><a href="#">Baro Bou</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Tomake</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Jeevan</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Haraner </a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Bidhilipi</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Bhalobasa </a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Prateek</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Aparanher</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Mukhyamantri</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Charmurti</a>
												</li>
											</ul></li>
										<li><a href="html.html">Popular Hollywood Movies</a>
											<ul class="lg-submenu"><li class="ar_left"><i class="fa fa-film"></i><a href="#">Wind River</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Logan</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Coco</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Meyerowitz </a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Ragnarok</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Driver</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Dunkirk</a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Big Sick </a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">American </a>
												</li>
												<li class="ar_left"><i class="fa fa-film"></i><a href="#">Logan  </a>
												</li>
											</ul></li>
										<li>
											<div class="prs_navi_slider_wraper">
												<div class="owl-carousel owl-theme">
													<div class="item">
														<img src="{!!asset('public/assets/website/images/content-up1.jpg')!!}" alt="navi_img"></div>
													<div class="item">
														<img src="{!!asset('public/assets/website/images/content-up2.jpg')!!}" alt="navi_img"></div>
													<div class="item">
														<img src="{!!asset('public/assets/website/images/content-up3.jpg')!!}" alt="navi_img"></div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li class="parent"><a href="{{ url('contentform')}}">Submit Your Content</a>
									<!--<ul class="lg-submenu"><li><a href="#">Star Plus</a></li>-->
									<!--	<li><a href="#">Star Jalsha</a></li>-->
									<!--	<li><a href="#">Star Gold</a></li>-->
									<!--	<li><a href="#">Sony TV</a></li>-->
									<!--	<li><a href="#">Sab TV</a></li>-->
									<!--	<li><a href="#">Sony Pal</a></li>-->
									<!--	<li><a href="#">Set Max</a></li>-->
									<!--</ul>-->
								</li>
								<!--<li class="parent megamenu"><a href="#">video</a>-->
								<!--	<ul class="lg-submenu prs_navi_video_wrapper"><li>-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp1.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--		<li>-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp2.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--		<li>-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp3.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--		<li>-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp4.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--		<li>-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp5.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--		<li class="hidden-sm">-->
								<!--			<div class="prs_video_navi_img_main_wrapper">-->
								<!--				<img src="{!!asset('public/assets/website/images/content-vp6.jpg')!!}" alt="video_img"><div class="prs_video_navi_overlay_wrapper">	<a class="test-popup-link button" rel="external" href="https://www.youtube.com/embed/ryzOXAO0Ss0" title="title"><i class="flaticon-play-button"></i></a>-->
								<!--				</div>-->
								<!--			</div>-->
								<!--		</li>-->
								<!--	</ul></li>-->
								<!--<li class="parent"><a href="#">pages</a>-->
								<!--	<ul class="lg-submenu"><li class="parent"><a href="#">Blog</a>-->
								<!--			<ul class="lg-submenu"><li><a href="blog_category.html">Blog-Category</a>-->
								<!--				</li>-->
								<!--				<li><a href="blog_single.html">Blog-Single</a>-->
								<!--				</li>-->
								<!--			</ul></li>-->
								<!--		<li class="parent"><a href="#">Event</a>-->
								<!--			<ul class="lg-submenu"><li><a href="event_category.html">Event-Category</a>-->
								<!--				</li>-->
								<!--				<li><a href="event_single.html">Event-Single</a>-->
								<!--				</li>-->
								<!--			</ul></li>-->
								<!--		<li class="parent"><a href="#">Movie</a>-->
								<!--			<ul class="lg-submenu"><li><a href="movie_category.html">Movie-Category</a>-->
								<!--				</li>-->
								<!--				<li><a href="movie_single.html">Movie-Single</a>-->
								<!--				</li>-->
								<!--				<li><a href="movie_single_second.html">Movie-Single-II</a>-->
								<!--				</li>-->
								<!--			</ul></li>-->
								<!--		<li><a href="gallery.html">gallery</a>-->
								<!--		</li>-->
								<!--		<li><a href="booking_type.html">Booking-Type</a>-->
								<!--		</li>-->
								<!--		<li><a href="confirmation_screen.html">Confirmation-Screen</a>-->
								<!--		</li>-->
								<!--		<li><a href="movie_booking.html">Movie-Booking</a>-->
								<!--		</li>-->
								<!--		<li><a href="seat_booking.html">Seat-Booking</a>-->
								<!--		</li>-->
								<!--	</ul></li>-->
								<li class="parent"><a href="{{ url('contactus')}}">contact</a>
								</li>
							</ul></div>
						<!-- /dl-menuwrapper -->
					</nav></div>
			</div>
			<div class="prs_navi_right_main_wrapper">
				<div class="prs_slidebar_wrapper">
					<button class="second-nav-toggler" type="button">
						<img src="{!!asset('public/assets/website/images/header-bars.png')!!}" alt="bar_png"></button>
				</div>
				<!--<div class="prs_top_login_btn_wrapper">-->
				<!--	<div class="prs_animate_btn1">-->
				<!--		<ul><li><a href="#" class="button button--tamaya" data-text="sign up" data-toggle="modal" data-target="#myModal"><span>sign up</span></a>-->
				<!--			</li>-->
				<!--		</ul></div>-->
				<!--</div>-->
				<!--<div class="product-heading">-->
				<!--	<div class="con">-->
				<!--		<select><option>All Categories</option><option>Movie</option><option>Video</option><option>Music</option><option>TV-Show</option></select><input type="text" placeholder="Search Movie , Video , Music"><button type="submit"><i class="flaticon-tool"></i>-->
				<!--		</button>-->
				<!--	</div>-->
				<!--</div>-->
			</div>
			<div id="mobile-nav" data-prevent-default="true" data-mouse-events="true">
				<div class="mobail_nav_overlay"></div>
				<div class="mobile-nav-box">
					<div class="mobile-logo">
						<a href="{{ url('index')}}" class="mobile-main-logo">
						<img src="{!!asset('public/assets/image/logo111.jpeg')!!}"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mass TV</span>
						</a>	
						<a href="#" class="manu-close"><i class="fa fa-times"></i></a>
					</div>
					<ul class="mobile-list-nav"><li><a href="#">OVERVIEW</a>
						</li>
						<li><a href="#">UPCOMING SERIES</a>
						</li>
						<li><a href="{{ url('contentform')}}">SUBMIT YOUR CONTENT</a>
						</li>
						<!--<li><a href="#">GALLERY</a>-->
						<!--</li>-->
						<!--<li><a href="#">BLOG</a>-->
						<!--</li>-->
						<li><a href="{{ url('contactus')}}">CONTACT</a>
						</li>
					</ul><div class="product-heading prs_slidebar_searchbar_wrapper">
						<!--<div class="con">-->
						<!--	<select><option>All Categories</option><option>Movie</option><option>Video</option><option>Music</option><option>TV-Show</option></select><input type="text" placeholder="Search Movie , Video , Music"><button type="submit"><i class="flaticon-tool"></i>-->
						<!--	</button>-->
						<!--</div>-->
					</div>
					<!--<div class="achivement-blog">-->
					<!--	<ul class="flat-list"><li>-->
					<!--			<a href="#">	<i class="fa fa-facebook"></i>-->
					<!--				<h6>Facebook</h6>-->
					<!--				<span class="counter">12546</span>-->
					<!--			</a>-->
					<!--		</li>-->
					<!--		<li>-->
					<!--			<a href="#">	<i class="fa fa-twitter"></i>-->
					<!--				<h6>Twiter</h6>-->
					<!--				<span class="counter">12546</span>-->
					<!--			</a>-->
					<!--		</li>-->
					<!--		<li>-->
					<!--			<a href="#">	<i class="fa fa-pinterest"></i>-->
					<!--				<h6>Pinterest</h6>-->
					<!--				<span class="counter">12546</span>-->
					<!--			</a>-->
					<!--		</li>-->
					<!--	</ul></div>-->
					<div class="prs_top_login_btn_wrapper prs_slidebar_searchbar_btn_wrapper">
						<!--<div class="prs_animate_btn1">-->
						<!--	<ul><li><a href="#" class="button button--tamaya" data-text="sign up" data-toggle="modal" data-target="#myModal"><span>sign up</span></a>-->
						<!--		</li>-->
						<!--	</ul></div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- prs navigation End -->
	<!-- prs title wrapper Start -->
	<div class="prs_title_main_sec_wrapper">
		<div class="prs_title_img_overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="prs_title_heading_wrapper">
						<h2>contact us</h2>
						<ul><li><a href="#">Home</a>
							</li>
							<li>&nbsp;&nbsp; &gt;&nbsp;&nbsp; contact</li>
						</ul></div>
				</div>
			</div>
		</div>
	</div>
	<!-- prs title wrapper End -->
	<!-- prs contact form wrapper Start -->
	<div class="prs_contact_form_main_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="prs_contact_left_wrapper">
						<h2>Contact us</h2>
					</div>
					<div class="row">
						 <form action="{{ url('contactquery') }}" method="post">
                           @csrf
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="prs_contact_input_wrapper">
									<input name="name" type="text" class="require" placeholder="Name" required></div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="prs_contact_input_wrapper">
									<input type="text" name="phone" class="require" onkeypress="return AllowOnlyNumbers(event);" onpaste="return AllowOnlyNumbers(event);" minlength="9" maxlength="13" placeholder="Phone" required></div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="prs_contact_input_wrapper">
									<textarea name="query" class="require" rows="7" placeholder="Comment" required></textarea></div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="response"></div>
								<div class="prs_contact_input_wrapper prs_contact_input_wrapper2">
									<ul><li>
											<input type="hidden" name="form_type" value="contact">
											<button type="submit" class="submitForm">Submit</button>
										</li>
									</ul></div>
							</div>
						</form>
					</div>
				</div>
				<!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
				<!--	<div class="prs_contact_right_section_wrapper">-->
				<!--		<ul><li><a href="#"><i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;facebook.com/presenter</a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-twitter"></i> &nbsp;&nbsp;&nbsp;twitter.com/presenter</a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-vimeo"></i> &nbsp;&nbsp;&nbsp;vimeo.com/presenter</a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-instagram"></i> &nbsp;&nbsp;&nbsp;instagram.com/presenter</a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-youtube-play"></i> &nbsp;&nbsp;&nbsp;youtube.com/presenter</a>-->
				<!--			</li>-->
				<!--		</ul></div>-->
				<!--</div>-->
			</div>
		</div>
	</div>
	<!-- prs contact form wrapper End -->
	<!-- prs contact map Start -->
	<!--<div class="hs_contact_map_main_wrapper">-->
	<!--	<div id="map"></div>-->
	<!--</div>-->
	<!-- prs contact map End -->
	<!-- prs contact info Start -->
	<div class="prs_contact_info_main_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="prs_contact_info_box_wrapper">
						<div class="prs_contact_info_smallbox">	<i class="flaticon-call-answer"></i>
						</div>
						<h3>contact</h3>
						<p>+91-123456789
							<br>+91-4444-5555</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="prs_contact_info_box_wrapper prs_contact_info_box_wrapper2">
						<div class="prs_contact_info_smallbox">	<i class="flaticon-call-answer"></i>
						</div>
						<h3>Location</h3>
						<p>601 - Ram Nagar , India
							<br>Omex City 245 , America</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="prs_contact_info_box_wrapper prs_contact_info_box_wrapper2">
						<div class="prs_contact_info_smallbox">	<i class="flaticon-call-answer"></i>
						</div>
						<h3>Email</h3>
						<p><a href="#">presenter@example.com</a> 
							<br><a href="#">movie@example.com</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- prs contact info End -->
	<!-- prs patner slider Start -->
	<!--<div class="prs_patner_main_section_wrapper">-->
	<!--	<div class="container">-->
	<!--		<div class="row">-->
	<!--			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
	<!--				<div class="prs_heading_section_wrapper">-->
	<!--					<h2>Our Patner&rsquo;s</h2>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
	<!--				<div class="prs_pn_slider_wraper">-->
	<!--					<div class="owl-carousel owl-theme">-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p1.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p2.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p3.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p4.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p5.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--						<div class="item">-->
	<!--							<div class="prs_pn_img_wrapper">-->
	<!--								<img src="images/content-p6.jpg" alt="patner_img"></div>-->
	<!--						</div>-->
	<!--					</div>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- prs patner slider End -->
	<!-- prs Newsletter Wrapper Start -->
	<!--<div class="prs_newsletter_wrapper">-->
	<!--	<div class="container">-->
	<!--		<div class="row">-->
	<!--			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">-->
	<!--				<div class="prs_newsletter_text">-->
	<!--					<h3>Get update sign up now !</h3>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">-->
	<!--				<div class="prs_newsletter_field">-->
	<!--					<input type="text" placeholder="Enter Your Email"><button type="submit">Submit</button>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- prs Newsletter Wrapper End -->
	<!-- prs footer Wrapper Start -->
	<div class="prs_footer_main_section_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_1">
						<h2>MASS TV</h2>
						<ul><li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Home</a>
							</li>
							<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Upcoming Series</a>
							</li>
							<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Submit Your Content</a>
							</li>
							<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Contact</a>
							</li>
							<!--<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Malyalam movie</a>-->
							<!--</li>-->
							<!--<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">English Action movie</a>-->
							<!--</li>-->
							<!--<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Hindi Action movie</a>-->
							<!--</li>-->
						</ul></div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_2">
						<!--<h2>MOVIES by presenter</h2>-->
						<!--<ul><li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Action movie</a>-->
						<!--	</li>-->
						<!--	<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Romantic movie</a>-->
						<!--	</li>-->
							<!--<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Adult movie</a>-->
							<!--</li>-->
						<!--	<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Comedy movie</a>-->
						<!--	</li>-->
						<!--	<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Drama movie</a>-->
						<!--	</li>-->
						<!--	<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Musical movie</a>-->
						<!--	</li>-->
						<!--	<li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Classical movie</a>-->
						<!--	</li>-->
						<!--</ul>-->
						</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_3">
				<!--		<h2>BOOKING ONLINE</h2>-->
				<!--		<ul>-->
				<!--		    <li>-->
				<!--		        <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.example.com</a>-->
				<!--			</li>-->
				<!--			<li>-->
				<!--			    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.hello.com</a>-->
				<!--			</li>-->
							<!--<li>-->
							<!--    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.example.com</a>-->
							<!--</li>-->
							<!--<li>-->
							<!--    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.hello.com</a>-->
							<!--</li>-->
							<!--<li>-->
							<!--    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.example.com</a>-->
							<!--</li>-->
							<!--<li>-->
							<!--    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.hello.com</a>-->
							<!--</li>-->
							<!--<li>-->
							<!--    <i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">www.example.com</a>-->
							<!--</li>-->
				<!--		</ul> -->
				</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_4">
						<h2>App available on</h2>
						<p>Download App and Get Free Movie Ticket !</p>
						<ul><li>
								<a href="#">
									<img src="{!!asset('public/assets/website/images/content-f1.jpg')!!}" alt="footer_img"></a>
							</li>
							<li>
								<a href="#">
									<img src="{!!asset('public/assets/website/images/content-f2.jpg')!!}" alt="footer_img"></a>
							</li>
						</ul>
					<!--	<h5><span>$50</span> Payback on App Download</h5>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="prs_bottom_footer_wrapper">	<a href="javascript:.html" id="return-to-top"><i class="flaticon-play-button"></i></a>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
					<div class="prs_bottom_footer_cont_wrapper">
						<p>Copyright 2020-24 <a href="#">Mass TV</a> . All rights reserved - Design by <a href="#">TechnoDroidz</a>
						</p>
					</div>
				</div>
				<!--<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">-->
				<!--	<div class="prs_footer_social_wrapper">-->
				<!--		<ul><li><a href="#"><i class="fa fa-facebook"></i></a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-twitter"></i></a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-linkedin"></i></a>-->
				<!--			</li>-->
				<!--			<li><a href="#"><i class="fa fa-youtube-play"></i></a>-->
				<!--			</li>-->
				<!--		</ul></div>-->
				<!--</div>-->
			</div>
		</div>
	</div>
	<!-- prs footer Wrapper End -->
	<!-- st login wrapper Start -->
	<div class="modal fade st_pop_form_wrapper" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="st_pop_form_heading_wrapper float_left">
					<h3>Log in</h3>
				</div>
				<div class="st_profile_input float_left">
					<label>Email / Mobile Number</label>
					<input type="text"></div>
				<div class="st_profile__pass_input st_profile__pass_input_pop float_left">
					<input type="password" placeholder="Password"></div>
				<div class="st_form_pop_fp float_left">
					<h3><a href="#" data-toggle="modal" data-target="#myModa2" target="_blank">Forgot Password?</a></h3>
				</div>
				<div class="st_form_pop_login_btn float_left">	<a href="page-1-7_profile_settings.html">LOGIN</a>
				</div>
				<div class="st_form_pop_or_btn float_left">
					<h4>or</h4>
				</div>
				<div class="st_form_pop_facebook_btn float_left">	<a href="#"> Connect with Facebook</a>
				</div>
				<div class="st_form_pop_gmail_btn float_left">	<a href="#"> Connect with Google</a>
				</div>
				<div class="st_form_pop_signin_btn float_left">
					<h4>Don&rsquo;t have an account? <a href="#" data-toggle="modal" data-target="#myModa3" target="_blank">Sign Up</a></h4>
					<h5>I agree to the <a href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy</a></h5>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade st_pop_form_wrapper" id="myModa2" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="st_pop_form_heading_wrapper st_pop_form_heading_wrapper_fpass float_left">
					<h3>Forgot Password</h3>
					<p>We can help! All you need to do is enter your email ID and follow the instructions!</p>
				</div>
				<div class="st_profile_input float_left">
					<label>Email Address</label>
					<input type="text"></div>
				<div class="st_form_pop_fpass_btn float_left">	<a href="#">Verify</a>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade st_pop_form_wrapper" id="myModa3" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="st_pop_form_heading_wrapper float_left">
					<h3>Sign Up</h3>
				</div>
				<div class="st_profile_input float_left">
					<label>Email / Mobile Number</label>
					<input type="text"></div>
				<div class="st_profile__pass_input st_profile__pass_input_pop float_left">
					<input type="password" placeholder="Password"></div>
				<div class="st_form_pop_fp float_left">
					<h3><a href="#" data-toggle="modal" data-target="#myModa2" target="_blank">Forgot Password?</a></h3>
				</div>
				<div class="st_form_pop_login_btn float_left">	<a href="page-1-7_profile_settings.html">LOGIN</a>
				</div>
				<div class="st_form_pop_or_btn float_left">
					<h4>or</h4>
				</div>
				<div class="st_form_pop_facebook_btn float_left">	<a href="#"><i class="fab fa-facebook-f"></i> Connect with Facebook</a>
				</div>
				<div class="st_form_pop_gmail_btn float_left">	<a href="#"><i class="fab fa-google-plus-g"></i> Connect with Google</a>
				</div>
				<div class="st_form_pop_signin_btn st_form_pop_signin_btn_signup float_left">
					<h5>I agree to the <a href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy</a></h5>
				</div>
			</div>
		</div>
	</div>
	<!-- st login wrapper End -->
	<!--main js file start-->
	<script src="{!!asset('public/assets/website/js/8456472-js-jquery_min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/6787333-js-modernizr.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/5278653-js-bootstrap.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/8863983-js-owl.carousel.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/8407388-js-jquery.dlmenu.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/3236438-js-jquery.sticky.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/4285693-js-jquery.nice-select.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/5425453-js-jquery.magnific-popup.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/8132609-js-jquery.bxslider.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/4283246-js-venobox.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/4682105-js-smothscroll_part1.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/4851242-js-smothscroll_part2.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-jquery.themepunch.revolution.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-jquery.themepunch.tools.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.addon.snow.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.actions.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.carousel.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.kenburn.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.layeranimation.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.migration.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.navigation.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.parallax.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.slideanims.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/rs_slider-revolution.extension.video.min.js')!!}"></script>
	<script src="{!!asset('public/assets/website/js/9821250-js-custom.js')!!}"></script>
	<!--main js file end-->
	<script>
//  		function initMap() {
//  		        	var uluru = {lat: -36.742775, lng:  174.731559};
//  		        	var map = new google.maps.Map(document.getElementById('map'), {
//  		        	zoom: 15,
//  		        	scrollwheel: false,
//  		        	center: uluru
//  		        	});
//  		        	var marker = new google.maps.Marker({
//  		        	position: uluru,
//  		        	map: map
//  		        	});
//  		        	}
  

       function AllowOnlyNumbers(e) {

                e = (e) ? e : window.event;
                var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
                var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
                var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);
            
                return (/^\d+$/.test(str));
            }


	</script><script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi2zbxXa0ObGqaSBo5NJMdwLs_xtQ03nI&amp;callback=initMap">
	</script></body></html>
