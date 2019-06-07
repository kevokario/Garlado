<?php

include './functions.php';

//POST REQUESTS
if (isset($_POST['cat']) === true) {
    $cat = $_POST['cat'];

    if ($cat === 'loadMajors') {
        loadMajors();
    } else if ($cat === 'loadDataOnMajors') {
        $majorName = $_POST['major'];
        loadDataOnMajors($majorName);
    } else if ($cat === 'searchItem') {
        $itemName = $_POST['productName'];
        searchItem($itemName);
    } else if ($cat === 'loadMajorGroupData') {
        loadMajorGroupData();
    } else if ($cat === 'loadMostBoughtData') {
        loadMostBoughtData();
    } else if ($cat === 'loadMajorGroup1Data') {
        loadMajorGroup1Data();
    } else if ($cat === 'fetchCrumbData') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        fetchCrumbData($queryName, $queryType);
    } else if ($cat === 'loadTreeData') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        loadTreeData($queryName, $queryType);
    } else if ($cat === 'loadBrandData') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        loadBrandData($queryName, $queryType);
    } else if ($cat === 'loadFeatures') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        loadFeatures($queryName, $queryType);
    } else if ($cat === 'loadProducts') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        loadProducts($queryName, $queryType);
    } else if ($cat === 'priceFilter') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $fromPrice = $_POST['fromPrice'];
        $toPrice = $_POST['toPrice'];
        $sortMethod = $_POST['sortMethod'];
        priceFilter($queryName, $queryType, $fromPrice, $toPrice, $sortMethod);
    } else if ($cat === 'sortFilter') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $fromPrice = $_POST['fromPrice'];
        $toPrice = $_POST['toPrice'];
        $filterName = $_POST['filterName'];
        $pr = $_POST['pr'];
        sortFilter($queryName, $queryType, $fromPrice, $toPrice, $filterName, $pr);
    } else if ($cat === 'loadPagination') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        loadPagination($queryName, $queryType);
    } else if ($cat === 'pagerClicked') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $data = $_POST['data'];
        $priceFrom = $_POST['priceFrom'];
        $priceTo = $_POST['priceTo'];
        $filter = $_POST['filter'];
        $brand = $_POST['brand'];
        pagerClicked($queryName, $queryType, $data, $priceFrom, $priceTo, $filter, $brand);
    } else if ($cat === 'loadNextMenu') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $lastItem = $_POST['lastItem'];
        $priceFrom = $_POST['priceFrom'];
        $priceTo = $_POST['priceTo'];
        $brand = $_POST['brand'];
        loadNextMenu($queryName, $queryType, $lastItem, $priceFrom, $priceTo, $brand);
    } else if ($cat === 'loadPrevMenu') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $lastItem = $_POST['lastItem'];
        $priceFrom = $_POST['priceFrom'];
        $priceTo = $_POST['priceTo'];
        $brand = $_POST['brand'];
        loadPrevMenu($queryName, $queryType, $lastItem, $priceFrom, $priceTo, $brand);
//        echo $lastItem.'From sq1';
    } else if ($cat === 'brandClicked') {
        $queryName = $_POST['queryName'];
        $queryType = $_POST['queryType'];
        $priceFrom = $_POST['priceFrom'];
        $priceTo = $_POST['priceTo'];
        $sortOrder = $_POST['sortOrder'];
        $brandName = $_POST['brandName'];
        brandClicked($queryName, $queryType, $priceFrom, $priceTo, $sortOrder, $brandName);
    } else if ($cat === 'pdBreadCrumb') {
        $name = $_POST['name'];
        pdBreadCrumb($name);
    } else if ($cat === 'pdloadImageDivData') {
        $name = $_POST['name'];
        pdloadImageDivData($name);
    } else if ($cat === 'loadFeaturesPd') {
        $name = $_POST['name'];
        loadFeaturesPd($name);
    } else if ($cat === 'loadMorePicDivData') {
        $name = $_POST['name'];
        loadMorePicDivData($name);
    } else if ($cat === 'loadMoreProductsDivDatapD') {
        loadMoreProductsDivDatapD();
    } else if ($cat === 'getCartDataInterface') {
        getCart();
    } else if ($cat === 'addToCartInterface') {
        $name = $_POST['name'];
        addToCartInterface($name);
    } else if ($cat === 'addToCartInterface1') {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        addToCartInterface1($name, $quantity);
    } else if ($cat === 'removeFromCartInterface') {
        $index = $_POST['index'];
        removeFromCart($index);
    } else if ($cat === 'loadShoppingListData') {
        getCart();
    } else if ($cat === 'moneyFormat') {
        $price = moneyFormat($_POST['money']);
        echo $price;
    } else if ($cat === 'checkUserLoggedIn') {
        checkUserLoggedIn();
    } else if ($cat === 'attemptSignUp') {
        $jsonData = $_POST['jsonData'];
        attemptSignUp($jsonData);
    } else if ($cat === 'codeVerificationDb') {
        $code = $_POST['code'];
        codeVerificationDb($code);
    } else if ($cat === 'getResendCode') {
        getResendCode();
    } else if ($cat === 'clientLogin') {
        $jsonData = $_POST['jsonData'];
        clientLogin($jsonData);
    } else if ($cat === 'loadCustomerData') {
        loadCustomerData();
    } else if ($cat === 'loadCCountries') {
        loadCCountries();
    } else if ($cat === 'loadCCounties') {
        $country = $_POST['country'];
        loadCCounties($country);
    } else if ($cat === 'loadSttates') {
        $state = $_POST['state'];
        loadSttates($state);
    } else if ($cat === 'loadSttations') {
        $station = $_POST['station'];
        loadSttations($station);
    } else if ($cat === 'loadStationAddress') {
        $station = $_POST['station'];
        loadStationAddress($station);
   } else if ($cat === 'addNewClientAddress') {
        $jsonData = $_POST['jsonData'];
        addNewClientAddress($jsonData);
    
   } else if ($cat === 'loadClientAddresses') {
        $email = $_POST['email'];
        loadClientAddresses($email);
    }
    else if($cat === 'editAddressData') {
        $id = $_POST['id'];
        editAddressData($id);
    }
    else if($cat === 'saveEditAddress'){
        $jsonData = $_POST['jsonData'];
        saveEditAddress($jsonData);
    }
    else if($cat === 'deleteAddressData'){
        $jsonData = $_POST['jsonData'];
        deleteAddressData($jsonData);
        
    }
    else if($cat === 'verifyAddress'){
        $email = $_POST['email'];
        verifyAddress($email);
    }
    else if($cat === 'loadOrderPayment'){
        $address = $_POST['address'];
        loadOrderPayment($address);
    }
    else if($cat==='getConfirmOrderDetails'){
        $address = $_POST['address'];
        getConfirmOrderDetails($address);
    }
    else if($cat==='orderPlacement'){
        $json = $_POST['json'];
        placeOrder($json);
    }
}
//GET REQUESTS
if (isset($_GET['gcat']) === true) {
    
}
//echo 'Obtained';