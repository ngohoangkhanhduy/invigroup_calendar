<?php

namespace Drupal\invigroup_calendar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form get day by the date.
 */
class getDayForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'getday_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $selectDay = [];
    for ($i=1; $i <=22 ; $i++) {
      $selectDay[$i] = $i;
    }

    $selectMonth = [];
    for ($i=1; $i <=13 ; $i++) {
      $selectMonth[$i] = $i;
    }

    $selectYear = [];
    for ($i=2020; $i >=1990 ; $i--) {
      $selectYear[$i] = $i;
    }

    $form['datetime_field'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Select date'),
    ];

    $form['datetime_field']['select_day'] = [
      '#type' => 'select',
      '#title' => $this->t('Day: '),
      '#options' => $selectDay
      ];

      $form['datetime_field']['select_month'] = [
        '#type' => 'select',
        '#title' => $this->t('Month: '),
        '#options' => $selectMonth
      ];
      $form['datetime_field']['select_year'] = [
        '#type' => 'select',
        '#title' => $this->t('Year: '),
        '#options' => $selectYear
        ];
    $form['submit'] = array(
          '#type' => 'submit',
          '#value' => $this->t('Submit'),
        );
        return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     $day   = $form_state->getValue('select_day');
     $month = $form_state->getValue('select_month');
     $year  = $form_state->getValue('select_year');

     $noday = $this->calculate($day,$month,$year);
     $message = $this->t('@day/@month/@year is @noday',['@day'=>$day, '@month'=>$month, '@year'=>$year,'@noday'=>$noday ]);
     $this->messenger()->addMessage($message);
     return;
  }

  /**
   * Get day of date .
   * @param integer $d
   * @param integer $m
   * @param integer $y
   * @return string
   */
  public function calculate($d, $m, $y) {

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

}
