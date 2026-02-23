<?php

namespace App\Factory;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Socio>
 *
 * @method static Socio|Proxy createOne(array $attributes = [])
 * @method static Socio[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Socio[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Socio|Proxy find(object|array|mixed $criteria)
 * @method static Socio|Proxy findOrCreate(array $attributes)
 * @method static Socio|Proxy first(string $sortedField = 'id')
 * @method static Socio|Proxy last(string $sortedField = 'id')
 * @method static Socio|Proxy random(array $attributes = [])
 * @method static Socio|Proxy randomOrCreate(array $attributes = [])
 * @method static Socio[]|Proxy[] all()
 * @method static Socio[]|Proxy[] findBy(array $attributes)
 * @method static Socio[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Socio[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class SocioFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]    public static function class(): string
    {
        return Socio::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]    protected function defaults(): array|callable    {
        return [
            'apellidos' => self::faker()->lastName(),
            'dni' => self::faker()->dni(),
            'esDocente' => self::faker()->boolean(),
            'esEstudiante' => self::faker()->boolean(),
            'nombre' => self::faker()->firstName(),
            'telefono' => self::faker()->phoneNumber(),
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Socio $socio): void {})
        ;
    }
}
