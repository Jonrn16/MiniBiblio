<?php

namespace App\Factory;

use App\Entity\Autor;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Autor>
 *
 * @method static Autor|Proxy createOne(array $attributes = [])
 * @method static Autor[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Autor[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Autor|Proxy find(object|array|mixed $criteria)
 * @method static Autor|Proxy findOrCreate(array $attributes)
 * @method static Autor|Proxy first(string $sortedField = 'id')
 * @method static Autor|Proxy last(string $sortedField = 'id')
 * @method static Autor|Proxy random(array $attributes = [])
 * @method static Autor|Proxy randomOrCreate(array $attributes = [])
 * @method static Autor[]|Proxy[] all()
 * @method static Autor[]|Proxy[] findBy(array $attributes)
 * @method static Autor[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Autor[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AutorFactory extends PersistentProxyObjectFactory{
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
        return Autor::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]    protected function defaults(): array|callable    {
        return [
            'apellidos' => self::faker()->lastName(),
            'fechaNacimiento' => self::faker()->dateTime(),
            'nombre' => self::faker()->firstName()
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Autor $autor): void {})
        ;
    }
}
