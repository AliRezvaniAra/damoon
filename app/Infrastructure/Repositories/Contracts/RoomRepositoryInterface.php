<?php
namespace App\Infrastructure\Repositories\Contracts;

use App\Models\Room;

interface RoomRepositoryInterface
{
    public function findForUpdate(int $id): ?Room;
}
