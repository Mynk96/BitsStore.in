<?php
if(isset($_GET['category'])){
    if(htmlspecialchars($_GET['category']) == "" || htmlspecialchars(($_GET['category'])) == "all"){
            
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $per_page = 12;

    $total_count = Photograph::count_all();
    
    $pagination = new Pagination($page, $per_page,$total_count);
    
    $sql = "SELECT * FROM photographs ";
    $sql .="LIMIT {$per_page} ";
    $sql .="OFFSET {$pagination->offset()}";
    
    $photos = Photograph::find_by_sql($sql);
    } 
    else {
    $category = $_GET['category'];
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $per_page = 12;

    $total_count = Photograph::count_all_with_category($category);
    
    $pagination = new Pagination($page, $per_page,$total_count);
    
    $sql = "SELECT * FROM photographs WHERE category = '".$category."'";
    $sql .="LIMIT {$per_page} ";
    $sql .="OFFSET {$pagination->offset()}";
    
    $photos = Photograph::find_by_sql($sql);
    } 
}
else{ 
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $per_page = 12;

    $total_count = Photograph::count_all();
    
    $pagination = new Pagination($page, $per_page,$total_count);
    
    $sql = "SELECT * FROM photographs ";
    $sql .="LIMIT {$per_page} ";
    $sql .="OFFSET {$pagination->offset()}";
    
    $photos = Photograph::find_by_sql($sql);

}

if(isset($_GET['toSearch'])){
    $name = $_GET['toSearch'];
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $per_page = 12;

    $total_count = Photograph::count_all_with_search($name);
    
    $pagination = new Pagination($page, $per_page,$total_count);
    
    $sql = "SELECT * FROM photographs WHERE product_name LIKE '".$name."%'";
    $sql .=" LIMIT {$per_page} ";
    $sql .="OFFSET {$pagination->offset()}";
    
    $photos = Photograph::find_by_sql($sql);
}







?>

