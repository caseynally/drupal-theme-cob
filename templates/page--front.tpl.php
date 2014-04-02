<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div id="page">
	<div id="header">
		<div id="topRow">

	<?php
		echo theme('links__system_main_menu', array(
			'links'      => $main_menu,
			'attributes' => array(
				'id' => 'main-menu',
				'class'      => array('links')
			)
		));

		$home_text = t('Home');
		if ($logo) {
			echo "
			<div id=\"logo\">
				<a href=\"$front_page\" title=\"$home_text\" rel=\"home\">
					<img src=\"$logo\"    alt=\"$home_text\" />
				</a>
				</div>
			";
		}

		echo "<div id=\"mobileMenu\"><button class=\"nav-button\"></button></div>";


		if ($site_name) {
			echo "
				<div id=\"site_name\">
					<h1>
						<a href=\"$front_page\" title=\"$home_text\" rel=\"home\">
						$site_name
						</a>
					</h1>

				</div>
			";
		}
echo "
		</div> <!--topRow -->
		<div id=\"headerLinks\">
			<ul>
				<li><i class=\"icon-star\"></i>Dashboard</li>
				<li> <i class=\"icon-comments\"></i>uReport</li>
				<li class=\"last\"><i class=\"icon-user\"></i>myBloomington</li>
			</ul>
		</div>
		";

			if ($site_slogan) {
				echo "<div id=\"site-slogan\"><h2>$site_slogan</h2></div>";
			}

			echo render($page['header']);

	?>
	</div> <!--/#header -->
	<?php
		include __DIR__.'/../includes/dropdowns.php';


		if ($title || $breadcrumb) {
			echo "<div id=\"breadcrumb\">";
			echo render($title_prefix);
			if ($title) {
				echo "<h1 class=\"title\" id=\"page-title\">$title</h1>";
			}
			echo render($title_suffix);
			if ($breadcrumb) {
				echo $breadcrumb;
			}
			echo "</div>";
		}

		echo $messages;
	?>
	<div id="main" class="clearfix">
		<div id="content" class="column">
			<div id="frontpagelargeColumn">
				<?php
					if ($tabs) {
						echo '<div class="tabs">';
						echo render($tabs);
						echo '</div>';
					}
					echo render($page['help']);
					if ($action_links) {
						echo '<ul class="action-links">';
						echo render($action_links);
						echo '</ul>';
					}
				?>
				<div id="frontpageCurrent">
					<div id="frontpageNews">
					<h2>City News Highlights</h2>
					<?php
						$news = cob_nodes_recent('news', 7);
						$featuredNews    = array_slice($news, 0, 2);
						$highlightedNews = array_slice($news, 2);

						foreach ($highlightedNews as $node) {
							$n = node_view($node, 'sidebar');
							echo render($n);
						}
					?>
					</div>

					<div id="frontpageEvents">
						<h2>Upcoming Events</h2>
						<p>Next 10 events</p>
						<h4>Thu, Oct 3</h4>
						<div class="frontpageEventListings">
						<ul>
							<li>SilverSneakers Cardio Circuit</li>
							<li>SilverSneakers Muscle Strength and Range of Movement</li>
							<li>Bloomington Digital Underground Advisory Committee</li>
							<li>Commission on the Status of Women</li>
							<li>Bloomington Walking Club</li>
						</ul>
						<h4>Fri, Oct 4</h4>
						<ul><li>Hola Bloomington</li></ul>
						<p>View more link</p>
						</div>
					</div>
				</div>
				<div id="frequentlyRequested">
					<h2>Frequently Requested</h2>
					<div class="frRow">
						<div class="homepageFeaturedservice"><a href="https://bloomington.in.gov/webtrac/cgi-bin/wspd_cgi.sh/wb1000.html?wbp=1">
							<img src="/media/m/2014/3/7/100/5319dea183301.png" /></a>
							<h4><a href="https://bloomington.in.gov/webtrac/cgi-bin/wspd_cgi.sh/wb1000.html?wbp=1">Parks and Recreation Services</a></h4>
							<p>Sign up for tee times, classes and leagues, and reserve park shelters</p>
						</div>
						<div class="homepageFeaturedservice"><a href="<?php echo $base_path; ?>/ureport"><img src="/media/m/2014/3/31/100/5339b5be251ff.png" /></a>
							<h4><a href="<?php echo $base_path; ?>/ureport">Report Issues</a></h4><p>Notify the City of community issues, such as potholes, graffiti, malfunctioning street lights, and more.</p>
						</div>
					</div>
					<div class="frRow">
						<div class="homepageFeaturedservice"><a href="<?php echo $base_path; ?>/contact"><img src="/media/m/2014/3/6/100/5318b4fc606c9.png" /></a>
							<h4><a href="<?php echo $base_path; ?>/contact">Contact the City</a></h4>
							<p>Staff directory, primary phone numbers, and other contact options</p>
						</div>
						<div class="homepageFeaturedservice"><a href="<?php echo $base_path; ?>/jobs"><img src="/media/m/2014/3/31/100/5339b3453b324.png" /></a>
							<h4><a href="<?php echo $base_path; ?>/jobs">Employment Opportunities</a></h4><p>See current City openings</p>
						</div>
					</div>

				</div>
			</div>
			<div id="frontpageFeatured">
				<div id="homepageFeaturedNews">
				<?php
					foreach ($featuredNews as $node) {
						$n = node_view($node, 'teaser');
						echo render($n);
					}
				?>
				</div>
			</div>
		</div> <!-- /#content -->
	</div> <!-- /#main -->

	<div id="footer">
		<?php
			echo render($page['footer']);
			echo theme('links__system_secondary_menu', array(
				'links' => $secondary_menu,
				'attributes' => array(
					'id' => 'secondary-menu',
					'class' => array('links', 'inline')
				)
			));
		?>
	</div> <!-- /#footer -->
</div> <!-- /#page -->
