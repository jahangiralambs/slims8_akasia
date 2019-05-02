<?php
/**
 * Template for visitor counter
 * name of memberID text field must be: memberID
 * name of institution text field must be: institution
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

$main_template_path = $sysconf['template']['dir'].'/'.$sysconf['template']['theme'].'/login_template.inc.php';

?>

<form action="index.php?p=visitor" name="visitorCounterForm" id="visitorCounterForm" class="animate infinate fadeIn" method="post">
  <div class="visitor-box">
      <div class="left left-box">
        <img id="visitorCounterPhoto" src="./images/persons/photo.png"/>
        <div id="counterInfo" class="info"><?php echo __('Please insert your library member ID otherwise your full name instead'); ?></div>
      </div>
      <div class="right right-box">
        <br>
        <h3><?php echo __('Visitor Counter'); ?></h3>
        <label for="memberID"><?php echo __('Member ID / Visitor Name'); ?></label>
        <input type="text" name="memberID" id="memberID" autofocus/>
        <br>
        <label for="institution"><?php echo __('Institution'); ?></label>
        <input type="text" name="institution" id="institution" class="form-control input-lg" />
        <input type="submit" id="counter" name="counter" value="<?php echo __('Add'); ?>">
      </div>
  </div>
</form>

