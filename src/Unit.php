<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Knppy\UnitOfMeasurement\Behaviour\Calculatable;
use Knppy\UnitOfMeasurement\Behaviour\Comparable;
use Knppy\UnitOfMeasurement\Behaviour\Convertable;
use Knppy\UnitOfMeasurement\Behaviour\Formatable;
use Knppy\UnitOfMeasurement\Casts\UnitCast;

/**
 * @method static Unit yottagram(float $value = 1)
 * @method static Unit zettagram(float $value = 1)
 * @method static Unit exagram(float $value = 1)
 * @method static Unit petagram(float $value = 1)
 * @method static Unit teragram(float $value = 1)
 * @method static Unit gigagram(float $value = 1)
 * @method static Unit megagram(float $value = 1)
 * @method static Unit kilogram(float $value = 1)
 * @method static Unit hectogram(float $value = 1)
 * @method static Unit decagram(float $value = 1)
 * @method static Unit gram(float $value = 1)
 * @method static Unit decigram(float $value = 1)
 * @method static Unit centigram(float $value = 1)
 * @method static Unit milligram(float $value = 1)
 * @method static Unit microgram(float $value = 1)
 * @method static Unit nanogram(float $value = 1)
 * @method static Unit picogram(float $value = 1)
 * @method static Unit femtogram(float $value = 1)
 * @method static Unit attogram(float $value = 1)
 * @method static Unit zeptogram(float $value = 1)
 * @method static Unit yoctogram(float $value = 1)
 * @method static Unit cubicYottameter(float $value = 1)
 * @method static Unit cubicZettameter(float $value = 1)
 * @method static Unit cubicExameter(float $value = 1)
 * @method static Unit cubicPetameter(float $value = 1)
 * @method static Unit cubicTerameter(float $value = 1)
 * @method static Unit cubicGigameter(float $value = 1)
 * @method static Unit cubicMegameter(float $value = 1)
 * @method static Unit cubicKilometer(float $value = 1)
 * @method static Unit cubicMeter(float $value = 1)
 * @method static Unit cubicDecimeter(float $value = 1)
 * @method static Unit cubicCentimeter(float $value = 1)
 * @method static Unit cubicMillimeter(float $value = 1)
 * @method static Unit cubicMicrometer(float $value = 1)
 * @method static Unit cubicNanometer(float $value = 1)
 * @method static Unit cubicPicometer(float $value = 1)
 * @method static Unit cubicFemtometer(float $value = 1)
 * @method static Unit cubicAttometer(float $value = 1)
 * @method static Unit cubicZeptometer(float $value = 1)
 * @method static Unit cubicYoctometer(float $value = 1)
 * @method static Unit yottaLiter(float $value = 1)
 * @method static Unit zettaLiter(float $value = 1)
 * @method static Unit exaLiter(float $value = 1)
 * @method static Unit petaLiter(float $value = 1)
 * @method static Unit teraLiter(float $value = 1)
 * @method static Unit gigaLiter(float $value = 1)
 * @method static Unit megaLiter(float $value = 1)
 * @method static Unit kiloLiter(float $value = 1)
 * @method static Unit hectoLiter(float $value = 1)
 * @method static Unit decaLiter(float $value = 1)
 * @method static Unit liter(float $value = 1)
 * @method static Unit deciLiter(float $value = 1)
 * @method static Unit centiLiter(float $value = 1)
 * @method static Unit milliLiter(float $value = 1)
 * @method static Unit microLiter(float $value = 1)
 * @method static Unit nanoLiter(float $value = 1)
 * @method static Unit picoLiter(float $value = 1)
 * @method static Unit femtoLiter(float $value = 1)
 * @method static Unit attoLiter(float $value = 1)
 * @method static Unit zeptoLiter(float $value = 1)
 * @method static Unit yoctoLiter(float $value = 1)
 */
class Unit implements Arrayable, Castable, Jsonable, JsonSerializable, Renderable
{
    use Calculatable;
    use Comparable;
    use Convertable;
    use Formatable;
    use Macroable {
        __callStatic as protected macroableCallStatic;
    }

    /**
     * Stores whether the unit is mutable or not.
     */
    private bool $mutable = false;

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
     * Make the unit immutable.
     */
    public function immutable(): Unit
    {
        $this->mutable = false;

        return new self($this->getValue(), $this->getMeasurement());
    }

    /**
     * Determine if the unit is mutable.
     */
    public function isMutable(): bool
    {
        return $this->mutable === true;
    }

    /**
     * Determine if the unit is immutable.
     */
    public function isImmutable(): bool
    {
        return ! $this->isMutable();
    }

    /**
     * Specify data which should be serialized to JSON.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Make the unit mutable.
     *
     * @return $this
     */
    public function mutable(): Unit
    {
        $this->mutable = true;

        return $this;
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
        return $this->format();
    }

    /**
     * Set the value of the unit.
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }
}
