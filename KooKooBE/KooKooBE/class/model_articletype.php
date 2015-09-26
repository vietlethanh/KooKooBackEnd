<?php
/*
 * This file was automatically generated By Code Smith 
 * Modifications will be overwritten when code smith is run
 *
 * PLEASE DO NOT MAKE MODIFICATIONS TO THIS FILE
 * Date Created 5/6/2012
 *
 */

/* <summary>
 * Implementations of slarticletypes represent a ArticleType
 * </summary>
 */
class Model_ArticleType
{		   
	#region PRESERVE ExtraMethods For ArticleType
	#endregion
    #region Contants	
    const ACT_ADD							= 100;
    const ACT_UPDATE						= 101;
    const ACT_DELETE						= 102;
    const ACT_CHANGE_PAGE					= 103;
    const ACT_SHOW_EDIT                     = 104;
	const ACT_GET                           = 105;
	const ACT_GET_ALL                       = 106;
	
	
    const NUM_PER_PAGE                      = 15;
    
    const TBL_SL_ARTICLE_TYPE			            = 'sl_article_type';

	const SQL_INSERT_SL_ARTICLE_TYPE		= 'INSERT INTO `{0}`
		(
			ArticleTypeID,
			ArticleTypeName,
			CreatedBy,
			CreatedDate,
			ModifiedBy,
			ModifiedDate,
			DeletedBy,
			DeletedDate,
			IsDeleted,
			`Status`,
			`Level`,
			ParentID,
			Thumbnail,
			Logo
        )
        VALUES (
		\'{1}\', \'{2}\', \'{3}\', \'{4}\', \'{5}\', \'{6}\', \'{7}\', \'{8}\', \'{9}\', \'{10}\', \'{11}\', \'{12}\',\'{13}\', \'{14}\'
        );';
        
	const SQL_UPDATE_SL_ARTICLE_TYPE		= 'UPDATE `{0}`
		SET  
			`ArticleTypeID` = \'{1}\',
			`ArticleTypeName` = \'{2}\',
			`CreatedBy` = \'{3}\',
			`CreatedDate` = \'{4}\',
			`ModifiedBy` = \'{5}\',
			`ModifiedDate` = \'{6}\',
			`DeletedBy` = \'{7}\',
			`DeletedDate` = \'{8}\',
			`IsDeleted` = \'{9}\',
			`Status` = \'{10}\',
			`Level` = \'{11}\',
			`ParentID` = \'{12}\',
			`Thumbnail` = \'{13}\',
			`Logo` = \'{14}\'
		WHERE `ArticleTypeID` = \'{1}\'  ';
		   

    const SQL_CREATE_TABLE_SL_ARTICLE_TYPE		= 'CREATE TABLE `{0}` (

			`ArticleTypeID` varchar(20),
			`ArticleTypeName` varchar(50),
			`CreatedBy` varchar(20),
			`CreatedDate` ,
			`ModifiedBy` varchar(20),
			`ModifiedDate` ,
			`DeletedBy` varchar(20),
			`DeletedDate` ,
			`IsDeleted` ,
			`Status` varchar(20),
			`Level` ,
			`ParentID` varchar(20),
			`Thumbnail` varchar(250),
			`Logo` varchar(240),
			PRIMARY KEY(ArticleTypeID)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
	
    #endregion   
    
    #region Variables
	var $_objConnection;
	#end region
	
	#region Contructors
	/**
	*  Phuong th?c kh?i t?o d?i tu?ng faq d?ng th?i t?o connection d?n db
	*
	* @param object $objConnection ??i tu?ng k?t n?i d?n db
			
	* @return void 
	*
	*/
	public function  Model_ArticleType($objConnection)
	{
		$this->_objConnection = $objConnection;
		
	}
    #region
    
    #region Public Functions
    
