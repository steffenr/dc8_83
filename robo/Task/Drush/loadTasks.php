<?php

namespace DrupalCenter\Robo\Task\Drush;

trait loadTasks {

  /**
   * Apply database updates.
   *
   * @return ApplyDatabaseUpdates
   */
  protected function taskDrushApplyDatabaseUpdates() {
    return new ApplyDatabaseUpdates();
  }

  /**
   * Apply entity schema updates.
   *
   * @return ApplyEntitySchemaUpdates
   */
  protected function taskDrushEntitySchemaUpdates() {
    return new ApplyEntitySchemaUpdates();
  }

  /**
   * Rebuild caches.
   *
   * @return CacheRebuild
   */
  protected function taskDrushCacheRebuild() {
    return new CacheRebuild();
  }

  /**
   * Import configuration.
   *
   * @return ConfigImport
   */
  protected function taskDrushConfigImport() {
    return new ConfigImport();
  }

  /**
   * Export configuration.
   *
   * @return ConfigExport
   */
  protected function taskDrushConfigExport() {
    return new ConfigExport();
  }

  /**
   * Enable extension(s).
   *
   * @param array $extensions
   *   An array of names for extensions to enable.
   *
   * @return EnableExtension
   */
  protected function taskDrushEnableExtension(array $extensions) {
    return new EnableExtension($extensions);
  }

  /**
   * Update localizations.
   *
   * @return LocaleUpdate
   */
  protected function taskDrushLocaleUpdate() {
    return new LocaleUpdate();
  }

  /**
   * Install Drupal site.
   *
   * @return SiteInstall
   */
  protected function taskDrushSiteInstall() {
    return new SiteInstall();
  }

  /**
   * Drop all database tables.
   *
   * @return SqlDrop
   */
  protected function taskDrushSqlDrop() {
    return new SqlDrop();
  }

  /**
   * Set a state value.
   *
   * @param string $key
   *   The state key.
   * @param mixed $value
   *   The value to assign to the state key.
   * @param string $format
   *   The type for the value. Use 'auto' to detect format from value. Other
   *   recognized values are 'string', 'integer', 'float' or 'boolean' for
   *   corresponding primitive type, or 'json', 'yaml' for complex types.
   *
   * @return StateSet
   */
  protected function taskDrushStateSet($key, $value, $format = 'auto') {
    return new StateSet($key, $value, $format);
  }

  /**
   * Display one-time login URL.
   *
   * @param int|string $user
   *   An optional uid, user name, or email address for the user to log in
   *   (defaults to user ID '1').
   *
   * @return UserLogin
   */
  protected function taskDrushUserLogin($user = 1) {
    return new UserLogin($user);
  }

}
