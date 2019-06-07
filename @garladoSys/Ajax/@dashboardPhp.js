//
//
//THIS FILE MANAGES PHP FILE FOR DASHBOARD
//
//
function addMemberImage(name, mail, phone, level, image, st, div) {
    // addMemberImage(name,mail,phone,level,image.files[0],dimage,feedback);
    var form_data = new FormData();
    var imagename = 'undefined';
    form_data.append("file", image);
    $.ajax({
        url: "uploadUserPic.php",
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

            imagename = data;
            div.innerHTML = '';
//             test('obtained from server'+image);
            addMemberSave(name, mail, phone, level, imagename, st, div);
        }
    });
}
function addMemberSave(name, mail, phone, level, image, st, div) {
    var name = name;
    var mail = mail;
    var phone = phone;
    var level = level;
    var image = image;
    var div = div;
    var ajax = getAjax();
    var url = 'AjaxPhp/@dasboardScript.php?\n\
             name=' + name +
            '&mail=' + mail +
            '&phone=' + phone +
            '&level=' + level +
            '&image=' + image +
            '&cat=addMember&stat=' + st;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<strong><i class="fa fa-smile-o"></i> Adding new User...<i class="fa fa-refresh fa-spin"></strong>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function getDetails(email, div) {
    var mail = email;
    var div = div;
    var ajax = getAjax();

    var url = "AjaxPhp/@dasboardScript.php?cat=showDetails&id=" + mail;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<strong>Loading user data...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<strong>Loading user data...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<strong>Loading user data...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<strong>Loading user data...<i class="fa fa-refresh fa-spin"></strong>';
        }
    };

    ajax.open("GET", url, true);
    ajax.send();

}


//add group subsection

function addGroupsql(name, mydiv) {
    var div = mydiv;
    var gname = name;
    var ajax = getAjax();
//    div.innerHTML = '<p><i span class="fa-smile-o"></i> Adding Group <strong>'+gname+'</strong>...<i class="fa fa-spin fa-refresh"></i></p>';


    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding Group <strong>' + gname + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding Group <strong>' + gname + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding Group <strong>' + gname + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding Group <strong>' + gname + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };

    ajax.open("GET", "AjaxPhp/@dasboardScript.php?cat=addGroup&GroupName=" + gname, true);
    ajax.send();
}

function popGroupData() {
    var div = document.getElementById('generalGroupView');
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", "AjaxPhp/@dasboardScript.php?cat=viewGroup", true);
    ajax.send();
}
function popGroupDataFilter(str) {
    var div = document.getElementById('generalGroupView');
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", "AjaxPhp/@dasboardScript.php?cat=viewGroupFilter&key=" + str, true);
    ajax.send();
}

function updateGroup(id, name, status, maindiv) {
    var myid = id;
    var myname = name;
    var mystatus = status;
    var div = maindiv;
//    test('2');
    var ajax = getAjax();

    var url = "AjaxPhp/@dasboardScript.php?cat=updateGroup&id=" + myid + "&name=" + myname + "&status=" + mystatus + "";

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
//            test(ajax.responseText);
            if (ajax.responseText.indexOf("Update Successful!") !== -1) {
                popGroupDataFilter(document.getElementById('filterGroup').value);
            }
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();


}


//add category subsection
function addCategorysql(general, name, div) {
    var general = general;
    var cat = name;
    var mydiv = div;
    var ajax = getAjax();

    var url = "AjaxPhp/test.php?cat=addCategory&general=" + general + "&name=" + cat;
//    test('1');
//    mydiv.innerHTML=name+'<br>'+cat;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding category group <strong>' + cat + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function popTableCategory() {
    var div = document.getElementById('generalCategoryView');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateTableCategoryEdit';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = 'Loading data..<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}
function filterCategory() {
    var status = document.filterEdit.statusGroupEdit.value;
    var group = document.filterEdit.generalGroupEdit.value;

    var table = document.getElementById('generalCategoryView');

    var statusdiv = document.getElementById('statusGroupEdit');
    var groupdiv = document.getElementById('generalEditError');

    if (status === '---select status---' || group === '---select Group---') {
        if (status === '---select status---') {
            statusdiv.innerHTML = 'Select Valid search status';
        }
        if (group === '---select Group---') {
            groupdiv.innerHTML = 'select valid group';
        }
    } else {
        statusdiv.innerHTML = '';
        groupdiv.innerHTML = '';
        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=filterCategory&status=' + status + '&group=' + group;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                table.innerHTML = ajax.responseText;
            } else {
                table.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    }

}
function filterCategory1() {
    var status = document.filterEdit.statusGroupEdit.value;
    var group = document.filterEdit.generalGroupEdit.value;

    var table = document.getElementById('generalCategoryView');
    if (status === '---select status---' || group === '---select Group---') {

        status = 'ALL';
        group = 'ALL';

    } else {

        var url = 'AjaxPhp/test.php?cat=filterCategory&status=' + status + '&group=' + group;
        var ajax = getAjax();

        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                table.innerHTML = ajax.responseText;
            } else {
                table.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    }
}

