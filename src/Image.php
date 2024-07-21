<?php
require_once 'connect.php';

class Image 
{
    private $client;
    private $database;
    private $collection;

    public function __construct($client, $databaseName) {
        $this->client = $client;
        $this->database = $databaseName;
        $this->collection = $this->database . '.Img';
    }
        public function getAllImages() {
            $query = new MongoDB\Driver\Query([]);
            $cursor = $this->client->executeQuery($this->collection, $query);
    
            $images = [];
            foreach ($cursor as $document) {
                $images[] = $document;
            }
    
            return $images;
        }
    
        public function deleteImage($id) {
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
    
            $this->client->executeBulkWrite($this->collection, $bulk);
        }
    
        public function editImage($id, $imageName, $imageData, $mime) {
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->update(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['name' => $imageName, 'data' => new MongoDB\BSON\Binary($imageData, MongoDB\BSON\Binary::TYPE_GENERIC), 'mime' => $mime]],
                ['multi' => false, 'upsert' => false]
            );
    
            $this->client->executeBulkWrite($this->collection, $bulk);
        }
    
        public function uploadImage($imageName, $imageData, $mime) {
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert([
                'name' => $imageName, 
                'data' => new MongoDB\BSON\Binary($imageData, MongoDB\BSON\Binary::TYPE_GENERIC), 
                'mime' => $mime
            ]);
    
            $this->client->executeBulkWrite($this->collection, $bulk);
        }
    
        public function getImageDetails($id) {
            $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($id)]);
            $cursor = $this->client->executeQuery($this->collection, $query);
    
            foreach ($cursor as $document) {
                return $document;
            }
    
        return null;
    }
}