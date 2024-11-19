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
 * @method static Unit yottamole(float $value = 1)
 * @method static Unit zettamole(float $value = 1)
 * @method static Unit examole(float $value = 1)
 * @method static Unit petamole(float $value = 1)
 * @method static Unit teramole(float $value = 1)
 * @method static Unit gigamole(float $value = 1)
 * @method static Unit megamole(float $value = 1)
 * @method static Unit kilomole(float $value = 1)
 * @method static Unit mole(float $value = 1)
 * @method static Unit hectomole(float $value = 1)
 * @method static Unit decamole(float $value = 1)
 * @method static Unit decimole(float $value = 1)
 * @method static Unit centimole(float $value = 1)
 * @method static Unit millimole(float $value = 1)
 * @method static Unit micromole(float $value = 1)
 * @method static Unit nanomole(float $value = 1)
 * @method static Unit picomole(float $value = 1)
 * @method static Unit femtomole(float $value = 1)
 * @method static Unit attomole(float $value = 1)
 * @method static Unit zeptomole(float $value = 1)
 * @method static Unit yoctomole(float $value = 1)
 * @method static Unit quantity(float $value = 1)
 * @method static Unit yottaSquareMeter(float $value = 1)
 * @method static Unit zettaSquareMeter(float $value = 1)
 * @method static Unit exaSquareMeter(float $value = 1)
 * @method static Unit petaSquareMeter(float $value = 1)
 * @method static Unit teraSquareMeter(float $value = 1)
 * @method static Unit gigaSquareMeter(float $value = 1)
 * @method static Unit megaSquareMeter(float $value = 1)
 * @method static Unit kiloSquareMeter(float $value = 1)
 * @method static Unit squareMeter(float $value = 1)
 * @method static Unit deciSquareMeter(float $value = 1)
 * @method static Unit centiSquareMeter(float $value = 1)
 * @method static Unit milliSquareMeter(float $value = 1)
 * @method static Unit microSquareMeter(float $value = 1)
 * @method static Unit nanoSquareMeter(float $value = 1)
 * @method static Unit picoSquareMeter(float $value = 1)
 * @method static Unit femtoSquareMeter(float $value = 1)
 * @method static Unit attoSquareMeter(float $value = 1)
 * @method static Unit zeptoSquareMeter(float $value = 1)
 * @method static Unit yoctoSquareMeter(float $value = 1)
 * @method static Unit acre(float $value = 1)
 * @method static Unit are(float $value = 1)
 * @method static Unit hectare(float $value = 1)
 * @method static Unit perch(float $value = 1)
 * @method static Unit rood(float $value = 1)
 * @method static Unit section(float $value = 1)
 * @method static Unit surveyAcre(float $value = 1)
 * @method static Unit surveyTownship(float $value = 1)
 * @method static Unit yottameter(float $value = 1)
 * @method static Unit zettameter(float $value = 1)
 * @method static Unit exameter(float $value = 1)
 * @method static Unit petameter(float $value = 1)
 * @method static Unit terameter(float $value = 1)
 * @method static Unit gigameter(float $value = 1)
 * @method static Unit megameter(float $value = 1)
 * @method static Unit kilometer(float $value = 1)
 * @method static Unit meter(float $value = 1)
 * @method static Unit decimeter(float $value = 1)
 * @method static Unit centimeter(float $value = 1)
 * @method static Unit millimeter(float $value = 1)
 * @method static Unit micrometer(float $value = 1)
 * @method static Unit nanometer(float $value = 1)
 * @method static Unit picometer(float $value = 1)
 * @method static Unit femtometer(float $value = 1)
 * @method static Unit attometer(float $value = 1)
 * @method static Unit zeptometer(float $value = 1)
 * @method static Unit yoctometer(float $value = 1)
 * @method static Unit cable(float $value = 1)
 * @method static Unit chain(float $value = 1)
 * @method static Unit fathom(float $value = 1)
 * @method static Unit foot(float $value = 1)
 * @method static Unit furlong(float $value = 1)
 * @method static Unit league(float $value = 1)
 * @method static Unit link(float $value = 1)
 * @method static Unit mile(float $value = 1)
 * @method static Unit pica(float $value = 1)
 * @method static Unit point(float $value = 1)
 * @method static Unit thou(float $value = 1)
 * @method static Unit yard(float $value = 1)
 * @method static Unit yottagram(float $value = 1)
 * @method static Unit zettagram(float $value = 1)
 * @method static Unit exagram(float $value = 1)
 * @method static Unit petagram(float $value = 1)
 * @method static Unit teragram(float $vateramolelue = 1)
 * @method static Unit gigagram(float $value = 1)
 * @method static Unit megagram(float $value = 1)
 * @method static Unit tonne(float $value = 1)
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
 * @method static Unit pound(float $value = 1)
 * @method static Unit drachm(float $value = 1)
 * @method static Unit longTon(float $value = 1)
 * @method static Unit longHundredweight(float $value = 1)
 * @method static Unit ounce(float $value = 1)
 * @method static Unit quarter(float $value = 1)
 * @method static Unit shortTon(float $value = 1)
 * @method static Unit shortHundredweight(float $value = 1)
 * @method static Unit celsius(float $value = 1)
 * @method static Unit fahrenheit(float $value = 1)
 * @method static Unit rankine(float $value = 1)
 * @method static Unit kelvin(float $value = 1)
 * @method static Unit romer(float $value = 1)
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
 * @method static Unit acreFoot(float $value = 1)
 * @method static Unit bushel(float $value = 1)
 * @method static Unit dryBarrel(float $value = 1)
 * @method static Unit dryGallon(float $value = 1)
 * @method static Unit dryPint(float $value = 1)
 * @method static Unit dryQuart(float $value = 1)
 * @method static Unit fluidDrachm(float $value = 1)
 * @method static Unit fluidOunce(float $value = 1)
 * @method static Unit fluidScruple(float $value = 1)
 * @method static Unit gallon(float $value = 1)
 * @method static Unit gill(float $value = 1)
 * @method static Unit hogshead(float $value = 1)
 * @method static Unit liquidBarrel(float $value = 1)
 * @method static Unit minim(float $value = 1)
 * @method static Unit oilBarrel(float $value = 1)
 * @method static Unit peck(float $value = 1)
 * @method static Unit pint(float $value = 1)
 * @method static Unit quart(float $value = 1)
 * @method static Unit tablespoon(float $value = 1)
 * @method static Unit teaspoon(float $value = 1)
 * @method static Unit pinch(float $value = 1)
 * @method static Unit cup(float $value = 1)
 * @method static Unit usFluidDrachm(float $value = 1)
 * @method static Unit usFluidOunce(float $value = 1)
 * @method static Unit usGill(float $value = 1)
 * @method static Unit usLiquidGallon(float $value = 1)
 * @method static Unit usLiquidPint(float $value = 1)
 * @method static Unit usLiquidQuart(float $value = 1)
 * @method static Unit usMinim(float $value = 1)
 * @method static Unit usShot(float $value = 1)
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

        return new self(($parameters[0] ?? 1), new Measurement($method));
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
