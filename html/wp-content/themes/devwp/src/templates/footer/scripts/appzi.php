<!-- Appzi -->
<?php

$appzi_id = !empty(getenv('APPZI_ID')) ? getenv('APPZI_ID') : '';
if (empty($appzi_id)) {
  return;
}
?>
<script type="text/javascript" src="<?php echo 'https://w.appzi.io/bootstrap/bundle.js?token=' . $appzi_id; ?>">
</script>
