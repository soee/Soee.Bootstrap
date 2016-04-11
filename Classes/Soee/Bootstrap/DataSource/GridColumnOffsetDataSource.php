<?php
namespace Soee\Bootstrap\DataSource;

use TYPO3\Neos\Exception;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\Flow\I18n\EelHelper\TranslationHelper;

/**
 * Class GridColumnOffsetDataSource
 * @package Soee\Bootstrap\DataSource
 */
class GridColumnOffsetDataSource extends AbstractGridColumnDataSource
{
    /**
     * @var string
     */
    static protected $identifier = 'soee-bootstrap-grid-column-offset';

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

        $data = [];

        foreach($this->settings['devices'] as $device => $deviceData) {
            $groupLabel = $deviceData['label'];
            $data += $this->getEditorValues($device, $groupLabel);
        }

        return $data;
    }

    /**
     * Generates array with column offset options
     *
     * @param string $device
     * @param string $label
     * @return array
     */
    public function getEditorValues($device, $label)
    {
        $gridSize = $this->settings['gridSize'] ?:12;
        $options = [];
        $translationHelper = new TranslationHelper();
        $translatedLabel = $translationHelper->translate($label);

        for($i=0; $i<=$gridSize; $i++) {
            $value = 'col-' . $device . '-offset-' . $i;
            $options[$value] = ['label' => strtolower("$translatedLabel: $i / $gridSize"), 'group' => $translatedLabel];
        }

        return $options;
    }
}
