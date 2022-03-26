<!-- Global site tag (gtag.js) - Google Analytics -->
<?php
$ga = getenv('GA_PROP');
if (empty($ga)) {
    return;
}
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ga; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', <?= json_encode($ga); ?>);
</script>

