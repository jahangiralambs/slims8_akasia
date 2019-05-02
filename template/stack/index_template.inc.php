<?php
/**
 * Template for OPAC
 *
 * Copyright (C) 2018 Drajat Hasan (drajathasan20@gmail.com)
 * Some code taken and modified from SLiMS Default Public template
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 */
// be sure that this file not accessed directly

if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}

?>
<!-- 
 ____  _             _      _____                    _       _       
/ ___|| |_ __ _  ___| | __ |_   _|__ _ __ ___  _ __ | | __ _| |_ ___ 
\___ \| __/ _` |/ __| |/ /   | |/ _ \ '_ ` _ \| '_ \| |/ _` | __/ _ \
 ___) | || (_| | (__|   <    | |  __/ | | | | | |_) | | (_| | ||  __/
|____/ \__\__,_|\___|_|\_\   |_|\___|_| |_| |_| .__/|_|\__,_|\__\___|
                                              |_| 
											 ____          __  __ ____  
											| __ ) _   _  |  \/  |  _ \ 
											|  _ \| | | | | |\/| | | | |
											| |_) | |_| | | |  | | |_| |
											|____/ \__, | |_|  |_|____/ 
											       |___/   v1.0.0                                   
 -->
<!DOCTYPE html>
<html lang="<?php echo substr($sysconf['default_lang'], 0, 2); ?>" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
<head>
<?php
// Meta Template
include "component/meta.php";
?>
</head>
<body itemscope="itemscope" itemtype="http://schema.org/WebPage">
	<?php
	include "component/header.php";
	?>
	<?php if(isset($_GET['search']) || isset($_GET['p'])): ?>
	<?php
    if(isset($_GET['p'])) {
      switch ($_GET['p']) {
      case ''             : $page_title = __('Collections'); break;
      case 'show_detail'  : $page_title = __("Record Detail"); break;
      case 'member'       : $page_title = __("Member Area"); break;
      case 'member'       : $page_title = __("Member Area"); break;
      default             : $page_title; break; }
    } else {
      $page_title = __('Collections');
    }

    // Set height
    $height = '100%';
    if(strlen($main_content) == 7) {
    	$height = '1000px';
    } else if (empty($main_content)) {
    	$height = '1000px';
    } else if (isset($_GET['p']) AND $_GET['p'] == 'member') {
    	if (!utility::isMemberLogin()) {
    		$height = '400px';
    	}
    } else if (isset($_GET['p']) AND $_GET['p'] == 'news') {
    	$height = '1400px';
    }
    ?>
    <!-- Page title -->
	<div class="page_title">
		<h4><?php echo $page_title;?></h4>
	</div>
	<!-- Main content -->
	<div class="mainContent" style="height:<?php echo $height;?>;">
		<div class="left label-left">
			<!-- Result info -->
			<?php if(isset($_GET['search'])) : ?>
	        <h2><?php echo __('Search Result'); ?></h2>
	        <?php echo $search_result_info;?>
	        <?php endif; ?>
			<!-- <img class="cover" src="<?php echo $sysconf['template']['dir']; ?>/stack/asset/img/book.png"> -->
			<!-- If Member Logged
	        ============================================= -->
	        <h2><?php echo __('Information'); ?></h2>
	        <?php 
	        	if (isset($_GET['p']) AND ($_GET['p'] == 'show_detail')) {
	        		echo '<div class="cover"></div>';
	        	}
	        ?>
	        <hr/>
	        <p><?php echo (utility::isMemberLogin()) ? $header_info : $info; ?></p>
	        <br/>
			</div>
		<?php if (isset($_GET['keywords']) AND (isset($_GET['p'])) AND ($_GET['p'] == 'show_detail')) : ?>
		<form action="index.php" method="get">
			<div class="detail-search-box">
				<input type="text" aria-hidden="true" name="keywords" autocomplete="off" placeholder="Masukan kata kunci" autofocus>
				<button class="btn btn-success" style="padding-top: 10px;padding-bottom: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-search"></i></button>
				<input type="hidden" name="search" value="search">
				<a class="advS coll" href="javascript:void(0)" style="color: #3e3e3e; margin-bottom: 10px;padding-right:0">Advance Search</a>
			</div>
		</form>
		<?php endif; ?>
		<div class="result-content">
			<?php if (isset($_GET['keywords']) AND (!isset($_GET['p']))) : ?>
			<div class="search-box">
				<form action="index.php" method="get">
					<input type="text" id="keyword" name="keywords" aria-hidden="true" autocomplete="off" placeholder="Masukan kata kunci" autofocus>
					<button class="btn btn-success" style="padding-top: 10px;padding-bottom: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-search"></i></button>
					<input type="hidden" name="search" value="search">
					<a class="advS coll" href="#" style="color: #3e3e3e; margin-bottom: 10px;">Advance Search</a>
				</form>
			</div>
			<?php endif; ?>
			<?php
	        // Generate Output
	        // catch empty list
	        if(strlen($main_content) == 7) {
	           echo '<h2>' . __('No Result') . '</h2><hr/><p>' . __('Please try again') . '</p>';
	        } else {
	           echo $main_content;
	        }
	        // var_dump($main_content);
	        ?>
		</div>
	</div>
	<?php else: ?>
	<!-- Home Page -->
	<aside class="mainCon">
		<form action="index.php" method="get">
			<div class="banner-content animated infinate fadeInUp">
				<h1><?php echo __('SEARCH'); ?></h1>
				<span><?php echo __('start it by typing one or more keywords for title, author or subject'); ?></span>
				<input type="text" id="keyword" name="keywords" aria-hidden="true" autocomplete="off" placeholder="Keywords" autofocus>
				<button class="btn btn-success" style="padding-top: 10px;padding-bottom: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-search"></i></button>
				<input type="hidden" name="search" value="search"/>
				<br>
				<a class="advS" href="javascript:void(0)"><?php echo __('Advanced Search') ?></a>
			</div>
			<div class="quotes-on-dday animated infinate fadeInLeft">
				<!-- Quotes get from www.goodreads.com -->
				<h3>Quotes</h3>
				<span class="quotes"></span>
				<small class="authorq"></small>
			</div>
		</form>
	</aside>
	<?php endif; ?>
	<!-- Footer -->
	<?php
	include "component/footer.php";
	?>
	<!-- Modalbox -->
	<?php
	include "component/modal.php";
	?>
	<script type="text/javascript">
		/* Mobile prevent */
		var h = $(window).innerWidth();
		if ( h < 1000) {
	 		$('html').load('template/stack/mobile.html');
			// alert($(window).height());
		}
	</script>
	<script type="text/javascript">
		<?php if(isset($_GET['search']) && (isset($_GET['keywords'])) && ($_GET['keywords'] != ''))   : ?>
		$('.biblioRecordTitle h4, .author, .biblioRecord .abstract, .biblioRecord .controls').highlight(<?php echo $searched_words_js_array; ?>);
		<?php endif; ?>
		// Advance Search Modal Box
		$('.advS').on('click', function(){
			$('.modalbox').removeClass('hide slideOutUp');
			$('.modalbox').addClass('animated slideInDown');
			$('.adv-title').focus();
		});

		$('.cls').on('click', function(){
			$('.modalbox').removeClass('slideInDown');
			$('.modalbox').addClass('slideOutUp');
			$('#keyword').focus();
		});

		/* Lang */
		$('.selLang').on('click', function(){
			$('.language_board').removeClass('hide');
			$('.language_board').slideDown();	
		});
		$('#lang').on('change', function(){
			var val = $(this).val();
			window.location = 'index.php?select_lang='+val;
		});

		/* random quotes */
		<?php 
		// Num
		$num = array('first','second','third');
		// Shuffle
		shuffle($num);
		$get_num = $num[0];
		// Get quotes
		$data = $dbs->escape_string(file_get_contents(SB.'template/stack/quotes/'.$get_num.'.json'));
		?>
		// Parsing json
		var myObj = JSON.parse('<?php echo $data;?>');
		// Quotes
		$('.quotes').html('"'+myObj.quotes+'"');
		// Author
		$('.authorq').html('<b>-- '+myObj.author+'</b>');
	</script>
</body>
</html>