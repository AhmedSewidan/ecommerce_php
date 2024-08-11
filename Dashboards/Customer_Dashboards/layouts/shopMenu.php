<div class="shop_sidebar_area">

    <div class="widget catagory mb-50">
        
        <h6 class="widget-title mb-30">Catagories</h6>

        <div class="catagories-menu">
            <ul>
                <?php 
                    $product = new Product();
                    $sectionRecords = $product->records('sections'); 

                    $list = '';
                    foreach( $sectionRecords as $record ){
                        
                        echo "<li class=";
                        if( $record['section_id'] == $_GET['section'] ){
                            echo "active";
                        }
                        echo ">
                            <a href=\"../Shop/shop.php?section={$record['section_id']}\">{$record['section_name']}</a>
                        </li>";
                    }

                    
                    $min = 10;
                    $max = 20000;
                    if(isset($_SESSION['min']) && isset($_SESSION['max'])){
                        $min = $_SESSION['min'];
                        $max = $_SESSION['max'];
                    }
                    // unset($_SESSION['min'], $_SESSION['max'])
                ?> 
            </ul>
        </div>
    </div>

    <!-- ##### Single Widget ##### -->
    <div class="widget brands mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Brands</h6>

        <div class="widget-desc">
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="amado">
                <label class="form-check-label" for="amado">Amado</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="ikea">
                <label class="form-check-label" for="ikea">Ikea</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="furniture">
                <label class="form-check-label" for="furniture">Furniture Inc</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="factory">
                <label class="form-check-label" for="factory">The factory</label>
            </div>
            <!-- Single Form Check -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="artdeco">
                <label class="form-check-label" for="artdeco">Artdeco</label>
            </div>
        </div>
    </div>

    <!-- ##### Single Widget ##### -->
    <div class="widget color mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Color</h6>

        <div class="widget-desc">
            <ul class="d-flex">
                <li><a href="#" class="color1"></a></li>
                <li><a href="#" class="color2"></a></li>
                <li><a href="#" class="color3"></a></li>
                <li><a href="#" class="color4"></a></li>
                <li><a href="#" class="color5"></a></li>
                <li><a href="#" class="color6"></a></li>
                <li><a href="#" class="color7"></a></li>
                <li><a href="#" class="color8"></a></li>
            </ul>
        </div>
    </div>

    <form id="priceRangeForm" action="../../../../Controllers/Customers/view-request.php?section=<?php echo $_GET['section'] ?>" method="POST" target="_self">
        <!-- Hidden input fields for min and max price -->
        <input type="hidden" id="minPrice" name="min" value="10">
        <input type="hidden" id="maxPrice" name="max" value="30000">

        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Price</h6>

            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="10" data-max="20000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="<?php echo $min ?>" data-value-max="<?php echo $max ?>" data-label-result="">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price"><?php echo '$' . $min . ' - $' . $max ?></div>
                </div>
            </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn amado-btn mb-15" id="submit-button">Arrange</button>
    </form>

    
    <div>
        <form action="../../../../Controllers/Customers/view-request.php?section=<?php echo $section ?>" method="post">
            <input type="submit" name="auto" class="btn amado-btn mb-15" value="Auto Arrangment">
        </form>
    </div>


</div>