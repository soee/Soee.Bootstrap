<?php
namespace Soee\Bootstrap\DataSource;

use TYPO3\Neos\Exception;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\Flow\I18n\EelHelper\TranslationHelper;

/**
 * Class GridColumnOrderDataSource
 * @package Soee\Bootstrap\DataSource
 */
class GridColumnOrderDataSource extends AbstractGridColumnDataSource
{
    /**
     * @var string
     */
    static protected $identifier = 'soee-bootstrap-grid-column-order';

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
     * Generates array with column order options
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

        for($i=1; $i<=$gridSize; $i++) {
            $value = 'col-' . $device . '-push-' . $i;

            $options[$value] = [
                'label' => strtolower("$translatedLabel: _push $i / $gridSize"),
                'group' => $translatedLabel
            ];
        }

        for($i=1; $i<=$gridSize; $i++) {
            $value = 'col-' . $device . '-pull-' . $i;

            $options[$value] = [
                'label' => strtolower("$translatedLabel: _pull $i / $gridSize"),
                'group' => $translatedLabel
            ];
        }

        return $options;
    }
}
