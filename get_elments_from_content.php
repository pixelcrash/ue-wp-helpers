<?php
          $content = wpautop(get_the_content());
          $dom = new DOMDocument();
          $dom->encoding = 'utf-8';
          $dom->loadHTML( utf8_decode( $content ) );
          $lines = array();
          //$dom->loadHTML($content);
          foreach($dom->getElementsByTagName('p') as $node)
          {

              $lines[] = $dom->saveHTML($node);

          }
          
          $numP = count($lines);
          
?>
