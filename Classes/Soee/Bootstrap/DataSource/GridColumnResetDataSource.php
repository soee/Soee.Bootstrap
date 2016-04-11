<?php
namespace Soee\Bootstrap\DataSource;

use TYPO3\Neos\Exception;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\Flow\I18n\EelHelper\TranslationHelper;

/**
 * Class GridColumnResetDataSource
 * @package Soee\Bootstrap\DataSource
 */
class GridColumnResetDataSource extends AbstractGridColumnDataSource
{
    /**
     * @var string
     */
    static protected $identifier = 'soee-bootstrap-grid-column-reset';

    /**
     * Get data
     *
     * @param NodeInterface $node The node that is currently edited (optional)
     * @param array $arguments Additional arguments (key / value)
     * @return array JSON serializable data
     * @throws Exception
     */
    public function getData(NodeInterface $node = NULL, array $arguments)
    {
        $this->validateSettings();

        $data = $this->getEditorValues($this->settings['devices']);

        return $data;
    }

    /**
     * Generates array with column reset options
     *
     * @param array $devices
     * @return array
     */
    public function getEditorValues($devices)
    {
        $options = [];
        $translationHelper = new TranslationHelper();

        // .hidden-*-down first
        foreach ($devices as $device => $deviceData) {
            $label = $deviceData['label'];
            $options['hidden-' . $device . '-down'] = ['label' => '_hidden ' . $translationHelper->translate($label) . ' down'];
        }

        // .hidden-*-up first
        foreach ($devices as $device => $deviceData) {
            $label = $deviceData['label'];
            $options['hidden-' . $device . '-up'] = ['label' => '_hidden ' . $translationHelper->translate($label) . ' up'];
        }

        return $options;
    }
}
