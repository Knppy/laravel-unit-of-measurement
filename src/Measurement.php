<?php

namespace Knppy\UnitOfUnit;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Knppy\UnitOfUnit\Casts\UnitCast;
use Knppy\UnitOfUnit\Enums\UnitType;
use OutOfBoundsException;

/**
 * @method static Unit yottagram()
 * @method static Unit zettagram()
 * @method static Unit exagram()
 * @method static Unit petagram()
 * @method static Unit teragram()
 * @method static Unit gigagram()
 * @method static Unit megagram()
 * @method static Unit kilogram()
 * @method static Unit hectogram()
 * @method static Unit decagram()
 * @method static Unit gram()
 * @method static Unit decigram()
 * @method static Unit centigram()
 * @method static Unit milligram()
 * @method static Unit microgram()
 * @method static Unit nanogram()
 * @method static Unit picogram()
 * @method static Unit femtogram()
 * @method static Unit attogram()
 * @method static Unit zeptogram()
 * @method static Unit yoctogram()
 * @method static Unit cubicYottameter()
 * @method static Unit cubicZettameter()
 * @method static Unit cubicExameter()
 * @method static Unit cubicPetameter()
 * @method static Unit cubicTerameter()
 * @method static Unit cubicGigameter()
 * @method static Unit cubicMegameter()
 * @method static Unit cubicKilometer()
 * @method static Unit cubicMeter()
 * @method static Unit cubicDecimeter()
 * @method static Unit cubicCentimeter()
 * @method static Unit cubicMillimeter()
 * @method static Unit cubicMicrometer()
 * @method static Unit cubicNanometer()
 * @method static Unit cubicPicometer()
 * @method static Unit cubicFemtometer()
 * @method static Unit cubicAttometer()
 * @method static Unit cubicZeptometer()
 * @method static Unit cubicYoctometer()
 * @method static Unit yottaLiter()
 * @method static Unit zettaLiter()
 * @method static Unit exaLiter()
 * @method static Unit petaLiter()
 * @method static Unit teraLiter()
 * @method static Unit gigaLiter()
 * @method static Unit megaLiter()
 * @method static Unit kiloLiter()
 * @method static Unit hectoLiter()
 * @method static Unit decaLiter()
 * @method static Unit liter()
 * @method static Unit deciLiter()
 * @method static Unit centiLiter()
 * @method static Unit milliLiter()
 * @method static Unit microLiter()
 * @method static Unit nanoLiter()
 * @method static Unit picoLiter()
 * @method static Unit femtoLiter()
 * @method static Unit attoLiter()
 * @method static Unit zeptoLiter()
 * @method static Unit yoctoLiter()
 */
class Unit implements Arrayable, Castable, Jsonable, JsonSerializable, Renderable
{
    use Macroable {
        __callStatic as protected macroableCallStatic;
    }

    private static ?Collection $measurements = null;

    private ?Unit $baseUnit;

    private UnitType $type;

    private string $name;

    private string $symbol;

    private float $factor;

    /**
     * Dynamically handle calls to the class.
     */
    public static function __callStatic($method, $parameters): Unit
    {
        if (static::hasMacro($method)) {
            return static::macroableCallStatic($method, $parameters);
        }

        return new self($method);
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     */
    public static function castUsing(array $arguments): string
    {
        return UnitCast::class;
    }

    /**
     * Get a collection of all measurements.
     */
    public static function measurements(): Collection
    {
        return self::$measurements ??= collect(config('unit-of-measurement.measurements', []));
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

        $this->baseUnit = isset($measurementAttributes['base_measurement']) ? new Unit($measurementAttributes['base_measurement']) : null;
        $this->type = UnitType::from($measurementAttributes['type']);
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
    public function equals(Unit $measurement): bool
    {
        return $this->getName() === $measurement->getName();
    }

    /**
     * Determine if this measurement is of the same type as another measurement.
     */
    public function equalsType(Unit $measurement): bool
    {
        return $this->getType()->name === $measurement->getType()->name;
    }

    /**
     * Get the base measurement.
     */
    public function getBaseUnit(): ?Unit
    {
        return $this->baseUnit;
    }

    /**
     * Get the factor.
     */
    public function getFactor(): float
    {
        return $this->factor ?? 1;
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
    public function getType(): UnitType
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
            'base_measurement' => $this->getBaseUnit(),
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
