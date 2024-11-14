<?php

// config for Knppy/UnitOfMeasurement
return [
    'measurements' => [
        [
            'type' => 'mass',
            'name' => 'gram',
            'symbol' => 'g',
            'factor' => 1,
        ],
        [
            'base_measurement' => 'gram',
            'type' => 'mass',
            'name' => 'kilogram',
            'symbol' => 'kg',
            'factor' => 1E3,
        ],
        [
            'type' => 'volume',
            'name' => 'cubicMeter',
            'symbol' => 'm3',
            'factor' => 1,
        ],
    ],
];
