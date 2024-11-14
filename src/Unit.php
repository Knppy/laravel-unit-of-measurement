<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Knppy\UnitOfMeasurement\Casts\UnitCast;

/**
 * @method static Unit gram(float $value = 1)
 * @method static Unit kilogram(float $value = 1)
 * @method static Unit cubicMeter(float $value = 1)
 */
class Unit implements Arrayable, Castable, Jsonable, JsonSerializable, Renderable
{
    use Macroable {
        __callStatic as protected macroableCallStatic;
    }

    /**
     * Dynamically handle calls to the class.
     */
    public static function __callStatic($method, $parameters): Unit
    {
        if (static::hasMacro($method)) {
            return static::macroableCallStatic($method, $parameters);
        }

        return new self($parameters[0] ?? 1, new Measurement($method));
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     */
    public static function castUsing(array $arguments): string
    {
        return UnitCast::class;
    }

    /**
     * Create a new instance of the unit from a string.
     */
    public static function from(string $value): Unit
    {
        $numberPart = (float) $value;
        $measurementPart = trim(str_replace((string) $numberPart, '', $value));

        return new self($numberPart, new Measurement($measurementPart));
    }

    /**
     * Create a new instance of the unit.
     */
    public function __construct(protected float $value, protected Measurement $measurement)
    {
        //
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Get the measurement.
     */
    public function getMeasurement(): Measurement
    {
        return $this->measurement;
    }

    /**
     * Get the value.
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        return [
            'value' => $this->getValue(),
            'measurement' => $this->getMeasurement(),
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Get the evaluated contents of the object.
     */
    public function render(): string
    {
        return (string) $this->value;
    }
}
