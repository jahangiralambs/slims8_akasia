<?php
/**
 * Template for Login
 *
 * Copyright (C) 2015 Arie Nugraha (dicarve@gmail.com)
 * Create by Eddy Subratha (eddy.subratha@slims.web.id)
 * 
 * Slims 8 (Akasia)
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

<!DOCTYPE html>
<html lang="<?php echo substr($sysconf['default_lang'], 0, 2); ?>" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
<head>
<?php 
// Meta
// =============================================
include "partials/meta.php"; 
include "partials/header.php"; 
include "partials/bg.php"; 
?>

</head>

<body itemscope itemtype="http://schema.org/WebPage" id="login-page"  >
  <!-- Login
  ============================================= -->
  <main id="content" class="s-main s-login" role="main" >
    <div class="s-login-content animated flipInY delay9">
	<img src="template/bootstrap_4/img/logo.png" alt=""/></img>
		<?php echo $main_content; ?>
    </div>
  </main>

  


  <script>
    $("form, input").attr({
      autocomplete    : "off",  
      autocorrect     : "off",  
      autocapitalize  : "off",  
      spellcheck      : "off"  
    });

    $('.homeButton').val('Back to Home');

    //If captcha available
    $('.captchaAdmin').parent().parent().attr('style','padding: 25px 20px;');
    $('.captchaAdmin').parent().parent().parent().attr('style','top: -40px;');

  </script>

</body>

</html>
