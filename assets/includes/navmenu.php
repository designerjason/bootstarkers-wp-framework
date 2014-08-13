<nav class="nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
<div class="wrapper">
    <?php wp_nav_menu( array( 
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'nav-inner',
        'depth' => 2
    ) ); ?>
</div>
</nav>