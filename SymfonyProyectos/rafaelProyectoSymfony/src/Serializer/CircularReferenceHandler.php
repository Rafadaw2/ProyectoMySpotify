<?php
namespace App\Serializer;

class CircularReferenceHandler {
    public function __invoke($object) {
        return $object->getId(); // Devuelve solo el ID en lugar de serializar todo el objeto
    }
}
