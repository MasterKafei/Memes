<?php

namespace AppBundle\Service\Util\Console\Model;

/**
 * Class Message
 * @package AppBundle\Service\Util\Console\Model
 */
class Message
{
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_DANGER = 'danger';

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $icon;

    /**
     * Message constructor.
     *
     * @param string $text
     * @param string $type
     * @param string $icon
     */
    public function __construct($text, $type = self::TYPE_INFO, $icon = 'far fa-envelope')
    {
        $this->setText($text)->setType($type)->setIcon($icon);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }
}
