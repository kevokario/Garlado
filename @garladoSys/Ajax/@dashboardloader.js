
//
//=++++++++++++++++++++FILE MANAGES SWAPPING OF DIVS++++++++++++++
//
/////////////////////////////////////////////////////////////////
//                  Click Handler Section                    //
///////////////////////////////////////////////////////////////

function menuClicked(str) {
    var mystr = str;
    if (mystr === 'Manage Staff') {
        menuHandler('Manage Staff');
    } else if (mystr === 'defaultPage') {
        menuHandler('defaultPage');
    } else if (mystr === 'goodsManager') {
        menuHandler('goodsManager');
    }

//Add Staff SubOptions
    else if (mystr === 'Add Member') {
        menuHandlerAddStaff('addMember');
    } else if (mystr === 'Add Member') {
        menuHandlerAddStaff('addMember');
    } else if (mystr === 'Members View') {
        menuHandlerAddStaff('viewMember');
        popData();
    } else if (mystr === 'View Audit') {
        menuHandlerAddStaff('viewAudit');
    }

//goodsmanager Suboption
    /*  OPTION GENERAL  */
    else if (mystr === 'addGeneral') {
        menuHandlerGeneral('addGeneral');
    } else if (mystr === 'viewGeneral') {
        menuHandlerGeneral('viewGeneral');
    } else if (mystr === 'editGeneral') {
        menuHandlerGeneral('editGeneral');
    }

//goodsmanager Suboption
    /*  OPTION CATEGORY  */
    else if (mystr === 'addCategory') {
        menuHandlerCategory('addCategory');
    } else if (mystr === 'editCategory') {
        menuHandlerCategory('editCategory');
    }

//goodsmanager Suboption
    /*  OPTION CATEGORY  */
    else if (mystr === 'addBrand') {
        menuHandlerBrand('addBrand');
    } else if (mystr === 'editBrand') {
        menuHandlerBrand('editBrand');
    }

//goodsmanager Suboption
    /*  SPECIFIC GROUP CATEGORY  */

    else if (mystr === 'addMinorCategory') {
        menuHandlerMinorCategory('addMinorCategory');
    } else if (mystr === 'editMinorCategory') {
        menuHandlerMinorCategory('editMinorCategory');
    }
//goodsmanager Suboption
    /*  MY PRODUCT CATEGORY  */
    else if (mystr === 'productsLoadProducts') {
        menuHandlerProduct('productsLoadProducts');
    } else if (mystr === 'productsUnLoadProducts') {
        menuHandlerProduct('productsUnLoadProducts');
    } else if (mystr === 'addProduct') {
        menuHandlerProduct('addProduct');
    } else if (mystr === 'editProduct') {
        menuHandlerProduct('editProduct');
    } else if (mystr === 'defaultProduct') {
        menuHandlerProduct('defaultProduct');
    }

//goods manager sub option.
//Option manage pricture

    else if (mystr === 'addmorepictures') {
        menuHandlerPictureManager('addMorePictures');
    } else if (mystr === 'manageproductpictures') {
        menuHandlerPictureManager('manageProductPictures');
    } else if (mystr === 'viewproductpictures') {
        menuHandlerPictureManager('viewProductPictures');
    }
//goods manager sub option.
//Option manage features

    else if (mystr === 'addFeature') {
        menuHandlerFeatureManager('addFeature');
//        menuHandlerFeatureManager('addFeature');
    } else if (mystr === 'viewFeature') {
        menuHandlerFeatureManager('viewFeature');
    } else if (mystr === 'AddCompFeature') {
        menuHandlerFeatureManager('AddCompFeature');
    } else if (mystr === 'AddNoCompFeature') {
        menuHandlerFeatureManager('AddNoCompFeature');
    } else if (mystr === 'defaultFeature') {
        menuHandlerFeatureManager('default');
    }

// store management Area
    else if (mystr === 'my Store') {
        menuHandlerStore('@storeManager');
    } else if (mystr === 'addStock') {
        menuHandlerStore('addStock');
    } else if (mystr === 'viewStore') {
        menuHandlerStore('viewStore');
    }
    //pickup management Area
    else if (mystr === 'pickup manager') {
        menuHandlerPickup('@pickupManager');
    } else if (mystr === 'addCountry') {
        menuHandlerPickup('addCountry');
    } else if (mystr === 'viewCountry') {
        menuHandlerPickup('viewCountry');
    } else if (mystr === 'addCounty') {
        menuHandlerCounty('addCounty');
    } else if (mystr === 'viewCounty') {
        menuHandlerCounty('viewCounty');
    } else if (mystr === 'addConstituency') {
        menuHandlerConstituency('addConstituency');
    } else if (mystr === 'viewConstituency') {
        menuHandlerConstituency('viewConstituency');
    } else if (mystr === 'addPickup') {
        menuHandlerPickups('addPickup');
    } else if (mystr === 'viewPickup') {
        menuHandlerPickups('viewPickup');
    }

}


function numberValidate1(str, ediv) {
    //variables

    var number = str;
    var div = ediv;
    var result = true;
    //validation

    if (number.length === 0) {
        result = false;
        div.innerHTML = 'Please provide number of new stock items';
    } else if (/[^0-9\-]/.test(number)) {
        result = false;
        div.innerHTML = 'Provide only digits';
    } else {
        result = true;
        div.innerHTML = '';
    }

    return result;
}





///////////////////////////////////////////////////////////////
//                  switch Handler Section                   //
///////////////////////////////////////////////////////////////

function menuHandler(str) {
//my variables
    var ajax = getAjax();
    var mystr = str;
    var div = document.getElementById('mainDivDboard');
    var div = document.getElementById('mainDivDboard');
    var page = '';
    if (mystr === 'defaultPage') {
        page = '@defaultPage.html';
    } else if (mystr === 'Manage Staff') {
        page = '@staffManager.html';
    } else if (mystr === 'goodsManager') {
        page = '@goodsManager.html';
    }
    var url = "widgets/" + page;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            //  alert(ajax.responseText);
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}


///////////////////////////////////////////////////////////////
//         switch Handler Section  SubOption ADD SAFF        //
///////////////////////////////////////////////////////////////

