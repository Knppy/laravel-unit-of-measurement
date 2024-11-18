<?php

namespace Knppy\UnitOfMeasurement\Enums;

enum MeasurementType: string
{
    case AMOUNT = 'amount';
    case LENGTH = 'length';
    case MASS = 'mass';
    case VOLUME = 'volume';
}