function updateCategory(catid, status, catname, mydiv) {
    var stat = status;
    var id = catid;
    var name = catname;
    var div = mydiv;
    var url = 'AjaxPhp/test.php?cat=updateCategory&id=' + id + '&catname=' + name + '&status=' + stat;
    var ajax = getAjax();

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (ajax.responseText.indexOf("Changes Successfuly saved!") !== -1) {
                filterCategory1();
            }
        } else if (ajax.readyState === 3) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 2) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 1) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-refresh fa-spin"></strong>';
        } else if (ajax.readyState === 0) {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-refresh fa-spin"></strong>';
        }
    };//
    ajax.open("GET", url, true);
    ajax.send();
}

//add minorcategory suboption

function addMinorCategorysql(general, category, name, div) {
    var general = general;
    var cat = name;
    var mycategory = category;
    var mydiv = div;
    var ajax = getAjax();

    var url = "AjaxPhp/test.php?cat=addMinorCategory&category=" + mycategory + "&name=" + cat;
//    test(category);
//    mydiv.innerHTML=name+'<br>'+cat;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            mydiv.innerHTML = ajax.responseText;
        } else {
            mydiv.innerHTML = '<p><i span class="fa fa-smile-o"></i> Adding Specific category group <strong>' + cat + '</strong>...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function filterMinorCategoryEditSql(general, category, status, div) {
    var general = general;
    var cat = category;
    var stat = status;
    var div = div;
//    test('Here');
    var url = 'AjaxPhp/test.php?cat=filterMinorCategoryEdit&general=' + general + '&category=' + cat + '&status=' + stat;
    var ajax = getAjax();

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = 'Loading data...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
//    
}
function updateMinorGroup(myname, myid, mystatus, mydiv) {
    var name = myname;
    var id = myid;
    var status = mystatus;
    var div = mydiv;
    var ajax = getAjax();
    var stat = document.editMinorCategory.statusMinorGroupEdit.value;
    var gen = document.editMinorCategory.generalMinorGroupEdit.value;
    var cat = document.editMinorCategory.categoryMinorGroupEdit.value;
    var url = "AjaxPhp/test.php?cat=SaveMinorChangeUpdate&minorid=" + id + "&minorname=" + name + "&minorstat=" + status;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            if (stat === '---select status---' || gen === '---select Group---' || cat === '---select Cat---') {
                filterMinorCategoryEditSql("ALL", "ALL", "ALL", document.getElementById('SpecificCategoryViewEdit'));
            } else {
                filterMinorCategoryEditSql(gen, cat, stat, document.getElementById('SpecificCategoryViewEdit'));
            }

        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();

}
//insert brand to db
function addBrandSql(general, bname, imagename, mydiv) {
    var name = bname;
    var mygen = general;
    var img = imagename;
    var div = mydiv;

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=addBrandGroup&general=' + mygen + '&name=' + name + '&image=' + img;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Adding brand group...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();

}

function uploadImageProduct(specific, name, image, imagediv, price, mprice, brand, status, div) {
    // addProductAddSql(specific,name,image.files[0],imagediv,price,brand,status,div);
    var form_data = new FormData();
    var imagename = 'undefined';
    form_data.append("file", image);
    $.ajax({
        url: "upload.php",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            imagediv.innerHTML = "<label class='text-success'>Uploading image...<i class='fa fa-spin fa-refresh'></i></label>";
        },
        success: function (data)
        {
            imagediv.innerHTML = '';
            imagename = data;
//             imagediv.innerHTML = data;
//             test('obtained from server');
            addProductAddSql(specific, name, imagename, price, mprice, brand, status, div);
        }
    });

}
//this function is a dummy function to test if we can get the image name and do somethin with the name.
function addPtest(imagename) {
    alert(" To server :" + imagename);
}
function filterCategoryBrand() {
    var group = document.filterEditBrand.generalGroupEditBrand.value;
    var status = document.filterEditBrand.statusGroupEditBrand.value;
    if (group === '---select Group---' || status === '---select status---') {
        status = 'ALL';
        group = 'ALL';
    }
    var table = document.getElementById('generalBrandView');

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=filterBrandEdit&status=' + status + '&group=' + group;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            table.innerHTML = ajax.responseText;
        } else {
            table.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function filerCategoryBrand1() {
    var general = document.filterEditBrand.generalGroupEditBrand.value;
    var gendiv = document.getElementById('generalGroupEditBrand');

    var status = document.filterEditBrand.statusGroupEditBrand.value;
    var statdiv = document.getElementById('statusGroupEditBrand');

    var genstat = generalValidate(general, gendiv);
    var statstat = statusValidate(status, statdiv);


    if (genstat === true && statstat === true) {
        var table = document.getElementById('generalBrandView');

        var ajax = getAjax();
        var url = 'AjaxPhp/test.php?cat=filterBrandEdit&status=' + status + '&group=' + general;
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4) {
                table.innerHTML = ajax.responseText;
            } else {
                table.innerHTML = 'Loading...<i class="fa fa-spin fa-refresh"></i>';
            }
        };
        ajax.open("GET", url, true);
        ajax.send();
    }
}

