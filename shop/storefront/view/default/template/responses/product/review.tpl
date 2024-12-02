<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="content"><b><?php echo $review['author']; ?></b> | <img src="<?php echo $this->templateResource('/image/stars_'.$review['rating'] . '.png'); ?>" alt="<?php echo $review['stars']; ?>" width="64" height="12" /><br />
	<?php echo $review['date_added']; ?>&nbsp <?php if ($review['verified_purchase']) { ?><span class="verified_review"><?php echo $this->language->get('text_verified_review'); ?></span> <?php } ?><br />
  <br />
  <?php echo $review['text']; ?></div>
<?php } ?>
<div class="pagination"><?php echo $pagination_bootstrap; ?></div>
<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
