<?php

declare(strict_types = 1);

namespace App;

use App\BoardingCard\AbstractCard;

class TripSorter {

    /**
     * @var array AbstractCard[]
     */
    protected $boardingCards = [];

    /**
     * @var array AbstractCard[]
     */
    protected $boardingCardsSorted = [];

    /**
     * @param array $boardingCards AbstractCard[]
     */
    public function __construct(array $boardingCards) {
        $this->boardingCards = $boardingCards;
    }

    /**
     * @return array AbstractCard[]
     */
    public function getSorted() : array {
        return $this->boardingCardsSorted;
    }

    /**
     * Sort boarding cards by origin and destination.
     * 
     * @return void
     */
    public function sort() {
        $this->putFirstAndLast();

        foreach ($this->boardingCards as $boardingCard) {
            $this->put($boardingCard);
        }
    }

    protected function putFirstAndLast() {
        $keysToRemove = [];

        for ($i = 0; $i < count($this->boardingCards); $i++) {
            $isLastElement  = true;
            $hasPrevElement = false;

            foreach ($this->boardingCards as $boardingCard) {
                if (mb_strtolower($this->boardingCards[$i]->getOrigin()) == mb_strtolower($boardingCard->getDestination())) {
                    $hasPrevElement = true;
                } else if(mb_strtolower($this->boardingCards[$i]->getDestination()) == mb_strtolower($boardingCard->getOrigin())) {
                    $isLastElement = false;
                }
            }

            if (!$hasPrevElement) {
                // Put as first element
                array_unshift($this->boardingCardsSorted, $this->boardingCards[$i]);
                $keysToRemove[$i] = $i;
            } else if ($isLastElement) {
                // Put as last element
                array_push($this->boardingCardsSorted, $this->boardingCards[$i]);
                $keysToRemove[$i] = $i;
            }
        }

        // Remove first and last element from future comparisons
        foreach ($keysToRemove as $k) {
            unset($this->boardingCards[$k]);
        }
    }

    protected function put(AbstractCard $boardingCard) {
        foreach ($this->boardingCardsSorted as $index => $card) {
            // Put after compared element
            if (mb_strtolower($card->getDestination()) == mb_strtolower($boardingCard->getOrigin())) {
                array_splice($this->boardingCardsSorted, $index+1, 0, [$boardingCard]);
                return;
            }

            // Put before compared element
            if (mb_strtolower($card->getOrigin()) == mb_strtolower($boardingCard->getDestination())) {
                array_splice($this->boardingCardsSorted, $index, 0, [$boardingCard]);
                return;
            }
        }
    }
}