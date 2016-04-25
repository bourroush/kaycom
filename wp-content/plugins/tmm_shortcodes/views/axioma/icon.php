<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php


$css_styles = "";
$icon_styles = "";


// Font Weight
if (!empty($font_weight)) { $css_styles.= "font-weight: {$font_weight};"; }

if (!isset($icon_css_class)) { $icon_css_class = ""; }
if (!isset($icons_style)) { $icons_style = ""; }

// Icon BG Color for Circle Style
if (!empty($icon_bg_color) && $icons_style == 'circle-pic') {
	$icon_styles = "background-color: {$icon_bg_color}; color: {$icon_bg_color};";
}

// Icon BG Color for Small Circle Style
if (!empty($icon_bg_color) && $icons_style == 'small-circle-pic') {
	$icon_styles = "background-color: {$icon_bg_color};";
}

// Icon BG Color for Default Style
if (!empty($icon_bg_color) && $icons_style == 'default-pic') {
	$icon_styles = "color : {$icon_bg_color};";
}

$icon = "<i style='{$icon_styles}' class='{$icon_css_class} {$icons_style} shortcode_icon'></i>";

switch ($icons_style) {
	case 'circle-pic':
		
	// URL
	if (!empty($url)) {
		if (!empty($css_styles)) {
			echo "<a class='link-active' target='_blank' href='{$url}' style='{$css_styles}'>";
		} else {
			echo "<a class='link-active' target='_blank' href='{$url}'>";
		}
	}
			
		// Type
		if (empty($css_styles)) {
			echo "<{$type}> class='align-center'" . $icon;
		} else {
			echo "<{$type} class='align-center' style='{$css_styles}'>" . $icon;
		}

			// Text Content
			if (!empty($content)) {
				echo $content;
			}
			
		// Close Type
		if (isset($type)) {
			echo "</{$type}>";
		}
		
	if (!empty($url)) {
		echo "</a>";
	}
			
	if (!empty($text)) {
		echo "<div class='optional-text align-center'>$text</div>";
	}
	break;
	
	case 'small-circle-pic':
		
		// URL
		if (!empty($url)) {
			if (!empty($css_styles)) {
				echo "<a target='_blank' href='{$url}' style='{$css_styles}'>";
			} else {
				echo "<a target='_blank' href='{$url}'>";
			}
		}
	
		echo $icon;
		
		if (!empty($url)) {
			echo "</a>";
		}
	
	// Text
	if (!empty($text)) { 
		echo "<div class='optional-text scp'>";
	}

		// Type
		if (empty($css_styles)) {
			echo "<{$type}> ";
		} else {
			echo "<{$type} style='{$css_styles}'>";
		}

			// Text Content
			if (!empty($content)) {
				echo $content;
			}

		// Close Type
		if (isset($type)) {
			echo "</{$type}>";
		}

	// Close Text
	if (!empty($text)) {
		echo "<p>$text</p></div>";
	}			
		
	break;
	
	case 'default-pic':
		
	echo '<div class="default-pic-icon">' . $icon;	
	
		// Type
		if (empty($css_styles)) {
			echo "<{$type}> ";
		} else {
			echo "<{$type} style='{$css_styles}'>";
		}

			// URL
			if (!empty($url)) {
				if (!empty($css_styles)) {
					echo "<a target='_blank' href='{$url}' style='{$css_styles}'>";
				} else {
					echo "<a target='_blank' href='{$url}'>";
				}
			}

				// Text Content
				if (!empty($content)) {
					echo $content;
				}

			if (!empty($url)) {
				echo "</a>";
			}

		// Close Type
		if (isset($type)) {
			echo "</{$type}>";
		}

		// Text
		if (!empty($text)) {
			echo "<div class='optional-text'><p>$text</p></div>";
		}
	
	echo '</div>';
		
	break;
}
	

?>

 				
