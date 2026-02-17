<?php
namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\RoomRepositoryInterface;
use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    public function findForUpdate(int $id): ?Room
    {
        return Room::where('id', $id)->lockForUpdate()->first();
    }

}
