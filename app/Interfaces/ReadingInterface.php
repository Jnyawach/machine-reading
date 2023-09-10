<?php

namespace App\Interfaces;

interface ReadingInterface
{

    public function getReadings();
    public function getReadingById(string $id);
    public function createReading(array $data);
    public function updateReading(array $data, string $id);
    public function deleteReading(string $id);

    public function markConfirmed(string $id);


}
