
    /*
    this.edit = edit;
    function edit() {

		var articleID = core.util.getObjectValueByID("txtArticleID");
		var prefix = core.util.getObjectValueByID("txtPrefix");
		var title = core.util.getObjectValueByID("txtTitle");
		var fileName = core.util.getObjectValueByID("txtFileName");
		var articleType = core.util.getObjectValueByID("txtArticleType");
		var content = core.util.getObjectValueByID("txtContent");
		var notificationType = core.util.getObjectValueByID("txtNotificationType");
		var tags = core.util.getObjectValueByID("txtTags");
		var catalogueID = core.util.getObjectValueByID("txtCatalogueID");
		var sectionID = core.util.getObjectValueByID("txtSectionID");
		var numView = core.util.getObjectValueByID("txtNumView");
		var numComment = core.util.getObjectValueByID("txtNumComment");
		var status = core.util.getObjectValueByID("txtStatus");
		var comments = core.util.getObjectValueByID("txtcomments");
		var renewedDate = core.util.getObjectValueByID("txtRenewedDate");
		var renewedNum = core.util.getObjectValueByID("txtRenewedNum");
	                
        strRequest = "?isAJ=1&act=" + ACT_UPDATE +  
            '&ArticleID='+ core.urlencode(articleID)+
			'&Prefix='+ core.urlencode(prefix)+
			'&Title='+ core.urlencode(title)+
			'&FileName='+ core.urlencode(fileName)+
			'&ArticleType='+ core.urlencode(articleType)+
			'&Content='+ core.urlencode(content)+
			'&NotificationType='+ core.urlencode(notificationType)+
			'&Tags='+ core.urlencode(tags)+
			'&CatalogueID='+ core.urlencode(catalogueID)+
			'&SectionID='+ core.urlencode(sectionID)+
			'&NumView='+ core.urlencode(numView)+
			'&NumComment='+ core.urlencode(numComment)+
			'&Status='+ core.urlencode(status)+
			'&comments='+ core.urlencode(comments)+
			'&RenewedDate='+ core.urlencode(renewedDate)+
			'&RenewedNum='+ core.urlencode(renewedNum)		;
        
        var ajax = new Ajax();
        ajax.SendRequestToServerWithCustomMsg(_strPage, strRequest, edit_OnCallBack, true, MSG_AJAX_FETCHING_VN);
    }

    function edit_OnCallBack(xmlHTTPRequest) {
        core.util.disableControl("btnOK", false);
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
                    changePage(_strPage, ACT_CHANGE_PAGE, core.getObject("txtPage");
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

		var articleID = core.util.getObjectValueByID("txtArticleID");
		var prefix = core.util.getObjectValueByID("txtPrefix");
		var title = core.util.getObjectValueByID("txtTitle");
		var fileName = core.util.getObjectValueByID("txtFileName");
		var articleType = core.util.getObjectValueByID("txtArticleType");
		var content = core.util.getObjectValueByID("txtContent");
		var notificationType = core.util.getObjectValueByID("txtNotificationType");
		var tags = core.util.getObjectValueByID("txtTags");
		var catalogueID = core.util.getObjectValueByID("txtCatalogueID");
		var sectionID = core.util.getObjectValueByID("txtSectionID");
		var numView = core.util.getObjectValueByID("txtNumView");
		var numComment = core.util.getObjectValueByID("txtNumComment");
		var status = core.util.getObjectValueByID("txtStatus");
		var comments = core.util.getObjectValueByID("txtcomments");
		var renewedDate = core.util.getObjectValueByID("txtRenewedDate");
		var renewedNum = core.util.getObjectValueByID("txtRenewedNum");
	        
        strRequest = "?isAJ=1&act=" + ACT_ADD +  
            '&ArticleID='+ core.urlencode(articleID)+
			'&Prefix='+ core.urlencode(prefix)+
			'&Title='+ core.urlencode(title)+
			'&FileName='+ core.urlencode(fileName)+
			'&ArticleType='+ core.urlencode(articleType)+
			'&Content='+ core.urlencode(content)+
			'&NotificationType='+ core.urlencode(notificationType)+
			'&Tags='+ core.urlencode(tags)+
			'&CatalogueID='+ core.urlencode(catalogueID)+
			'&SectionID='+ core.urlencode(sectionID)+
			'&NumView='+ core.urlencode(numView)+
			'&NumComment='+ core.urlencode(numComment)+
			'&Status='+ core.urlencode(status)+
			'&comments='+ core.urlencode(comments)+
			'&RenewedDate='+ core.urlencode(renewedDate)+
			'&RenewedNum='+ core.urlencode(renewedNum)		;
        
        var ajax = new Ajax();
        ajax.SendRequestToServerWithCustomMsg(_strPage, strRequest, insertNew_OnCallBack, true, MSG_AJAX_FETCHING_VN);
    }

    function insertNew_OnCallBack(xmlHTTPRequest) {
        core.util.disableControl("btnOK", false);
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
        popDiv.alert('Do you want to delete ' + name + ' ?', SYSTEM_TITLE_ERROR, 2, "_objArticle.delete_OK()", "_objArticle.delete_Cancel()");

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
					core.getObject('txtArticleID').val(ArticleID);
					core.getObject('txtPrefix').val(Prefix);
					core.getObject('txtTitle').val(Title);
					core.getObject('txtFileName').val(FileName);
					core.getObject('txtArticleType').val(ArticleType);
					core.getObject('txtContent').val(Content);
					core.getObject('txtNotificationType').val(NotificationType);
					core.getObject('txtTags').val(Tags);
					core.getObject('txtCatalogueID').val(CatalogueID);
					core.getObject('txtSectionID').val(SectionID);
					core.getObject('txtNumView').val(NumView);
					core.getObject('txtNumComment').val(NumComment);
					core.getObject('txtStatus').val(Status);
					core.getObject('txtcomments').val(comments);
					core.getObject('txtRenewedDate').val(RenewedDate);
					core.getObject('txtRenewedNum').val(RenewedNum);
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
		core.getObject('txtArticleID').val('');
		core.getObject('txtPrefix').val('');
		core.getObject('txtTitle').val('');
		core.getObject('txtFileName').val('');
		core.getObject('txtArticleType').val('');
		core.getObject('txtContent').val('');
		core.getObject('txtNotificationType').val('');
		core.getObject('txtTags').val('');
		core.getObject('txtCatalogueID').val('');
		core.getObject('txtSectionID').val('');
		core.getObject('txtNumView').val('');
		core.getObject('txtNumComment').val('');
		core.getObject('txtStatus').val('');
		core.getObject('txtcomments').val('');
		core.getObject('txtRenewedDate').val('');
		core.getObject('txtRenewedNum').val('');
    }
    //endregion   
	*/