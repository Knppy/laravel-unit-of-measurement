<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Knppy\UnitOfMeasurement\Casts\MeasurementCast;
use Knppy\UnitOfMeasurement\Enums\MeasurementType;
use OutOfBoundsException;

/**
 * @method static Measurement gram()
 * @method static Measurement kilogram()
 * @method static Measurement cubicMeter()
 */
class Measurement implements Arrayable, Castable, Jsonable, JsonSerializable, Renderable
{
    use Macroable {
        __callStatic as protected macroableCallStatic;
    }

    private static ?Collection $measurements = null;

    private ?Measurement $baseMeasurement;

    private MeasurementType $type;

    private string $name;

    private string $symbol;

    private float $factor;

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     */
    public static function castUsing(array $arguments): string
    {
        return MeasurementCast::class;
    }

    /**
     * Get a collection of all measurements.
     */
    public static function measurements(): Collection
    {
        return self::$measurements ??= collect(config('unit-of-measurement.measurements', []));
    }

    /**
     * Dynamically handle calls to the class.
     */
    public static function __callStatic($method, $parameters): Measurement
    {
        if (static::hasMacro($method)) {
            return static::macroableCallStatic($method, $parameters);
        }

        return new self($method);
    }

    /**
     * Create a new instance of the measurement.
     */
    public function __construct(string $measurement)
    {
        $measurements = self::measurements();
        $measurementAttributes = $measurements->where('name', '=', $measurement)->first();

        if (! $measurementAttributes) {
            $measurementAttributes = $measurements->where('symbol', '=', $measurement)->first();
        }

        if (! $measurementAttributes) {
            throw new OutOfBoundsException('Invalid measurement "'.$measurement.'"');
        }

        $this->baseMeasurement = isset($measurementAttributes['base_measurement']) ? new Measurement($measurementAttributes['base_measurement']) : null;
        $this->type = MeasurementType::from($measurementAttributes['type']);
        $this->name = (string) $measurementAttributes['name'];
        $this->symbol = (string) $measurementAttributes['symbol'];
        $this->factor = (float) $measurementAttributes['factor'];
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Determine if this measurement is equal to another measurement.
     */
    public function equals(Measurement $measurement): bool
    {
        return $this->getName() === $measurement->getName();
    }

    /**
     * Determine if this measurement is of the same type as another measurement.
     */
    public function equalsType(Measurement $measurement): bool
    {
        return $this->getType()->name === $measurement->getType()->name;
    }

    /**
     * Get the base measurement.
     */
    public function getBaseMeasurement(): ?Measurement
    {
        return $this->baseMeasurement;
    }

    /**
     * Get the factor.
     */
    public function getFactor(): float
    {
        return $this->factor;
    }

    /**
     * Get the name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the symbol.
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * Get the type.
     */
    public function getType(): MeasurementType
    {
        return $this->type;
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the evaluated contents of the object.
     */
    public function render(): string
    {
        return $this->getSymbol().' ('.$this->getName().')';
    }

    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        return [
            'base_measurement' => $this->getBaseMeasurement(),
            'type' => $this->getType(),
            'name' => $this->getName(),
            'symbol' => $this->getSymbol(),
            'factor' => $this->getFactor(),
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
}
