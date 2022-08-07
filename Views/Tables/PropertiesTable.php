<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/Configs/bootstrap.php");

CheckIfAjaxRequest();

if (isset($_POST)) {

    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = 'properties.'.$_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

    $totalProperties = $propertiesModel->getProperties();
    $totalRecords = ($totalProperties !== false) ? count($totalProperties) : 0;

    $searchQuery = '';

    $searchByTown = SecureInput($_POST['town']);
    $searchByNumberOfBedrooms = SecureInput($_POST['numberOfBedrooms']);
    $searchByPrice = SecureInput($_POST['searchPrice']);
    $searchByType = SecureInput($_POST['type']);
    $searchByPropertyType = SecureInput($_POST['propertyTypes']);

    if ($searchByTown != '') {
        $searchQuery .= " WHERE (town like '%" . $searchByTown . "%' ) ";
    }

    if ($searchByNumberOfBedrooms != '') {

        if ($searchQuery == '') {
            $searchQuery .= " WHERE (num_bedrooms = " . $searchByNumberOfBedrooms . " ) ";
        } else {
            $searchQuery .= " AND (num_bedrooms = " . $searchByNumberOfBedrooms . " ) ";
        }
    }

    if ($searchByPrice != '') {

        if ($searchQuery == '') {
            $searchQuery .= " WHERE (price = " . $searchByPrice . " ) ";
        } else {
            $searchQuery .= " AND (price = " . $searchByPrice . " ) ";
        }
    }

    if ($searchByType != '') {

        if ($searchQuery == '') {
            $searchQuery .= " WHERE (type = '" . $searchByType . "' ) ";
        } else {
            $searchQuery .= " AND (type = '" . $searchByType . "' ) ";
        }
    }
    if ($searchByPropertyType != '') {

        if ($searchQuery == '') {
            $searchQuery .= " WHERE (property_type_id = " . $searchByPropertyType . " ) ";
        } else {
            $searchQuery .= " AND (property_type_id = " . $searchByPropertyType . " ) ";
        }
    }

    $data = array(
        'column_name' => $columnName,
        'column_sort_order' => $columnSortOrder,
        'limit' => (int)$row,
        'offset' => (int)$rowperpage,
        'search_query' => $searchQuery
    );

    $finalResult = $propertiesModel->getPaginatedProperties($data);

    $data = array();

    if ($finalResult !== false) {
        foreach ($finalResult as $withdrawal) {

            $data[] = [
                'Id' => $withdrawal['id'],
                'Property Type' => $withdrawal['propertyTypeTitle'],
                'County' => $withdrawal['county'],
                'Country' => $withdrawal['country'],
                'Town' => $withdrawal['town'],
                'Description' => $withdrawal['description'],
                'Address' => $withdrawal['address'],
                'Image' => $withdrawal['image_full'],
                'Thumbnail' => $withdrawal['image_thumbnail'],
                'Latitude' => $withdrawal['latitude'],
                'Longitude' => $withdrawal['longitude'],
                'No Bedrooms' => $withdrawal['num_bedrooms'],
                'No Bathrooms' => $withdrawal['num_bathrooms'],
                'Price' => $withdrawal['price'],
                'S/R' => $withdrawal['type']

            ];

        }
    }

## Response
    $response = array(
        "draw" => (int)$draw,
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecords,
        "aaData" => $data
    );

    echo json_encode($response);

}