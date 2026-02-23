<?php

namespace App\Factory;

use App\Entity\Editorial;
use App\Repository\EditorialRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Editorial>
 *
 * @method static Editorial|Proxy createOne(array $attributes = [])
 * @method static Editorial[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Editorial[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Editorial|Proxy find(object|array|mixed $criteria)
 * @method static Editorial|Proxy findOrCreate(array $attributes)
 * @method static Editorial|Proxy first(string $sortedField = 'id')
 * @method static Editorial|Proxy last(string $sortedField = 'id')
 * @method static Editorial|Proxy random(array $attributes = [])
 * @method static Editorial|Proxy randomOrCreate(array $attributes = [])
 * @method static Editorial[]|Proxy[] all()
 * @method static Editorial[]|Proxy[] findBy(array $attributes)
 * @method static Editorial[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Editorial[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class EditorialFactory extends PersistentProxyObjectFactory{
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
        return Editorial::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]    protected function defaults(): array|callable    {
        return [
            'localidad' => self::faker()->city(),
            'nombre' => self::faker()->company()
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Editorial $editorial): void {})
        ;
    }
}
