<?php

declare(strict_types = 1);

namespace App\BoardingCard;

abstract class AbstractCard {

    /**
     * Trip origin
     * 
     * @var string
     */
    protected $origin;

    /**
     * Trip destination
     * 
     * @var string
     */
    protected $destination;

    /**
     * Trip additional info
     * 
     * @var string
     */
    protected $info;

    /**
     * Constructor.
     * 
     * array[origin]
     * array[destination]
     * array[info]
     * 
     * @param array $options (See above)
     * @throws Exception\PropertyDoesNotExists
     */
    public function __construct(array $options) {
        $this->setOptions($options);
    }

    /**
     * Set transportation options.
     * 
     * @param array $options
     * @throws Exception\PropertyDoesNotExists
     */
    protected function setOptions(array $options) {
        foreach ($options as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            } else {
                throw new Exception\PropertyDoesNotExistsException(sprintf("Class `%s` doesn't have `%s` property defined.", get_parent_class($this), $property));
            }
        }
    }

    /**
     * @return string
     */
    public function getOrigin() {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getDestination() {
        return $this->destination;
    }

    public abstract function __toString();
}