function updateBandDataSql(id, brand, status, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=updateBandDataSql&id=' + id + '&brand=' + brand + '&status=' + status;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            filterCategoryBrand();
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function updateBandDataSqlWithImage(id, imagename, brand, stat, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=updateBandDataSqlWithImage&id=' + id + '&brand=' + brand + '&status=' + stat + '&logo=' + imagename;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            filterCategoryBrand();
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function addProductAddSql(specific, name, imagename, price, mprice, brand, status, div) {
    var specific = specific;
    var name = name;
    var price = price;
    var brand = brand;
    var status = status;
    var div = div;
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=addProductAddSql&specific=' + specific + '&name=' + name + '&price=' + price + '&mprice=' + mprice + '&image=' + imagename + '&brand=' + brand + '&status=' + status;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Adding product <strong>' + name + '</strong>...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

}

function populateTableEditProduct() {
    var table = document.getElementById('tableProductView');
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateTableEditProduct';
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            table.innerHTML = ajax.responseText;
        } else {
            table.innerHTML = 'Loading my Products...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function updateProductDetailsSql(productId, name, price, mprice, status, div) {
    var id = productId;
    var name = name;
    var price = price;
    var mprice = mprice;
    var status = status;
    var div = div;

    var stat = 0;
    if (status === 'ACTIVE') {
        stat = 1;
    }

    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=updateProductDetailsSql&id=' + id + '&name=' + name + '&price=' + price + '&mprice=' + mprice + '&status=' + stat;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            editProductFilterAction1();
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving changes...<i class="fa fa-spin fa-refresh"></li>';
        }
    };
    ajax.open("GET", url, true);
    ajax.send();
}

