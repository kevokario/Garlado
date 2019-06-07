<?php

include '../Core/functions.php';
//sleep(2);

if (isset($_SESSION['marvel']) === false) {
    ?>
    <script>document.location.href = '../@logout.php';</script>    
    <?php

}
if (isset($_GET['cat'])) {

    $cat = $_GET['cat'];

    if ($cat === 'populateParentCategory') {
        populateParentCategory();
    } else if ($cat === 'addCategory') {
        $name = $_GET['name'];
        $general = $_GET['general'];
        addCategory($name, $general);
    }

    /* Populate field edit cat combo */ else if ($cat === 'populateParentCategoryEdit') {
        populateParentCategoryEdit();
    } else if ($cat === 'populateTableCategoryEdit') {
        filterCategory('ALL', 'ALL');
    } else if ($cat === 'filterCategory') {
        $status = $_GET['status'];
        $group = $_GET['group'];
        filterCategory($status, $group);
    } else if ($cat === 'PopCategoryData') {
        $id = $_GET['id'];
        PopCategoryData($id);
    } else if ($cat === 'updateCategory') {
        $catid = $_GET['id'];
        $catname = $_GET['catname'];
        $status = $_GET['status'];
        updateCategory($catid, $catname, $status);
    } else if ($cat === 'populateCateOnGeneral') {
        $general = $_GET['general'];
        populateCateOnGeneral($general);
    } else if ($cat === 'addMinorCategory') {
        $category = $_GET['category'];
        $name = $_GET['name'];
        addMinorCategory($category, $name);
    } else if ($cat === 'populateMinorParentEdit') {
        populateParentCategoryEdit();
    } else if ($cat === 'populateCateOnGeneralEdit') {
        $general = $_GET['general'];
        populateCateOnGeneralEdit($general);
    } else if ($cat === 'filterMinorCategoryEdit') {
        $general = $_GET['general'];
        $category = $_GET['category'];
        $status = $_GET['status'];
        filterMinorCategoryEdit($general, $category, $status);
    } else if ($cat === 'EditMinCatUpdate') {
        $id = $_GET['id'];
        EditMinCatUpdate($id);
    } else if ($cat === 'SaveMinorChangeUpdate') {
        $id = $_GET['minorid'];
        $name = $_GET['minorname'];
        $status = $_GET['minorstat'];

        SaveMinorChangeUpdate($id, $name, $status);
    } else if ($cat === 'populateAppProductGeneral') {
        populateAppProductGeneral();

//         populateParentCategoryEdit();
    //
    } else if ($cat === 'populateAppProductCategory') {
        $name = $_GET['name'];
        populateAppProductCategory($name);
    } else if ($cat === 'populateAppProductSpecific') {
        $name = $_GET['name'];
        populateAppProductSpecific($name);
    }
    //
    // BRAND STUFF
    //
    else if ($cat === 'populateParentBrandEdit') {
        populateParentCategoryEdit();
    } else if ($cat === 'populateParentBrand') {
        populateParentCategory();
    } else if ($cat === 'addBrandGroup') {
        $general = $_GET['general'];
        $name = $_GET['name'];
        $pic = $_GET['image'];
        addBrandGroup($name, $general, $pic);
    } else if ($cat === 'filterBrand') {
        filterBrand('ALL', 'ALL');
    } else if ($cat === 'filterBrandEdit') {
        $status = $_GET['status'];
        $general = $_GET['group'];
        filterBrand($status, $general);
    } else if ($cat === 'populateBrandData') {
        $id = $_GET['id'];
        populateBrandData($id);
    } else if ($cat === 'updateBandDataSql') {
        $id = $_GET['id'];
        $brand = $_GET['brand'];
        $status = $_GET['status'];

        updateBandDataSql($id, $brand, $status);
    }
     else if ($cat === 'updateBandDataSqlWithImage') {
        $id = $_GET['id'];
        $brand = $_GET['brand'];
        $status = $_GET['status'];
        $logo = $_GET['logo'];

        updateBandDataSqlWithImage($id, $brand, $status,$logo);
    }
    else if ($cat === 'populateAppProductBrand') {
        $name = $_GET['name'];
        populateAppProductBrand($name);
    } else if ($cat === 'addProductAddSql') {
        $specific = $_GET['specific'];
        $name = $_GET['name'];
        $price = $_GET['price'];
        $mprice = $_GET['mprice'];
        $image = $_GET['image'];
        $brand = $_GET['brand'];
        $status = $_GET['status'];
        addProductAddSql($specific, $name, $price,$mprice, $image, $brand, $status);
    }
    //
    //EDIT PRODUCT LOGIC
    //
    else if ($cat === 'populateTableEditProduct') {
        populateTableEditProduct('ALL', 'ALL', 'ALL', 'ALL');
    } else if ($cat === 'populateEditProductGeneral') {
        populateParentCategoryEdit();
    } else if ($cat === 'populateEditProductCategory') {
        $name = $_GET['name'];
        populateCateOnGeneralEdit($name);
    } else if ($cat === 'populateEditProductSpecific') {
        $name = $_GET['name'];
        populateAppProductSpecificEdit($name);
    } else if ($cat === 'editProductFilterAction') {
        $general = $_GET['general'];
        $category = $_GET['category'];
        $specific = $_GET['specific'];
        $status = $_GET['status'];
        populateTableEditProduct($general, $category, $specific, $status);
    } elseif ($cat === 'getProductData') {
        $id = $_GET['id'];
        getProductData($id);
    } else if ($cat === 'updateProductDetailsSql') {
        $id = $_GET['id'];
        $name = $_GET['name'];
        $price = $_GET['price'];
        $mprice = $_GET['mprice'];
        $stat = $_GET['status'];
        updateProductDetailsSql($id, $name, $price,$mprice, $stat);
    }
    //add more pic stuff
    else if ($cat === 'loadMorePicStuff') {
        $id = $_GET['id'];
        loadMorePicStuff($id);
    } else if ($cat === 'addMorePicSql') {
        $id = $_GET['id'];
        $img = $_GET['img'];
        $pname = $_GET['productname'];

        addMorePicSql($id, $img, $pname);
    } else if ($cat === 'loadPicList') {
        $id = $_GET['id'];
        loadPicList($id);
    } else if ($cat === 'setWebPicFunction') {
        $id = $_GET['id'];
        $imagename = $_GET['imagename'];
        $name = $_GET['productname'];
        setWebPicFunction($id, $imagename,$name);
    } else if ($cat === 'loadCarousel') {
        $id = $_GET['id'];
        loadCarousel($id);
//        echo 'obtained :'.$id;
    } else if ($cat === 'deleteWebPic') {
        //echo 'Pic deleted';
        $id = $_GET['id'];
        $image = $_GET['image'];
        $pname = $_GET['productname'];
        deleteWebPic($id, $image,$pname);
//        echo $image;
    } else if ($cat === 'addCompFeatureSql') {
        $id = $_GET['id'];
        $ram = $_GET['ram'];
        $rom = $_GET['rom'];
        $processor = $_GET['processor'];
        $os = $_GET['os'];
        $display = $_GET['display'];
        $sim = $_GET['sim'];
        $productname = $_GET['productname'];
        addCompFeatureSql($id, $ram, $rom, $processor, $os, $display, $sim,$productname);
    } else if ($cat === 'AddNoCompFeature') {
        $id = $_GET['id'];
        AddNoCompFeature($id);
    } else if ($cat === 'AddcaddNCompFeatureSql') {
        $id = $_GET['id'];
        $prop1 = $_GET['prop1'];
        $prop2 = $_GET['prop2'];
        $productname = $_GET['productname'];
        AddcaddNCompFeatureSql($id, $prop1, $prop2,$productname);
    } else if ($cat === 'ViewNCompFeature') {
        $id = $_GET['id'];
        ViewNCompFeature($id);
    } else if ($cat === 'editCoreDataClick') {
        $id = $_GET['id'];
        editCoreDataClick($id);
    } else if ($cat === 'saveCoreDataClickSql') {
        $id = $_GET['id'];
        $ram = $_GET['ram'];
        $rom = $_GET['rom'];
        $cpu = $_GET['cpu'];
        $os = $_GET['os'];
        $display = $_GET['display'];
        $sim = $_GET['sim'];
        $productname = $_GET['productname'];
        saveCoreDataClickSql($id, $ram, $rom, $cpu, $os, $display, $sim,$productname);
    } else if ($cat === 'deleteNFeature') {
        $itemId = $_GET['itemId'];
        $featureId = $_GET['featureId'];
        deleteNFeature($itemId, $featureId);
    } else if ($cat === 'deleteCFeature') {
        $id = $_GET['id'];
        $productname = $_GET['productname'];
        deleteCFeature($id,$productname);
    } else if ($cat === 'populateFilterGeneral') {
        populateParentCategoryEdit();
    } else if ($cat === 'populateFilterCat') {
        $name = $_GET['name'];
        populateCateOnGeneralEdit($name);
    } else if ($cat === 'populateFilterSpec') {
        $name = $_GET['name'];
        populateAppProductSpecificEdit($name);
    } else if ($cat === 'populateTableMyStore') {
        $general = $_GET['general'];
        $category = $_GET['category'];
        $specific = $_GET['spec'];
        $status = 'ALL';
        // echo 'Obtained!1'.$general.'<br>2'.$category.'<br>3'.$specific.'<br>.4'.$status;
        populateTableAddStore($general, $category, $specific, $status);
    } else if ($cat === 'populateTableAddStoreName') {
        $name = $_GET['name'];
        populateTableAddStoreName($name);
    } else if ($cat === 'popMoreStock') {
        $id = $_GET['id'];
        popMoreStock($id);
    } else if ($cat === 'AddStockModalData') {
        $id = $_GET['id'];
        AddStockModalData($id);
    } else if ($cat === 'saveStockSql') {
        $id = $_GET['id'];
        $current = $_GET['current'];
        $stock = $_GET['stock'];
        saveStockSql($id, $current, $stock);
    } else if ($cat === 'getviewStoreDefaults') {
        getviewStoreDefaults();
//       echo 'Obtained';
    } else if ($cat === 'veiwMyStoreGeneral') {
        veiwMyStoreGeneral();
//       echo 'Obtained';
    } else if ($cat === 'viewMyStoreCategory') {
        viewMyStoreCategory();
    } else if ($cat === 'myStoreFilterCategory') {
        $name = $_GET['name'];
        if ($name === 'ALL') {
            viewMyStoreCategory();
        } else {
            myStoreFilterCategory($name);
        }
    } else if ($cat === 'viewMyStoreSpecific') {
        viewMyStoreSpecific();
    } else if ($cat === 'myStorePopulateCat') {
        $general = $_GET['name'];
        populateCateOnGeneralEdit($general);
    } else if ($cat === 'myStoreFilterSpecific') {
        $name = $_GET['name'];
        $general = $_GET['general'];
        if($general === 'ALL' && $name=== 'ALL'){
            viewMyStoreSpecific();
        } else {
            myStoreFilterSpecific($name,$general);
        }
    }
    else if($cat === 'myAccount'){
        $email = $_GET['email'];
        myAccount($email);
    } else if($cat === 'resetPasswordSql'){
        $email = $_GET['email'];
        $pass = $_GET['pass'];
        resetPasswordSql($email,$pass);
    }
    else if ($cat === 'popAuditCombo'){
        $adminId = $_GET['adminId'];
        popAuditCombo($adminId);
    } else if($cat === 'showUserAuditSql'){
        $mf = $_GET['mf'];
        $mt = $_GET['mt'];
        $yf = $_GET['yf'];
        $yt = $_GET['yt'];
        $id = $_GET['id'];
        showUserAuditSql($id,$mf,$mt,$yf,$yt);
    } else if($cat === 'popUsers'){
        popUsers();
    } else if($cat === 'countryAdd'){
        $jsonData = $_GET['jsonData'];
        countryAdd($jsonData);
    }
    else if($cat === 'loadCountries'){
        loadCountries('ALL');
    }
    else if($cat === 'loadCountriesFilter'){
        $f = $_GET['f'];
        loadCountries($f);
    }
    else if($cat === 'loadCountryEdit'){
        $id = $_GET['id'];
        loadCountryEdit($id);
    } else if($cat === 'editCountrySave'){
        $jsonData = $_GET['jsonData'];
        editCountrySave($jsonData);
    }
    else if($cat === 'getCountryAdd'){
        getCountryAdd();
    }
    else if($cat === 'addNewCounty'){
        $jsonData = $_GET['jsonData'];
        addNewCounty($jsonData);
    }
    else if($cat === 'filterCountyData'){
        $jsonData = $_GET['jsonData'];
        filterCountyData($jsonData);
    }
    else if($cat === 'filterCountyDataAction'){
        $jsonData = $_GET['jsonData'];
        filterCountyData($jsonData);
    }
    else if($cat === 'getCountyDataEdit'){
        $id = $_GET['id'];
        getCountyDataEdit($id);
    }
    else if($cat === 'saveEditCountyDataUpdate'){
        $jsonData = $_GET['jsonData'];
        saveEditCountyDataUpdate($jsonData);
    }
    else if($cat === 'loadCountiesForState'){
        getCountryAdd();
    }
    else if($cat === 'loadCountiesForCountries'){
        $country=$_GET['country'];
        loadCountiesForCountries($country);
    }
    else if($cat === 'loadCountiesForCountriesEdit'){
        $country=$_GET['country'];
        loadCountiesForCountriesEdit($country);
    }
    else if($cat === 'addNewConstituency'){
        $jsonData=$_GET['jsonData'];
        addConstituency($jsonData);
    }
    else if ($cat==='loadCountriesConstituency'){
        getCountryAdd();
    }
    else if($cat==='loadTableConstituencySql'){
        $jsonData = $_GET['jsonData'];
        loadTableConstituencySql($jsonData);
    }
    else if($cat==='EditStateDetails'){
        $id = $_GET['id'];
        EditStateDetails($id);
//        echo 'Welcome';
    }
    else if($cat==='editStateDetailsSaveSql'){
        $jsonData = $_GET['jsonData'];
        editStateDetailsSaveSql($jsonData);
//        echo 'Welcome';
    }
    else if($cat==='loadPickupCountries'){
        getCountryAdd();
    }
    else if($cat==='loadStatesSql'){
        $county = $_GET['county'];
        loadStatesSql($county);
    }
    else if($cat==='loadStatesSql1'){
        $county = $_GET['county'];
        loadStatesSql1($county);
    }
    else if($cat === 'AddPickupPoint'){
        $jsonData = $_GET['jsonData'];
        AddPickupPoint($jsonData);
    }
    else if ($cat === 'loadPickupEditCountries'){
        getCountryAdd();
    }
    else if ($cat === 'populateTableEditPickup'){
        $jsonData = $_GET['jsonData'];
        populateTableEditPickup($jsonData);
    }
    else if ($cat === 'getPickupPointData'){
        $id = $_GET['id'];
        getPickupPointData($id);
    }
    else if ($cat === 'pickupDetailsDataSaveSql'){
        $jsonData = $_GET['jsonData'];
        pickupDetailsDataSave($jsonData);
    }
}


// send your cv to this email
//
//  enocent@live.com
//
//


