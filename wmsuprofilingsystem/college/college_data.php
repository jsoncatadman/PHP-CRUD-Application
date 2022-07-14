<?php

    session_start();
    include '../classes/databasemanager.class.php';

    $db = new Connection();
    $conn = $db->open();

    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $searchArray = array();

    ## Search 
    $searchQuery = " ";
    if($searchValue != '')
    {
        $searchQuery = " AND (code LIKE :code or 
                description LIKE :description ) ";
        $searchArray = array( 
                'code'=>"%$searchValue%", 
                'description'=>"%$searchValue%"
        );
    }

    ## Total number of records without filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM tblcollege ");
    $stmt->execute();
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM tblcollege WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $conn->prepare("SELECT * FROM tblcollege WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

    // Bind values
    foreach($searchArray as $key=>$search)
    {
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $empRecords = $stmt->fetchAll();

    $data = array();

    foreach($empRecords as $row)
    {
        $edit = "<a class='action-button edit' href='edit.php?id=". $row['id'] ."'>Edit</a>";
        $view = "<a class='action-button view' href='view.php?id=". $row['id'] ."'>View</a>";

        $data[] = array(
                "id"=>$row['id'],
                "code"=>$row['code'],
                "description"=>$row['description'],
                "edit"=>$edit,
                "view"=>$view
        );
    }

    ## Response
    $response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
    );

    $conn = $db->close();

    echo json_encode($response);

    /*

    $action = "<a class="action-button edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>";

    */