<?php

declare(strict_types = 1);

namespace App;

class TripSorterDecorator {

    const END_OF_TRIP_MESSAGE = 'You have arrived at your final destination.';

    /**
     * @var array AbstractCard[]
     */
    protected $boardingCards = [];

    /**
     * @var array AbstractCard[]
     */
    public function __construct(array $boardingCards) {
        $this->boardingCards = $boardingCards;
    }

    public function __toString() {
        $output = '';
        $number = 1;

        foreach ($this->boardingCards as $boardingCard) {
            $output .= sprintf("%d: %s\n", $number++, $boardingCard);
        }

        $output .= sprintf("%d: %s\n", $number++, self::END_OF_TRIP_MESSAGE);

        return $output;
    }

}
