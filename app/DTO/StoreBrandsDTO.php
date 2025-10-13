<?php 
namespace App\DTO;
class StoreBrandsDTO{


    public function __construct(
        public string $name , 
        public string $country , 
        public ?string $description ,
    ){}
}