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
 * @method static Measurement yottamole()
 * @method static Measurement zettamole()
 * @method static Measurement examole()
 * @method static Measurement petamole()
 * @method static Measurement teramole()
 * @method static Measurement gigamole()
 * @method static Measurement megamole()
 * @method static Measurement kilomole()
 * @method static Measurement mole()
 * @method static Measurement hectomole()
 * @method static Measurement decamole()
 * @method static Measurement decimole()
 * @method static Measurement centimole()
 * @method static Measurement millimole()
 * @method static Measurement micromole()
 * @method static Measurement nanomole()
 * @method static Measurement picomole()
 * @method static Measurement femtomole()
 * @method static Measurement attomole()
 * @method static Measurement zeptomole()
 * @method static Measurement yoctomole()
 * @method static Measurement quantity()
 * @method static Measurement yottaSquareMeter()
 * @method static Measurement zettaSquareMeter()
 * @method static Measurement exaSquareMeter()
 * @method static Measurement petaSquareMeter()
 * @method static Measurement teraSquareMeter()
 * @method static Measurement gigaSquareMeter()
 * @method static Measurement megaSquareMeter()
 * @method static Measurement kiloSquareMeter()
 * @method static Measurement squareMeter()
 * @method static Measurement deciSquareMeter()
 * @method static Measurement centiSquareMeter()
 * @method static Measurement milliSquareMeter()
 * @method static Measurement microSquareMeter()
 * @method static Measurement nanoSquareMeter()
 * @method static Measurement picoSquareMeter()
 * @method static Measurement femtoSquareMeter()
 * @method static Measurement attoSquareMeter()
 * @method static Measurement zeptoSquareMeter()
 * @method static Measurement yoctoSquareMeter()
 * @method static Measurement yottameter()
 * @method static Measurement zettameter()
 * @method static Measurement exameter()
 * @method static Measurement petameter()
 * @method static Measurement terameter()
 * @method static Measurement gigameter()
 * @method static Measurement megameter()
 * @method static Measurement kilometer()
 * @method static Measurement meter()
 * @method static Measurement decimeter()
 * @method static Measurement centimeter()
 * @method static Measurement millimeter()
 * @method static Measurement micrometer()
 * @method static Measurement nanometer()
 * @method static Measurement picometer()
 * @method static Measurement femtometer()
 * @method static Measurement attometer()
 * @method static Measurement zeptometer()
 * @method static Measurement yoctometer()
 * @method static Measurement cable()
 * @method static Measurement chain()
 * @method static Measurement fathom()
 * @method static Measurement foot()
 * @method static Measurement furlong()
 * @method static Measurement league()
 * @method static Measurement link()
 * @method static Measurement mile()
 * @method static Measurement pica()
 * @method static Measurement point()
 * @method static Measurement thou()
 * @method static Measurement yard()
 * @method static Measurement yottagram()
 * @method static Measurement zettagram()
 * @method static Measurement exagram()
 * @method static Measurement petagram()
 * @method static Measurement teragram()
 * @method static Measurement gigagram()
 * @method static Measurement megagram()
 * @method static Measurement tonne()
 * @method static Measurement kilogram()
 * @method static Measurement hectogram()
 * @method static Measurement decagram()
 * @method static Measurement gram()
 * @method static Measurement decigram()
 * @method static Measurement centigram()
 * @method static Measurement milligram()
 * @method static Measurement microgram()
 * @method static Measurement nanogram()
 * @method static Measurement picogram()
 * @method static Measurement femtogram()
 * @method static Measurement attogram()
 * @method static Measurement zeptogram()
 * @method static Measurement yoctogram()
 * @method static Measurement pound()
 * @method static Measurement drachm()
 * @method static Measurement longTon()
 * @method static Measurement longHundredweight()
 * @method static Measurement ounce()
 * @method static Measurement quarter()
 * @method static Measurement shortTon()
 * @method static Measurement shortHundredweight()
 * @method static Measurement celsius()
 * @method static Measurement fahrenheit()
 * @method static Measurement rankine()
 * @method static Measurement kelvin()
 * @method static Measurement romer()
 * @method static Measurement cubicYottameter()
 * @method static Measurement cubicZettameter()
 * @method static Measurement cubicExameter()
 * @method static Measurement cubicPetameter()
 * @method static Measurement cubicTerameter()
 * @method static Measurement cubicGigameter()
 * @method static Measurement cubicMegameter()
 * @method static Measurement cubicKilometer()
 * @method static Measurement cubicMeter()
 * @method static Measurement cubicDecimeter()
 * @method static Measurement cubicCentimeter()
 * @method static Measurement cubicMillimeter()
 * @method static Measurement cubicMicrometer()
 * @method static Measurement cubicNanometer()
 * @method static Measurement cubicPicometer()
 * @method static Measurement cubicFemtometer()
 * @method static Measurement cubicAttometer()
 * @method static Measurement cubicZeptometer()
 * @method static Measurement cubicYoctometer()
 * @method static Measurement yottaLiter()
 * @method static Measurement zettaLiter()
 * @method static Measurement exaLiter()
 * @method static Measurement petaLiter()
 * @method static Measurement teraLiter()
 * @method static Measurement gigaLiter()
 * @method static Measurement megaLiter()
 * @method static Measurement kiloLiter()
 * @method static Measurement hectoLiter()
 * @method static Measurement decaLiter()
 * @method static Measurement liter()
 * @method static Measurement deciLiter()
 * @method static Measurement centiLiter()
 * @method static Measurement milliLiter()
 * @method static Measurement microLiter()
 * @method static Measurement nanoLiter()
 * @method static Measurement picoLiter()
 * @method static Measurement femtoLiter()
 * @method static Measurement attoLiter()
 * @method static Measurement zeptoLiter()
 * @method static Measurement yoctoLiter()
 */
class Measurement implements Arrayable, Castable, Jsonable, JsonSerializable, Renderable
{
    use Macroable {
        __callStatic as protected macroableCallStatic;
    }

    private static ?Collection $measurements = null;

    private ?Measurement $baseMeasurement;

    private MeasurementType $type;

    private array $systems;

    private string $name;

    private string $symbol;

    private float $preAddition;

    private float $factor;

    private float $postAddition;

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
        $this->systems = (array) $measurementAttributes['system'];
        $this->name = (string) $measurementAttributes['name'];
        $this->symbol = (string) $measurementAttributes['symbol'];
        $this->preAddition = (float) ($measurementAttributes['pre_addition'] ?? 0);
        $this->factor = (float) $measurementAttributes['factor'];
        $this->postAddition = (float) ($measurementAttributes['post_addition'] ?? 0);
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
     * Get the pre addition.
     */
    public function getPreAddition(): float
    {
        return $this->preAddition;
    }

    /**
     * Get the post addition.
     */
    public function getPostAddition(): float
    {
        return $this->postAddition;
    }

    /**
     * Get the symbol.
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * Get the systems.
     */
    public function getSystems(): array
    {
        return $this->systems;
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
