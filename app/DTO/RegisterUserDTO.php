<?php 

namespace App\DTO;

class RegisterUserDTO
{

    public function __construct(
        public string $name , 
        public string $email , 
        public string $password,
    ){}
}