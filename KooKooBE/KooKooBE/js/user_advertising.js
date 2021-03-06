/*
 * This file was automatically generated By Code Smith 
 * Modifications will be overwritten when code smith is run
 *
 * PLEASE DO NOT MAKE MODIFICATIONS TO THIS FILE
 * Date Created 5/6/2012
 *
 */



/// <summary>
/// Implementations of sladvertisings represent a Advertising
///
/// </summary>
var advertising = {
    //region PRESERVE ExtraMethods For Article
    //endregion
    //region Contants	
    ACT_ADD: 10,
    ACT_UPDATE: 11,
    ACT_DELETE: 12,
    ACT_CHANGE_PAGE: 13,
    ACT_SHOW_EDIT: 14,
    ACT_GET: 15,
    ACT_ACTIVE: 16,
    Page: "admin_advertising.php",
	
	showPopupAdd: function(modalID)
	{
		advertising.clearForm();
		core.util.getObjectByClass('ckCreateOther').show();
		
		$('#'+modalID).modal({ backdrop: 'static', keyboard: false });
	},
	
	showPopupEdit: function(advertID, modalID)
	{
		
		core.util.getObjectByID('adddocmode').val(1);
		core.util.getObjectByID('AdvertisingID').val(advertID);
		advertisingInfo = {
			id : advertID,
			act: this.ACT_SHOW_EDIT
		}
		core.request.post(this.Page,advertisingInfo,
            function(respone, info){
				var strRespond = core.util.parserXML(respone);
				if (parseInt(strRespond[1]['rs']) == 1) {
					core.util.getObjectByClass('ckCreateOther').hide();
					core.util.getObjectByClass('popup-title').html('Edit Advertising');
					var advert = $.parseJSON(strRespond[1]['content']);
					advertising.bindingAdForm(advert);
					$('#'+modalID).modal({ backdrop: 'static', keyboard: false });
					 core.ui.hideInfoBar();	
                }
                else{
                    core.ui.showInfoBar(2, strRespond[1]["inf"]);						
                }
            },
            function()
            {
				core.ui.showInfoBar(2, core.constant.MsgProcessError);					
            }
        );
		
	},
	
	bindingAdForm: function(advert)
	{
		var controlID = 'txtAdName';		
		core.util.getObjectByID(controlID).val(advert.AdvertisingName);
		
		controlID = 'cmAdType';		
		core.util.getObjectByID(controlID).val(advert.AdTypeID);

		controlID = 'cmCatType';
		core.util.getObjectByID(controlID).val(advert.ArticleTypeID);
		
		controlID = 'txtContent';		
		core.util.getObjectByID(controlID).html(advert.Content);
		
		controlID = 'txtOrder';		
		core.util.getObjectByID(controlID).val(advert.Order);

		controlID = 'txtPreferLink';		
		core.util.getObjectByID(controlID).val(advert.PreferLink);

		controlID = 'txtStartDate';		
		core.util.getObjectByID(controlID).val(advert.StartDate);
		
		controlID = 'txtEndDate';		
		core.util.getObjectByID(controlID).val(advert.EndDate);
		
		controlID = 'txtImageLink';		
		core.util.getObjectByID(controlID).val(advert.ImageLink);
		
		controlID = 'txtPartner';		
		core.util.getObjectByID(controlID).html(advert.PartnerID);
	},
	
	getAdvertisingInfo: function(submitID) {
		
        core.util.disableControl(submitID, true);
   
		var controlID = 'txtAdName';		
		var adName = core.util.getObjectValueByID(controlID);
		
		controlID = 'cmAdType';		
		var adType = core.util.getObjectValueByID(controlID);

		controlID = 'cmCatType';
		var catType = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtContent';		
		var content = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtOrder';		
		var order = core.util.getObjectValueByID(controlID);

		controlID = 'txtStartDate';		
		var startDate = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtEndDate';		
		var endDate = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtImageLink';		
		var imageLink = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtPreferLink';		
		var preferLink = core.util.getObjectValueByID(controlID);
		
		controlID = 'txtPartner';		
		var partner = core.util.getObjectValueByID(controlID);
		
		var adInfo = 
		{
			 AdvertisingName: adName,
			 AdTypeID: adType,
			 ArticleTypeID: catType,
			 Content: content,
			 Order: order,
			 StartDate: startDate,
			 EndDate: endDate,
			 ImageLink: imageLink,
			 PreferLink: preferLink,
			 PartnerID: partner,
			 AdvertisingID: core.util.getObjectValueByID('AdvertisingID'),
			 Mode: core.util.getObjectValueByID('adddocmode')
		};
		return adInfo;
    },
	
	clearForm: function()
	{
		var controlID = 'txtAdName';		
		core.util.clearValue(controlID);
		
		controlID = 'cmAdType';		
		core.util.deSelectOption(controlID);		
				
		controlID = 'txtOrder';		
		core.util.clearValue(controlID);

		controlID = 'txtStartDate';		
		core.util.clearValue(controlID);
		
		controlID = 'txtEndDate';		
		core.util.clearValue(controlID);
		
		controlID = 'txtImageLink';		
		core.util.clearValue(controlID);
		
		controlID = 'txtPreferLink';		
		core.util.clearValue(controlID);
		
		controlID = 'txtPartner';		
		core.util.clearValue(controlID);
		
		controlID = 'txtContent';		
		core.util.clearValue(controlID);
		
		core.util.getObjectByID('adddocmode').val(0);
		core.util.getObjectByID('AdvertisingID').val('');
	},
	
    addAdverting: function() { 
		var submitID = "btnSave"
        var advertisingInfo = this.getAdvertisingInfo(submitID);
		
		if(core.util.isNull(advertisingInfo))
		{
			return false;
		}
		if(advertisingInfo.Mode=='1' || advertisingInfo.Mode==1)
		{
			advertisingInfo.act = this.ACT_UPDATE;
		}
		else
		{
			advertisingInfo.act = this.ACT_ADD;
		}
		
		core.request.post(this.Page,advertisingInfo,
            function(respone, info){
				var strRespond = core.util.parserXML(respone);
				if (parseInt(strRespond[1]['rs']) == 1) {
					core.ui.showInfoBar(1, strRespond[1]["inf"]);	
					advertising.clearForm();
					core.util.disableControl(submitID, false);
					core.util.reload();
                }
                else{
                    core.ui.showInfoBar(2, strRespond[1]["inf"]);	
					core.util.disableControl(submitID, false);
                }
            },
            function()
            {
				core.ui.showInfoBar(2, core.constant.MsgProcessError);	
				core.util.disableControl(submitID, false);
            }
        );
    },

    deleteRetailer: function(name, retailerID, status) {
        //curRow = currentRowId;
        me = this;
        var adInfo =
		{
		    id: retailerID,
		    isactivate: status
		};

		adInfo.act = this.ACT_ACTIVE;

		core.request.post('' + this.Page, adInfo,
            function(respone, info) {
                var strRespond = core.util.parserXML(respone);
                if (parseInt(strRespond[1]['rs']) == 1) {
                    core.ui.showInfoBar(1, strRespond[1]["inf"]);
                    core.util.reload();
                }
                else {
                    core.ui.showInfoBar(2, strRespond[1]["inf"]);
                }
            },
            function() {
                core.ui.showInfoBar(2, core.constant.MsgProcessError);
            }
        );

    }

}

