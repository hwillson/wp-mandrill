<?php

/*
 * Plugin Name: Simple WP Mandrill
 * Plugin URI: http://github.com/hwillson/wp-mandrill
 * Description: Simple (and performant) Mandrill WordPress plugin.
 * Version: 1.0.0
 * Author: hwillson
 * Author URI: http://github.com/hwillson/wp-mandrill
 * License: MIT
 */

require_once 'lib/mandrill-api-php/src/Mandrill.php';

define('MANDRILL_API_KEY', 'XXX');
define('MANDRILL_FROM_EMAIL', 'name@email.com');
define('MANDRILL_FROM_NAME', 'John Smith');

if (!function_exists('wp_mail')) {

  function wp_mail($to, $subject, $message, $headers = '') {

    $atts = apply_filters(
      'wp_mail', compact('to', 'subject', 'message', 'headers')
    );

    if (isset($atts['to'])) {
      $to = $atts['to'];
    }

    if (isset($atts['subject'])) {
      $subject = $atts['subject'];
    }

    if (isset($atts['message'])) {
      $message = $atts['message'];
    }

    if (isset( $atts['headers'])) {
      $headers = $atts['headers'];
    }

    $mandrill = new Mandrill(MANDRILL_API_KEY);
    $mandrill_msg = array(
      'html' => $message,
      'subject' => $subject,
      'from_email' => MANDRILL_FROM_EMAIL,
      'from_name' => MANDRILL_FROM_NAME
    );

    $emails = array();
    if (is_array($to)) {
      foreach ($to as $email) {
        $emails[] = array(
          'email' => $email
        );
      }
    } else {
      $emails[] = array(
        'email' => $to
      );
    }
    $mandrill_msg['to'] = $emails;

    $mandrill->messages->send($mandrill_msg);

  }

}
