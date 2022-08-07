<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Configs/bootstrap.php");

?>
<head>
    <title>Interesting Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Properties Table</h2>
    <p>Town</p>
    <input class="form-control" id="townInput" type="text" placeholder="Search Town..">
    <p>Number Of Bedrooms</p>
    <input class="form-control" id="numberOfBedrooms" type="number" placeholder="Search Number Of bedrooms..">
    <p>Price</p>
    <input class="form-control" id="searchPrice" type="number" placeholder="Search Price..">
    <p>Type</p>
    <select id="type">
        <option value="" selected>All</option>
        <option value="rent">Rent</option>
        <option value="sale">Sale</option>
    </select>

    <p>Property Type</p>
    <select id="propertyTypes">
        <option value="" selected>All</option>
        <?php
        $types = $propertiesModel->getPropertyTypes();

        foreach ($types as $type){
        ?>
        <option value="<?php $type['id'] ?>"><?php echo $type['title']; ?></option>
        <?php
        }
        ?>
    </select>
    <br>
    <br>
    <br>
    <table id="propertiesTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Property Type</th>
            <th>County</th>
            <th>Country</th>
            <th>Town</th>
            <th>Description</th>
            <th>Address</th>
            <th>Image</th>
            <th>Thumbnail</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>No Bedrooms</th>
            <th>No Bathrooms</th>
            <th>Price</th>
            <th>S/R</th>
        </tr>
        </thead>
        <tbody id="myTable">
        </tbody>
    </table>
</div>

</body>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var datatableObject = $('#propertiesTable').DataTable({
            'processing': true,
            'scrollX': true,
            "bFilter": true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'POST',
            "iDisplayLength": 5,
            'ajax': {
                'url': '/Views/Tables/PropertiesTable.php',
                'data': function (data) {
                    data.town = $('#townInput').val();
                    data.numberOfBedrooms = $('#numberOfBedrooms').val();
                    data.searchPrice = $('#searchPrice').val();
                    data.type = $('#type').val();
                    data.propertyTypes = $('#propertyTypes').val();
                }
            },
            'columns': [
                {data: 'Id', sortable: true, orderable: true},
                {data: 'Property Type', sortable: false},
                {data: 'County', sortable: false},
                {data: 'Country'},
                {data: 'Town', sortable: false},
                {data: 'Description'},
                {data: 'Address', sortable: false},
                {data: 'Image', sortable: false},
                {data: 'Thumbnail', sortable: false},
                {data: 'Latitude', sortable: false},
                {data: 'Longitude', sortable: false},
                {data: 'No Bedrooms', sortable: false},
                {data: 'No Bathrooms', sortable: false},
                {data: 'Price', sortable: false},
                {data: 'S/R', sortable: false},

            ],
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "order": [[0, "asc"]]
        });

        $('#townInput').on('change', function () {
            datatableObject.draw();
        });

        $('#numberOfBedrooms').on('change', function () {
            datatableObject.draw();
        });

        $('#searchPrice').on('change', function () {
            datatableObject.draw();
        });

        $('#type').on('change', function () {
            datatableObject.draw();
        });

        $('#propertyTypes').on('change', function () {
            datatableObject.draw();
        });

    });
</script>
