<?php

declare(strict_types = 1);

namespace App\BoardingCard;

class PlaneCard extends AbstractCard {

    const MESSAGE      = 'From %s, take flight %s to %s.';
    const MESSAGE_SEAT = ' Gate %s, seat %s.';

    /**
     * @var string
     */
    protected $flightNumber;

    /**
     * @var string
     */
    protected $gateNumber;

    /**
     * @var string
     */
    protected $seatNumber;

    public function __toString() {
        $output = sprintf(self::MESSAGE, $this->getOrigin(), $this->flightNumber, $this->getDestination());

        $output .= sprintf(self::MESSAGE_SEAT, $this->gateNumber, $this->seatNumber);

        if ($this->info) {
            $output .= sprintf(' %s', $this->info);
        }

        return $output;
    }

}