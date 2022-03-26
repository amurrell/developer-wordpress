<?php

if (!$data) {

    the_post();

    $data = (object) [
        'title' => get_the_title(),
        'content' => apply_filters('the_content', get_the_content()),
    ];

}

?>

<div class="page">
	<div class="page-container">
		<h1>
			<?= $data->title; ?>
		</h1>

		<?php render('/src/templates/page/content/content.php', $data); ?>

	</div>
</div>
