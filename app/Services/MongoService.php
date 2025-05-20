<?php

namespace App\Services;

use MongoDB\Client;
use MongoDB\Model\BSONArray;

class MongoService
{
    protected $client;
    protected $collection;

    public function __construct()
    {
        //Connexion .env (MONGO_URI)
        $uri = env('MONGO_DB_DSN', 'mongodb://127.0.0.1:27017');
        $this->client = new Client($uri);

        $this->collection = $this->client->selectCollection('EcoRideRoles', 'users_roles');
    }

    /**
     * roles MongoDB with ID MySQL
     * @param int|string $userId ID utilisateur MySQL
     * @param array $roles : ['chauffeur', 'passager']
     * @return void
     */

    public function setRoles($userId, array $roles)
    {
        $this->collection->updateOne(
            ['utilisateur_id' => (string)$userId],
            ['$set' => ['roles' => $roles]],
            ['upsert' => true]
        );
    }

    public function getRoles($userId): array
    {
        $document = $this->collection->findOne(['utilisateur_id' => $userId]);

        if (!$document || !isset($document['roles'])) {
            return [];
        }

        $roles = $document['roles'];

        //BSONArray => array PHP
        if ($roles instanceof BSONArray) {
            return $roles->getArrayCopy();
        }

        return (array) $roles;
    }
}