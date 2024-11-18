<?php

namespace Knppy\UnitOfMeasurement\Enums;

enum MeasurementType: string
{
    case AMOUNT = 'amount';
    case AREA = 'area';
    case LENGTH = 'length';
    case MASS = 'mass';
    case VOLUME = 'volume';
}
