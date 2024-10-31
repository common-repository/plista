=== plista ===
Tags: advertising, recommendations, plista, similar items, ads, related articles
Donate link: http://www.plista.com
Contributors: plista.com
Text Domain: plista
Requires at least: 3.0.0
Tested up to: 4.7.1
Stable tag: 1.5.10

The plista Widget adds plista RecommendationAds to your Wordpress blog posts.

== Description ==

= Advantages =

- First advertising format with visitors Value
- Increase traffic and sales
- Increase of user Session Duration
- Free and easy Registration
- No contract term

The new preference based plista advertising format offers an innovative solution for publishers to promote their products and websites with much better efficiency.
You can showcase user-specific content in a relevant context with our advertising format 
The key technology of plista filters content across your sites and determines its relevance.
Visitors to your website, only get recommendations based on individual preferences which allow precise targeting for publishers.

= Translations =

* Spanish (es_ES) - Ramon Navarro
* English (en_GB) - plista

== Premises ==

PHP5 is required for the use of this Plugin

== Installation == 

= For just one widget, without own positioning =
1.	Log in in Wordpress 
2.	Go to menu „Plugins“
3.	Click on „Install“
4.	Search for „plista“ in the top right corner on the site
5.	Click on „install now“ and wait a seconds to click on activate the plugin
6.	If you don’t have an account at plista yet you have to register here: [contact page](https://www.plista.com/publisher/contact-publisher/)
7.	In wordpress you have to go to settings > plista and type in the information you have received from plista
8.	If you want to position the widget your own, you have to use Shorttags

= Shorttags for own positioning for one or more widgets =
* Shortcode options have to be activated
 * Activate shortcode checkboxes
 * Got to Design/Appereance > Editor > single.php
 * Put in the following code whereever you want to position the widget

>`<?php echo do_shortcode( '[plista widgetname=plista_widget_belowArticle_test]' ); ?>`

The name of the widget, here : 'plista_widget_belowArticle_test', is an information that you received from plista

* Outstream Ads
Put in the following div for the outstream video ad:

>`<div data-widget="plista_widget_outstream"></div>`

== Frequently Asked Questions ==
= Where do I get the "name of the widget" and the "public key" required for the settings of the plugin? =
The "name of the widget" and the "public key" are available after registration on [contact page](https://www.plista.com/publisher/contact-publisher/)
These details are also available on the Publisher Dashboard in [Planet](https://planet.plista.com/)
Click the icon in the "integration" column and you will get all the necessary information displayed.

= Why are no Ads displaying on my Website? =
Ads are only unlocked after a more detailed check of your Website from plista. 
This check usually happens within a few working days. In any case, you will be notified. 

= Why is the Message "plista has been successfully installed" displayed? =
This Message will disappear after we have received about 10 items from your site.

For more questions please visit our FAQ's: [FAQ for Publishers](https://www.plista.com/publisher/publisher-faq/)

== Upgrade Notice ==

Please upgrade to Version 1.5.10

== Screenshots ==

1. Plista presentation
2. Recommendation widget
3. plista Adminpage

== Changelog ==

1.0 @ 09-22-2011
    * first official release

1.1 @ 09-23-2011
    * major relase

1.2 @ 10-05-2011
    * better handling for img indexing
    * english translation v1

1.2.1 @ 10-31-2011
    * fixes picture related bugs

1.3.0 @ 12-07-2011
    * use wp_head to set custom css
    * improved styles for admin page
    * possibility to change widget style for mobile design (wp touch required)
    * possibility to set a default image

1.3.1 @ 12-08-2011
    * plista_integration function is no global available

1.3.2 @ 01-04-2012
    * fix css bugs
    * added new possibilities to style the widget
    * added possibility to exclude categories for pictureAds
    * tested functionality width WordPress 3.3.1

1.3.3 @ 01-27-2012
    * change order of image indexing
    * added Spanish translations
    * jslint javascript used for admin page
    * added notice to contact plista before activating pictureAds
    * added possibility to exclude tags

1.3.4 @ 01-30-2012
    * fix warning if no tags are available

1.3.5 @ 02-07-2012
    * don't look for youtube image if no youtube video is present

1.3.6 @ 24-03-2014
    * remove PHP version in comment tag

1.4.0 @ 16-04-2015
    * use the async version of plista
    * add option to exclude post types
    * index created_at and category
    * remove picture ads
    * don't index pages if user is logged in and previews site

1.5.0 @ 20-01-2016
    * title and text are now limited to 255 characters
    * plista::init() is no longer called statically
    * created_at is now named published_at and will no longer return “false”
    * new option to define image size
    * added shorttag feature with new additional parameters
    * new parameter updated_at
    * fixed problem with too many tags on the Options page

1.5.1 @ 26-01-2016
    * Fix warning if image sizes not defined

1.5.2 @ 23-11-2016
    * Fix json_encode($plista_data) when data is empty

1.5.3 @ 29-11-2016
    * Fix item push

1.5.4 @ 19-01-2017
    * Make all plista plugin functions static

1.5.5 @ 25-01-2017
    * Fix undefined variable imgsrc

1.5.6 @ 27-01-2017
    * Fix Javascript exceptions in plista-admin.js

1.5.7 @ 21-02-2017
    * Add input for plista origin in the plugin settings

1.5.8 @ 06-03-2017
    * Add input for plista origin in the plugin settings

1.5.9 @ 19-06-2017
    * Add single page website option

1.5.10 @ 22-09-2017
    * Update readme.txt