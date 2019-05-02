<?php
/**
 * Template for Biblio List
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

$label_cache = array();
/**
 *
 * Format bibliographic item list for OPAC display
 *
 * @param   object      $dbs
 * @param   array       $biblio_detail
 * @param   int		$n
 * @param   array       $settings
 * @param   array       $return_back
 *
 * return   string
 *
 */
function biblio_list_format($dbs, $biblio_detail, $n, $settings = array(), &$return_back = array()) {
  global $label_cache, $sysconf;
  // init output var
  $output     = '';

  $title      = $biblio_detail['title'];
  $biblio_id  = $biblio_detail['biblio_id'];
  $detail_url = SWB.'index.php?p=show_detail&id='.$biblio_id.'&keywords='.$settings['keywords'];
  $cite_url   = SWB.'index.php?p=cite&id='.$biblio_id.'&keywords='.$settings['keywords'];  
  $title_link = '<a href="'.$detail_url.'" class="titleField" itemprop="name" property="name" title="'.__('View record detail description for this title').'">'.$title.'</a>';

  $output .= '<div class="content-title">';
  $output .= '<div class="content-title-main">';
  $output .= '<div class="biblioRecordTitle" itemscope itemtype="http://schema.org/Book" vocab="http://schema.org/" typeof="Book">';
  $output .= '<h4><a href="'.$detail_url.'">'.$title.'</a></h4>';
  $output .= '</div>';
  // cover images var
  $output .= '<div class="content-title-img">';
  $image_cover = '<img src="./lib/minigalnano/createthumb.php?filename=../../template/stack/asset/img/book.png&width=120">';
  if (!empty($biblio_detail['image']) && !defined('LIGHTWEIGHT_MODE')) {
    $biblio_detail['image'] = urlencode($biblio_detail['image']);
    $images_loc = '../../images/docs/'.$biblio_detail['image'];
    if ($sysconf['tg']['type'] == 'minigalnano') {
      $thumb_url = './lib/minigalnano/createthumb.php?filename='.urlencode($images_loc).'&width=120';
      $image_cover = '<img src="'.$thumb_url.'" class="img-thumbnail" itemprop="image" alt="'.$title.'" />';
    }
  }
  // concat author data
  $_authors = isset($biblio_detail['author'])?$biblio_detail['author']:biblio_list_model::getAuthors($dbs, $biblio_id, true);
  $authorTag = '<div class="author" itemprop="author" property="author" itemscope itemtype="http://schema.org/Person">&nbsp;<b style="padding-left:20px;">'.__('Author').'&nbsp;:&nbsp;</b>';
  if ($_authors) {
    $_authors_string = '';
    if (is_array($_authors)) {
      foreach ($_authors as $author) {
        $_authors_string .= '<span class="author-name" itemprop="name" property="name">'.$author.'</span> - ';  
      }
    } else {
      $_authors_string .= '<span class="author-name" itemprop="name" property="name">'.$_authors.'</span> - ';
    }
    $_authors_string = substr_replace($_authors_string, '', -2);
    $authorTag .= $_authors_string;
  }
  $authorTag .= '</div>';
  /* Call Num */
  $callNum_q = $dbs->query('SELECT call_number FROM biblio WHERE biblio_id = \''.$dbs->escape_string($biblio_id).'\'');
  $callNum_d = $callNum_q->fetch_row();
  $call_num  = '<div class="callNum">';
  $call_num .= '&nbsp;<b style="padding-left:20px;">'.__('Call Number').'&nbsp;:&nbsp;</b>'.$callNum_d[0];
  $call_num .= '</div>';
  /* Total item */
  // get total number of this biblio items/copies
  $_item_q = $dbs->query('SELECT COUNT(*) FROM item WHERE biblio_id='.$biblio_id);
  $_item_c = $_item_q->fetch_row();
  // get total number of currently borrowed copies
  $_borrowed_q = $dbs->query('SELECT COUNT(*) FROM loan AS l INNER JOIN item AS i'
    .' ON l.item_code=i.item_code WHERE l.is_lent=1 AND l.is_return=0 AND i.biblio_id='.$biblio_id);
  $_borrowed_c = $_borrowed_q->fetch_row();
  // total available
  $totItem = '';
  $_total_avail = $_item_c[0]-$_borrowed_c[0];
  if ($_total_avail < 1) {
    $totItem .= '<strong style="color: #f00;">'.__('none copy available').'</strong>';
  } else {
    $item_availability_message = str_replace('{numberAvailable}' , $_total_avail, __('{numberAvailable} copies available for loan'));
    $totItem .= $item_availability_message;
  }
  $totItem = '&nbsp;<b style="padding-left:20px;">Ketersediaan&nbsp;:&nbsp;</b>'.$totItem;
  /* Mark Biblio */
  $mark_tag = '';
  if (utility::isMemberLogin() && $settings['enable_mark']){
    $_i= rand(); // Add By Eddy Subratha
    $_check_mark = ' <input type="checkbox" id="biblioCheck'.$_i.'" name="biblio[]" class="biblioCheck" value="'.$biblio_id.'" />';

    $mark_tag  = '<div class="checkbox">';
    $mark_tag .= '<label>';
    $mark_tag .= $_check_mark;
    $mark_tag .= '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
    $mark_tag .= '<label>';
    $mark_tag .= '</div>';

  }
  $output .= $mark_tag;
  /* Social Media */
  // social buttons
  $sosmed = '';
  if ($sysconf['social_shares']) {
    $detail_url_encoded = urlencode('http://'.$_SERVER['SERVER_NAME'].$detail_url);
    $sosmed = '<div class="social-media" style="margin-left: 187px;margin-top: 10px;">
    Bagikan : 
    <a target="blank" href="http://www.facebook.com/sharer.php?u='.$detail_url_encoded.'" title="Facebook"><i class="fa fa-facebook"></i></a>
    &nbsp;<a target="blank" href="http://twitter.com/share?url='.$detail_url_encoded.'&text='.urlencode($title).'" title="Twitter"><i class="fa fa-twitter"></i></a>
    &nbsp;<a target="blank" href="https://plus.google.com/share?url='.$detail_url_encoded.'" title="Google Plus"><i class="fa fa-google-plus"></i></a>
    &nbsp;<a target="blank" href="http://www.digg.com/submit?url='.$detail_url_encoded.'" title="Digg It"><i class="fa fa-digg"></i></a>
    &nbsp;<a target="blank" href="http://reddit.com/submit?url='.$detail_url_encoded.'&title='.urlencode($title).'" title="Reddit"><i class="fa fa-reddit"></i></a>
    &nbsp;<a target="blank" href="http://www.linkedin.com/shareArticle?mini=true&url='.$detail_url_encoded.'" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
    &nbsp;<a target="blank" href="http://www.stumbleupon.com/submit?url='.$detail_url_encoded.'&title='.urlencode($title).'" title="Stumbleupon"><i class="fa fa-stumbleupon"></i></a>
    &nbsp;<a target="blank" href="https://web.whatsapp.com/send?text='.$detail_url_encoded.'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
    </div>';
  }
  /* Button */
  $btn  = '<div style="float:right;display: block;margin-left: 155px;margin-top: 30px;">';
  $btn .= '<a href="'.$detail_url.'" class="spc-btn btn btn-primary" style="margin-left: 243px;">Detail catuman</a>';
  $btn .= '&nbsp;<a target="blank" href="'.$detail_url.'&inXML=true" class="spc-btn btn btn-primary">XML Detail</a>';
  $btn .= '&nbsp;<a href="'.$cite_url.'" class="spc-btn btn btn-primary openPopUp citationLink" title="'.str_replace('{title}', substr($title, 0, 50) , __('Citation for: {title}')).'" target="_blank">'.__('Cite').'</a>';
  $btn .= '<br>'.$sosmed;
  $btn .= '</div>';
  /* Set out */
  $output .= $image_cover;
  $output .= '</div>';
  $output .= '<i style="color: #183e59;transform: rotate(45deg);font-size: 18pt;right: -29px;"class="fa fa-thumb-tack"></i><br>';
  $output .= $authorTag.$call_num.$totItem.$btn;
  $output .= '</div>';        
  $output .= '</div>';
  return $output;
}