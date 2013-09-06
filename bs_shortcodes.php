<?php

// Add Shortcode
function bootstrap_label() {

  // Code
  return '<span class="label-default">Default</span>';
}
add_shortcode( 'label', 'bootstrap_label' );

function bootstrap_label_primary() {

  // Code
  return '<span class="label label-primary">Primary</span>';
}
add_shortcode( 'label-primary', 'bootstrap_label_primary' );

function bootstrap_label_success() {

  // Code
  return '<span class="label label-success">Success</span>';
}
add_shortcode( 'label-success', 'bootstrap_label_success' );

function bootstrap_label_warning() {

  // Code
  return '<span class="label label-warning">Warning</span>';
}
add_shortcode( 'label-warning', 'bootstrap_label_warning' );

function bootstrap_label_danger() {

  // Code
  return '<span class="label label-danger">Danger</span>';
}
add_shortcode( 'label-danger', 'bootstrap_label_danger' );

function bootstrap_label_info() {

  // Code
  return '<span class="label label-info">Info</span>';
}
add_shortcode( 'label-info', 'bootstrap_label_info' );

/*
 * bs_label
 */
function bs_label( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<span class="label label-' . $type . '">' . do_shortcode( $content ) . '</span>';

}
// add_shortcode('label', 'bs_label' );

/*
 * bs_panel
 */
function bs_panel( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type',
      "title" => ''
    ), $atts));

    return '<div class="panel panel-' . $type . '">' .
    '<div class="panel-heading"' .
      '<h3 class="panel-title">' . $title . '</h3>' .
    '</div>' .
      '<div class="panel-body">' . do_shortcode( $content ) . '</div>' .
    '</div>';

}
add_shortcode('panel', 'bs_panel' );

// Add Shortcode
function bs_alert( $atts , $content = null ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'type' => '',
    ), $atts )
  );

  if($type) {
    $html = '<div class="alert alert-' . $type . '">' . $content . '</div>';
  } else {
    $html = '<div class="alert">' . $content . '</div>';
  }
  // Code
  return $html;
}
add_shortcode( 'alert', 'bs_alert' );

/*
 * bs_button
 */
function bs_button($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => '',
        "xclass" => ''
     ), $atts));
     return '<a href="' . $link . '" class="btn btn-' . $type . ' btn-' . $size . ' ' . $xclass . '">' . do_shortcode( $content ) . '</a>';
}
// add_shortcode('button', 'bs_button' );

// function bs_tooltip($atts, $content = null) {
//  extract(shortcode_atts(array(
//          "title" => 'title',
//          "toggle" => 'tooltip',
//          "position" => 'above'
//  ), $atts));
//  return '<a href="#" data-toggle="tooltip" title="' . $title . '">' . do_shortcode( $content ) . '</a>';
// }
add_shortcode('tooltip', 'bs_tooltip' );

function bs_tooltip( $atts, $content = null ) {

  $defaults = array(
  'title' => '',
  'placement' => 'top',
  'animation' => 'true',
  'html' => 'false'
  );
  extract( shortcode_atts( $defaults, $atts ) );

  wp_enqueue_script( 'bootstrap-shortcodes-tooltip',
                    get_template_directory_uri().'/assets/js/bootstrap-shortcodes-tooltip.js',
                    array( 'jquery' ), false, true );

  return '<a href="#" class="bs-tooltip" data-toggle="tooltip"
            title="' . $title . '"
            data-placement="' . $placement . '"
            data-animation="' . $animation . '"
            data-html="' . $html . '">' .
            do_shortcode( $content ) .
        '</a>';
}

// Add Shortcode
function bs_icon( $atts ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'glyph' => '',
      'style' => '',
    ), $atts )
  );

  $html = '<i class="glyphicon glyphicon-' . $glyph . '"></i>';
  // Code
  return $html;
}
add_shortcode( 'icon', 'bs_icon' );

function bs_code($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => ''
     ), $atts));
     return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
}
add_shortcode('code', 'bs_code' );

function bs_collapse( $atts, $content = null ) {

    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else
      $GLOBALS['current_collapse']++;


    $defaults = array( 'title' => 'Tab', 'state' => '');
    extract( shortcode_atts( $defaults, $atts ) );

    if (!empty($state))
      $state = 'in';

    return '
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['current_collapse'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
          ' . $title . '
        </a>
      </div>
      <div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="accordion-body collapse ' . $state . '">
          <div class="panel-body">
          ' . $content . '
        </div>
      </div>
    </div>
    </div>
    ';
  }
add_shortcode('bs_collapse', 'bs_collapse' );
