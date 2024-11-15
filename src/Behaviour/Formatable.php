<?php

namespace Knppy\UnitOfMeasurement\Behaviour;

trait Formatable
{
    /**
     * Format the unit.
     */
    public function format(int $decimals = 2, ?string $decimalSeparator = ',', ?string $thousandsSeparator = '.'): string
    {
        $negative = $this->isNegative();
        $value = $this->getValue();
        $amount = $negative ? -$value : $value;
        $suffix = ' '.$this->getMeasurement()->getSymbol();

        $value = rtrim(rtrim(number_format($amount, $decimals, $decimalSeparator, $thousandsSeparator), '0'), $decimalSeparator);

        return ($negative ? '-' : '').$value.$suffix;
    }

    /**
     * Format the unit without the measurement suffix.
     */
    public function formatSimple(int $decimals = 2, ?string $decimalSeparator = ',', ?string $thousandsSeparator = '.'): string
    {
        return rtrim(rtrim(number_format($this->getValue(), $decimals, $decimalSeparator, $thousandsSeparator), '0'), $decimalSeparator);
    }
}
