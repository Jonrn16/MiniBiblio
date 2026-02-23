<?php

namespace App\Factory;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Libro>
 *
 * @method static Libro|Proxy createOne(array $attributes = [])
 * @method static Libro[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Libro[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Libro|Proxy find(object|array|mixed $criteria)
 * @method static Libro|Proxy findOrCreate(array $attributes)
 * @method static Libro|Proxy first(string $sortedField = 'id')
 * @method static Libro|Proxy last(string $sortedField = 'id')
 * @method static Libro|Proxy random(array $attributes = [])
 * @method static Libro|Proxy randomOrCreate(array $attributes = [])
 * @method static Libro[]|Proxy[] all()
 * @method static Libro[]|Proxy[] findBy(array $attributes)
 * @method static Libro[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Libro[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class LibroFactory extends PersistentProxyObjectFactory{
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
        return Libro::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]    protected function defaults(): array|callable    {
        return [
            'anioPublicacion' => self::faker()->year(),
            'isbn' => self::faker()->isbn10(),
            'paginas' => self::faker()->randomNumber(),
            'titulo' => self::faker()->sentence(3),
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Libro $libro): void {})
        ;
    }
}
