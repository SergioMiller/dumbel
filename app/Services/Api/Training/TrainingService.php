<?php
declare(strict_types=1);

namespace App\Services\Api\Training;

use App\Models\Training;
use App\Services\Api\Training\Dto\TrainingAddDto;

class TrainingService
{
    public function create(TrainingAddDto $data): Training
    {
        $training = (new Training($data->toArray()));
        $training->save();

        return $training;
    }
}
