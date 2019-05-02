<!-- 
	Modified from SLiMS defaul template, detail_template.php
-->
<div class="content-title-2">
	<!-- GMD Name -->
	<h3><?php echo $gmd_name ?></h3>
	<!-- Title -->
	<div itemprop="name" property="name">
		<h4 style="font-weight:bold"><?php echo $title;?></h4>
	</div>
	<!-- Author -->
	<div itemprop="author" property="author" itemscope itemtype="http://schema.org/Person">
		<?php echo  $authors;?>
	</div>
	<!-- Notes -->
	<div class="notes">
		<?php if($notes) : ?>
		 	<p style="text-align: justify !important; font-family:  sans-serif;"><?php echo $notes ?></p>
		<?php else : ?>
			<em><?php echo __('Description Not Available'); ?></em>
		<?php endif; ?>
	</div>
	<!-- Availibility -->
	<div class="availibility">
		<h3><i class="fa fa-plus-square-o"></i>&nbsp;<?php echo __('Availability'); ?></h3>
		<?php echo ($availability) ? $availability : '<p class="s-alert">'.__('No copy data').'</p>'; ?>
	</div>
	<!-- Detail infp -->
	<div class="detailInfo">
		<h3><i class="fa fa-file-text-o"></i>&nbsp; <?php echo __('Detail Information'); ?></h3>
		<!-- Series title -->
		<span><?php echo __('Series Title'); ?></span>
		<div itemprop="alternativeHeadline" property="alternativeHeadline"><?php echo ($series_title) ? $series_title : '-'; ?></div>
		<!-- Call Number -->
		<span><?php echo __('Call Number'); ?></span>
		<div><?php echo ($call_number) ? $call_number : '-'; ?></div>
		<!-- Publisher -->
		<span><?php echo __('Publisher'); ?></span>
		<div class="publisher-child">
		  <span itemprop="publisher" property="publisher" itemtype="http://schema.org/Organization" itemscope><label><?php echo __('Publisher Name');?></label>&nbsp;:&nbsp;<?php echo $publisher_name ?></span>
          <span itemprop="publisher" property="publisher"><label><?php echo __('Publish place');?></label>&nbsp;:&nbsp;<?php echo $publish_place ?></span>
          <span itemprop="datePublished" property="datePublished"><label><?php echo __('Publish year');?></label>&nbsp;:&nbsp;<?php echo $publish_year ?></span>
		</div>
		<!-- Collation -->
		<span><?php echo __('Collation'); ?></span>
		<div itemprop="numberOfPages" property="numberOfPages"><?php echo ($collation) ? $collation : '-'; ?></div>
		<!-- Language -->
		<span><?php echo __('Language'); ?></span>
		<div><meta itemprop="inLanguage" property="inLanguage" content="<?php echo $language_name ?>" /><?php echo ($language_name) ? $language_name : '-';?></div>
		<!-- ISBN -->
		<span><?php echo __('ISBN/ISSN'); ?></span>
		<div itemprop="isbn" property="isbn"><?php echo ($isbn_issn) ? $isbn_issn : '-'; ?></div>
		<!-- Classification -->
		<span><?php echo __('Classification'); ?></span>
		<div><?php echo ($classification) ? $classification : '-'; ?></div>
		<!-- Content Type -->
		<span><?php echo __('Content Type'); ?></span>
		<div itemprop="bookFormat" property="bookFormat"><?php echo ($content_type) ? $content_type : '-'; ?></div>
		<!-- Media Type -->
		<span><?php echo __('Media Type'); ?></span>
		<div itemprop="bookFormat" property="bookFormat"><?php echo ($media_type) ? $media_type : '-'; ?></div>
		<!-- Carrier Type -->
		<span><?php echo __('Carrier Type'); ?></span>
		<div itemprop="bookFormat" property="bookFormat"><?php echo ($carrier_type) ? $carrier_type : '-'; ?></div>
		<!-- Edition -->
		<span><?php echo __('Edition'); ?></span>
		<div itemprop="bookEdition" property="bookEdition"><?php echo ($edition) ? $edition : '-'; ?></div>
		<!-- Subject -->
		<span><?php echo __('Subject(s)'); ?></span>
		<div class="s-subject" itemprop="keywords" property="keywords"><?php echo ($subjects) ? $subjects : '-'; ?></div>
		<!-- Specific Detail Info -->
		<span><?php echo __('Specific Detail Info'); ?></span>
		<div><?php echo ($spec_detail_info) ? $spec_detail_info : '-'; ?></div>
		<!-- Statement of Responsibility -->
		<span><?php echo __('Statement of Responsibility'); ?></span>
		<div itemprop="author" property="author"><?php echo ($sor) ? $sor : '-';  ?></div>
	</div>
	<!-- Related biblio data -->  
	<h3><i class="fa fa-circle-o"></i> <?php echo __('Other version/related'); ?></h3>
	<?php echo ($related) ? $related : '<p class="s-alert">'.__('No other version available').'</p>'; ?>
	<!-- Attachment-->  
	<?php if ($file_att) : ?>
  	<h3><i class="fa fa-arrow-circle-o-down"></i> <?php echo __('File Attachment'); ?></h3>
  	<div itemprop="associatedMedia">
    	<div class="s-download">
      		<?php echo $file_att; ?>
    	</div> 
  	</div>
  	<?php endif; ?>
  	<!-- Comment -->  
  	<?php if(isset($_SESSION['mid']) && $sysconf['comment']['enable']) : ?>
  	<h3><i class="fa fa-comments-o"></i> <?php echo __('Comments'); ?></h3>
  	<?php echo showComment($biblio_id); ?>
  	<?php endif; ?>
</div>
<?php 
/* Change book cover if not exist */
if (preg_match('/\balt="No image\b/',$image)) {
   $image = '<img src="./template/stack/asset/img/book.png" alt="No Book" style="width:200px;height:264px;"/>';
}
?>
<script type="text/javascript">
	/* Set cover via jquery */
	$('.cover').html('<?php echo $image;?>');
</script>