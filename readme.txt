=== Banner Rotator XML v4 ===
Contributors: flashblue
Tags: banner, rotator, xml, slide, slideshow, as3, flashblue, html, content, x, y, position, jpg, gif, png, swf, random, radius, url, link, timer, target, order, clock, left, center, right
Requires at least: 2.8.0
Tested up to: 3.0.2
Stable tag: trunk

XML driven flash banner / image rotator with tile animation effect.

== Description ==

Features included:

* XML driven flash image / picture / photo banner rotator
* Displays JPG images, GIF images, PNG images and SWF files
* All data can be changed in the XML file
* Supports multiple banners, can display swf and / or image files
* Time period for each banner is set in the XML file (second based)
* Timer clock to display elapsed time period
* Auto play option to play banner rotator automatically according to the timer or manually change items by clicking on buttons
* Image names / paths set in XML file
* URL links & targets for each banner when pressed set in XML file
* Rounded corner radius for soften edges
* You can show / hide buttons
* You can change buttons, timer clock horizontal positions to "left | center | right", vertical positions to "top, center, bottom"
* You can set image order random from XML (randomize="true")
* You can change animation options (tile direction, tile number, animation time, transition type, matrix effect and more...) for both images & contents from XML
* If you write type="alpha" on item animation, fade transition runs instead of tiles
* Special / accent characters are supported
* X-Y positions of contents set in XML
* Content font, background alpha, colors set in XML
* You can set bg alpha 0 for transparent texts
* Content background radius for oval background
* Includes WordPress plugin & Joomla module
* Supports HTML formatting
* Includes a html swfObject embed example with parameters
* Help file is included

== Installation ==

Make sure your Wordpress version is greater than 2.8 and your hosting provider is using PHP5.

1. Create a new folder inside your **wp-content** folder called **flashdo**, inside this folder create a new one called **flashblue**, inside this folder create a new one called **banner-rotator-xml-v4** and copy files under **deploy** folder there
2. If you copied the **deploy** to a location different than the one above, go to **Banner Rotator XML v4** from the **Settings** tab in your **WordPress Dashboard** and update the path accordingly
3. Add `[banner-rotator-xml-v4][/banner-rotator-xml-v4]` where you want the Flash to show up in your post/page
4. If you want to make the Banner Rotator XML v4 part of your theme, edit the template files and add `<?php bannerrotatorxmlv4_echo_embed_code(); ?>` where you want it to show up
5. Modify the `banner.xml` content and use it to overwrite `wp-content/flashdo/flashblue/banner-rotator-xml-v4/xml/banner.xml`
6. To use your own images / swf, upload them to `wp-content/flashdo/flashblue/banner-rotator-xml-v4/images/`

= Additional settings file =

To embed the Banner Rotator XML v4 more than once, you will need another settings file. Let's assume your new file is called `banner2.xml`. Add `[banner-rotator-xml-v4 xmlUrl="xml/banner2.xml"][/banner-rotator-xml-v4]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the file name as **the first argument** of the `bannerrotatorxmlv4_echo_embed_code()` function call (for example `<?php bannerrotatorxmlv4_echo_embed_code("xml/banner2.xml"); ?>`).

= No Flash support text =

To support visitors without Adobe Flash Player, you can provide alternative content by adding the text between `[banner-rotator-xml-v4]` and `[/banner-rotator-xml-v4]`. If you made the Flash part of your theme, add the text as **the second argument** of the `bannerrotatorxmlv4_echo_embed_code()` function call (for example `<?php bannerrotatorxmlv4_echo_embed_code("","Alternative content"); ?>`).

= If you have PHP4 =

To make it work with PHP4, add `[banner-rotator-xml-v4 width="590" height="300"][/banner-rotator-xml-v4]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the width and height as **the third and fourth argument** of the `bannerrotatorxmlv4_echo_embed_code()` function call. Don't forget to provide your own width and height values, since 590 and 300 are just examples.

== Screenshots ==

1. You can view the live demo on [flashdo.com](http://www.flashdo.com/item/banner-rotator-xml-v4/836 "Banner Rotator XML v4") for Banner Rotator XML v4.