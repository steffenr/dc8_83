<?php

namespace Drupal\dc_migrate;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages DrupalCenter migrate processors.
 *
 * @see hook_dc_migrate_processor_info_alter()
 * @see \Drupal\dc_migrate\Annotation\DcMigrateProcessor
 * @see \Drupal\dc_migrate\Plugin\DcMigrateProcessorInterface
 * @see \Drupal\dc_migrate\Plugin\DcMigrateProcessorBase
 * @see plugin_api
 */
class DcMigrateProcessorPluginManager extends DefaultPluginManager {

  /**
   * Constructs a DcMigrateProcessorPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/DcMigrateProcessor', $namespaces, $module_handler, 'Drupal\dc_migrate\Plugin\DcMigrateProcessorInterface', 'Drupal\dc_migrate\Annotation\DcMigrateProcessor');
    $this->alterInfo('dc_migrate_processor_info');
    $this->setCacheBackend($cache_backend, 'dc_migrate_processor_plugins');
  }

  /**
   * Get a list of all registerd processor plugin instances.
   *
   * @return \Drupal\dc_migrate\Plugin\DcMigrateProcessorInterface[]
   *   List of processor plugin instances.
   */
  public function getProcessors() {
    $instances = &drupal_static(__FUNCTION__, []);
    if (empty($instances)) {
      // Get registered processor plugins.
      $processors = $this->getDefinitions();
      uasort($processors, array('Drupal\Component\Utility\SortArray', 'sortByWeightElement'));
      foreach ($processors as $plugin_id => $processor) {
        // Execute the processor plugin.
        $instances[$plugin_id] = $this->createInstance($plugin_id, $processor);
      }
    }

    return $instances;
  }

  /**
   * Get the instance of a specific processor.
   *
   * @param string $id
   *   The plugin ID of the processor.
   *
   * @return \Drupal\dc_migrate\Plugin\DcMigrateProcessorInterface
   *   The processor instance or NULL if no processor with the given ID exists.
   */
  public function getProcessor($id) {
    $processors = $this->getProcessors();
    return isset($processors[$id]) ? $processors[$id] : NULL;
  }

}
