<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\User;
use App\Models\Ticket;

class TicketRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Ticket::class;
    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getAll()
    {
        return Ticket::all();
    }

    public function find($slug)
    {
        return Ticket::whereSlug($slug)->firstOrFail();
    }
}