function addMorePicsSql(id, imagename, productname, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=addMorePicSql&img=' + imagename + '&id=' + id + '&productname=' + productname;
//    div.innerHTML=imagename;

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;

        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Adding picture...<i class="fa fa-spin fa-refresh"></li>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

//
//
//FUNCTIONS FEATURES
//
//
function  addCompFeatureSql(itemID, ram, rom, processor, os, display, sim, productname, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=addCompFeatureSql&id=' + itemID + '&ram=' + ram + '&rom=' + rom + '&processor=' + processor + '&os=' + os + '&display=' + display + '&sim=' + sim + '&productname=' + productname;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Adding features...<i class="fa fa-spin fa-refresh"></li>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function AddcaddNCompFeatureSql(id, prop1, prop2, productname, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=AddcaddNCompFeatureSql&id=' + id + '&prop1=' + prop1 + '&prop2=' + prop2 + '&productname=' + productname;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Adding features...<i class="fa fa-spin fa-refresh"></li>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function saveCoreDataClickSql(id, ram, rom, cpu, os, display, sim, productname, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=saveCoreDataClickSql&id=' + id + '&ram=' + ram + '&rom=' + rom + '&cpu=' + cpu + '&os=' + os + '&display=' + display + '&sim=' + sim + '&productname=' + productname;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Saving feature Updates...<i class="fa fa-spin fa-refresh"></li>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function populateTableAddStore(general, category, spec, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateTableMyStore&general=' + general + '&category=' + category + '&spec=' + spec;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText + '<br>';
        } else {
            div.innerHTML = '<p><i class="fa fa-smile-o"></i> Loading...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function populateTableAddStoreName(name, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=populateTableAddStoreName&name=' + name;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<p><i class="fa fa-smile-o"></i> Loading...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function saveStockSql(current, stock, id, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=saveStockSql&current=' + current + '&stock=' + stock + '&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<p><i class="fa fa-smile-o"></i> Adding Stock...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}


function resetPasswordSql(email, pass1, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=resetPasswordSql&email=' + email + '&pass=' + pass1;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<p><i class="fa fa-smile-o"></i> Saving new password...<i class="fa fa-spin fa-refresh"></i></p>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function showUserAuditSql(id, mf, mt, yf, yt, table, level) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=showUserAuditSql&mf=' + mf + '&mt=' + mt + '&yf=' + yf + '&yt=' + yt + '&id=' + id;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            var response = ajax.responseText;
            table.innerHTML = response.substring(response.indexOf('~') + 1, response.indexOf('_'));
            level.innerHTML = response.substring(response.indexOf('_') + 1, response.indexOf('#')) + '%';
//           table.innerHTML=response;
        } else {
            table.innerHTML = '<i class="fa fa-smile-o"></i> Loading user audit...<i class="fa fa-refresh fa-spin"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function countryAddSql(name, code, div) {
    var ajax = getAjax();
    var arrayData = new Array();
    arrayData[0] = name;
    arrayData[1] = code;
    var jsonString = JSON.stringify(arrayData);
    var url = 'AjaxPhp/test.php?cat=countryAdd&jsonData=' + jsonString;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function editCountrySaveSql(jsonString, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=editCountrySave&jsonData=' + jsonString;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            filterCountry();
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function addNewCountySql(countrySelect, countyName, ddiv) {
    var ajax = getAjax();
    var arrayData = new Array();
    arrayData[0] = countrySelect;
    arrayData[1] = countyName;
    var jsonData = JSON.stringify(arrayData);
    var url = 'AjaxPhp/test.php?cat=addNewCounty&jsonData=' + jsonData;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            ddiv.innerHTML = ajax.responseText;
        } else {
            ddiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function saveEditCountyDataUpdateSql(countyId, county, status, div) {
    var array = new Array();
    array[0] = county.trim();
    if (status === 'ACTIVE') {
        array[1] = 1;
    } else {
        array[1] = 0;
    }
    array[2] = countyId;
    var jsonData = JSON.stringify(array);
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=saveEditCountyDataUpdate&jsonData=' + jsonData;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            filterCountyData();
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//function for add forms
function loadCountyStateSql(str, select, selectDiv) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountiesForCountries&country=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            select.innerHTML = ajax.responseText;
            selectDiv.innerHTML = '';
        } else {
            selectDiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//function for add forms
function loadStatesSql(str, select, selectDiv) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadStatesSql&county=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            select.innerHTML = ajax.responseText;
            selectDiv.innerHTML = '';
        } else {
            selectDiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//function for edit/vew pages
function loadCountyStateSql1(str, select, selectDiv) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadCountiesForCountriesEdit&country=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            select.innerHTML = ajax.responseText;
            selectDiv.innerHTML = '';
        } else {
            selectDiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//function for STATES edit/vew pages
function loadStatesSql1(str, select, selectDiv) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadStatesSql1&county=' + str.trim();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            select.innerHTML = ajax.responseText;
            selectDiv.innerHTML = '';
        } else {
            selectDiv.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function addNewConstituencySql(country, county, constituency, div) {
    var ajax = getAjax();
    var array = new Array();
    array[0] = country;
    array[1] = county;
    array[2] = constituency;
    var jsonData = JSON.stringify(array);
    var url = 'AjaxPhp/test.php?cat=addNewConstituency&jsonData=' + jsonData;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}

function loadTableConstituencySql(jsonData, table) {
    var ajax = getAjax();
    var url = 'AjaxPhp/test.php?cat=loadTableConstituencySql&jsonData=' + jsonData;
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

function editStateDetailsSaveSql(id, state, status, div) {
    var ajax = getAjax();
    var array = new Array();
    array[0] = id;
    array[1] = state;
    array[2] = status;//send updates to erve
    var jsonData = JSON.stringify(array);
    var url = 'AjaxPhp/test.php?cat=editStateDetailsSaveSql&jsonData='+jsonData;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            done(div,ajax.responseText);
            loadTableConstituencyData();
        } else {
            wait(div);
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function wait(div) {
    div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
}
function done(div, data) {
    div.innerHTML = data;
}

function  AddPickupPointSql(jsonData,ddiv){
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=AddPickupPoint&jsonData="+jsonData;
    ajax.onreadystatechange = function(){
        if(ajax.readyState === 4 ){
            done(ddiv,ajax.responseText);
        } else {
            wait(ddiv);
        }
    };
    ajax.open('GET',url,true);
    ajax.send();
}

function pickupDetailsDataSaveSql(json,div){
    var ajax = getAjax();
    var url = "AjaxPhp/test.php?cat=pickupDetailsDataSaveSql&jsonData="+json;
    ajax.onreadystatechange = function(){
        if(ajax.readyState === 4 ){
            done(div,ajax.responseText);
            populateTableEditPickup();
        } else {
            wait(div);
        }
    };
    ajax.open('GET',url,true);
    ajax.send();
}