function menuHandlerAddStaff(str) {
    var ajax = getAjax();
    var mystr = str;
    var div = document.getElementById('holder');
    var page = '';
    var url = "widgets/" + mystr + ".html";
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
//            alert(ajax.responseText);
            if (mystr === 'viewMember') {
                popData();
            }
            if (mystr === 'viewAudit') {
                popUsers();
            }

        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p class="text-center text-primary">Loaing...<i class="fa fa-refresh fa-spin"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function popData() {
    var ajax = getAjax();
    var div = document.getElementById('usertable');
    //test('demo1');
    div.innerHTML = '<tr><td colspan="5" class="text-center text-primary">Loading user-data...<i class="fa fa-refresh fa-spin"></i></td></tr>';
    try {
        var url = "AjaxPhp/@dasboardScript.php?cat=viewMember";
        //test(url);
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                div.innerHTML = ajax.responseText;
            } else if (ajax.readyState === 3) {
                div.innerHTML = '<p class="text-center text-primary">Loading user-data...<i class="fa fa-refresh fa-spin"></i></p>';
            } else if (ajax.readyState === 2) {
                div.innerHTML = '<p class="text-center text-primary">Loading user-data...<i class="fa fa-refresh fa-spin"></i></p>';
            } else if (ajax.readyState === 1) {
                div.innerHTML = '<p class="text-center text-primary">Loading user-data...<i class="fa fa-refresh fa-spin"></i></p>';
            } else if (ajax.readyState === 0) {
                div.innerHTML = '<p class="text-center text-primary">Loading user-data...<i class="fa fa-refresh fa-spin"></i></p>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    } catch (e) {
        alert(e);
    }
}

function Launchdiv(str) {
    $('#myModal').modal('show');
    getDetails(str, document.getElementById('detailsarea'));
}

function popS() {

}

/////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption GENERAL GOOD MANAGER SAFF        //
/////////////////////////////////////////////////////////////////////////

function menuHandlerGeneral(str) {
    var div = document.getElementById('modalGeneral');
    var mystr = str;
    var url = 'widgets/myGeneralData/' + mystr + '.html';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            popGroupData();
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}
/////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption CATEGORY GOOD MANAGER SAFF        //
/////////////////////////////////////////////////////////////////////////

function menuHandlerCategory(str) {
    var div = document.getElementById('modalCategory');
    var mystr = str;
    var url = 'widgets/myCategoryData/' + mystr + '.html';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
//           populateParent();populateParentEdit();
            if (mystr === 'addCategory') {
                populateParent();
            }
            if (mystr === 'editCategory') {
                populateParentEdit();
                popTableCategory();
            }

        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}
//Add GROUP FORM CONTENT SCRIPT
//==================================================

function groupAdd() {
    var namediv = document.getElementById('addNewGroup');
    var alldiv = document.getElementById('addGroup');
    var name = document.addGroup.addNewGroup.value;
    var namevalid = nameValidate1(name, namediv);
    if (namevalid === false) {
//      alldiv.innerHTML='not Cool'; 
        namediv.focus();
    } else {
        alldiv.innerHTML = '';
        addGroupsql(name, alldiv);
    }
}

function editGroupModal(id) {
    $('#groupEdit').modal('show');
    popGroupDat(id);
}

function popGroupDat(id) {
    var myid = id;
    var namefield = document.groupeditform.namegroup;
    var groupstat = document.groupeditform.status;
    var errordiv = document.getElementById('editgroupfeedback');
    var idfield = document.groupeditform.majorID;
    var ajax = getAjax();
    idfield.value = myid;
    var url = "AjaxPhp/@dasboardScript.php?cat=groupDataView&GroupId=" + myid;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {

            errordiv.innerHTML = '';
            var response = ajax.responseText;
//            test(response);
            var start = response.indexOf('~');
            var middle = response.indexOf('^');
            var name = response.substring((start + 1), middle);
            var status = response.substring((middle + 1));
            // errordiv.innerHTML = '*'+name+'*'+status+'*';
            namefield.value = name;
            if (status == 0) {
                groupstat.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            } else {
                groupstat.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            }
        } else if (ajax.readyState === 3) {
            errordiv.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 2) {
            errordiv.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 1) {
            errordiv.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 0) {
            errordiv.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function editGroupSave() {
    var name = document.groupeditform.namegroup.value;
    var namediv = document.getElementById('namediv');
    var id = document.groupeditform.majorID.value;
    var status = document.groupeditform.status.value;
    var maindiv = document.getElementById('editgroupfeedback');
    var nameok = nameValidate(name, namediv);
    if (nameok === true) {
//update data in database
        updateGroup(id, name, status, maindiv);
    } else {
        document.groupeditform.namegroup.focus();
    }
}


//Add CATEGORY GROUP FORM CONTENT SCRIPT
//==================================================
/*populate combobox general in form add category*/
function populateParent() {
    var field = document.addCategoryform.general;
    var div = document.getElementById('generalError');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateParentCategory";
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            field.innerHTML = '';
            div.innerHTML = '';
            field.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}
/*function populates combobox for edit category*/
function populateParentEdit() {
    var field = document.filterEdit.generalGroupEdit;
    var div = document.getElementById('generalEditError');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateParentCategoryEdit";
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            field.innerHTML = '';
            div.innerHTML = '';
            field.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

/*function add general clicked*/

function addCategory() {

    var general = document.addCategoryform.general.value;
    var gendiv = document.getElementById('generalError');
    var cat = document.addCategoryform.addcategory.value;
    var catdiv = document.getElementById('addCategory');
    var errdiv = document.getElementById('addCategoryfeedback');
    var catok = nameValidate(cat, catdiv);
    var genok = generalValidate(general, gendiv);
    if (catok === false) {
        document.addCategoryform.addcategory.focus();
    } else if (genok === false) {
        document.addCategoryform.general.focus();
    } else {
        addCategorysql(general, cat, errdiv);
    }

}



function editCategory(str) {
//display modal
    $('#categoryGroupEdit').modal('show');
    var mystr = str;
    //var fields to populate
    var id = document.editcat.catid.value = mystr;
    var prtname = document.editcat.prtname;
    var prcat = document.editcat.categorynameedit;
    var crtstat = document.editcat.crtstatusedit;
    var div = document.getElementById('editCatErrordiv');
//   div.innerHTML='wew';
//    test(q);
    var url = 'AjaxPhp/test.php?cat=PopCategoryData&id=' + mystr;
//    prcat.value='KARIO';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            var pname = response.substring(response.indexOf('^') + 1, response.indexOf('*'));
            var cname = response.substring(response.indexOf('*') + 1, response.indexOf('+'));
            var status = response.substring(response.indexOf('+') + 1);
            prtname.value = pname;
            div.innerHTML = '';
            prcat.value = cname;
            if (status == 0) {
                crtstat.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            } else {
                crtstat.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            }

        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function editCat() {
    var id = document.editcat.catid.value;
    var prtname = document.editcat.prtname.value;
    var prcat = document.editcat.categorynameedit.value;
    var catdiv = document.getElementById('errorcrtname');
    var crtstat = document.editcat.crtstatusedit.value;
    var div = document.getElementById('editCatErrordiv');
    var status = document.editcat.crtstatusedit.value;
    var mystat = 0;
    if (status === 'ACTIVE') {
        mystat = 1;
    }
    var nameok = nameValidate(prcat, catdiv);
    if (nameok === false) {
        document.editcat.categorynameedit.focus();
    } else {
        updateCategory(id, mystat, prcat, div);
    }
}

////////////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption SPECIFIC CATEGORY GOOD MANAGER SAFF     //
////////////////////////////////////////////////////////////////////////////////

function menuHandlerMinorCategory(str) {
    var div = document.getElementById('modalMinorCategory');
    var mystr = str;
    var url = 'widgets/mySpecificData/' + mystr + '.html';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
//           populateParent();populateParentEdit();
            if (mystr === 'addMinorCategory') {
                //some function here to load predata
                populateMinorParent();
            }
            if (mystr === 'editMinorCategory') {
                //some function here to preload data
                populateMinorParentEdit();
                filterMinorCategoryEditSql("ALL", "ALL", "ALL", document.getElementById('SpecificCategoryViewEdit'));
            }

        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p class="text-center text-primary">Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function populateMinorParent() {
    var generalcombo = document.addMinorCategoryform.general;
    var generaldiv = document.getElementById('generalErrorMinor12');
    var url = "AjaxPhp/test.php?cat=populateParentCategory";
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            generaldiv.innerHTML = '';
            generalcombo.innerHTML = ajax.responseText;
        } else {
            generaldiv.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function populateMinorCategory(str) {
    var general = str;
    var category = document.addMinorCategoryform.category;
    var categorydiv = document.getElementById('cagetoryErrorMinor');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateCateOnGeneral&general=" + general;
    if (str.indexOf('---') !== -1) {
        category.innerHTML = '<option>------SELECT CATEGORY GROUP------</option>';
    } else {
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                var response = ajax.responseText;
                if (response.indexOf('nothing') === -1) {
                    categorydiv.innerHTML = '';
                    category.innerHTML = ajax.responseText;
                } else {
                    categorydiv.innerHTML = 'No items found! Please add items at <strong>Product Category groups</strong> option.';
                    category.innerHTML = '<option>------SELECT CATEGORY GROUP------</option>';
                }
            } else {
                categorydiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    }
}
function addMinorCategory() {
    var generalcombo = document.addMinorCategoryform.general.value;
    var generaldiv = document.getElementById('generalErrorMinor12');
    var category = document.addMinorCategoryform.category.value;
    var categorydiv = document.getElementById('cagetoryErrorMinor');
    var minorname = document.addMinorCategoryform.addminorcategory.value;
    var minordiv = document.getElementById('addCategoryminor');
    var div = document.getElementById('addMinorCategoryfeedback');
    var generalsuccess = generalValidate(generalcombo, generaldiv);
    var catsucess = categoryValidate(category, categorydiv);
    var namesuccess = nameValidate(minorname, minordiv);
    if (generalsuccess === false || catsucess === false || namesuccess === false) {

    } else {
        addMinorCategorysql(generalcombo, category, minorname, div);
//       div.innerHTML=category;
    }

}

function populateMinorParentEdit() {
    var general = document.editMinorCategory.generalMinorGroupEdit;
    var div = document.getElementById('generalMinorGroupEdit');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateMinorParentEdit';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = '';
            general.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function populateMinorCategoryEdit(str) {
    var general = str;
    var category = document.editMinorCategory.categoryMinorGroupEdit;
    var categorydiv = document.getElementById('categoryMinorGroupEdit');
//    test('got');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateCateOnGeneralEdit&general=" + general;
    if (str.indexOf('---') !== -1) {
        category.innerHTML = '<option>---select Cat---</option>';
    } else {
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                var response = ajax.responseText;
                if (response.indexOf('nothing') === -1) {
                    categorydiv.innerHTML = '';
                    category.innerHTML = ajax.responseText;
                } else {
                    categorydiv.innerHTML = 'No items found!';
                    category.innerHTML = '<option>---select Cat---</option>';
                }
            } else {
                categorydiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    }
}

function filterMinorCategoryEdit() {
    var general = document.editMinorCategory.generalMinorGroupEdit;
    var gendiv = document.getElementById('generalMinorGroupEdit');
    var category = document.editMinorCategory.categoryMinorGroupEdit;
    var categorydiv = document.getElementById('categoryMinorGroupEdit');
    var status = document.editMinorCategory.statusMinorGroupEdit;
    var statusdiv = document.getElementById('statusMinorGroupEdit');
    var fbdiv = document.getElementById('SpecificCategoryViewEdit');
    var gens = generalValidate(general.value, gendiv);
    var cats = categoryValidate(category.value, categorydiv);
    var stat = statusValidate(status.value, statusdiv);
    if (gens === true && cats === true && stat === true) {
        filterMinorCategoryEditSql(general.value, category.value, status.value, fbdiv);
    }

}

function editMinorCatUpdator(mystr) {
    var str = mystr;
    //form elements
    var generalname = document.editminorcat.prtname;
    var catname = document.editminorcat.catname;
    var miname = document.editminorcat.minorname;
    var status = document.editminorcat.minorstatus;
    var minorid = document.editminorcat.id;
    var div = document.getElementById('editMINCatErrordiv');
    minorid.value = str;
    var url = 'AjaxPhp/test.php?cat=EditMinCatUpdate&id=' + str;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = '';
            var response = ajax.responseText;
            var grp = response.substring((response.indexOf('^') + 1), response.indexOf('*'));
            var cnm = response.substring((response.indexOf('*') + 1), response.indexOf('~'));
            var min = response.substring((response.indexOf('~') + 1), response.indexOf('+'));
            var stat = response.substring(response.indexOf('+') + 1);
            generalname.value = grp;
            catname.value = cnm;
            miname.value = min;
            if (stat === '0') {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            } else {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            }
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
    $('#minorCatEditUpdate').modal('show');
}

function editMinorCat() {
    var miname = document.editminorcat.minorname.value;
    var status = document.editminorcat.minorstatus.value;
    var minorid = document.editminorcat.id.value;
    var div = document.getElementById('editMINCatErrordiv');
    var namdiv = document.getElementById('errormincrtname');
    var mystat = 0;
    if (status === 'ACTIVE') {
        mystat = 1;
    }
    var coolname = nameValidate(miname, namdiv);
    if (coolname === true) {
        updateMinorGroup(miname, minorid, mystat, div);
    }

}

/////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption MY PRODUCTS MANAGER STUFF        //
/////////////////////////////////////////////////////////////////////////

function menuHandlerProduct(str) {
    var ajax = getAjax();
    var mystr = str;
    var div = document.getElementById('mainDivDboard');
    var page = '';
    var x = 0;
    var url = '';
    if (mystr === 'productsUnLoadProducts') {
        url = 'widgets/@goodsManager.html';
    } else if (mystr === 'productsLoadProducts') {
        url = 'widgets/@productManager.html';
        x = 1;
    } else {
        url = 'widgets/myProductData/' + mystr + '.html';
        div = document.getElementById('productdiv');
    }

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (x === 1) {
                menuClicked('defaultProduct');
            }
            if (mystr === 'addProduct') {
                populateAppProductGeneral();
            }
            if (mystr === 'editProduct') {
//Edit product clicked.
//
//SOME ITEMS SHOULD BE POPULATED ON LOADING THIS CONTENT.
//1.POPULATE THE TABLE
                populateEditProductGeneral();
                populateTableEditProduct();
                ////
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

//function to add products!

function addProductAdd() {
    var general = document.addProduct.productGeneralSelect.value;
    var gendiv = document.getElementById('productGeneralSelect');
    var category = document.addProduct.productCategorySelect.value;
    var catdiv = document.getElementById('productCategorySelect');
    var specific = document.addProduct.productSpecificSelect.value;
    var specdiv = document.getElementById('productSpecificSelect');
    var name = document.addProduct.productName.value;
    var namediv = document.getElementById('productName');
    var price = document.addProduct.productPrice.value;
    var pricediv = document.getElementById('productPrice');
    var mprice = document.addProduct.marketPrice.value;
    var mpricediv = document.getElementById('marketPrice');
    var image = document.addProduct.productImage;
    var imagediv = document.getElementById('productImage');
    var status = document.addProduct.productStatus.value;
    var statdiv = document.getElementById('productStatus');
    var div = document.getElementById('maindivaddProduct');
    var brand = document.addProduct.productBrand.value;
    var branddiv = document.getElementById('productBrand');
    //validate data
    var genstat = generalValidate(general, gendiv);
    var catstat = categoryValidate(category, catdiv);
    var specstat = specificValidate(specific, specdiv);
    var namestat = productNameValidate(name, namediv);
    var pricestat = priceValidate(price, pricediv);
    var mpricestat = priceValidate(mprice, mpricediv);
    var statstat = statusValidate(status, statdiv);
    var brandstat = brandNameValidate(brand, branddiv);
    var imgstat = imageValidator(image, imagediv);
//    test(image.files[0]);
    if (genstat === false) {
        document.addProduct.productGeneralSelect.focus();
    } else if (catstat === false) {
        document.addProduct.productCategorySelect.focus();
    } else if (specstat === false) {
        document.addProduct.productSpecificSelect.focus();
    } else if (namestat === false) {
        document.addProduct.productName.focus();
    } else if (pricestat === false) {
        document.addProduct.productPrice.focus();
    } else if (mpricestat === false) {
        document.addProduct.marketPrice.focus();
    } else if (imgstat === false) {
        document.addProduct.productImage.focus();
    } else if (brandstat === false) {
        document.addProduct.productBrand.focus();
    } else if (statstat === false) {
        document.addProduct.productStatus.focus();
    } else {
// test('already to go');
        var stat1 = 0;
        if (status === 'ACTIVE') {
            stat1 = 1;
        }
        uploadImageProduct(specific, name, image.files[0], imagediv, price, mprice, brand, stat1, div);
    }

}

function populateAppProductGeneral() {
    var general = document.addProduct.productGeneralSelect;
    var gendiv = document.getElementById('productGeneralSelect');
    var url = 'AjaxPhp/test.php?cat=populateAppProductGeneral';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            gendiv.innerHTML = '';
            general.innerHTML = ajax.responseText;
        } else {
            gendiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function populateAppProductCategory(mystr) {
    var category = document.addProduct.productCategorySelect;
    var catdiv = document.getElementById('productCategorySelect');
    var str = mystr;
    var brand = document.addProduct.productBrand;
    var branddiv = document.getElementById('productBrand');
    /*
     * 
     * Make another ajax object that populates the set brand category based on selected Brand name
     * 
     */
    if (mystr.indexOf('---') !== -1) {
        category.innerHTML = '<option>------CATEGORY GROUP------</option>';
        brand.innerHTML = '<option>------SET BRAND------</option><option>NONE</option>';
    } else {
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=populateAppProductCategory&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                catdiv.innerHTML = '';
                category.innerHTML = ajax.responseText;
            } else {
                catdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
//        test('cool');
        var ajax1 = getAjax();
        ajax1.onreadystatechange = function () {
            if (ajax1.readyState === 4) {
                brand.innerHTML = ajax1.responseText;
                branddiv.innerHTML = '';
            } else {
                branddiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax1.open('GET', 'AjaxPhp/test.php?cat=populateAppProductBrand&name=' + str, true);
        ajax1.send();
    }
}

function populateAppProductSpecific(mystr) {
    var specific = document.addProduct.productSpecificSelect;
    var specdiv = document.getElementById('productSpecificSelect');
    var str = mystr;
    if (mystr.indexOf('---') !== -1) {
        specific.innerHTML = '<option>------SPECIFIC GROUP------</option>';
    } else {
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=populateAppProductSpecific&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                specdiv.innerHTML = '';
                if (ajax.responseText === 'nothing') {
                    specdiv.innerHTML = 'No items found Here! Add Components or<br>Set items to active to see them';
                    specific.innerHTML = '<option>------SPECIFIC GROUP------</option>';
                } else {
                    specific.innerHTML = ajax.responseText;
                }
            } else {
                specdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
//        test('cool');
    }
}

function imageValidator(image, imagediv) {
    var valid = false;
    //var value = image.value;
    if (image.files[0] === undefined) {
        imagediv.innerHTML = 'Select an image';
    } else {
        var name = image.files[0].name;
        var ext = name.split('.').pop().toLowerCase();
        var imgSize = image.files[0].size;
        //imagediv.innerHTML = '<p>Select an image for your product</p>';
        if (checkFormat(ext) === false)
        {
            imagediv.innerHTML = '<p>Invalid image format.</p>';
        } else if (imgSize < 2000)
        {
            imagediv.innerHTML = "Image quality is too low, select an image with better resolution";
        } else
        {
            valid = true;
            imagediv.innerHTML = '';
            //uploadImageProduct(image,imagediv);
        }
    }
    return valid;
}

function checkFormat(str) {
    var result = false;
    if (str === 'png') {
        result = true;
    } else if (str === 'jpg') {
        result = true;
    } else if (str === 'jpeg') {
        result = true;
    } else if (str === 'gif') {
        result = true;
    }
    return result;
}

/////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption BRAND MANAGER STAFF              //
/////////////////////////////////////////////////////////////////////////

function menuHandlerBrand(str) {
    var mystr = str;
    var div = document.getElementById('modalBrand');
    var url = 'widgets/myBrandData/' + mystr + '.html';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (mystr === 'addBrand') {
                populateBrandGeneral();
            }
            if (mystr === 'editBrand') {
                populateBrandGeneralEdit();
                filterCategoryBrand();
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}
//Add Brand GROUP FORM CONTENT SCRIPT
//==================================================
/*populate combobox general in form add brand*/

function addBrandName() {
    var general = document.addBrandForm.general.value;
    var gendiv = document.getElementById('generalErrorBrand');
    var bname = document.addBrandForm.addBrand.value;
    var bdiv = document.getElementById('addErrorBrand');

    var bpic = document.addBrandForm.addPic;
    var picDiv = document.getElementById('addErrorPic');

    var div = document.getElementById('addBrandfeedback');

    var genstat = generalValidate(general, gendiv);
    var namestat = brandNameValidate(bname, bdiv);
    var picstat = imageValidator(bpic, picDiv);

    if (genstat === false || namestat === false || picstat === false) {

    } else {
        uploadBrandPic(general, bname, bpic.files[0], div);
    }

}
function uploadBrandPic(general, bname, bpic, div) {
    // addProductAddSql(specific,name,image.files[0],imagediv,price,brand,status,div);
    var form_data = new FormData();
    var imagename = 'undefined';
    form_data.append("file", bpic);
    $.ajax({
        url: "uploadBrandPic.php",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            div.innerHTML = "<label class='text-success'>Uploading image...<i class='fa fa-spin fa-refresh'></i></label>";
        },
        success: function (data)
        {
            div.innerHTML = '';
            imagename = data;
//             imagediv.innerHTML = data;
//             test('obtained from server');
            addBrandSql(general, bname, imagename, div);
        }
    });

}

function populateBrandGeneral() {
    var field = document.addBrandForm.general;
    var div = document.getElementById('generalErrorBrand');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateParentBrand";
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            field.innerHTML = '';
            div.innerHTML = '';
            field.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}


function populateBrandGeneralEdit() {
    var field = document.filterEditBrand.generalGroupEditBrand;
    var div = document.getElementById('generalGroupEditBrand');
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=populateParentBrandEdit";
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            field.innerHTML = '';
            div.innerHTML = '';
            field.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function populateBrandData(str) {

    var mystr = str;
    var id = document.editbrand.brandid;
    var gen = document.editbrand.genname;
    var brand = document.editbrand.brandnameedit;
    var branddiv = document.getElementById('errorbrandname');
    var status = document.editbrand.brandstatusedit;
    var picdiv = document.getElementById('viewBrandPic');
    var div = document.getElementById('editBrandErrordiv');
    id.value = mystr;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateBrandData&id=' + mystr;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            var group = response.substring((response.indexOf('^') + 1), response.indexOf('~'));
            var brnme = response.substring((response.indexOf('~') + 1), response.indexOf('*'));
            var stat = response.substring((response.indexOf('*') + 1), response.indexOf('{'));
            var pic = response.substring((response.indexOf('{') + 1), response.indexOf('}'));
            if (pic.length < 2) {
                picdiv.innerHTML = '<img class="userImg" src="./img/logo.png" alt="Brand Logo"/>';
            } else {
                picdiv.innerHTML = '<img class="userImg" src="../BrandImages/' + pic + '" alt="Brand Logo"/>';
            }
            gen.value = group;
            div.innerHTML = '';
            brand.value = brnme;
            if (stat === '0') {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            } else {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
    $('#brandGroupEdit').modal('show');
}
function toggleBrandEdit() {
    if (document.getElementById('selectBrandPicDiv').style.display === 'none') {
        document.getElementById('selectBrandPicDiv').style.display = 'block';
    } else {
        document.getElementById('selectBrandPicDiv').style.display = 'none';
    }
}
function updateBandData() {
    if (document.getElementById('selectBrandPicDiv').style.display === 'none') {
        var id = document.editbrand.brandid.value;
        var brand = document.editbrand.brandnameedit;
        var branddiv = document.getElementById('errorbrandname');
        var status = document.editbrand.brandstatusedit.value;
        var div = document.getElementById('editBrandErrordiv');
        var brandstat = brandNameValidate(brand.value, branddiv);
        if (brandstat === false) {
            brand.focus();
        } else {
            var stat = 0;
            if (status === 'ACTIVE') {
                stat = 1;
            }
            updateBandDataSql(id, brand.value, stat, div);
        }
    } else {
        var id = document.editbrand.brandid.value;

        var brand = document.editbrand.brandnameedit;
        var branddiv = document.getElementById('errorbrandname');

        var status = document.editbrand.brandstatusedit.value;
        var div = document.getElementById('editBrandErrordiv');

        var logo = document.editbrand.brandpicedit;
        var logod = document.getElementById('errorbrandpic');

        var logostat = imageValidator(logo, logod);

        var brandstat = brandNameValidate(brand.value, branddiv);
        if (brandstat === false) {
            brand.focus();
        }
        if (logostat === false) {
            logo.focus();
        } else {
            var stat = 0;
            if (status === 'ACTIVE') {
                stat = 1;
            }
            uploadNewPicBrand(id, logo, brand.value, stat, div);
        }
    }


}
function uploadNewPicBrand(id, logo, brand, stat, div) {
    var form_data1 = new FormData();
    var imagename = 'undefined';
    form_data1.append("file", logo.files[0]);
    $.ajax({
        url: "uploadBrandPic.php",
        method: "POST",
        data: form_data1,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            div.innerHTML = "<label class='text-success'>Uploading image...<i class='fa fa-spin fa-refresh'></i></label>";
            document.getElementById('viewBrandPic').innerHTML = "<h1 class='text-center userImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        },
        success: function (data)
        {
            div.innerHTML = data;
            imagename = data;
            document.getElementById('viewBrandPic').innerHTML = '<img class="userImg" src="../BrandImages/' + imagename + '" alt="Brand Logo"/>';
            updateBandDataSqlWithImage(id, imagename, brand, stat, div);
        }
    });
}
/////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption EDIT PRODUCT  STAFF              //
/////////////////////////////////////////////////////////////////////////

function editProductFilterAction() {
    var general = document.editProductFilter.editProductFilterGeneral.value;
    var gendiv = document.getElementById('editProductFilterGeneral');
    var category = document.editProductFilter.editProductFilterCat.value;
    var catdiv = document.getElementById('editProductFilterCat');
    var specific = document.editProductFilter.editProductFilterSpec.value;
    var specdiv = document.getElementById('editProductFilterSpec');
    var status = document.editProductFilter.editProductFilterStatus.value;
    var statdiv = document.getElementById('editProductFilterStatus');
    var table = document.getElementById('tableProductView');
    var genstat = generalValidate(general, gendiv);
    var catstat = categoryValidate(category, catdiv);
    var spectat = specificValidate(specific, specdiv);
    var stattat = statusValidate(status, statdiv);
    if (genstat === false || catstat === false || spectat === false || stattat === false) {

    } else {

        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=editProductFilterAction&general=' + general + '&category=' + category + '&specific=' + specific + '&status=' + status;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                table.innerHTML = ajax.responseText;
            } else {
                table.innerHTML = 'Loading my Products...<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }

}
function editProductFilterAction1() {
    var general = document.editProductFilter.editProductFilterGeneral.value;
    var gendiv = document.getElementById('editProductFilterGeneral');
    var category = document.editProductFilter.editProductFilterCat.value;
    var catdiv = document.getElementById('editProductFilterCat');
    var specific = document.editProductFilter.editProductFilterSpec.value;
    var specdiv = document.getElementById('editProductFilterSpec');
    var status = document.editProductFilter.editProductFilterStatus.value;
    var statdiv = document.getElementById('editProductFilterStatus');
    var table = document.getElementById('tableProductView');
    if (general === '---select Group---') {
        general = 'ALL';
    }
    if (category === '---select Cat---') {
        category = 'ALL';
    }
    if (status === '---select status---') {
        status = 'ALL';
    }
    if (specific === '---select group---') {
        specific = 'ALL';
    }

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=editProductFilterAction&general=' + general + '&category=' + category + '&specific=' + specific + '&status=' + status;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            table.innerHTML = ajax.responseText;
        } else {
            table.innerHTML = 'Loading my Products...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function populateEditProductGeneral() {
    var general = document.editProductFilter.editProductFilterGeneral;
    var gendiv = document.getElementById('editProductFilterGeneral');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateEditProductGeneral';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            gendiv.innerHTML = '';
            general.innerHTML = ajax.responseText;
        } else {
            gendiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function populateEditProductCategory(str) {
    var category = document.editProductFilter.editProductFilterCat;
    var catdiv = document.getElementById('editProductFilterCat');
    var ajax = getAjax();
    if (str === '---select Group---') {
        category.innerHTML = '<option>---select Cat---</option>';
    } else {
        var url = 'AjaxPhp/test.php?cat=populateEditProductCategory&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                catdiv.innerHTML = '';
                category.innerHTML = ajax.responseText;
            } else {
                catdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function populateEditProductSpecific(str) {
    var specific = document.editProductFilter.editProductFilterSpec;
    var specdiv = document.getElementById('editProductFilterSpec');
    var ajax = getAjax();
    if (str === '---select Cat---') {
        specific.innerHTML = '<option>---select group---</option>';
    } else {
        var url = 'AjaxPhp/test.php?cat=populateEditProductSpecific&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                specdiv.innerHTML = '';
                specific.innerHTML = ajax.responseText;
            } else {
                specdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function editProductModal1(str) {
//fields to populate
    var productId = document.editProductData.editProductDataProductId;
    var general = document.editProductData.editProductDataGeneral;
    var category = document.editProductData.editProductDataCategory;
    var specific = document.editProductData.editProductDataSpecific;
    var name = document.editProductData.editProductDataName;
    var price = document.editProductData.editProductDataPrice;
    var brand = document.editProductData.editProductDataBrand;
    var mprice = document.editProductData.editProductDataMPrice;
    var status = document.editProductData.editProductDataStatus;
    var imagdiv = document.getElementById('productImage');
    var div = document.getElementById('editProductDataFeedBack');
    productId.value = str;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=getProductData&id=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {

            var response = ajax.responseText;
//            test(response);
            general.value = response.substring((response.indexOf('~') + 1), response.indexOf('*'));
            category.value = response.substring((response.indexOf('*') + 1), response.indexOf('/'));
            specific.value = response.substring((response.indexOf('/') + 1), response.indexOf('+'));
            var nm = response.substring((response.indexOf('+') + 1), response.indexOf('_'));
            name.value = nm;
            price.value = response.substring((response.indexOf('_') + 1), response.indexOf('^'));
            mprice.value = response.substring((response.indexOf('{') + 1), response.indexOf('}'));
            brand.value = response.substring((response.indexOf('}') + 1), response.indexOf(']'));
            var stat = response.substring((response.indexOf('^') + 1), response.indexOf('#'));
            if (stat === '1') {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            } else {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            }
            var pic = response.substring((response.indexOf('#') + 1), response.indexOf('{'));
            imagdiv.innerHTML = "<img class='productImg1'alt='" + nm + "' src='../productImages/" + pic + "'/>";
        } else {
            imagdiv.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
            div.innerHTML = '<i class="fa fa-spin fa-refresh;"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    $('#manageEditProduct').modal('show');
//alert(str);
}

function updateProductDetails() {
//variables to work with
    var productId = document.editProductData.editProductDataProductId.value;
    var name = document.editProductData.editProductDataName.value;
    var namediv = document.getElementById('editProductDataName');
    var price = document.editProductData.editProductDataPrice.value;
    var pricediv = document.getElementById('editProductDataPrice');
    var mprice = document.editProductData.editProductDataMPrice.value;
    var mpricediv = document.getElementById('editProductDataMPrice');
    var status = document.editProductData.editProductDataStatus.value;
    var div = document.getElementById('editProductDataFeedBack');
    //validation
    var namestat = productNameValidate(name, namediv);
    var pricestat = priceValidate(price, pricediv);
    var mpricestat = priceValidate(mprice, mpricediv);
    //sending this updaes to the db
    if (namestat === true && pricestat === true && mpricestat) {
        updateProductDetailsSql(productId, name, price, mprice, status, div);
    }
}

//responsible for managing product features.
function modalProductManageFeaturesModal(str) {
    menuHandlerFeatureManager('default');
    $('#modalProductManageFeatures').modal('show');
}



//
//
//SWAPER FOR PICTURE MANAGER
//
//
//---------------------------START CODE THAT WORKS WITH EDITING PICTURES--------------------------------
var itemid = '';
var imgname = '';
function setId(id) {
    itemid = id;
}

function getId() {
    return itemid;
}

function setImgname(img) {
    imgname = img;
}
function getImgname() {
    return imgname;
}
//-----------------------------END CODE THAT WORKS WITH EDITING PICTURES---------------------------------
//responsible for managing pictures
function modalSetProductPicModal(str) {
//items to populate id with
    itemid = str;
    menuHandlerPictureManager('default');
    $('#modalSetProductPic').modal('show');
}

function menuHandlerPictureManager(mystr) {
    var div = document.getElementById('mainDivPicManager');
    var ajax = getAjax();
    var url = 'widgets/myProductData/pictureManager/' + mystr + '.html';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (mystr === 'addMorePictures') {
                loadMorePicStuff();
            }
            if (mystr === 'manageProductPictures') {
                loadViewPicStuff();
            }
            if (mystr === 'viewProductPictures') {
                loadCarousel();
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
//    test(url);
}

function loadMorePicStuff() {
    var id = getId();
    var ajax = getAjax();
    var namediv = document.getElementById('addMorePictureName');
    var div = document.getElementById('addMorePicFeedBack');
    namediv.innerHTML = id;
    //we have the id of the item.
    //What we do when we come back
    //we fetch the name of the item

    var url = 'AjaxPhp/test.php?cat=loadMorePicStuff&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            namediv.innerHTML = response.substring((response.indexOf('^') + 1), response.indexOf('~'));
            setImgname(response.substring(response.indexOf('~') + 1));
            div.innerHTML = '';
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//function poulates manage pic stuff
function loadViewPicStuff() {
    var id = getId();
    var name = document.getElementById('webPicName');
    var div = document.getElementById('webPicDiv');
    //fetch name
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadMorePicStuff&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            name.innerHTML = response.substring((response.indexOf('^') + 1), response.indexOf('~'));
            setImgname(response.substring(response.indexOf('~') + 1));
            div.innerHTML = '';
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    //fetch list of images

    var url1 = 'AjaxPhp/test.php?cat=loadPicList&id=' + id;
    var piclist = document.getElementById('myPicList');
    var pic = document.getElementById('webPic');
    var ajaxlist = getAjax();
    ajaxlist.onreadystatechange = function () {
        if (ajaxlist.readyState === 4) {
            var response = ajaxlist.responseText;
//            test(response);
            piclist.innerHTML = response.substring(0, response.indexOf('~'));
            var img = response.substring(response.indexOf('~') + 1);
            pic.innerHTML = '<img src="../productImages/' + img + '" value="' + img + '"  alt="my Picture" class="productImg"/>';
            setImgname(img);
        } else {
            piclist.innerHTML = 'Loading picture list...<i class="fa fa-refresh fa-spin"></i>';
            pic.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        }
    };
    ajaxlist.open('GET', url1, true);
    ajaxlist.send();
}

/*
 * FUNCTION FOR ADDING NEW IMAGES
 */
function uploadMoreImages() {
    var id = getId();
    var pic = document.addMorePic.moreItemPic;
    var picdiv = document.getElementById('moreItempicDiv');
    var div = document.getElementById('addMorePicFeedBack');
    var productname = document.editProductData.editProductDataName.value;
    var picstat = imageValidator(pic, picdiv);
    if (picstat === true) {
        var form_data1 = new FormData();
        var imagename = 'undefined';
        form_data1.append("file", pic.files[0]);
        $.ajax({
            url: "upload.php",
            method: "POST",
            data: form_data1,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                div.innerHTML = "<label class='text-success'>Uploading image...<i class='fa fa-spin fa-refresh'></i></label>";
            },
            success: function (data)
            {
                div.innerHTML = data;
                imagename = data;
                addMorePicsSql(id, imagename, productname, div);
            }
        });
    }
}

//this function manages click events for the button

function popImageProduct(str) {
    var pic = document.getElementById('webPic');
    var spic = document.getElementById('selectedPictureName');
    var picname = str.substring(0, str.indexOf('^'));
    var picId = str.substring(str.indexOf(">") + 1);
    setImgname(picname);
    pic.innerHTML = '<img src="../productImages/' + picname + '"   alt="my Picture" class="productImg"/>';
    spic.innerHTML = picId;
}

function setWebPic() {
    var div = document.getElementById('webPicDiv');
    var itemid = getId();
    var imagename = getImgname();
    var name = document.editProductData.editProductDataName.value;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=setWebPicFunction&id=' + itemid + '&imagename=' + imagename + '&productname=' + name;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (ajax.responseText === 'Update successful!!!') {
                var imagdiv = document.getElementById('productImage');
                imagdiv.innerHTML = '<img src="../productImages/' + imagename + '"   alt="my Picture" class="productImg1"/>';
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function deleteWebPic() {
    var id = getId();
    var name = getImgname();
    var productname = document.editProductData.editProductDataName.value;
    var div = document.getElementById('webPicDiv');
    var url = 'AjaxPhp/test.php?cat=deleteWebPic&id=' + id + '&image=' + name + '&productname=' + productname;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            if (ajax.responseText === 'Picture Successfuly Deleted!!') {
                div.innerHTML = ajax.responseText;
                refreshManagePicPage();
            } else {
                div.innerHTML = ajax.responseText;
            }
        } else {
            div.innerHTML = 'Deleting Image...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function refreshManagePicPage() {
    var id = getId();
    var url1 = 'AjaxPhp/test.php?cat=loadPicList&id=' + id;
    var piclist = document.getElementById('myPicList');
    var pic = document.getElementById('webPic');
    var ajaxlist = getAjax();
    ajaxlist.onreadystatechange = function () {
        if (ajaxlist.readyState === 4) {
            var response = ajaxlist.responseText;
//            test(response);
            piclist.innerHTML = response.substring(0, response.indexOf('~'));
            var img = response.substring(response.indexOf('~') + 1);
            pic.innerHTML = '<img src="../productImages/' + img + '" value="' + img + '"  alt="my Picture" class="productImg"/>';
            var imagdiv = document.getElementById('productImage');
            imagdiv.innerHTML = '<img src="../productImages/' + img + '"   alt="my Picture" class="productImg"/>';
        } else {
            piclist.innerHTML = 'Loading picture list...<i class="fa fa-refresh fa-spin"></i>';
            pic.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        }
    };
    ajaxlist.open('GET', url1, true);
    ajaxlist.send();
}
function loadCarousel() {
    var id = getId();
    var div = document.getElementById('cardiv');
    var url = 'AjaxPhp/test.php?cat=loadCarousel&id=' + id;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = 'Loading Images...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//
//
//SWAPER FOR FEATURE MANAGER
//
//

function menuHandlerFeatureManager(mystr) {
    var div = document.getElementById('mainDivFeatureManager');
    var ajax = getAjax();
    var url = 'widgets/myProductData/featureManager/' + mystr + '.html';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (mystr === 'AddNoCompFeature') {
                AddNoCompFeature();
            }
            if (mystr === 'viewFeature') {
                ViewNCompFeature();
            }
        } else {
            div.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
//    test(url);
}


//adds features 
function addCompFeature() {
    var itemID = document.editProductData.editProductDataProductId.value;
    var productname = document.editProductData.editProductDataName.value;
    var ram = document.addFormFeature.ram.value;
    var ramdiv = document.getElementById('ADFram');
    var rom = document.addFormFeature.rom.value;
    var romdiv = document.getElementById('ADFrom');
    var processor = document.addFormFeature.processor.value;
    var processordiv = document.getElementById('ADFProcessor');
    var os = document.addFormFeature.os.value;
    var osdiv = document.getElementById('ADFos');
    var display = document.addFormFeature.display.value;
    var displaydiv = document.getElementById('ADFdisplay');
    var sim = document.addFormFeature.sim.value;
    var simdiv = document.getElementById('ADFsim');
    var div = document.getElementById('ADFfeedback');
    var ramstat = ramValidate(ram, ramdiv);
    var romstat = romValidate(rom, romdiv);
    var prostat = processorValidate(processor, processordiv);
    var osstat = osValidate(os, osdiv);
    var dipstat = displayValidate(display, displaydiv);
    var simstat = simslotValidate(sim, simdiv);
    if (ramstat === true && romstat === true && prostat === true && osstat === true && dipstat === true && simstat === true) {
        addCompFeatureSql(itemID, ram, rom, processor, os, display, sim, productname, div);
    } else {
        div.innerHTML = '';
    }
//    
}

//default no add
function AddNoCompFeature() {
    var id = document.editProductData.editProductDataProductId.value;
    var doc = document.getElementById('ANFimg');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=AddNoCompFeature&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            doc.innerHTML = ajax.responseText;
        } else {
            doc.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

//non features add
function AddcaddNCompFeature() {
    var id = document.editProductData.editProductDataProductId.value;
    var productname = document.editProductData.editProductDataName.value;
    var prop1 = document.addFormNFeature.prop1.value;
    var propdiv1 = document.getElementById('ANFprop1');
    var prop2 = document.addFormNFeature.prop2.value;
    var propdiv2 = document.getElementById('ANFprop2');
    var div = document.getElementById('ANFfeedback');
    var propstat1 = propertyValidate(prop1, propdiv1);
    var propstat2 = propertyValidate(prop2, propdiv2);
    if (propstat1 === true && propstat2 === true) {
        AddcaddNCompFeatureSql(id, prop1, prop2, productname, div);
    } else {
        div.innerHTML = '';
    }

}

//view item features
function ViewNCompFeature() {
    var id = document.editProductData.editProductDataProductId.value;
    var picdiv = document.getElementById('ANFimgView');
    var corediv = document.getElementById('ANFcoreView');
    var namediv = document.getElementById('ANFnameView');
    var tablediv = document.getElementById('ANFprops');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=ViewNCompFeature&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            var corepresent = response.substring((response.indexOf('~') + 1), response.indexOf('^'));
            var despresent = response.substring((response.indexOf('^') + 1), response.indexOf('#'));
            var img = response.substring((response.indexOf('+') + 1), response.indexOf('_'));
            var name = response.substring(response.indexOf('_') + 1);
            picdiv.innerHTML = img;
            namediv.innerHTML = name;
            if (corepresent === '1') {
                corediv.innerHTML = response.substring((response.indexOf('#') + 1), response.indexOf('*'));
            }
            if (despresent === '1') {
                tablediv.innerHTML = response.substring((response.indexOf('*') + 1), response.indexOf('+'));
            }
            if (despresent === '0') {
                tablediv.innerHTML = '<tr><td>No description found for <strong>' + name + '</strong></td><td> <marquee><i class="fa fa-truck"></i></marquee><hr style="margin: 0;padding: 0"/></td></tr>';
            }

        } else {
            picdiv.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
            tablediv.innerHTML = 'Loading Descriptions....<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function editCoreDataClick(str) {
    var id = str;
    var idd = document.editCoreData.id;
    var ram = document.editCoreData.ram;
    var rom = document.editCoreData.rom;
    var cpu = document.editCoreData.cpu;
    var os = document.editCoreData.os;
    var display = document.editCoreData.display;
    var sim = document.editCoreData.sim;
    var div = document.getElementById('ECDfeedback');
    var url = 'AjaxPhp/test.php?cat=editCoreDataClick&id=' + id;
    var ajax = getAjax();
    idd.value = id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = '';
            var response = ajax.responseText;
            ram.value = response.substring((response.indexOf('~') + 1), response.indexOf('!'));
            rom.value = response.substring((response.indexOf('!') + 1), response.indexOf('#'));
            cpu.value = response.substring((response.indexOf('%') + 1), response.indexOf('^'));
            os.value = response.substring((response.indexOf('$') + 1), response.indexOf('%'));
            display.value = response.substring((response.indexOf('#') + 1), response.indexOf('$'));
            sim.value = response.substring((response.indexOf('^') + 1));
//            div.innerHTML='From Ram'+ram.value;
        } else {
            div.innerHTML = 'Loading Data....<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    $('#EditCoreDataModal').modal('show');
}

function saveCoreDataClick() {
    var id = document.editCoreData.id.value;
    var productname = document.editProductData.editProductDataName.value;
    var ram = document.editCoreData.ram.value;
    var ramdiv = document.getElementById('ECDram');
    var rom = document.editCoreData.rom.value;
    var romdiv = document.getElementById('ECDrom');
    var cpu = document.editCoreData.cpu.value;
    var cpudiv = document.getElementById('ECDcpu');
    var os = document.editCoreData.os.value;
    var osdiv = document.getElementById('ECDos');
    var display = document.editCoreData.display.value;
    var disdiv = document.getElementById('ECDdisplay');
    var sim = document.editCoreData.sim.value;
    var simdiv = document.getElementById('ECDsim');
    var div = document.getElementById('ECDfeedback');
    var ramstat = ramValidate(ram, ramdiv);
    var romstat = romValidate(rom, romdiv);
    var cpustat = processorValidate(cpu, cpudiv);
    var osstat = osValidate(os, osdiv);
    var disstat = displayValidate(display, disdiv);
    var simstat = simslotValidate(sim, simdiv);
    if (ramstat === true && romstat === true && cpustat === true && osstat === true && disstat === true && simstat === true) {
        saveCoreDataClickSql(id, ram, rom, cpu, os, display, sim, productname, div);
    } else {
        div.innerHTML = '';
    }

}


function deleteNFeature(str) {
    var id = document.editProductData.editProductDataProductId.value;
    var name = document.getElementById('ANFnameView').innerHTML;
    var tablediv = document.getElementById('ANFprops');
    var dividiv = document.getElementById('ANFfeedbacktable');
    var url = 'AjaxPhp/test.php?cat=deleteNFeature&itemId=' + id + '&featureId=' + str;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            var st = response.substring((response.indexOf('~') + 1), response.indexOf('^'));
            var dat = response.substring(response.indexOf('^') + 1);
            if (st === '1') {
                tablediv.innerHTML = dat;
            }
            if (st === '0') {
                tablediv.innerHTML = '<tr><td>No description found for <strong>' + name + '</strong></td><td> <marquee><i class="fa fa-truck"></i></marquee><hr style="margin: 0;padding: 0"/></td></tr>';
            }
            dividiv.innerHTML = '';
        } else {
            dividiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function deleteCFeature(str) {
    var productname = document.editProductData.editProductDataName.value;
    var div = document.getElementById('ANFcoreView');
    var dividiv = document.getElementById('ANFfeedbacktable');
    var url = 'AjaxPhp/test.php?cat=deleteCFeature&id=' + str + '&productname=' + productname;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            dividiv.innerHTML = '';
            if (ajax.responseText === 'Core features successfuly deleted!') {
                div.innerHTML = '';
            } else {
                dividiv.innerHTML = ajax.responseText;
            }
        } else {
            dividiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

////////////////////////////////////////////////////////////////////////////////
//  switch Handler Section  SubOption SPECIFIC CATEGORY GOOD MANAGER SAFF     //
////////////////////////////////////////////////////////////////////////////////


function menuHandlerStore(mystr) {
    var ajax = getAjax();
    var div = document.getElementById('mainDivDboard');
    var url = '';
    if (mystr === '@storeManager') {
        url = 'widgets/' + mystr + '.html';
    } else {

        url = 'widgets/storeData/' + mystr + '.html';
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (mystr === 'addStock') {
                filterOptions('filterDefault');
            }
            if (mystr === 'viewStore') {
                getviewStoreDefaults();
            }
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function filterOptions(str) {
    var div = document.getElementById('filterOptions');
    var ajax = getAjax();
    var url = 'widgets/storeData/' + str + '.html';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            populateFilterGeneral();
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function populateFilterGeneral() {
    var general = document.filterGroup.general;
    var gendiv = document.getElementById('FGgeneral');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateFilterGeneral';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            general.innerHTML = ajax.responseText;
            gendiv.innerHTML = '';
        } else {
            gendiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function populateFilterCat(str) {
    var category = document.filterGroup.category;
    var catdiv = document.getElementById('FGcat');
    if (str === '---select Group---') {
        category.innerHTML = '<option>---select Cat---</option>';
    } else {
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=populateFilterCat&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                category.innerHTML = ajax.responseText;
                catdiv.innerHTML = '';
            } else {
                catdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}
function populateFilterSpec(str) {
    var spec = document.filterGroup.specific;
    var specdiv = document.getElementById('FGspecific');
    if (str === '---select Cat---') {
        spec.innerHTML = '<option>---select group---</option>';
    } else {
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=populateFilterSpec&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                spec.innerHTML = ajax.responseText;
                specdiv.innerHTML = '';
            } else {
                specdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}
function filterGroupClick() {
    var div = document.getElementById('tableAddProductView');
    var general = document.filterGroup.general.value;
    var gendiv = document.getElementById('FGgeneral');

    var category = document.filterGroup.category.value;
    var catdiv = document.getElementById('FGcat');

    var spec = document.filterGroup.specific.value;
    var specdiv = document.getElementById('FGspecific');

    var genstat = generalValidate(general, gendiv);
    var catstat = categoryValidate(category, catdiv);
    var specstat = specificValidate(spec, specdiv);

    if (genstat === true && catstat === true && specstat === true) {
        populateTableAddStore(general, category, spec, div);
    } else {

    }

}

function filterNameFunction() {
    var div = document.getElementById('tableAddProductView');
    var name = document.getElementById('filterNamename').value;
    var namediv = document.getElementById('FNname');
    var d = productNameValidate1(name, namediv);
    if (d === true) {
        populateTableAddStoreName(name, div);
    }
}

function popMoreStock(str) {
    var div = document.getElementById('itemDec');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=popMoreStock&id=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = "<h4>Loading Data...<br><i class='fa fa-pulse fa-refresh'></i></h4>\
<h1 class='text-center productImg'>Loading Data...<br><i class='fa fa-pulse fa-refresh'></i></h1>\n\
<h5>Loading Data...<br><i class='fa fa-pulse fa-refresh'></i></h5>";
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
var crt = 0;
function setCrt(str) {
    crt = str;
}
function getCrt(str) {
    return crt;
}
function AddStockModal(str) {
    var title = document.getElementById('NSFtitle');
    var current = document.newStockForm.current;
    var iddv = document.newStockForm.id;
    iddv.value = str;
    var div = document.getElementById('NSFfeedback');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=AddStockModalData&id=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            div.innerHTML = '';
            title.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('@'));
            current.value = response.substring(response.indexOf('@') + 1);
            setCrt(response.substring(response.indexOf('@') + 1));
        } else {
            div.innerHTML = "<i class='fa fa-pulse fa-refresh'></i>";
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    $('#stockAddModal').modal('toggle');
}

function changerValue(str) {
    if (str.length === 0) {
        document.newStockForm.current.value = getCrt();
    } else {
        var t = parseInt(getCrt()) + parseInt(str);
        document.newStockForm.current.value = t;
    }
}

function saveStock() {
    var stock = document.newStockForm.stock.value;
    var current = document.newStockForm.current.value;
    var id = document.newStockForm.id.value;
    var div = document.getElementById('NSFfeedback');
    var stocdiv = document.getElementById('NSFstock');

    var sst = numberValidate1(stock, stocdiv);
    if (sst === true) {
        saveStockSql(current, stock, id, div);
    } else {
        div.innerHTML = '';
    }
}


//
//view store data
//

function getviewStoreDefaults() {
    var dgen = document.getElementById('totalGenDisplay');
    var dcat = document.getElementById('totalCatDisplay');
    var dspec = document.getElementById('totalSpecDisplay');
    var dtot = document.getElementById('totalSumDisplay');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=getviewStoreDefaults';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            // test(response);
            dgen.innerHTML = response.substring((response.indexOf('~') + 1), response.indexOf('!'));
            dcat.innerHTML = response.substring((response.indexOf('!') + 1), response.indexOf('|'));
            dspec.innerHTML = response.substring((response.indexOf('|') + 1), response.indexOf('#'));
            var tot = response.substring((response.indexOf('#') + 1), response.indexOf('$'));

            dtot.innerHTML = moneyFormatter(tot);
        } else {
            dgen.innerHTML = dcat.innerHTML = dspec.innerHTML = dtot.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

}
function veiwMyStoreGeneral() {
    var table = document.getElementById('viewMyStoreGeneralDataTable');
    var gentot = document.getElementById('myStoreGeneralTot');
    var total = document.getElementById('generalTotal');
    var url = 'AjaxPhp/test.php?cat=veiwMyStoreGeneral';

    var arrname = '';
    var arrdat = '';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            table.innerHTML = response.substring((response.indexOf('~') + 1), response.indexOf('@'));
            total.innerHTML = moneyFormatter(response.substring((response.indexOf('@') + 1), response.indexOf('$')));
            gentot.innerHTML = response.substring((response.indexOf('$') + 1), response.indexOf('%'));
            arrname = response.substring((response.indexOf('%') + 1), response.indexOf('^'));
            arrdat = response.substring((response.indexOf('^') + 1), response.indexOf('&'));
            loadGraph(arrname, arrdat);
        } else {
            gentot.innerHTML = table.innerHTML = total.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    $('#viewStoreGeneralModal').modal('show');


}


function genStoreToggler() {
    var p = document.getElementById('genStoreToggle');
    var table = document.getElementById('tableMyStoreGeneral');
    var graph = document.getElementById('graphMyStoreGeneral');
    var x = p.innerHTML;
    if (x === 'Display as graph') {
        p.innerHTML = 'Display as Table';
        table.style.display = 'none';
        graph.style.display = 'block';
    } else {
        p.innerHTML = 'Display as graph';
        graph.style.display = 'none';
        table.style.display = 'block';
    }
}

function loadGraph(arrname, arrdat) {
    var arrayLabel = stringToArray(arrname);
    var arrayData = stringToArray(arrdat);
    var arraydat = stringToArray(arrdat);
    var chart = new Chart(document.getElementById('generalCanvasStore').getContext('2d'), {
        type: 'bar',
        data: {
            labels: arrayLabel/*["Java", "Python", "HTML","Java", "Python", "HTML","Java", "Python", "HTML"]*/,
            datasets: [{
                    label: "A Graph Of General Groups Against Money Value",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: arrayData/*[400, 334, 250,255, 99, 132,255, 99, 132]*/
                }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false
//                    aspectRatio: (4/3),
//                responsive: true,
//                legend: {
//            display: true,
//            labels: {
//                fontColor: 'rgb(255, 99, 132)'
//            }
//        }
        }
    });

}
function stringToArray(x) {
    var x1 = x.substring(0, x.lastIndexOf('*'));
    var count = x1.substring(x1.lastIndexOf('#') + 1);
    var array = new Array();
    for (var a = 0; a < count; a++) {
        var data = '';
        var index1 = '';
        var index2 = '';
        var d = '';
        var al = (a + 1) + '';
        index1 = (x.indexOf((a + 1) + '*') + (al.length + 1));
        index2 = (x.indexOf('#' + (a + 2)));
        if ((a) === (count - 1)) {
            index1 = (x.indexOf((a + 1) + '*') + al.length + 1);
            index2 = (x.lastIndexOf('#'));
        }
        data = x.substring(parseInt(index1), parseInt(index2));
        array[a] = data;
    }
    return array;
}

//========== CAT Store ============

function viewMyStoreCategory() {
    var combo = document.viewStoreCategory.general;
    var combodiv = document.getElementById('VSCgeneral');
    var title = document.getElementById('VSCgeneralName');
    var table = document.getElementById('VSCTable');
    //remember graph

    var count = document.getElementById('VSCcount');
    var amount = document.getElementById('VSCAmount');
    var arrname = '';
    var arrdat = '';
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=viewMyStoreCategory';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            combo.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('!'));
            count.innerHTML = response.substring(response.indexOf('!') + 1, response.indexOf('@'));
            table.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('#'));
            title.innerHTML = "ALL Category Groups";
            arrname = response.substring(response.indexOf('#') + 1, response.indexOf('$'));
            arrdat = response.substring(response.indexOf('$') + 1, response.indexOf('%'));
            amount.innerHTML = document.getElementById('totalSumDisplay').innerHTML;
            combodiv.innerHTML = '';
            loadGraphCat(arrname, arrdat, 'ALL');
        } else {
            combodiv.innerHTML = title.innerHTML = table.innerHTML =
                    count.innerHTML = amount.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    //populate combo box

    //populate table

    //get totalAmnt, total count,



    $('#viewStoreCategoryModal').modal('toggle');
}

function loadGraphCat(arrname, arrdat, str) {
    document.getElementById('VSCGraphDiv').innerHTML = ' <canvas id="VSCGraph"></canvas>';
    var arrayLabel = stringToArray(arrname);
    var arrayData = stringToArray(arrdat);
    var chart = new Chart(document.getElementById('VSCGraph').getContext('2d'), {
        type: 'bar',
        data: {
            labels: arrayLabel/*["Java", "Python", "HTML","Java", "Python", "HTML","Java", "Python", "HTML"]*/,
            datasets: [{
                    label: "A Graph Of Category Group(s) '" + str + "' Against Money Value",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: arrayData/*[400, 334, 250,255, 99, 132,255, 99, 132]*/
                }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false
        }
    });

}

function changedData(combo, div) {

    if (combo === '---select Group---') {
        div.innerHTML = 'Garlado Limited.';
    } else {
        div.innerHTML = combo;
        myStoreFilterCategory(combo);
    }
}

function catStoreToggler() {
    var p = document.getElementById('toggleCatStore');
    if (p.innerHTML === 'Display as Graph') {
        p.innerHTML = 'Display as Table';
        document.getElementById('VSCGraphDiv').style.display = 'block';
        document.getElementById('VSCTableDiv').style.display = 'none';
    } else {
        p.innerHTML = 'Display as Graph';
        document.getElementById('VSCGraphDiv').style.display = 'none';
        document.getElementById('VSCTableDiv').style.display = 'block';
    }
}
function myStoreFilterCategory(str) {
    var combo = document.viewStoreCategory.general;
    var combodiv = document.getElementById('VSCgeneral');
    var title = document.getElementById('VSCgeneralName');
    var table = document.getElementById('VSCTable');
    //remember graph

    var count = document.getElementById('VSCcount');
    var amount = document.getElementById('VSCAmount');
    var arrname = '';
    var arrdat = '';
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=myStoreFilterCategory&name=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            count.innerHTML = response.substring(response.indexOf('!') + 1, response.indexOf('@'));
            table.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('#'));
            arrname = response.substring(response.indexOf('#') + 1, response.indexOf('$'));
            arrdat = response.substring(response.indexOf('$') + 1, response.indexOf('%'));
            amount.innerHTML = moneyFormatter(response.substring(response.indexOf('%') + 1, response.indexOf('^')));
            combodiv.innerHTML = '';
            loadGraphCat(arrname, arrdat, str);
        } else {
            table.innerHTML =
                    count.innerHTML = amount.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}



//========== SPEC STORE ===========

function viewMyStoreSpecific() {
    var gencombo = document.viewStoreSpecific.general;
    var gendiv = document.getElementById('VSSgeneral');
    var table = document.getElementById('VSSTable');
    var gtotal = document.getElementById('VSScount');
    var ctotal = document.getElementById('VSSAmount');
    var arrDat = '';
    var arrNam = '';
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=viewMyStoreSpecific';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            gencombo.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('!'));
            gtotal.innerHTML = response.substring(response.indexOf('!') + 1, response.indexOf('@'));
            gendiv.innerHTML = '';
            ctotal.innerHTML = document.getElementById('totalSumDisplay').innerHTML;
            table.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('+'));
            arrDat = response.substring(response.indexOf('$') + 1, response.indexOf('%'));
            arrNam = response.substring(response.indexOf('+') + 1, response.indexOf('$'));
            loadGraphSpec(arrNam, arrDat, 'ALL');
        } else {
            gendiv.innerHTML = table.innerHTML
                    = gtotal.innerHTML = ctotal.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    $('#viewStoreSpecificModal').modal('show');
}

function specStoreToggler() {
    var p = document.getElementById('toggleSpecStore');
    if (p.innerHTML === 'Display as Graph') {
        p.innerHTML = 'Display as Table';
        document.getElementById('VSSGraphDiv').style.display = 'block';
        document.getElementById('VSSTableDiv').style.display = 'none';
    } else {
        p.innerHTML = 'Display as Graph';
        document.getElementById('VSSGraphDiv').style.display = 'none';
        document.getElementById('VSSTableDiv').style.display = 'block';
    }
}

function myStorePopulateCat(str) {
    var catCombo = document.viewStoreSpecific.category;
    var catdiv = document.getElementById('VSScat');
    if (str === '---select Group---') {
        catCombo = innerHTML = '<option>---select Cat---</option>';
    } else {
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=myStorePopulateCat&name=' + str;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                catdiv.innerHTML = '';
                catCombo.innerHTML = ajax.responseText;
            } else {
                catdiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function loadGraphSpec(arrname, arrdat, str) {
    document.getElementById('VSSGraphDiv').innerHTML = ' <canvas id="VSSGraph"></canvas>';
    var arrayLabel = stringToArray(arrname);
    var arrayData = stringToArray(arrdat);
    var chart = new Chart(document.getElementById('VSSGraph').getContext('2d'), {
        type: 'bar',
        data: {
            labels: arrayLabel,
            datasets: [{
                    label: "A Graph Of Specific Group(s) '" + str + "' Against Money Value",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: arrayData
                }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false
        }
    });
}

function myStoreFilterSpecific(str) {
    var major = document.viewStoreSpecific.general.value;
    if (str === '---select Cat---') {
        document.getElementById('VSSGraphDiv').innerHTML = ' <canvas id="VSSGraph"></canvas>';
        document.getElementById('VSSTable').innerHTML = '';
        var gname = document.getElementById('VSSCatName').innerHTML = 'Garlado Limited';
    } else {
        var table = document.getElementById('VSSTable');
        var gtotal = document.getElementById('VSScount');
        var ctotal = document.getElementById('VSSAmount');
        var gname = document.getElementById('VSSCatName').innerHTML = str;
        var arrDat = '';
        var arrNam = '';
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=myStoreFilterSpecific&name=' + str + '&general=' + major;
//        test(url);
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                var response = ajax.responseText;
                table.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('+'));
                gtotal.innerHTML = response.substring(response.indexOf('!') + 1, response.indexOf('@'));
                ctotal.innerHTML = moneyFormatter(response.substring(response.indexOf('%') + 1, response.indexOf('^')));
                arrDat = response.substring(response.indexOf('$') + 1, response.indexOf('%'));
                arrNam = response.substring(response.indexOf('+') + 1, response.indexOf('$'));
                loadGraphSpec(arrNam, arrDat, str);
            } else {
                table.innerHTML
                        = gtotal.innerHTML = ctotal.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function moneyFormatter(str) {
    var money = str;
    var moneyr = '';
    for (var a = money.length; a >= 0; a--) {
        moneyr = moneyr + money.charAt(a);
    }
    var monArr = new Array();
    var cont = true;
    while (cont === true) {
        if (moneyr.length > 3) {
            monArr.push(moneyr.substring(0, 3));
            moneyr = moneyr.substring(3);
            monArr.push(',');
        } else {
            monArr.push(moneyr);
            cont = false;
        }
    }
    var newMoney = '';
    for (var a = 0; a < monArr.length; a++) {
        newMoney = newMoney + monArr[a];
    }
    var corrMon = '';
    for (var a = newMoney.length; a >= 0; a--) {
        corrMon = corrMon + newMoney.charAt(a);
    }
    return corrMon;
}

function myAccount(str) {
    var name = document.getElementById('myName');
    var email = document.getElementById('myEmail');
    var phone = document.getElementById('myPhone');
    var level = document.getElementById('myLevel');
    var pic = document.getElementById('myPic');

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=myAccount&email=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            email.innerHTML = str;
            name.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('!'));
            phone.innerHTML = response.substring(response.indexOf('+') + 1, response.indexOf('_'));
            level.innerHTML = response.substring(response.indexOf('_') + 1, response.indexOf('$'));
            pic.innerHTML = '<img class="userImg" src="userpics/' + response.substring(response.indexOf('$') + 1, response.indexOf('=')) + '" alt="' + name.innerHTML + '" />';
        } else {
            name.innerHTML = phone.innerHTML = email.innerHTML = level.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            pic.innerHTML = "<h1 class='text-center productImg'>Loading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    $('#modalMyAccount').modal('show');
}


function modifyMyAccount(str) {
    document.changePassword.id.value = str;
    $('#modifyMyAccount').modal('show');
}

function resetPassword() {
    var email = document.changePassword.id.value;
    var pass1 = document.changePassword.pass1.value;
    var pass2 = document.changePassword.pass2.value;
    var pass1div = document.getElementById('cp1');
    var pass2div = document.getElementById('cp2');
    var div = document.getElementById('cpfeedback');

    var pass1stat = passwordValidate1(pass2, pass1, pass1div, pass2div);
    var pass2stat = passwordValidate1(pass1, pass2, pass2div, pass1div);

    if (pass2stat === true && pass1stat === true) {
        resetPasswordSql(email, pass1, div);
    } else {
        div.innerHTML = '';
    }
}

//audit data manenoz here

function popUsers() {
    var ajax = getAjax();
    var div = document.getElementById('usersAudit');
    var url = 'AjaxPhp/test.php?cat=popUsers';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Loading users...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function showAuditModal(str) {
    popAuditCombo(str);
    document.getElementById('auditLevel').innerHTML = 'Garlado Limited.';
    document.getElementById('userAuditData').innerHTML = '<tr><td colspan="7"> <h3 class="mytitle">Garlado Limited</h3></td></tr>';
    $('#auditModal').modal('show');
}

function popAuditCombo(str) {
    var userid = document.auditSelect.userid;
    userid.value = str;
    var monthFCombo = document.auditSelect.monthFrom;
    var mfc = document.getElementById('monthFrom');
    var monthTCombo = document.auditSelect.monthTo;
    var mtc = document.getElementById('monthTo');

    var yearFCombo = document.auditSelect.yearFrom;
    var yfc = document.getElementById('yearFrom');
    var yearTCombo = document.auditSelect.yearTo;
    var ytc = document.getElementById('yearTo');

    var name = document.getElementById('specName');

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=popAuditCombo&adminId=' + str;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            monthFCombo.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('@'));
            monthTCombo.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('@'));

            yearFCombo.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('$'));
            yearTCombo.innerHTML = response.substring(response.indexOf('@') + 1, response.indexOf('$'));

            name.innerHTML = response.substring(response.indexOf('$') + 1, response.indexOf('%'));

            mfc.innerHTML = mtc.innerHTML = yfc.innerHTML = ytc.innerHTML = '';
        } else {
            mfc.innerHTML = mtc.innerHTML = yfc.innerHTML = ytc.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

}

function fromMonthChange(strF, strT, cboT) {
    if (strT === '---select Month---') {

    } else {
        var intstrT = parseInt(monthToInt(strT));
        var intstrF = parseInt(monthToInt(strF));
        var fromyr = document.auditSelect.yearFrom.value;
        var toyr = document.auditSelect.yearTo.value;
//        test(fromyr + '\n' + toyr);
        if (fromyr === '---select year---' || toyr === '---select year---') {
            if (intstrF > intstrT) {
                cboT.value = strF;
            }
        } else {
            if (parseInt(fromyr) < parseInt(toyr)) {

            } else {
                cboT.value = strF;
            }
        }

    }
}
function toMonthChange(strT, strF, cboF) {
    if (strF === '---select Month---') {

    } else {
        var intstrT = parseInt(monthToInt(strT));
        var intstrF = parseInt(monthToInt(strF));
        var fromyr = document.auditSelect.yearFrom.value;
        var toyr = document.auditSelect.yearTo.value;
//        test(fromyr + '\n' + toyr);
        if (fromyr === '---select year---' || toyr === '---select year---') {
            if (intstrT < intstrF) {
                cboF.value = strT;
            }
        } else {
            if (parseInt(fromyr) < parseInt(toyr)) {

            } else {
                cboF.value = strT;
            }
        }

    }
}

function fromYearChange(yrF, yrT, cboT) {
    if (yrF === '---select year---') {

    } else {
        if (parseInt(yrF) > parseInt(yrT)) {
            cboT.value = yrF;
        }
    }
}

function toYearChange(yrT, yrF, cboF) {
    if (yrF === '---select year---') {

    } else {
        if (parseInt(yrT) < parseInt(yrF)) {
            cboF.value = yrT;
        }
    }
}


function intToMonth(intm) {
    var res = '';
    if (intm === '01') {
        res = 'JAN';
    } else if (intm === '02') {
        res = 'FEB';
    } else if (intm === '03') {
        res = 'MAR';
    } else if (intm === '04') {
        res = 'APR';
    } else if (intm === '05') {
        res = 'MAY';
    } else if (intm === '06') {
        res = 'JUN';
    } else if (intm === '07') {
        res = 'JUL';
    } else if (intm === '08') {
        res = 'AUG';
    } else if (intm === '09') {
        res = 'SEP';
    } else if (intm === '10') {
        res = 'OCT';
    } else if (intm === '11') {
        res = 'NOV';
    } else if (intm === '12') {
        res = 'DEC';
    }
    return res;
}

function monthToInt(intm) {
    var res = '';
    if (intm === 'JAN') {
        res = '01';
    } else if (intm === 'FEB') {
        res = '02';
    } else if (intm === 'MAR') {
        res = '03';
    } else if (intm === 'APR') {
        res = '04';
    } else if (intm === 'MAY') {
        res = '05';
    } else if (intm === 'JUN') {
        res = '06';
    } else if (intm === 'JUL') {
        res = '07';
    } else if (intm === 'AUG') {
        res = '08';
    } else if (intm === 'SEP') {
        res = '09';
    } else if (intm === 'OCT') {
        res = '10';
    } else if (intm === 'NOV') {
        res = '11';
    } else if (intm === 'DEC') {
        res = '12';
    }
    return res;
}

function  showUserAudit() {
    var div = document.getElementById('feedBackAuditSelect');
    var monthFCombo = document.auditSelect.monthFrom.value;
    var mfc = document.getElementById('monthFrom');
    var monthTCombo = document.auditSelect.monthTo.value;
    var mtc = document.getElementById('monthTo');

    var table = document.getElementById('userAuditData');
    var level = document.getElementById('auditLevel');

    var yearFCombo = document.auditSelect.yearFrom.value;
    var yfc = document.getElementById('yearFrom');
    var yearTCombo = document.auditSelect.yearTo.value;
    var ytc = document.getElementById('yearTo');

    var id = document.auditSelect.userid.value;

    var mfstat = monthValidate(monthFCombo, mfc);
    var mtstat = monthValidate(monthFCombo, mtc);

    var yfstat = yearValidate(yearFCombo, yfc);
    var ytstat = yearValidate(yearTCombo, ytc);

    if (mfstat === true && mtstat === true && yfstat === true && ytstat === true) {
        showUserAuditSql(id, monthFCombo, monthTCombo, yearFCombo, yearTCombo, table, level);
    } else {
        div.innerHTML = '';
    }
}

function divclick(str) {
    var str1 = str.substring(str.indexOf('value="') + 7, str.indexOf('" name="index"'));
    showAuditModal(str1);
}


/////////////////////////////////////////////////////////////////
//                 pick up manager                             //
/////////////////////////////////////////////////////////////////

function menuHandlerPickup(str) {
    var div = '';
    var ajax = getAjax();
    var url = '';
    if (str === '@pickupManager') {
        url = 'widgets/' + str + '.html';
        div = document.getElementById('mainDivDboard');
    } else {
        url = 'widgets/myPickUpPoints/' + str + '.html';
        div = document.getElementById('modalCountry');
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (str === 'viewCountry') {
                loadCountries();
            }
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function countryAdd() {
    var name = document.addCountry.addNewCountry.value.trim();
    var namediv = document.getElementById('addNewCountry');
    var code = document.addCountry.addCountryZip.value.trim();
    var codediv = document.getElementById('addCountryZip');
    var ddiv = document.getElementById('addCountryFb');
    var nameStat = nameValidate1(name, namediv);
    var codeStat = cCodeValidate(code, codediv);
    if (nameStat === true && codeStat === true) {
        countryAddSql(name, code, ddiv);
    } else {
        ddiv.innerHTML = '';
    }
}

function loadCountries() {
    var tbody = document.getElementById('countryTableView');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountries';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            tbody.innerHTML = ajax.responseText;
        } else {
            tbody.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function filterCountry() {
    var tbody = document.getElementById('countryTableView');
    var f = document.getElementById('filterCountry').value;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountriesFilter&f=' + f;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            tbody.innerHTML = ajax.responseText;
        } else {
            tbody.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function editCountryClicked(str) {
    document.countryEditForm.countryId.value = str.trim();
    var name = document.countryEditForm.countryName;
    var code = document.countryEditForm.countryCode;
    var select = document.countryEditForm.status;
    var div = document.getElementById('countryEditFeedback');
//    var 
//   send id o server, get data in response, fill the data in resoective fields
//
    var url = 'AjaxPhp/test.php?cat=loadCountryEdit&id=' + str;
    var ajax = getAjax();

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var data = ajax.responseText;
            var array = JSON.parse(ajax.responseText);
            name.value = array[0];
            code.value = array[2];
            var stat = parseInt(array[1]);
            if (stat === 1) {
                select.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            } else {
                select.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            }
            div.innerHTML = '';
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    $('#editCountryModal101').modal('toggle');
}

//work on this save updates on country through here
function editCountrySave() {
    var id = document.countryEditForm.countryId.value.trim();
    var name = document.countryEditForm.countryName.value.trim();
    var namediv = document.getElementById('countryName');
    var code = document.countryEditForm.countryCode.value.trim();
    var codediv = document.getElementById('countryCode');
    var select = document.countryEditForm.status.value;
    var div = document.getElementById('countryEditFeedback');
    var status = 0;
    if (select === 'ACTIVE') {
        status = 1;
    }
    var namestat = nameValidate1(name, namediv);
    var codeStat = cCodeValidate(code, codediv);
    if (namestat === true && codeStat === true) {
        var array = new Array();
        array[0] = id;
        array[1] = name;
        array[2] = status;
        array[3] = code;
        var jsonString = JSON.stringify(array);
        editCountrySaveSql(jsonString, div);
    }

}
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//                          menu handler county                           //
//                                                                        //
////////////////////////////////////////////////////////////////////////////

function menuHandlerCounty(str) {
    var div = document.getElementById('modalCounty');
    var ajax = getAjax();
    var url = 'widgets/myPickUpPoints/' + str + '.html';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (str === 'addCounty') {
                getCountryAdd();
            }
            if (str === 'viewCounty') {
                //get countries
                getfilterCountry();
                //populate table
                filterCountyData();
            }
        } else {
            div.innerHTML = '<i class="fa fa-pulse fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function getCountryAdd() {
    var countrySelect = document.addCounty.country;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=getCountryAdd';
    var div = document.getElementById('countyCountryAdd');
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            countrySelect.innerHTML = ajax.responseText;
            div.innerHTML = '';
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function addNewCounty() {
    var countrySelect = document.addCounty.country.value;
    var countryDiv = document.getElementById('countyCountryAdd');
    var countyName = document.addCounty.countyNameAdd.value;
    var countyDiv = document.getElementById('countyNameAdd');

    var ddiv = document.getElementById('addCountyFeedBack');

    var countryStat = countryValidate(countrySelect, countryDiv);
    var countyStat = countyValidate(countyName, countyDiv);

    if (countryStat === true && countyStat === true) {
        addNewCountySql(countrySelect, countyName, ddiv);
    } else {
        ddiv.innerHTML = '';
    }
}

function getfilterCountry() {
    var countrySelect = document.filterCounty.viewCountyCountry;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=getCountryAdd';
    var div = document.getElementById('viewCountyCountry');
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            countrySelect.innerHTML = ajax.responseText;
            div.innerHTML = '';
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function filterCountyData() {
    //get table, get status,get country
    var table = document.getElementById('tableViewCounty');
    var stat = document.filterCounty.viewCountyStatus.value;
    var country = document.filterCounty.viewCountyCountry.value;
    var array = new Array();
    array[0] = country;
    array[1] = stat;
    var jsonData = JSON.stringify(array);
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=filterCountyData&jsonData=' + jsonData;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            table.innerHTML = ajax.responseText;
        } else {
            table.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function filterCountyData1() {
    //get table, get status,get country
    var table = document.getElementById('tableViewCounty');
    var stat = document.filterCounty.viewCountyStatus.value;
    var statDiv = document.getElementById('viewCountyStatus');
    var country = document.filterCounty.viewCountyCountry.value;
    var countryDiv = document.getElementById('viewCountyCountry');
    var statStat = statusValidate(stat, statDiv);
    var countrStat = countryValidate(country, countryDiv);
    if (countrStat === true && statStat === true) {
        var array = new Array();
        array[0] = country;
        array[1] = stat;
        var jsonData = JSON.stringify(array);
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=filterCountyDataAction&jsonData=' + jsonData;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                table.innerHTML = ajax.responseText;
            } else {
                table.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function editCounty(str) {
    document.editCountyData.countyId.value = str.trim();
    var country = document.editCountyData.country;
    var county = document.editCountyData.county;
    var status = document.editCountyData.status;
    var div = document.getElementById('editCountyFb');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=getCountyDataEdit&id=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var data = JSON.parse(ajax.responseText);
            country.value = data[0];
            county.value = data[1];
            if (parseInt(data[2]) === 1) {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            } else {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            }
            div.innerHTML = '';
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    $('#countyPopupEdit').modal('show');
}

function saveEditCountyDataUpdate() {
    var countyId = document.editCountyData.countyId.value;
    var county = document.editCountyData.county.value;
    var countyDiv = document.getElementById('countyEdit');
    var status = document.editCountyData.status.value;
    var div = document.getElementById('editCountyFb');
    var countyStat = countyValidate(county, countyDiv);
    if (countyStat === true) {
        saveEditCountyDataUpdateSql(countyId, county, status, div);
    } else {
        div.innerHTML = '';
    }
}

function menuHandlerConstituency(str) {
    var div = document.getElementById('modalConstituency');
    var url = 'widgets/myPickUpPoints/' + str + '.html';
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (str === 'addConstituency') {
                loadCountiesForState();
            }
            if (str === 'viewConstituency') {
                loadCountriesConstituency();
                loadTableConstituencyData();
            }
        } else {
            div.innerHTML = '<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function loadCountiesForState() {
    var country = document.addConstituency.stateCountry;
    var countryDiv = document.getElementById('stateCountryDiv');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountiesForState';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            country.innerHTML = ajax.responseText;
            countryDiv.innerHTML = '';
        } else {
            countryDiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function loadCountyState(str) {
    var county = document.addConstituency.stateCounty;
    var countyDiv = document.getElementById('stateCounty');
    if (str === '---select Country---') {
        county.innerHTML = '<option>---select County---</option>';
    } else {
        loadCountyStateSql(str, county, countyDiv);
    }
}

function addNewConstituency() {
    var country = document.addConstituency.stateCountry.value;
    var countryDiv = document.getElementById('stateCountryDiv');
    var county = document.addConstituency.stateCounty.value;
    var countyDiv = document.getElementById('stateCounty');
    var constituency = document.addConstituency.addConstituency.value.trim();
    var constiuencyDiv = document.getElementById('stateConstituency');
    var div = document.getElementById('addConstituencyFeedback');

    var c1stat = countryValidate(country, countryDiv);
    var c2stat = countyValidate1(county, countyDiv);
    var c3stat = nameValidate1(constituency, constiuencyDiv);

    if (c1stat === true && c2stat === true && c3stat === true) {
        addNewConstituencySql(country, county, constituency, div);
    }
    div.innerHTML = '';
}

function loadCountriesConstituency() {
    //get the combo box
    var combo = document.filterStateEdit.country;
    var combodiv = document.getElementById('FSEcountry');
    //get the div
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountriesConstituency';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            combo.innerHTML = ajax.responseText;
            combodiv.innerHTML = '';
        } else {
            combodiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
// this function works on populating the county on edititng the manenoz
function loadCountyEditConst(str) {
    var county = document.filterStateEdit.county;
    var countydiv = document.getElementById('FSEcounty');
    if (str === '---select Country---') {
        county.innerHTML = '<option>---select County---</option>';
    } else {
        loadCountyStateSql1(str, county, countydiv);
    }
}
function loadTableConstituencyData() {
    //get the table div,
    var country = document.filterStateEdit.country.value.trim();
    var county = document.filterStateEdit.county.value.trim();
    var status = document.filterStateEdit.status.value.trim();
    var table = document.getElementById('tableViewState');
    var array = new Array();
    array[0] = country;
    array[1] = county;
    array[2] = status;
    var jsonData = JSON.stringify(array);
    loadTableConstituencySql(jsonData, table);

}

function EditStateDetails(str) {
    document.editStateDetails.id.value = str.trim();
    var country = document.editStateDetails.country;
    var county = document.editStateDetails.county;
    var state = document.editStateDetails.state;
    var status = document.editStateDetails.status;
    var div = document.getElementById('esdFeedBack');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=EditStateDetails&id=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var data = ajax.responseText;
            var array = JSON.parse(data);
            country.value = array[0];
            county.value = array[1];
            state.value = array[2];
            if (parseInt(array[3]) === 1) {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            } else {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            }
            div.innerHTML = '';
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    //get the data, feed into this fields
    $('#modalStateEdit').modal('toggle');
}

function editStateDetailsSave() {
    var id = document.editStateDetails.id.value.trim();
    var state = document.editStateDetails.state.value.trim();
    var statediv = document.getElementById('esdState');
    var status = document.editStateDetails.status.value.trim();
    var div = document.getElementById('esdFeedBack');
    var stateStat = countyValidate(state, statediv);
    if (stateStat === true) {
        editStateDetailsSaveSql(id, state, status, div);
    } else {
        div.innerHTML = '';
    }
}

function filterTableDataState() {
    //get the table div,
    var country = document.filterStateEdit.country.value.trim();
    var countryDiv = document.getElementById('FSEcountry');
    var county = document.filterStateEdit.county.value.trim();
    var countyDiv = document.getElementById('FSEcounty');
    var status = document.filterStateEdit.status.value.trim();
    var statusDiv = document.getElementById('FSEstatus');


    var table = document.getElementById('tableViewState');

    var contryStat = countryValidate(country, countryDiv);
    var countyStat = countyValidate1(county, countyDiv);
    var statusStat = statusValidate(status, statusDiv);

    if (countyStat === true && countyStat === true && statusStat === true) {
        var array = new Array();
        array[0] = country;
        array[1] = county;
        array[2] = status;
        var jsonData = JSON.stringify(array);
        loadTableConstituencySql(jsonData, table);
    }
}
/*
 ===========================================================================================
 ========                            I am picups yo!                         ===============
 ===========================================================================================
 */
function  menuHandlerPickups(str) {
    var ajax = getAjax();
    var div = document.getElementById('modalPickup');
    var url = 'widgets/myPickUpPoints/' + str + '.html';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            done(div, ajax.responseText);
            if (str === 'addPickup') {
                loadPickupCountries();
            }
            if (str === 'viewPickup') {
                loadPickupEditCountries();
                populateTableEditPickup();
            }
        } else {
            wait(div);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function loadPickupCountries() {
    var country = document.addPickupPoint.country;
    var countrydiv = document.getElementById('APPCountry');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadPickupCountries';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            countrydiv.innerHTML = '';
            done(country, ajax.responseText);
        } else {
            wait(countrydiv);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function loadPickupCounty(str) {
    var county = document.addPickupPoint.county;
    var countydiv = document.getElementById('APPCounty');
    if (str === '---select Country---') {
        county.innerHTML = '<option>---select County---</option>';
    } else {
        loadCountyStateSql(str, county, countydiv);
    }
}
function loadStates(str) {
    var state = document.addPickupPoint.state;
    var statediv = document.getElementById('APPstate');
    if (str === '---select County---') {
        state.innerHTML = '<option>---select State---</option>';
    } else {
        loadStatesSql(str, state, statediv);
    }
}
function AddPickupPoint() {
    var country = document.addPickupPoint.country.value;
    var countrydiv = document.getElementById('APPCountry');

    var county = document.addPickupPoint.county.value;
    var countydiv = document.getElementById('APPCounty');

    var state = document.addPickupPoint.state.value;
    var statediv = document.getElementById('APPstate');

    var address = document.addPickupPoint.address.value;
    var addressdiv = document.getElementById('APPAddress');

    var des = document.addPickupPoint.description.value;
    var desdiv = document.getElementById('APPDescription');

    var ddiv = document.getElementById('APPfeedback');

    var c1st = countryValidate(country, countrydiv);
    var c2st = countyValidate(county, countydiv);
    var stst = stateValidate(state, statediv);
    var adst = nameValidate2(address, addressdiv);
    var dest = descriptionValidate2(des, desdiv);

    if (c1st === true && c2st === true && stst === true && adst === true && dest === true) {
        var array = new Array();
        array[0] = country.trim();
        array[1] = county.trim();
        array[2] = state.trim();
        array[3] = address.trim();
        array[4] = des.trim();
        var jsonData = JSON.stringify(array);
        AddPickupPointSql(jsonData, ddiv);

    } else {
        done(ddiv, '');
    }
}

function loadPickupEditCountries() {
    var country = document.filterPickupEdit.country;
    var countrydiv = document.getElementById('FPEcountry');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadPickupEditCountries';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            done(countrydiv, '');
            done(country, ajax.responseText);
        } else {
            wait(countrydiv);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function countryPickup(str) {
    var county = document.filterPickupEdit.county;
    var countydiv = document.getElementById('FPEcounty');
    if (str === '---select Country---') {
        done(county, '<option>---select County---</option>');
    } else {
        loadCountyStateSql1(str, county, countydiv);
    }
}

function countyPickup(str) {
    var state = document.filterPickupEdit.state;
    var statediv = document.getElementById('FPEState');
    if (str === '---select County---') {
        done(state, '<option>---select State---</option>');
    } else {
        loadStatesSql1(str, state, statediv);
    }
}

function populateTableEditPickup() {
    var country = document.filterPickupEdit.country.value;
    var county = document.filterPickupEdit.county.value;
    var state = document.filterPickupEdit.state.value;
    var status = document.filterPickupEdit.status.value;
    var table = document.getElementById('viewPickupable');

    var array = [country, county, state, status];
    var jsonData = JSON.stringify(array);
    var url = 'AjaxPhp/test.php?cat=populateTableEditPickup&jsonData=' + jsonData;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            done(table, ajax.responseText);
        } else {
            wait(table);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function populateTableEditPickup1() {
    var country = document.filterPickupEdit.country.value;
    var countryDiv = document.getElementById('FPEcountry');
    var county = document.filterPickupEdit.county.value;
    var countyDiv = document.getElementById('FPEcounty');
    var state = document.filterPickupEdit.state.value;
    var stateDiv = document.getElementById('FPEState');
    var status = document.filterPickupEdit.status.value;
    var statusDiv = document.getElementById('FPEstatus');

    var table = document.getElementById('viewPickupable');

    var c1s = countryValidate(country, countryDiv);
    var cnt = countyValidate1(county, countyDiv);
    var sts = stateValidate(state, stateDiv);
    var sst = statusValidate(status, statusDiv);

    if (c1s === true && cnt === true && sts === true && sst === true) {
        var array = [country, county, state, status];
        var jsonData = JSON.stringify(array);
        var url = 'AjaxPhp/test.php?cat=populateTableEditPickup&jsonData=' + jsonData;
        var ajax = getAjax();
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                done(table, ajax.responseText);
            } else {
                wait(table);
            }
        };
        ajax.open('GET', url, true);
        ajax.send();
    }
}

function editPickupPointData(str) {
    document.pickupDetailsData.id.value = str.trim();
    var country = document.pickupDetailsData.country;
    var county = document.pickupDetailsData.county;
    var state = document.pickupDetailsData.state;
    var status = document.pickupDetailsData.status;
    var address = document.pickupDetailsData.pickupAddress;
    var description = document.pickupDetailsData.pickupDescription;
    var div = document.getElementById('PDDfeedback');

    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=getPickupPointData&id=" + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            done(div, '');
            var data = ajax.responseText;
            var json = JSON.parse(data);
            country.value = json[0];
            county.value = json[1];
            state.value = json[2];
            address.value = json[3];
            description.value = json[4];
            if (parseInt(json[5]) === 1) {
                done(status, '<option>ACTIVE</option><option>INACTIVE</option>');
            } else {
                done(status, '<option>INACTIVE</option><option>ACTIVE</option>');
            }
        } else {
            wait(div);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
    $('#editPickupData').modal('show');
}

function pickupDetailsDataSave() {
    var id = document.pickupDetailsData.id.value;
    var status = document.pickupDetailsData.status.value;
    var address = document.pickupDetailsData.pickupAddress.value;
    var addDiv = document.getElementById('PDDpickupAddress');
    var description = document.pickupDetailsData.pickupDescription.value;
    var desdiv = document.getElementById('PDDdescription');
    var div = document.getElementById('PDDfeedback');
    
    var ads = nameValidate2(address,addDiv);
    var des = descriptionValidate2(description,desdiv);
    var st = 0;
    if(status==='ACTIVE'){
        st=1;
    }
    if(ads===true && des===true){
      var array = [id,address,description,st];
      var json = JSON.stringify(array);
      pickupDetailsDataSaveSql(json,div);
    } else {
        done(div,'');
    }
}