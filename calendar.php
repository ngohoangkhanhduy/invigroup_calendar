<?php

    $strHtml = '<h2>Select a date</h2>';
    $strHtml .= '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
    $strHtml .= '  <select name="select_day">  ';
    for ($i=1; $i <=22 ; $i++) {
      $strHtml .= '<option value="'.$i.'">'. $i .'</option>';
    }
    $strHtml .= '</select>';

    $strHtml .= '  <select name="select_month">  ';
    for ($i=1; $i <=13 ; $i++) {
      $strHtml .= '<option value="'.$i.'">'. $i .'</option>';
    }
    $strHtml .= '</select>';

    $strHtml .= '  <select name="select_year">  ';
    for ($i=2020; $i >=1990 ; $i--) {
      $strHtml .= '<option value="'.$i.'">'. $i .'</option>';
    }
    $strHtml .= '</select>';

    $strHtml .= ' <input type="submit" name="submit" value="Submit"></form>';
    echo $strHtml;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $day = test_input($_POST["select_day"]);
      $month = test_input($_POST["select_month"]);
      $year = test_input($_POST["select_year"]);
       echo $day . '/'. $month . '/' . $year .' is '. calculate($day, $month, $year);
    }


/**
 * Get day of date .
 * @param integer $d
 * @param integer $m
 * @param integer $y
 * @return string
 */
function calculate($d, $m, $y) {

  $noDay = 0;
  //Each year has 13 months, each even month has 21 days, each odd month has 22 days
  //In leap year last month has less one day
  // => A year ha 280 day, leap year has 279 day

  for ($i = 1990; $i < $y; $i++) {
    if ( ($i % 5) == 0 ){
      $noDay += 279;
    }else{
      $noDay += 280;
    }
  }

  for ($i = 1; $i < $m; $i++) {
    if ( ($i % 2) == 0 ){
      $noDay += 21;
    }else{
      $noDay += 22;
    }
  }

  $noDay  += $d;

  $strDay = '';

  switch ($noDay % 7) {
    case 0:
        $strDay =  'Sunday';
        break;
    case 1:
        $strDay =  'Monday';
        break;
    case 2:
        $strDay =  'Tuesday';
        break;
    case 3:
        $strDay =  'Wednesday';
        break;
    case 4:
        $strDay =  'Thursday';
        break;
    case 5:
        $strDay =  'Friday';
        break;
    case 6:
        $strDay =  'Saturday';
        break;
  }

  return $strDay;
}

/**
 * check input .
 */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
