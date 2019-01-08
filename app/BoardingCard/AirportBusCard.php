<?php

declare(strict_types = 1);

namespace App\BoardingCard;

class AirportBusCard extends AbstractCard {

    const MESSAGE         = 'Take the airport bus from %s to %s.';
    const MESSAGE_SEAT    = ' Sit in seat %s.';
    const MESSAGE_NO_SEAT = ' No seat assignment.';

    /**
     * @var string
     */
    protected $seatNumber;

    public function __toString() {
        $output = sprintf(self::MESSAGE, $this->getOrigin(), $this->getDestination());

        if ($this->seatNumber) {
            $output .= sprintf(self::MESSAGE_SEAT, $this->seatNumber);
        } else {
            $output .= sprintf(self::MESSAGE_NO_SEAT);
        }

        if ($this->info) {
            $output .= sprintf(' %s', $this->info);
        }

        return $output;
    }

}