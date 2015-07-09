<header class="l-header-wrapper">
  <div class="l-header" role="banner">
    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
    <?php endif; ?>
    <?php if ($site_name || $site_slogan): ?>
      <hgroup>
        <?php if ($site_name): ?>
          <h1 class="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup>
    <?php endif; ?>
    <?php print render($page['branding']); ?>
  </div>
</header>

<div class="l-content-wrapper">

  <section class="l-content">
    <?php print render($page['pre_content']); ?>
    <div class="l-region l-content-main" role="main">
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <?php if ($next): ?>
          <?php print $next; ?>
        <?php endif; ?>
        <h1><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>
    <?php print render($page['post_content']); ?>
    <?php print render($page['actions']); ?>
  </section>

  <?php if ($page['sidebar_first']): ?>
  <aside class="l-sidebar">
    <?php print render($page['sidebar_first']); ?>
  </aside>
  <?php endif; ?>

</div>

<div class="l-footer-wrapper">
  <footer class="l-footer">
    <?php print render($page['footer']); ?>
  </footer>
</div>
<div class="l-footer-bottom-wrapper">
  <footer class="l-footer-bottom">
    <?php print render($page['footer_bottom']); ?>
  </footer>
</div>
