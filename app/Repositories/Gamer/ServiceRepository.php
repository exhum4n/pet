<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\Models\Gamer\Service;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

/**
 * @method Service update(Service $service, array $data)
 */
class ServiceRepository extends EloquentRepository
{
    /**
     * @param string $serviceId
     * @return Collection<Service>
     */
    public function getByServiceId(string $serviceId): Collection
    {
        $query = $this->getQuery();

        $query->leftJoin('gamers', 'gamers.id', '=', 'gamer_id');
        $query->where('service_id', '=', $serviceId);
        $query->select('gamers.*');

        return $query->get();
    }

    protected function getModel(): string
    {
        return Service::class;
    }
}
