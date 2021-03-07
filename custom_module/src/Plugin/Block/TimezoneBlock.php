<?php

namespace Drupal\custom_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_module\Services\TimezoneInterface;

/**
 * Provides a 'Timezone' Block.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone block"),
 * )
 */
class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /*
   * @var \Drupal\custom_module\Services\TimezoneInterface $timeZone
   */
  protected $timeZone;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\custom_module\Services\TimezoneInterface $timeZone
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition,TimezoneInterface $timeZone) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timeZone = $timeZone;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('custom_module.timezone_services')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {    
    $current_time = $this->timeZone->getTimeByTimezone();    
    $timezoneSettings = \Drupal::config('custom.adminsettings');     
    $country = $timezoneSettings->get('country');
    $city = $timezoneSettings->get('city');
    return [      
      '#theme' => 'timezone_template',
      '#current_time' => $current_time,
      '#country' => $country,
      '#city' => $city,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), array('config:custom.adminsettings','backend_overridable'));
  }    
}
