<?php
namespace Soee\Bootstrap\DataSource;

use TYPO3\Neos\Exception;
use TYPO3\Neos\Service\DataSource\AbstractDataSource;

/**
 * Class AbstractGridColumnDataSource
 * @package Soee\Bootstrap\DataSource
 */
abstract class AbstractGridColumnDataSource extends AbstractDataSource
{
    /**
     * @var array
     */
    protected $settings;

    /**
     * Soee.Bootstrap settings
     *
     * @param array $settings
     */
    public function injectSettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Validates required settings
     *
     * @throws Exception
     */
    protected function validateSettings()
    {
        if (empty($this->settings['devices']) || !is_array($this->settings['devices'])) {
            throw new Exception('Sorry, `Soee.Bootstrap.devices` settings are missing. Please check Settings.yaml file!', 1706555463);
        }
    }
}
