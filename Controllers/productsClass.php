<?php

$connection = new PDO('mysql:dbname=ecommerce;host=localhost', 'root', '');

class Product
{
    public $product_name;
    public $price;
    public $quantity;
    public $photo;
    public $product_status; 
    public $section_name;

    const DATA_STR    = PDO::PARAM_STR;
    const DATA_BOOL   = PDO::PARAM_BOOL;
    const DATA_INT    = PDO::PARAM_INT;
    const DATA_PHOTO  = PDO::PARAM_LOB;

    public static $tableName  = 'products';
    public static $primaryKey = 'product_id';
    public static $customer   = 1;
    public static $admin      = 2;


    public static $colums = [
        "product_id"     => self::DATA_INT,
        "photo"          => self::DATA_PHOTO,
        "product_name"   => self::DATA_STR,
        "price"          => self::DATA_STR,
        "quantity"       => self::DATA_STR,
        "product_status" => self::DATA_STR,
        "created"        => ''
    ];

    public function __construct(){}

    public static function setIntoDatabase()
    {

        $values = '';
        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['product_id', 'created']))
            {
                $values .= $key . ' = :' . $key . ', '; 
            }
        }

        return trim($values, ', ');
    }

    public static function setIdsIntoDatabase($array)
    {

        $values = '';
        foreach( $array as $key => $value )
        {
            $values .= "$value, ";
        }

        return trim($values, ', ');
    }

    // Product

    public function addProduct($product_name, $price, $quantity, $section = 1, $photo = null)
    {
        global $connection;

        if($quantity > 0){
            $product_status = "Available";
        }else{
            $product_status = "Not Available";
        } 

        $this->product_name   = $product_name;
        $this->price          = $price;
        $this->quantity       = $quantity;
        $this->photo          = $photo;
        $this->product_status = $product_status;
        
        $statm = "INSERT INTO " . self::$tableName . ' SET ' . self::setIntoDatabase() . ', section_id = ' . $section; 
        $insert = $connection->prepare($statm);

        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['product_id', 'created']))
            {
                $insert->bindValue(":$key", $this->$key, $value);
            }
        }

        return $insert->execute();
    }

    public function editProduct($product, $product_name, $price, $quantity, $photo = null)
    {

        if($quantity > 0){
            $product_status = "Available";
        }else{
            $product_status = "Not Available";
        } 

        $this->product_status = $product_status;
        $this->product_name  = $product_name;
        $this->price         = $price;
        $this->quantity      = $quantity;
        $this->photo         = $photo;

        $id = $product['product_id'];


        global $connection;
        
        $statm = "UPDATE " . self::$tableName . " SET " . self::setIntoDatabase() . " WHERE " . self::$primaryKey  . " = " . $id; 
        $insert = $connection->prepare($statm);

        // print_r($statm);
        
        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['product_id', 'created']))
            {
                $insert->bindValue(":{$key}", $this->$key, $value);
            }
        }

        return $insert->execute() ? true : false;    
    }

    public function editProductByQuantity( $user_id )
    {
        global $connection;

        $productsInCart = $this->productsInCart($user_id);

        foreach( $productsInCart as $productInCart ){
            $idInCart = $productInCart['product_id'];
            $productInStore = $this->getProductById($idInCart);
            $quantityInCart = $productInCart['order_quantity'];
            $quantityInStore = $productInStore['quantity'];
            $quantityUpdate = $quantityInStore - $quantityInCart;
            $statm  = "UPDATE " . self::$tableName . " SET quantity = $quantityUpdate WHERE " . self::$primaryKey  . " = " . $idInCart; 
            $insert = $connection->prepare($statm);
            $insert->execute();
        }
        

    }

    public function deleteProduct($Product)
    {
        $id = $Product['product_id'];

        global $connection;
        
        $statm = "DELETE FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " = " . $id; 
        $delete = $connection->prepare($statm);
        $delete->execute();
    }

    public function addMessage( $message, $user_id, $product_id )
    {
        global $connection;
        
        $statm = "INSERT INTO review (user_id, product_id, review_message) VALUES ($user_id, $product_id, \"$message\")"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }
    
    // Orders

    public function addProductToOrder( $product_id, $user_id, $order_quantity, $amount_one_product )
    {
        global $connection;
        
        $statm = "INSERT INTO one_product_order (product_id, order_quantity, total_amount, user_id) VALUES ($product_id, $order_quantity, $amount_one_product, $user_id)"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function getProductToOrder( $user_id )
    {
        global $connection;
        
        $statm = "SELECT * FROM one_product_order WHERE user_id = $user_id AND status = 'Not Orderd'"; 
        $insert = $connection->prepare($statm);
        $insert->execute();
        $fetchStat = $insert->fetchAll(PDO::FETCH_ASSOC);

        return $fetchStat;
    }

    public function getProductChart( $user_id, $product_id )
    {
        global $connection;
        
        $statm = "SELECT * FROM one_product_order WHERE user_id = $user_id AND product_id = $product_id AND status = 'Not Ordered'"; 
        $insert = $connection->prepare($statm);
        $insert->execute();
        $fetchStat = $insert->fetchAll(PDO::FETCH_ASSOC);

        return $fetchStat;
    }

    public function updateProductToOrder( $product_id, $user_id, $order_quantity, $amount_one_product )
    {
        global $connection;
        
        $statm = "UPDATE one_product_order
                    SET order_quantity = $order_quantity,
                        total_amount = $amount_one_product
                    WHERE user_id = $user_id
                    AND product_id = $product_id";

        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function updateProductToBeOrder( $user_id, $status, $order_id )
    {
        global $connection;
        
        $statm = "UPDATE one_product_order
                    SET status = '$status',
                    order_id  = $order_id
                    WHERE user_id = $user_id AND status = 'Not Ordered'";

        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function deleteProductToOrder( $product_id )
    {
        global $connection;
        
        $statm = "DELETE FROM one_product_order WHERE product_id = $product_id"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function addOrder( $user_id, $total_amount, $status, $city, $address, $second_number, $_comment, $first_name, $second_name, $delivery, $pay, $country = "Egypt" )
    {
        global $connection;
        
        $statm = "INSERT INTO customer_orders 
                        SET user_id = $user_id,
                        total_amount = $total_amount,
                        status = '$status',
                        country = '$country',
                        city = '$city',
                        address = '$address',
                        second_phone = '$second_number',
                        _comment = '$_comment',
                        first_name = '$first_name',
                        second_name = '$second_name',
                        delivery = $delivery,
                        pay = '$pay'"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function updateOrder( $user_id, $total_amount, $status )
    {
        global $connection;
        
        $statm = "UPDATE customer_orders
                    SET total_amount = $total_amount
                    WHERE user_id = $user_id"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function deleteOrder( $user_id, $order_id )
    {
        global $connection;
        
        $statm = "DELETE FROM customer_orders WHERE user_id = $user_id AND order_id = $order_id"; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function productsInCart( $user_id )
    {
        global $connection;
        
        $statm = "SELECT * FROM one_product_order WHERE user_id = $user_id AND status = 'Not Ordered'"; 
        $insert = $connection->prepare($statm);
        $insert->execute();
    
        $fetchStat = $insert->fetchAll(PDO::FETCH_ASSOC);

        return $fetchStat;
    }

    

    public function getProductsInOrder($user_id)
    {

        global $connection; 

        if($user_id){

            $statm2 = "SELECT 
                        products.photo,
                        products.product_name,
                        products.quantity,  
                        one_product_order.product_id,
                        one_product_order.order_quantity,  
                        one_product_order.total_amount
                    FROM 
                        products
                    JOIN 
                    one_product_order ON products.product_id = one_product_order.product_id 
                    WHERE one_product_order.user_id = $user_id AND one_product_order.status = 'Not Ordered'" ;
            $select = $connection->prepare($statm2);
            $select->execute();
            $records = $select->fetchAll(PDO::FETCH_ASSOC);

            $result = "";
            if(count($records)){

                foreach($records as $product){

                    $id             = $product['product_id'];
                    $price          = $product['total_amount'];
                    $quantity       = $product['quantity'];
                    $order_quantity = $product['order_quantity'];

                    $result .= "<form id=\"quantityForm\" onsubmit=\"return true;\" action=\"../../../../Controllers/Customers/update-order.php?id=$id\" method=\"post\">";
                    $result .= "<tr>"; 
                    $result .= "<td class=\"cart_product_img\">
                                    <a href=\"../Home/product-details.php?id=$id\"><img src=\"data:image/jpeg;base64," . base64_encode($product['photo']) . "\" alt=\"Product\"></a>
                                </td>";
                    $result .= "<td class=\"cart_product_desc\">
                                    <h5>{$product['product_name']}</h5>
                                </td>";
                    $result .= "<td class=\"price\">
                                    <span>$$price</span>
                                </td>";
                    $result .= "<td class=\"qty\">
                                    <div class=\"qty-btn d-flex\">
                                        <p>Qty</p>
                                        <div class=\"quantity\">
                                            <input class=\"qty-minus\" onclick=\"decrement(this, 1)\" type=\"submit\" class='submit' id='minus' value='-'>
                                                <input type=\"number\" class=\"qty-text\" step=\"1\" name=\"quantity\" value=\"$order_quantity\">
                                            <input class=\"qty-plus\" onclick=\"increment(this)\" type=\"submit\" class='submit' id='plus' value='+'>
                                        </div>
                                    </div>
                                </td>";
                    $result .= "<td><a class='delete' href=\"../../../../Controllers/Customers/delete-product-cart.php?id=$id\">&#x1F5D1;</a></td>";
                    $result .= "</tr>"; 

                    $result .= "</form>";
                }
            }

        }else{
            $result = "<td colspan='4'>Error Please Login Again</td>";
        }

        return $result;
    }

    public function getOrdersSent($user_id)
    {

        global $connection; 

        $statm2 = "SELECT * FROM customer_orders WHERE user_id = $user_id ORDER BY order_id DESC ";
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll(PDO::FETCH_ASSOC);
            
        $result = "";
        if( $records){
    
            foreach($records as $order){

                $statm1 = "SELECT product_id, order_quantity FROM one_product_order 
                WHERE user_id = $user_id AND order_id = {$order['order_id']} AND status = 'Ordered'";
                $select1 = $connection->prepare($statm1);
                $select1->execute();
                $arrOrderIDs = $select1->fetchAll(PDO::FETCH_ASSOC);

                $result .= "<a class=\"deleteOrder\" 
                                href=\"../../../../Controllers/Customers/delete-order.php?id={$order['order_id']}\" onclick=\"return confirm('Are you sure you want to delete this order?');\">
                                &#128465; Delete
                            </a>";
                $result .= "<table class='order-table'>";

                foreach( $order as $key => $value ){
                    if(!in_array($key,['user_id', 'last_update'])){
                        $result .= "<tr>"; 
                        $result .= "<th>" .ucwords(trim( str_replace('_', ' ', $key), '_' ) ). "</th>"; 
                        $result .= "<td>$value</td>"; 
                        $result .= "</tr>";
                    }
                }
                $result .= "<tr>"; 
                $result .= "<th class='products-details'>Products</th>
                              <td>"; 
                foreach( $arrOrderIDs as $id ){
                    $productId = $id['product_id'];
                    $product   = $this->getProductById($productId);
                    $photo     = $this->getPhoto($productId);
                    $result   .= "<a href='../Home/product-details.php?id=$productId'>
                    <img class=\"nav-link dropdown-toggle hide-arrow\" 
                    src=\"data:image/jpeg;base64," . base64_encode($photo) . "\" style=\"display:inline; width: 40px; height: 40px; border-radius: 50%;\" >
                    </a>";

                    $result   .= " {$product['product_name']} ({$id['order_quantity']})  ";
                }
                $result .= "  </td>
                            </tr>";

                $result .= "</table><br>";

            }
        }else{
            $result = "<p style='width:400px'>It's No Orders Here At This Time</p>";
        }


        return $result;
    }


    // Sections

    public function addSection($section_name, $photo)
    {
        global $connection;
    
        $this->section_name = $section_name;
        $this->photo = $photo;
    
        $statm = "INSERT INTO sections (section_name, photo) VALUES (?, ?)";
        $insert = $connection->prepare($statm);
    
        $insert->bindParam(1, $this->section_name, PDO::PARAM_STR);
    
        $insert->bindParam(2, $this->photo, PDO::PARAM_LOB);
    
        return $insert->execute();
    }

    public function editSection($section_name, $photo, $id)
    {
        global $connection;

        $this->section_name = $section_name;
        $this->photo = $photo;

        // Prepare SQL statement with placeholders
        $statm = "UPDATE sections SET section_name = ?, photo = ? WHERE section_id = ?";
        $update = $connection->prepare($statm);

        // Bind parameters
        $update->bindParam(1, $this->section_name, PDO::PARAM_STR);
        $update->bindParam(2, $this->photo, PDO::PARAM_LOB);
        $update->bindParam(3, $id, PDO::PARAM_INT); // Assuming section_id is an integer

        // Execute the statement
        return $update->execute();
    }

    public function deleteSection($section)
    {
        $id = $section['section_id'];

        global $connection;
        
        $statm = "DELETE FROM sections WHERE section_id = " . $id; 
        $delete = $connection->prepare($statm);
        $delete->execute();
    }

    // Comments 

    public function addComment($user_id_from, $product_id, $_comment, $type, $user_id_to = '')
    {
        global $connection;
    
        $statm = "INSERT INTO comments (user_id_from, user_id_to, product_id, _comment, type) 
        VALUES ( $user_id_from, $user_id_to, $product_id, $_comment, $type )";
        $insert = $connection->prepare($statm);
    
        return $insert->execute();
    } 
    // Many Products

    public function getProducts($Product_type)
    {

        global $connection; 

        $statm2 = "SELECT * FROM " . self::$tableName . " WHERE section_id = $Product_type" ;
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll();

        $result = "";
        if(count($records)){

            foreach($records as $Products){

                $id =  $Products['product_id'];
                $result .= "<tr>"; 
                $result .= "<td><input type='checkbox' class='myCheckbox' name='checkbox[]' value='" . $id ."'></td>";

                $result .="<th>
                <img src=\"data:image/jpeg;base64," . base64_encode($Products['photo']) . "\" style='border-radius:50%' width=\"50\" height=\"50\">
                </td>";

                foreach(self::$colums as $key => $value){
    
                    $values =  $Products[$key];

                    if(!in_array($key,['product_id', 'photo'])){
                        $result .= "<td>$values</td>";
                    }

                }

                $result .= "<td>
                                <div class='dropdown'>
                                <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <div class='dropdown-menu'>
                                    <a class='dropdown-item' href='../Forms/EditProduct.php?id=$id'>
                                    <i class='bx bx-edit-alt me-1'></i> Edit</a>
                                    
                                    <a class='dropdown-item' href='../../../../Controllers/deleteProduct.php?id=$id&section={$_GET['section']}'>
                                    <i class='bx bx-trash me-1'></i> Delete</a>
                                </div>
                                </div>
                            </td>";
                $result .= "</tr>"; 
            }
        }

        return $result;
    }

    public function getAllProductsByIDs($arrayIds)
    {

        global $connection; 

        $idsInCart = self::setIdsIntoDatabase($arrayIds);

        $statm2 = "SELECT * FROM " . self::$tableName . " WHERE product_id IN ( $idsInCart )";
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }

    public function checkQuantityBeforeBuy($user_id){
        global $product;
        $productsInCart = $this->productsInCart($user_id);
    
        $arrayIds = [];
        foreach( $productsInCart as $oneProduct){
            array_push($arrayIds, $oneProduct['product_id']);
        }
    
        $productDetail = $this->getAllProductsByIDs($arrayIds);
    
        foreach( $productDetail as $oneProductDetail){
            if($oneProductDetail['quantity'] == 0){
                return $oneProductDetail;
            }
        }
        return false;
    }

    public function getProductsAtHome()
    {

        global $connection; 

        $statm2 = "SELECT * FROM " . self::$tableName . " ORDER BY RAND() LIMIT 9" ;
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll();

        $result = "";
        if(count($records)){

            foreach($records as $product){

                $id      =  $product['product_id'];
                $price   = $product['price'];
                $name    = $product['product_name'];
                
                $photo   = $this->getPhoto($id);
                $result .= "<div class=\"single-products-catagory clearfix\">
                                <a href=\"../Home/product-details.php?id=$id\">
                                    <img src=\"data:image/jpeg;base64," . base64_encode( $photo ) . "\" alt=\"\">
                                    <div class=\"hover-content\">
                                        <div class=\"line\"></div>
                                        <p>$$price</p>
                                        <h4>$name</h4>
                                    </div>
                                </a>
                            </div>";
            }
        }

        return $result;
    }

    public function getShopProducts($product_type, $view = 6, $sort = "RAND()", $minPrice = '10', $maxPrice = '30000', $show = "Squars")
    {

        global $connection; 

        $statm1 = "SELECT COUNT(*) AS record_count FROM " . self::$tableName . " WHERE section_id = $product_type";
        $select1 = $connection->prepare($statm1);
        $select1->execute();
        $count_result = $select1->fetch();
        $record_count = $count_result['record_count'];
        
        if ($record_count >= 6) {
            $view = $view;
        } elseif ($record_count >= 1 && $record_count <= 6) {
            $view = $record_count;
        } else {
            $view = 0;
        }

        if( $sort  === "Date" ){
            $sort  = "product_id";
        }if( $sort === "Name" ){
            $sort  = "product_name";
        }if( $sort === "Price" ){
            $sort  = "price";
        }if( $sort === "Random" ){
            $sort  = "RAND()";
        }
        
        $statm2 = "SELECT * FROM " . self::$tableName . " WHERE section_id = $product_type AND price BETWEEN $minPrice AND $maxPrice ORDER BY $sort ASC LIMIT $view" ;
        $select2 = $connection->prepare($statm2);
        $select2->execute();
        $records2 = $select2->fetchAll();
        

        $result = "";
        if(count($records2)){

            foreach($records2 as $products){

                $id        =  $products['product_id'];
                $name      =  $products['product_name'];
                $price     =  $products['price'];
                $quantity  =  $products['quantity'];
                $status    =  $products['product_status'];
                $photo     =  $products['photo'];

                if( $quantity == 0 ){
                    $hoverMess = "Sold !..";
                    $linkBuy   = "#";
                    $message ="<p class=\"red\">This Product Is Currently Unavailable.</p>";
                }elseif( $quantity <= 3 ){
                $linkBuy   = "../../../../Controllers/Customers/addToChart.php?id=$id";
                    $hoverMess = "Add To Chart";
                    $message ="<p class=\"red\">Only $quantity Left In Stock - Order Soon.</p>";
                }else{
                $linkBuy   = "../../../../Controllers/Customers/addToChart.php?id=$id";
                    $hoverMess = "Add To Chart";
                    $message = "";
                }

                if( $show === "Squars" ){

                    $result .= "<div class=\"col-12 col-sm-6 col-md-12 col-xl-6\">
                    <a href=\"../Home/product-details.php?id=$id\">
                        <div class=\"single-product-wrapper\">

                            <div class=\"product-img\">
                                <img src=\"data:image/jpeg;base64," . base64_encode( $photo ) . "\" alt=\"\">
                            </div>

                            <div class=\"product-description d-flex align-items-center justify-content-between\">
                                <div class=\"product-meta-data\">
                                    <div class=\"line\"></div>
                                    <p class=\"product-price\">$$price</p>
                                        <h6>$name</h6>
                                </div>

                                <div class=\"ratings-cart text-right\">
                                    <div class=\"ratings\">
                                        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                    </div>
                                    <div class=\"cart\">
                                        <a href=\"$linkBuy\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"$hoverMess\">
                                            <img src=\"../../../../public/customer/img/core-img/cart.png\" alt=\"\">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            $message

                        </div>
                    </a>
                </div>";

                }elseif( $show === "Columns" ){
                    $result .= "<tr>
                        <td class=\"cart_product_img\" ><a href=\"../Home/product-details.php?id=$id\">
                            <img src=\"data:image/jpeg;base64," . base64_encode( $photo ) . "\" ></a></td>
                        <td>$name</td>
                        <td>$$price</td>
                        <td>
                            <div class=\"ratings-cart text-right\">
                                <div class=\"ratings\">
                                    <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                    <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                    <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                    <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                    <i class=\"fa fa-star\" aria-hidden=\"true\"></i>
                                </div>
                                <div class=\"cart\">
                                    <a href=\"$linkBuy\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"$hoverMess\">
                                        <img src=\"../../../../public/customer/img/core-img/cart.png\" alt=\"\">
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"5\">$message</td>
                    </tr>";
                                
                }


            }
        }else{
            if( $show === "Squars" ){
                $result .= '<div class="emptyProducts">Sorry This Section Has No Products At This Time</div>';
            }elseif( $show === "Columns" ){
                $result .= '<td colspan="5"><div class="emptyProducts">Sorry This Section Has No Products At This Time</div></td>';
            }
        }
        return $result;
    }

    public function deleteProducts($arrStudentIds)
    {
        global $connection;

        $deleteStatm = '';

        foreach( $arrStudentIds as $studentIds )
        {
            $deleteStatm  .=  $studentIds . ' , '; 
        }

        $result = "DELETE FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " IN ( " . trim( $deleteStatm, ' , ' ) . ' )'; 

        $delete = $connection->prepare($result);
        return $delete->execute();
    }

    // Get By ID

    public function getProductById($id)
    {
        global $connection;

        if( $id != null )
        {
            $statm2 = "SELECT * FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " = " . $id;
            $select = $connection->prepare($statm2);
            $select->execute();
            $record = $select->fetch(PDO::FETCH_ASSOC);
            return $record ; 
        }else{
            return false;
        }

    }

    public function getSectionById($id)
    {
        global $connection;

        if( $id != null )
        {
            $statm2 = "SELECT * FROM sections WHERE section_id = " . $id;
            $select = $connection->prepare($statm2);
            $select->execute();
            $record = $select->fetch(PDO::FETCH_ASSOC);
            return $record ; 
        }else{
            return false;
        }

    }
    
    function getSectionPhoto($id) {
        global $connection;
        
        $stmt = $connection->prepare("SELECT photo FROM sections WHERE section_id = ?");
        $stmt->execute([$id]);
        $photoData = $stmt->fetchColumn();
        
        return $photoData;
    }

    function getPhoto($id) {
        global $connection;
        
        $stmt = $connection->prepare("SELECT photo FROM " . self::$tableName . " WHERE product_id = ?");
        $stmt->execute([$id]);
        $photoData = $stmt->fetchColumn();
        
        return $photoData;
    }

    function randomId( $table, $columnId ){
        global $connection;
    
        $statmNum2   = "SELECT $columnId FROM $table ORDER BY RAND() LIMIT 1" ;
        $rendomId    = $connection->prepare($statmNum2);
        $rendomId->execute();
    
        $result = $rendomId->fetchAll();
    
        if(count($result)){
            
          return $result[0][$columnId];
        }
    }

    function firstRecord( $table, $id ){
        global $connection;
    
        $statmNum2   = "SELECT $id FROM $table ORDER BY $id LIMIT 1" ;
        $record    = $connection->prepare($statmNum2);
        $record->execute();
    
        $result = $record->fetchAll();
    
    
        if(count($result)){
            
            return $result[0]['section_id'];
        }
    }

    // Fetch Records

    public function fethAll()
    {
        global $connection;

        $stat = 'SELECT * FROM ' . self::$tableName;
        $conect = $connection->prepare($stat);
        $conect->execute();
    
        $fetchStat = $conect->fetchAll(PDO::FETCH_ASSOC);

        return $fetchStat;
    }

    function records( $table ){
        global $connection;

        $statmNum2   = "SELECT * FROM $table" ;
        $records    = $connection->prepare($statmNum2);
        $records->execute();

        return $records->fetchAll();

    }
    
    public function getLastInsert() {
        global $connection;

        return $connection->lastInsertId();
    }

}


