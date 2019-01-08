<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use App\BoardingCard\{AirportBusCard, PlaneCard, TrainCard};

class TripSorterTest extends TestCase {

    protected $boardingCards = [];

    protected function setUp() {
        parent::setUp();

        // Prepare the boarding cards collection
        $this->boardingCards = [
            new PlaneCard([
                'origin'       => 'Stockholm',
                'destination'  => 'New York',
                'flightNumber' => 'SK22',
                'gateNumber'   => '22',
                'seatNumber'   => '7B',
                'info'         => 'Baggage will we automatically transferred from your last leg.',
            ]),
            new TrainCard([
                'origin'       => 'Madrid',
                'destination'  => 'Barcelona',
                'trainNumber'  => '78A',
                'seatNumber'   => '45B',
            ]),
            new AirportBusCard([
                'origin'       => 'Barcelona',
                'destination'  => 'Gerona Airport',
            ]),
            new PlaneCard([
                'origin'       => 'Gerona Airport',
                'destination'  => 'Stockholm',
                'flightNumber' => 'SK455',
                'gateNumber'   => '45B',
                'seatNumber'   => '3A',
                'info'         => 'Baggage drop at ticket counter 344.',
            ]),
        ];

        // Randomize the collection order
        //shuffle($this->boardingCards);
    }

    public function testTripSorter() {
        $tripSorter = new App\TripSorter($this->boardingCards);

        $tripSorter->sort();

        $decorator = new App\TripSorterDecorator($tripSorter->getSorted());

        $outputString = <<<EOT
1: Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2: Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3: From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
4: From Stockholm, take flight SK22 to New York. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
5: You have arrived at your final destination.

EOT;

        echo $decorator;

        $this->expectOutputString($outputString);
    }
}