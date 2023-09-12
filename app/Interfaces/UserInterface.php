<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAllUsers();
    public function getUserById($id, $company);
    public function deleteUser($id);
    public function createUser($data);
    public function updateUser($id, $data);
    public function getUserTypes($type);
    public function getMyWeeklyReading($id);
}
