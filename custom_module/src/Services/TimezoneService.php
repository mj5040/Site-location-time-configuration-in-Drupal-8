<?php

namespace Drupal\custom_module\Services;

use Drupal\Core\Datetime\DateFormatterInterface;

/**
 * Class TimezoneService
 */
class TimezoneService  implements TimezoneInterface {
  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs Timezone
   * 
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter.
   */
  public function __construct(DateFormatterInterface $date_formatter) {
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */  
  public function getTimeByTimezone() {
    $timeZone = \Drupal::config('custom.adminsettings')->get('timezone'); 
    $formatted = $this->dateFormatter->format(time(), 'custom', 'jS M Y - h:i A', $timeZone);    
    return $formatted;
  }
}