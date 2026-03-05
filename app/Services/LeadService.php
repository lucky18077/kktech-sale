<?php

namespace App\Services;

use App\Repositories\LeadRepository;
use App\Models\Lead;

class LeadService
{
    protected LeadRepository $repo;

    public function __construct(LeadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(array $options = [])
    {
        if (!empty($options['paginate'])) {
            return $this->repo->paginate($options['perPage'] ?? 20, $options['with'] ?? []);
        }

        return $this->repo->all($options['with'] ?? []);
    }

    public function get(int $id): ?Lead
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Lead
    {
        // generate lead_ref_no if not provided
        if (empty($data['lead_ref_no'])) {
            $data['lead_ref_no'] = 'LR-' . strtoupper(uniqid());
        }
        return $this->repo->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
