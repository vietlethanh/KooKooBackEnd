/*
 * This file was automatically generated By Code Smith 
 * Modifications will be overwritten when code smith is run
 *
 * PLEASE DO NOT MAKE MODIFICATIONS TO THIS FILE
 * Date Created 5/6/2012
 *
 */



/// <summary>
/// Implementations of slmanufactorys represent a Manufactory
///
/// </summary>
function Manufactory()
{		   
	//region PRESERVE ExtraMethods For Manufactory
	//endregion
    //region Contants	
    var ACT_ADD = 10;
    var ACT_UPDATE = 11;
    var ACT_DELETE = 12;
    var ACT_CHANGE_PAGE = 13;
    var ACT_SHOW_EDIT = 14;
    var ACT_GET = 15;
    var _strPage = "admin_manufactory.php";
    
   
    //endregion   
    
    //region Public Functions
    
    this.btnSave_OnClick = btnSave_OnClick;
    function btnSave_OnClick() {
        core.disableControl("btnOK", true);
        var isValid = true;

		var manufactoryID = core.trim(core.getObject("txtManufactoryID").val());
		core.ValidateInputTextBox('txtManufactoryID','');
		if(manufactoryID == ''){
			core.ValidateInputTextBox('txtManufactoryID','ManufactoryID is required', isValid);
			isValid =  false;
		}else if (manufactoryID.length > 20) {
			core.ValidateInputTextBox('txtManufactoryID','ManufactoryID must be less than 20', isValid);
			isValid =  false;
		}

		var manufactoryName = core.trim(core.getObject("txtManufactoryName").val());
		core.ValidateInputTextBox('txtManufactoryName','');
		if(manufactoryName == ''){
			core.ValidateInputTextBox('txtManufactoryName','ManufactoryName is required', isValid);
			isValid =  false;
		}else if (manufactoryName.length > 50) {
			core.ValidateInputTextBox('txtManufactoryName','ManufactoryName must be less than 50', isValid);
			isValid =  false;
		}

	       
        if (isValid == false) {
         core.disableControl("btnOK", false);
            return;
        }
         
        if (core.getObject("adddocmode")[0].value == ADD_MODE) {
            insertNew();
        }
        else {
            edit();
        }
    }
    
    this.edit = edit;
    function edit() {

		var manufactoryID = core.trim(core.getObject("txtManufactoryID").val());
		var manufactoryName = core.trim(core.getObject("txtManufactoryName").val());
	                
        strRequest = "?isAJ=1&act=" + ACT_UPDATE +  
            '&ManufactoryID='+ core.urlencode(manufactoryID)+
			'&ManufactoryName='+ core.urlencode(manufactoryName)+		;
        
        var ajax = new Ajax();
        ajax.SendRequestToServerWithCustomMsg(_strPage, strRequest, edit_OnCallBack, true, MSG_AJAX_FETCHING_VN);
    }

    function edit_OnCallBack(xmlHTTPRequest) {
        core.disableControl("btnOK", false);
        if (xmlHTTPRequest.readyState == 4) {
            if (xmlHTTPRequest.status == 200) {
                var strRespond = core.parserXML(xmlHTTPRequest.responseText);
                if (!core.headerProcessingArr(strRespond[0], Array(true, true, false))) {
                    // ph?i kh?i t?o l?i d? tr?nh d?ng popdiv addFavourite
                    //var popDiv = new PopDiv();
                    //popDiv.init();
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                    return;
                }
                if (parseInt(strRespond[1]['rs']) == 1) {
                    showInfoBar('success', strRespond[1]["inf"]);
                    showAddMode();
                    changePage(_strPage, ACT_CHANGE_PAGE, core.getObject("txtPage").val());
                }
                else {
                    //var popDiv = new PopDiv();
                    //popDiv.init();
                    top.popDiv.childPop.alert(strRespond[1]["inf"], SYSTEM_TITLE_ERROR, 1);
                }
            }
        }
    }
    
    this.insertNew = insertNew;
    function insertNew() {

		var manufactoryID = core.trim(core.getObject("txtManufactoryID").val());
		var manufactoryName = core.trim(core.getObject("txtManufactoryName").val());
	        
        strRequest = "?isAJ=1&act=" + ACT_ADD +  
            '&ManufactoryID='+ core.urlencode(manufactoryID)+
			'&ManufactoryName='+ core.urlencode(manufactoryName)+		;
        
        var ajax = new Ajax();
        ajax.SendRequestToServerWithCustomMsg(_strPage, strRequest, insertNew_OnCallBack, true, MSG_AJAX_FETCHING_VN);
    }

    function insertNew_OnCallBack(xmlHTTPRequest) {
        core.disableControl("btnOK", false);
        if (xmlHTTPRequest.readyState == 4) {
            if (xmlHTTPRequest.status == 200) {
                var strRespond = core.parserXML(xmlHTTPRequest.responseText);
                if (!core.headerProcessingArr(strRespond[0], Array(true, true, false))) {
                    // ph?i kh?i t?o l?i d? tr?nh d?ng popdiv addFavourite
                    //var popDiv = new PopDiv();
                    //popDiv.init();
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                    return;
                }
                if (parseInt(strRespond[1]['rs']) == 1) {
                    showInfoBar('success', strRespond[1]["inf"]);
                    showAddMode();
                    changePage(_strPage, ACT_CHANGE_PAGE, 1);
                }
                else {
                    //var popDiv = new PopDiv();
                    //popDiv.init();
                    top.popDiv.childPop.alert(strRespond[1]["inf"], SYSTEM_TITLE_ERROR, 1);
                }
            }
        }
    }
    
    var _cacheURL_pdoc;
    this.deleteObj = deleteObj;
    function deleteObj(id, name) {
        //curRow = currentRowId;
        popDiv.alert('Do you want to delete ' + name + ' ?', SYSTEM_TITLE_ERROR, 2, "_objManufactory.delete_OK()", "_objManufactory.delete_Cancel()");

        var keyword = '';
        if (typeof core.getObject("txtGet") != 'undefined') {
            keyword = core.getObject("txtGet").val();
        }
      
        _cacheURL_pdoc = _strPage + "?isAJ=1&act=" + ACT_DELETE + "&id=" + docid + "&p=" + core.getObject("txtPage")[0].value + "&kw=" + keyword;
    }
    this.delete_Cancel = delete_Cancel;
    function delete_Cancel() {
        //core.getObject("adddocmode")[0].value = ADD_MODE;
    }
    this.delete_OK = delete_OK;
    function delete_OK() {
        // Prepare AJAX to remove selected doc from favorite list
        var ajax = new Ajax(METHOD_GET);
        ajax.SendRequestToServerWithCustomMsg(_cacheURL_pdoc, null, delete_OnCallBack, true, MSG_AJAX_FETCHING_VN);
    }
    function delete_OnCallBack(xmlHTTPRequest) {

        if (xmlHTTPRequest.readyState == 4) {
            if (xmlHTTPRequest.status == 200) {
                var strRespond = core.parserXML(xmlHTTPRequest.responseText);

                if (!core.headerProcessingArr(strRespond[0], Array(true, true, false))) {
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                    return;
                }
                if (parseInt(strRespond[1]['rs']) == 1) {
                    parent.window.showInfoBar('success', strRespond[1]["inf"]);
                    core.getObject("txtPage")[0].value = strRespond[1]["p"];
                    popDiv.hide();
                    core.getObject("list-content")[0].innerHTML = strRespond[1]['list'];
                }
                else //if(parseInt(strRespond[3]) == -1)
                {
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                }
            }
        }
    }
    
    this.showEdit = showEdit;
    function showEdit(strID) {
        showAddMode();
        strRequest = "?isAJ=1&act=" + ACT_SHOW_EDIT + "&id=" + strID; ;
        var ajax = new Ajax(METHOD_GET);
        ajax.SendRequestToServerWithCustomMsg(_strPage + strRequest, null, showEdit_OnCallBack, true, MSG_AJAX_FETCHING_VN);

    }
    function showEdit_OnCallBack(xmlHTTPRequest) {

        if (xmlHTTPRequest.readyState == 4) {
            if (xmlHTTPRequest.status == 200) {
                var strRespond = core.parserXML(xmlHTTPRequest.responseText);
                if (!core.headerProcessingArr(strRespond[0], Array(true, true, false))) {
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                    return;
                }
                if (parseInt(strRespond[1]['rs']) == 1) {
                    showInfoBar('success', MSG_RES_OPERATION_SUCCESS);
                    //alert(strRespond[1]['sens']);
                    // Add Doc && clear field
					core.getObject('txtManufactoryID').val(ManufactoryID);
					core.getObject('txtManufactoryName').val(ManufactoryName);
                    core.getObject("adddocmode")[0].value = EDIT_MODE;
                    core.getObject("status-add")[0].innerHTML = 'Edit mode';
                }
                else  // Duplicate
                {
                    popDiv.alert(MSG_RES_OPERATION_FAIL, SYSTEM_TITLE_ERROR, 1);
                }
            }
        }
    }
    
    this.showAddMode = showAddMode;
    function showAddMode() {
        core.getObject("adddocmode")[0].value = ADD_MODE;
        core.getObject("status-add")[0].innerHTML = 'Add mode';
		core.getObject('txtManufactoryID').val('');
		core.getObject('txtManufactoryName').val('');
    }
    //endregion   
}
var _objManufactory = new  Manufactory();
