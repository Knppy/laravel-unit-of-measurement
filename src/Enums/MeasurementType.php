<?php

namespace Knppy\UnitOfMeasurement\Enums;

enum MeasurementType: string
{
    case AMOUNT = 'amount';
    case MASS = 'mass';
    case VOLUME = 'volume';
}