    public function insert( $articletypename,$createdby,$createddate,$modifiedby,$modifieddate,$deletedby,$deleteddate,$isdeleted,$status,$level,$parentid)
	{
	   	
	   	$strTableName = self::TBL_SL_ARTICLE_TYPE;
		$intID = global_common::getMaxValueofField($this->_objConnection,global_mapping::ArticleTypeID, $strTableName) + 1;
	
		$strSQL = global_common::prepareQuery(self::SQL_INSERT_SL_ARTICLE_TYPE,
				array(self::TBL_SL_ARTICLE_TYPE,
                $intID,
                global_common::escape_mysql_string($articletypename),
                global_common::escape_mysql_string($createdby),
                global_common::escape_mysql_string($createddate),
                global_common::escape_mysql_string($modifiedby),
                global_common::escape_mysql_string($modifieddate),
                global_common::escape_mysql_string($deletedby),
                global_common::escape_mysql_string($deleteddate),
                global_common::escape_mysql_string($isdeleted),
                global_common::escape_mysql_string($status),
                global_common::escape_mysql_string($level),
                global_common::escape_mysql_string($parentid),
                null,
                null));
		//echo $strSQL;
		if (!global_common::ExecutequeryWithCheckExistedTable($strSQL,self::SQL_CREATE_TABLE_SL_ARTICLE_TYPE,$this->_objConnection,$strTableName))
		{
			//echo $strSQL;
			global_common::writeLog('Error add sl_article_type:'.$strSQL,1);
			return false;
		}	
		return $intID;
		
	}
    
    public function update($articletypeid,$articletypename,$createdby,$createddate,$modifiedby,$modifieddate,$deletedby,$deleteddate,$isdeleted,$status,$level,$parentid)
	{
		$strTableName = self::TBL_SL_ARTICLE_TYPE;
		$strSQL = global_common::prepareQuery(self::SQL_UPDATE_SL_ARTICLE_TYPE,
				array($strTableName,global_common::escape_mysql_string($articletypeid),global_common::escape_mysql_string($articletypename),global_common::escape_mysql_string($createdby),global_common::escape_mysql_string($createddate),global_common::escape_mysql_string($modifiedby),global_common::escape_mysql_string($modifieddate),global_common::escape_mysql_string($deletedby),global_common::escape_mysql_string($deleteddate),global_common::escape_mysql_string($isdeleted),global_common::escape_mysql_string($status),global_common::escape_mysql_string($level),global_common::escape_mysql_string($parentid) ));
		
		if (!global_common::ExecutequeryWithCheckExistedTable($strSQL,self::SQL_CREATE_TABLE_SL_ARTICLE_TYPE,$this->_objConnection,$strTableName))
		{
			//echo $strSQL;
			global_common::writeLog('Error add sl_article_type:'.$strSQL,1);
			return false;
		}	
		return $intNewID;		
	}
    
