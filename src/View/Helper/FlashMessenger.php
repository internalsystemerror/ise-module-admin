<?php

namespace IseAdmin\View\Helper;

use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\View\Helper\FlashMessenger as FlashMessengerHelper;

/**
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class FlashMessenger extends FlashMessengerHelper
{

    /**
     * {@inheritDoc}
     */
    protected $messageCloseString = '</li></ul></div>';

    /**
     * {@inheritDoc}
     */
    protected $messageOpenFormat = '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>';

    /**
     * {@inheritDoc}
     */
    protected $messageSeparatorString = '</li><li>';

    /**
     * Render messages
     */
    public function __toString()
    {
        $rendered       = '';
        $flashMessenger = $this->getPluginFlashMessenger();
        foreach ($this->classMessages as $namespace => $class) {
            if (!$flashMessenger->hasMessages($namespace)) {
                continue;
            }
            $classes = [
                'col-sm-3',
                'col-sm-offset-9',
                'col-lg-2',
                'col-lg-offset-10',
                'alert',
                'alert-dismissable',
                'alert-' . $class
            ];
            $rendered .= $this->render($namespace, $classes);
        }
        if ($rendered) {
            return '<div class="alert-notifications"><div class="container-fluid">' . $rendered . '</div></div>';
        }
        return $rendered;
    }

    /**
     * {@inheritDoc}
     */
    protected function renderMessages(
        $namespace = PluginFlashMessenger::NAMESPACE_DEFAULT,
        array $messages = [],
        array $classes = [],
        $autoEscape = null
    ) {
    

        // Select icon
        switch ($namespace) {
            case PluginFlashMessenger::NAMESPACE_INFO:
                $icon = 'info-sign';
                break;
            case PluginFlashMessenger::NAMESPACE_ERROR:
                $icon = 'remove';
                break;
            case PluginFlashMessenger::NAMESPACE_SUCCESS:
                $icon = 'ok';
                break;
            case PluginFlashMessenger::NAMESPACE_DEFAULT:
                $icon = 'question-sign';
                break;
            case PluginFlashMessenger::NAMESPACE_WARNING:
                $icon = 'warning-sign';
                break;
        }
        $icon = '<span class="glyphicon glyphicon-' . $icon . '"></span> ';

        // Append to messages
        $escapeHtml = $this->getEscapeHtmlHelper();
        foreach ($messages as &$message) {
            if ($autoEscape) {
                $message = $escapeHtml($message);
            }
            $message = $icon . $message;
        }

        return parent::renderMessages($message, $messages, $classes, false);
    }
}
