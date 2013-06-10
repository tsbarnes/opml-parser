<?php
  function parse_outlines($outline_set) {
    foreach($outline_set as $outline) {
      switch($outline['type']) {
        case 'rss':
          echo $outline['title'] . "\t" . $outline['xmlUrl'] . "\n";
          break;
        default:
          parse_outlines($outline->outline);
          break;
      }
    }
  }

  $opml = simplexml_load_file("subscriptions.xml");
  if($opml === false) {
    foreach(libxml_get_errors() as $error) {
      error_log($error);
    }
    die;
  }
  parse_outlines($opml->body->outline);
?>