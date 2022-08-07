<?php

namespace Models\PropertiesModel;

use Models\Model\Model;

class PropertiesModel extends Model
{

    public function getProperties(): bool|array
    {
        return $this->db
            ->from('properties')
            ->leftJoin('property_types ON property_types.id = properties.property_type_id')
            ->select('property_types.title as propertyTypeTitle')
            ->fetchAll();
    }

    public function getPaginatedProperties(array $data): bool|array
    {
        return $this->db
            ->getPdo()
            ->query("
                SELECT *,property_types.title as propertyTypeTitle FROM properties LEFT JOIN property_types ON property_types.id = properties.property_type_id " . $data['search_query'] . " ORDER BY " . $data['column_name'] . " " . $data['column_sort_order'] . " LIMIT " . $data['limit'] . "," . $data['offset'] . " 
            ")
            ->fetchAll();
    }

    public function getPropertyTypes(): bool|array
    {
        return $this->db
            ->from('property_types')
            ->fetchAll();
    }

}