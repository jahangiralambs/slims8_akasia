<header>
	<nav>
		<div class="left logo" onclick="javascript:window.location='index.php'" style="cursor: pointer">
			<img src="<?php echo $sysconf['template']['dir'];?>/stack/asset/img/logo.png">
			<span><?php echo '<b>SL<b style="color: #F48024">i</b>MS</b> | <small>'.$sysconf['library_subname'].'</small>'; ?></span>
		</div>
		<div class="right info">
			<a href="index.php" title="Beranda"><i class="fa fa-home"></i></a>
			<a href="index.php?p=libinfo" title="Informasi Perpustakaan"><i class="fa fa-info-circle"></i></a>
			<a href="index.php?p=member" title="Area Anggota"><i class="fa fa-users"></i></a>
			<a href="index.php?p=login" title="Login Pustakawan"><i class="fa fa-user"></i></a>
			<a href="index.php?p=help" title="Bantuan Pencarian"><i class="fa fa-search"></i></a>
			<a href="javascript:void(0)" class="selLang" title="Bahasa"><i class="fa fa-globe"></i></a>
		</div>
		<div class="language_board hide">
			<select id="lang">
				<?php echo $language_select; ?>
			</select>
		</div>
	</nav>
</header>