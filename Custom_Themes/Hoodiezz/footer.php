<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.0
 */

?>
  <!-- #main -->

  <footer>
    <div id="footer" role="contentinfo">
        <div id="footerLinks">
          <a href="/subscribe/" class="btn">Subscribe Now</a>
        </div>
        <div id="footerLinks2">
            <a href="/about-us/" title="About">About</a><br>
            <a href="http://blog.hoodiezz.com/" title="Blog" target="_blank">Blog</a><br>
            <a href="/contact-us/" title="Contact Us">Contact Us</a><br>
            <!-- <a href="/sitemap.xml" title="Hoodiezz.com’s Hoodie Sitemap" target="_blank">Hoodiezz.com’s Hoodie Sitemap</a><br> -->
        </div>
    </div>
  </footer>
  <div class="showMobile">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Mall And Exclusive Page Bottom Ads -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:15px"
         data-ad-client="ca-pub-6878956929412680"
         data-ad-slot="7519353251"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </div>
  </div>

  <div class="mobileMenu">
    <ul>
      <li>
        <a href="/find-cool-outfits-for-women/">Women</a>
      </li>
      <li>
        <a href="/find-cool-outfits-for-men/">Men</a>
      </li>
      <li>
        <a href="/hoodie-designer/">Designer</a>
      </li>
      <li>
        <a href="/retailers/">Add Products to Hoodiezz</a>
      </li>
      <li>
        <a href="/about-us/">About Us</a>
      </li>
      <li>
        <a href="http://blog.hoodiezz.com" target="_blank">Blog</a>
      </li>
      <li>
        <a href="/contact-us/">Contact Us</a>
      </li>
    </ul>
  </div>

</div><!-- #wrapper -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58064985-1', 'auto');
  ga('send', 'pageview');

</script>
<?php
  /* Always have wp_footer() just before the closing </body>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to reference JavaScript files.
   */

  wp_footer();
?>

  </div>
	</body>
</html>