# Link Picker for CMB2

Link Picker control designed to work with CMB2.

![Link Picker for CMB2](https://github.com/mkdo/link-picker-for-cmb2/blob/master/assets/banner-1544x500.png?raw=true "Link Picker for CMB2")

## About

Using the Link Picker for [CMB2](https://wordpress.org/plugins/cmb2/) control, you can choose a link from your WordPress site, or manually enter a link. You can also identify if the link should open in a new window, or not.

**Features:**

* Easy to integrate with [CMB2](https://wordpress.org/plugins/cmb2/), just add a type of `link_picker`
* Works with repeatable groups
* Works as a repeatable field when `repeatable` is set to `true`
* Outputs an array of `text`, `url` and `blank` when using `get_post_meta`
* You are able to split the values of the field into individual parts by setting `split_values` to `true`. You can retrieve the split values by using the ID of the field and appending `_text`, `_url` and `_blank` to the ID when using `get_post_meta` (not compatible if using a repeatable field)

See usage examples under Installation.

## Installation

1. Download this repository and unzip it into the folder `link-picker-for-cmb2`
2. Upload the `link-picker-for-cmb2` folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. There are no settings for the plugin.  See examples below for usage.

Example metabox:

```
$cmb->add_field( array(
	'name' => __( 'Website URL', 'cmb2' ),
	'desc' => __( 'field description (optional)', 'cmb2' ),
	'id'   => $prefix . 'url',
	'type' => 'link_picker',
	'repeatable' => true,
	'split_values' => true  // default is false
) );
```

Example display:

```
$url = get_post_meta( $post_ID, '_yourprefix_url', true );


if ( 'true' == $url[0]['blank'] ) {
	$blank = ' target="_blank"';
} else {
	$blank = '';
}

printf(
	'<a href="%s"%s>%s</a>',
	esc_url( $url[0]['url'] ),
	$blank,
	esc_attr( $url[0]['text'] )
);
```

## Changelog

**1.0.0** - *11.07.2016* - First stable release.    
**1.0.1** - *14.07.2016* - Media assets error message fix  
**1.0.2** - *14.07.2016* - Updated responsiveness of control    
**1.0.3** - *21.08.2016* - Fixed JS issues (with thanks to   [sagetopia](https://profiles.wordpress.org/sagetopia/))     
**1.0.4** - *21.08.2016* - Control now works if editor not supported by post type    
**1.0.5** - *23.09.2016* - Fixed a bug where the link was getting added to the main content editor  
**1.1.0** - *27.01.2017* - JS Error free for 2017! - Squashed all those nasty JS console bugs   
**1.2.0** - *27.01.2017* - WP Coding Standards, We got em! - Now passes those pesky WP Coding Standards  
**1.2.1** - *17.03.2017* - Added new artwork  
