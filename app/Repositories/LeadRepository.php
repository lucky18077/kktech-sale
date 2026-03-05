<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function all(array $with = [])
    {
        $query = Lead::query();
        if (!empty($with)) {
            $query->with($with);
        }
        return $query->get();
    }

    public function paginate(int $perPage = 20, array $with = [])
    {
        $query = Lead::query();
        if (!empty($with)) {
            $query->with($with);
        }
        return $query->paginate($perPage);
    }

    public function find(int $id): ?Lead
    {
        return Lead::find($id);
    }

    public function create(array $data): Lead
    {
        return Lead::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $lead = $this->find($id);
        if (!$lead) {
            return false;
        }
        return $lead->update($data);
    }

    public function delete(int $id): bool
    {
        $lead = $this->find($id);
        if (!$lead) {
            return false;
        }
        return (bool) $lead->delete();
    }
}
