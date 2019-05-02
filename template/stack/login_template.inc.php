<?php
/**
 * Template for Login
 *
 * Copyright (C) 2015 Arie Nugraha (dicarve@gmail.com)
 * Create by Eddy Subratha (eddy.subratha@slims.web.id)
 * Modified by Drajat Hasan (drajathasan20@gmail.com)
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
// Meta
// =============================================
include "component/meta.php"; ?>

</head>

<body itemscope itemtype="http://schema.org/WebPage" id="login-page">
  <?php if (isset($_GET['p']) AND ($_GET['p'] == 'login')) {?>
  <!-- Login
  ============================================= -->
  <main id="content" class="s-main s-login animated infinate slideInLeft" role="main">
    <div class="loginHeader">
      <h3><i class="fa fa-user"></i>&nbsp;Login Admin</h3>
    </div>
    <div class="s-login-content">
      <?php echo $main_content; ?>
    </div>
  </main>
  <div class="quotes-in-login quotes-on-dday animated infinate fadeInRight">
    <!-- Quotes get from www.goodreads.com -->
    <h3>Quotes</h3>
    <span class="quotes"></span>
    <small class="authorq"></small>
  </div>
  <?php
  } else {
    echo $main_content;
  }
  // Footer
  // =============================================
  include "component/footer.php"; ?>

  <script>
    $("form, input").attr({
      autocomplete    : "off",
      autocorrect     : "off",
      autocapitalize  : "off",
      spellcheck      : "off"
    });

    $('.homeButton').val('<?php echo __('Back To Home'); ?>');

    //If captcha available
    $('.captchaAdmin').parent().parent().attr('style','padding: 25px 20px;');
    $('.captchaAdmin').parent().parent().parent().attr('style','top: -40px;');

    /* Modified by Drajat Hasan */
    /* random quotes */
    <?php 
    // Num
    if (isset($_GET['p']) AND ($_GET['p'] == 'login')) {
    $num = array('first','second','third');
    // Shuffle
    shuffle($num);
    $get_num = $num[0];
    // Get quotes
    $data = $dbs->escape_string(file_get_contents(SB.'template/stack/quotes/'.$get_num.'.json'));
    ?>
    // JSON Parsing
    var myObj = JSON.parse('<?php echo $data;?>');
    // Quotes
    $('.quotes').html('"'+myObj.quotes+'"');
    // Author
    $('.authorq').html('<b>-- '+myObj.author+'</b>');
    <?php } ?>
  </script>

</body>

</html>
