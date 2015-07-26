<?php
class Parser {

  public function parse($file_content) {
    $content = '';
    $lines = explode("\n", $file_content);

    $currentLineIndex = 0;
    $paragraphStart   = -1;
    $listStart          = -1;
    $listEnd            = -1;

    foreach ($lines as $key => $line) {
      $currentLineIndex = $key;
      // search file lines made by only dash (-)
      if (preg_match('/^[-]+$/', $line) || preg_match('/^[=]+$/', $line) ) {
        $content .= '<h1>' . $lines[$key-1] . '</h1>';
      }

      if (empty($line)) {
        // if line contains just a new line

        // store current index
        $paragraphStart = $key;

        // search for double \n to find the paragraph end
      }

      if (preg_match('/^#{2,}/', $line, $matches)) {
        // we'll not create a paragraph
        $paragraphStart = -1;

        // gets the number of #
        $order = strlen($matches[0]);

        // remove the #s and trim the line
        $text = trim(substr($line, $order));

        $content .= '<h' . $order . '>' . $text . '</h' . $order . '>';
      }

      if (preg_match('/^[*|-]/', $line, $matches)) {
        $paragraphStart = -1;

        if ($matches[0] === '*') {
          $listType = 'unordered';
        } else if ($matches[0] === '-') {
          $listType = 'ordered';
        }

        if ($listStart < 0) {
          $listStart = $key;

        } else if(array_key_exists($key+1, $lines) && empty($lines[$key+1])) {
          $listEnd = $key;
        }

      }

      if ($listStart>0 && $listEnd>$listStart && isset($listType)) {
        if ($listType === 'unordered') {
          $content .= '<ul>';
        } else if ($listType === 'ordered') {
          $content .= '<ol>';
        }

        for ($i=$listStart; $i<=$listEnd; $i++) {
          $item = trim(substr($lines[$i], 1));
          $content .= '<li>' . $item . '</li>';
        }

        if ($listType === 'unordered') {
          $content .= '</ul>';
        } else if ($listType === 'ordered') {
          $content .= '</ol>';
        }

        $listStart = -1;
        $listEnd   = -1;
      }

      if (array_key_exists($key+1, $lines) && empty($lines[$key+1]) && $paragraphStart>0) {
        // if next line also contains a new line we've got the end of the
        // paragraph

        $paragraphEnd = $key;
        $content .= '<p>';
        for ($i = $paragraphStart; $i<=$paragraphEnd; $i++) {
          // line contains a trailing \n. We need to add a space
          // to avoid that words get merged
          $content .= $lines[$i] . ' ';
        }
        $content .= '</p>';

        // just reset the paragraphStart
        $paragraphStart = -1;
      }

    }

    return $content;
  }

}

 ?>
