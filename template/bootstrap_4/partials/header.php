<!--
   ___                     ____              _       _                     _  _   
  / _ \ _ __   __ _  ___  | __ )  ___   ___ | |_ ___| |_ _ __ __ _ _ __   | || |  
 | | | | '_ \ / _` |/ __| |  _ \ / _ \ / _ \| __/ __| __| '__/ _` | '_ \  | || |_ 
 | |_| | |_) | (_| | (__  | |_) | (_) | (_) | |_\__ \ |_| | | (_| | |_) | |__   _|
  \___/| .__/ \__,_|\___|_|____/ \___/ \___/ \__|___/\__|_|  \__,_| .__/     |_|  
 | |__ |_|  _  | | | / ___||  _ \                                 |_|             
 | '_ \| | | | | |_| \___ \| |_) |                                                
 | |_) | |_| | |  _  |___) |  _ <                                                 
 |_.__/ \__, | |_| |_|____/|_| \_\                                                
        |___/                                                                     
-->
<header id="header" class="animated fadeInDown"><div id="logo " class="pull-left"> <a href="index.php"><img src="template/bootstrap_4/img/main_logo.png" alt="<?php echo $sysconf['library_name']; ?>" /></img></a></div> <nav id="nav-menu-container"><form action="index.php" method="get" autocomplete="off"><div class="input-group"> <input type="text" id="keyword" name="keywords" class="form-control" role="search" placeholder="Masukkan kata kunci, lalu tekan Enter"> <span class="input-group-btn"><button class="btn btn-default" type="submit" name="search" value="search" ><i class="fa fa-search" aria-hidden="true"></i></button></span></div></form><ul class="nav-menu"><li><a href="index.php"><?php echo __('Home'); ?></a></li><li><a href="index.php?p=news"><?php echo __('Library News'); ?></a></li><li><a href="index.php?p=member"><?php echo __('Member Area'); ?></a></li><li><a href="index.php?p=help"><?php echo __('Help on Search'); ?></a></li><li><a href="index.php?p=librarian"><?php echo __('Librarian'); ?></a></li><li class="menu-has-children"><a href="#">Other Menu</a><ul><li><a href="index.php?p=libinfo"><?php echo __('Library Information'); ?></a></li><li><a href="index.php?p=peta" class="openPopUp" width="600" height="400"><?php echo __('Library Location'); ?></a></li><li><a href="index.php?p=slimsinfo"><?php echo __('About SLiMS'); ?></a></li><li><a href="index.php?p=login"><?php echo __('Librarian LOGIN'); ?></a></li></ul></li></ul><div class="hsr"><a href="http://hsr-share.blogspot.com" id="hsr" target="_blank"> Opac Bootstrap 4 for SLIMS 8.x<br/> by H S R </a></div> </nav> </header>