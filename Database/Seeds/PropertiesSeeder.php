<?php

use Phinx\Seed\AbstractSeed;
use GuzzleHttp\HandlerStack;
use Spatie\GuzzleRateLimiterMiddleware\RateLimiterMiddleware;

class PropertiesSeeder extends AbstractSeed
{
    public function run() :void
    {

        $stack = HandlerStack::create();
        $stack->push(RateLimiterMiddleware::perSecond(1));

        $apiIterator = new \Libraries\ApiIterator\ApiIterator(
            new GuzzleHttp\Client(
                [
                    'handler' => $stack,
                ]
            )
        );
        $apiIterator->setApiURL($_ENV['API_URL']);
        $apiIterator->setApiKey($_ENV['API_KEY']);

        do{
            $apiData = $apiIterator->getData();

            foreach ($apiData as $data) {

                if (isset($data->property_type)) {
                    $propertyData = (array)$data->property_type;
                    $this->adapter->query("INSERT IGNORE INTO `property_types` (id,title,description,created_at,updated_at) VALUES ('".$propertyData["id"]."', '".$propertyData["title"]."','".$propertyData["description"]."','".$propertyData["created_at"]."','".$propertyData["updated_at"]."')");
                }

                $propertyData = [
                    'uuid' => $data->uuid,
                    'property_type_id' => $data->property_type_id,
                    'county' => $data->county,
                    'country' => $data->country,
                    'town' => $data->town,
                    'description' => $data->description,
                    'address' => $data->address,
                    'image_full' => $data->image_full,
                    'image_thumbnail' => $data->image_thumbnail,
                    'latitude' => $data->latitude,
                    'longitude' => $data->longitude,
                    'num_bedrooms' => $data->num_bedrooms,
                    'num_bathrooms' => $data->num_bathrooms,
                    'price' => $data->price,
                    'type' => $data->type,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ];

                $properties = $this->table('properties');
                $properties->insert($propertyData)
                    ->save();

            }

        }while($apiIterator->hasNextPage);

    }
}