    public function getArticleTypeByID($objID,$selectField='*') 
	{		
		$cache = Application::getVar('getArticleTypeByID'.$objID);
		if($cache)
		{
			//global_common::writeLog('get cache',1,$_mainFrame->pPage);
			return $cache;
		}
		
		$selectField = $selectField? $selectField : '*';
		$strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE, 
				array($selectField, self::TBL_SL_ARTICLE_TYPE ,							
					'WHERE '.global_mapping::ArticleTypeID.' = \''.$objID.'\' '));
		//return $strSQL;
		$arrResult =$this->_objConnection->selectCommand($strSQL);		
		if(!$arrResult)
		{
			global_common::writeLog('get sl_article_type ByID:'.$strSQL,1,$_mainFrame->pPage);
			return null;
		}
		Application::setVar('getArticleTypeByID'.$objID,$arrResult[0]);
		//print_r($arrResult);
		return $arrResult[0];
	}
    
    public function getArticleTypeByName($catName,$selectField='*') 
	{		
	
		
		$selectField = $selectField? $selectField : '*';
		$strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE, 
				array($selectField, self::TBL_SL_ARTICLE_TYPE ,							
					'WHERE '.global_mapping::ArticleTypeName.' = \''. $catName .'\' '));
		//echo $strSQL;
		$arrResult =$this->_objConnection->selectCommand($strSQL);		
		if(!$arrResult)
		{
			global_common::writeLog('get sl_article_type getArticleTypeByName:'.$strSQL,1,$_mainFrame->pPage);
			return null;
		}
	
		return $arrResult[0];
	}
    
    public function getAllArticleType($intPage = 0,$selectField='*',$whereClause='',$orderBy='') 
	{		
		$selectField = $selectField? $selectField : '*';
        if($whereClause)
		{
			$whereClause = ' WHERE '.$whereClause;
		}
		
		if($orderBy)
		{
			$orderBy = ' ORDER BY Level,'.$orderBy.'';
		}
		else
		{
			$orderBy = ' ORDER BY Level';
		}
        if($intPage>0)
        {
		    $strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE, 
				array($selectField, Model_ArticleType::TBL_SL_ARTICLE_TYPE ,							
					$whereClause.$orderBy .' limit '.(($intPage-1)* self::NUM_PER_PAGE).','.self::NUM_PER_PAGE));
        }
        else
        {
            $strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE, 
				array($selectField, Model_ArticleType::TBL_SL_ARTICLE_TYPE ,							
					$whereClause.$orderBy ));
        }
		//return $strSQL;
		$arrResult =$this->_objConnection->selectCommand($strSQL);		
		if(!$arrResult)
		{
			global_common::writeLog('get All sl_article_type:'.$strSQL,1,$_mainFrame->pPage);
			return null;
		}
		//print_r($arrResult);
		return $arrResult;
	}
    
    public function getListArticleType($intPage,$orderBy='ArticleTypeID', $whereClause)
	{		
		$selectField = $selectField? $selectField : '*';
        if($whereClause)
        {
            $whereClause='WHERE'+ $whereClause;						
        }
        if($orderBy)
        {
            $orderBy='ORDER BY'+ $orderBy;						
        }
		$strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE,array('*',
					self::TBL_SL_ARTICLE_TYPE,$orderBy.' '.$whereClause.' limit '.(($intPage-1)* self::NUM_PER_PAGE).','.self::NUM_PER_PAGE));
		//echo 'sql:'.$strSQL;	
		$arrResult = $this->_objConnection->selectCommand($strSQL);
		//print_r($arrResult);
		$strHTML = '<table class="tbl-list">
                    <thead>
						<td>ArticleTypeID</td>
						<td>ArticleTypeName</td>
						<td>CreatedBy</td>
						<td>CreatedDate</td>
						<td>ModifiedBy</td>
						<td>ModifiedDate</td>
						<td>DeletedBy</td>
						<td>DeletedDate</td>
						<td>IsDeleted</td>
						<td>Status</td>
						<td>Level</td>
						<td>ParentID</td>
                    </thead>
                    <tbody>';
		$icount = count($arrmenu);
		for($i=0;$i<$icount;$i++)
		{
			$strHTML.='<tr class="'.($i%2==0?'even':'odd').'">
						<td>'.$arrResult[$i]['ArticleTypeID'].'</td>
						<td>'.$arrResult[$i]['ArticleTypeName'].'</td>
						<td>'.$arrResult[$i]['CreatedBy'].'</td>
						<td>'.$arrResult[$i]['CreatedDate'].'</td>
						<td>'.$arrResult[$i]['ModifiedBy'].'</td>
						<td>'.$arrResult[$i]['ModifiedDate'].'</td>
						<td>'.$arrResult[$i]['DeletedBy'].'</td>
						<td>'.$arrResult[$i]['DeletedDate'].'</td>
						<td><input type="checkbox" onclick="_objArticleType.showHide(\''.$arrResult[$i]['ArticleTypeID'].'\',\''.$arrResult[$i]['name'].'\',this)" '.($arrResult[$i]['IsDeleted']?'':'checked=checked').' /></td>
						<td>'.$arrResult[$i]['Status'].'</td>
						<td>'.$arrResult[$i]['Level'].'</td>
						<td class="lastCell">'.$arrResult[$i]['ParentID'].'</td>
					  </tr>';
		}
		$strHTML.='</tbody></table>';
		
		$strHTML .= "<div>".global_common::getPagingHTMLByNum($intPage,self::NUM_PER_PAGE,global_common::getTotalRecord(self::TBL_SL_ARTICLE_TYPE,$this->_objConnection),
				"_objMenu.changePage")."</div>";
		return $strHTML;
	}
    
	function displayAllCategory()
	{
		$strSQL .= global_common::prepareQuery(global_common::SQL_SELECT_FREE,array('*',
					self::TBL_SL_ARTICLE_TYPE,$orderBy.' '.$whereClause.' limit '.(($intPage-1)* self::NUM_PER_PAGE).','.self::NUM_PER_PAGE));
		//echo 'sql:'.$strSQL;	
		$arrResult = $this->_objConnection->selectCommand($strSQL);
		//print_r($arrResult);
	}
    #endregion   
}
?>
