<?php

/*  TO DO in columns Model

 * searchrules': {
  'required': true,
  'number': true,
  'minValue': 10
  }
 * key:true
 * cellattr: function(rowId, value, rowObject, colModel, arrData) {
  return ' colspan=2'},formatter: function(value, options, rData) {
  return rData[0] + ' ' + value + ', ' + rData[2];
  }
 * cellattr: function(rowId, value, rowObject, colModel, arrData) {
  return ' style=\"display:none\"'
  }

 * onContextMenu: function(event \/*, menu*\/ ) {
  var rowId = $(event.target).closest("tr.jqgrow").attr("id");
  //grid.setSelection(rowId);
  // disable menu for rows with even rowids
  $('#del').attr("disabled", Number(rowId) % 2 === 0);
  if (Number(rowId) % 2 === 0) {
  $('#del').attr("disabled", "disabled").addClass('ui-state-disabled');
  } else {
  $('#del').removeAttr("disabled").removeClass('ui-state-disabled');
  }
  return true;
  }
 *   $("#del").attr("disabled","disabled").addClass("ui-state-disabled");
 *  subGrid: true,
  subGridRowExpanded: function(subgrid_id, row_id) {
  var html = '<span>Some <b>HTML</b> </spanb>;
  $("#" + subgrid_id).append(html);
  },
 *  formater  check box when edit grid 
 * editrules:{required:true,integer:true},
 * editurl must be 'clientArray'
 * function fol(value, colname) {
  var id = jQuery("#list").jqGrid('getGridParam','selrow');
  var fol = jQuery("#list").jqGrid('getRowData',id);
  if (value > fol.max )
  return [false,"Min value can't be < tha Max value"];
  else
  return [true,""];
  }
 *  afterEditRow:function(rowid, rowdata, rowelem){
  alert("edit");
  },
  inlineData: {
  myParam: function () {
  console.log("inlineData is calling!!!");

  return false;
  }
  },
  editData: {
  TransactionId: function () {

  console.log("dasda");

  }
  },
 * autowidth: true, 
 * isNaN
 */

//namespace TravelRobotic\Lib\Grid;

//use TravelRobotic\Core\MainClassController;

class jqGridClass 
{

    private $_url;
    private $_ID;
    private $_pagerID;
    private $_gridWidth = 'auto';
    private $_gridheight = 'auto';
    private $_rowNum;
    private $_rowList;
    private $_sortOrder = '';
    private $_sortName = '';
    private $_gridTitle = 'New Grid';
    private $_colNames;
    private $_colWidth = 50;
    private $_colModel;
    private $_filterToolbar = '';
    private $_navGrid = '';
    private $_postData = '';
    private $_pageNumber = '1';
    private $_loadComplete = '';
    private $_onDblClickRow = '';
    private $_gridFooter = '';
    private $_rowMessageShow = '';
    private $_cmTamplet = '';
    private $_direction = '';
    private $_multiLanguage = NULL;
    private $_colNameArray = '';
    private $_colNamesMultiLanguage = '';
    private $_numOfColumns = '';
    private $_dataGridFooter = '';
    private $_groupHeader = '';
    private $_topperToolbar = '';
    private $_pdfLogo = '';
    private $_sortable = 'true';
    private $_frozenColumns = '';
    private $_frozenResizeColumns = '';
    private $_callFrozenFunction = '';
    private $_gridComplete = '';
    private $_errorArray = array();
    private $_indexErrorArray = 0;
    private $_arrayMultiLanguage = '';
    private $_ChooseColumns = '';
    private $_shrinkToFit = 'false';
    private $_exportExcelLogo = '';
    private $_exportCsvLogo = '';
    private $_EditLogo = '';
    private $_multiSelect = '';
    private $_DeleteLogo = '';
    private $_AddLogo = '';
    private $_menuRightClick = '';
    private $_addLogoFunction = '';
    private $_editLogoFunction = '';
    private $_deleteLogoFunction = '';
    private $_rightClickAction = '';
    private $_editInLine = '';
    private $_lastSelection = '';
    private $_editUrl = '';
    private $_subGrid = '';
    private $_optionFilter = '';
    private $_customSearchNavBar = '';
    private $_cellEdit = '';
    private $_functionValiden = '';
    private $_errorValidenEditArray = array();
    private $_indexErrorValidenEditArray = 0;
    private $_checkboxEditFunction = '';
    private $_showRowNumber = 'false';
    private $_widthRowNumber = 35;
    private $_exportExcel = '';
    private $_responsive = '';
    private $_onSelectRow='';

    /**
     * @Desc construct create unique id for grid and pager.
     */
    function __construct()
    {
        $uniqeid = uniqid();
        $this->_setGridId('list' . $uniqeid);
        $this->_setPagerId('pager' . $uniqeid);
    }

    /**
     * @Desc Create javaScript code for the grid by set collection of paramters.
     * @access private
     * @param NULL
     * @return String
     */
    private function _grid()
    {

        return(' 
    <script>
         ' . $this->_lastSelection . '
     $(function() {
         ' . $this->_frozenResizeColumns . '           
         ' . $this->_multiLanguage . '
         ' . $this->_colNameArray . '
         $("#' . $this->_ID . '").jqGrid({
              ' . $this->_subGrid . '
              datatype: "json",
              ' . $this->_cellEdit . '
              url: "' . $this->_url . '",
              editurl: "' . $this->_editUrl . '",  
              autowidth: true,           
              mtype: "POST",
              ' . $this->_multiSelect . '               
              emptyrecords: "Nothing to display",
              ' . $this->_direction . '
              colNames: ' . $this->_getColNames($this->_colNames) . '' . $this->_colNamesMultiLanguage . ',       
              colModel: [' . $this->_colModel() . '],
              pager: "#' . $this->_pagerID . '",
              rownumbers: ' . $this->_showRowNumber . ',
              rownumWidth: ' . $this->_widthRowNumber . ',    
              rowNum:' . $this->_rowNum . ',
              rowList:' . $this->_getRowList($this->_rowList) . ',
              ' . $this->_topperToolbar . '
              sortname: "' . $this->_sortName . '",
              shrinkToFit: ' . $this->_shrinkToFit . ',
              sortorder: "' . $this->_sortOrder . '",
              width: "' . $this->_gridWidth . '",    
              height: "' . $this->_gridheight . '",
              viewrecords: true,
              page:' . $this->_pageNumber . ',
              gridview: true,
              sortable:' . $this->_sortable . ',
              autoencode: true,
              loadError:function(data){
                $(".screenDisable").hide();
                $("#headerDisable").hide();
              },
              beforeRequest:function(data){
              $(".screenDisable").show();
              $("#headerDisable").show();
              },
              resizeStop: function () {
             
},
              "userDataOnFooter": true,
              ' . $this->_gridFooter . '
              ' . $this->_cmTamplet . '
              caption: "' . $this->_gridTitle . '",
              ' . $this->_gridComplete . '
              loadComplete: function(data){ 
                  $(".screenDisable").hide();
                  $("#headerDisable").hide();
                  ' . $this->_callFrozenFunction . '
                  ' . $this->_loadComplete . '
                  ' . $this->_rightClickAction . '                       
                                      }, 
              "ondblClickRow": function(rowid, selected,gridRow) {
                  ' . $this->_editInLine . '
                  ' . $this->_onDblClickRow . ' 
                                      }, 
              "onSelectRow": function(rowid, selected,gridRow) {
             ' . $this->_onSelectRow . ' 
              },
              ' . $this->_postData . '})' . $this->_navGrid . ';
              ' . $this->_filterToolbar . '
              ' . $this->_optionFilter . '    
              ' . $this->_dataGridFooter . '
              ' . $this->_groupHeader . '
              ' . $this->_rowMessageShow . '
              ' . $this->_AddLogo . '  
              ' . $this->_EditLogo . '   
              ' . $this->_DeleteLogo . '     
              ' . $this->_pdfLogo . '    
              ' . $this->_exportExcelLogo . '
              ' . $this->_exportCsvLogo . '
              ' . $this->_frozenColumns . '
              ' . $this->_ChooseColumns . ' 
              ' . $this->_customSearchNavBar . '          
                  });
              ' . $this->_functionValiden . '
              ' . $this->_checkboxEditFunction . '     
              ' . $this->_exportExcel . '    
              ' . $this->_responsive . '
    </script>
    ' . $this->_menuRightClick . '
    ');
    }

    /**
     * @Desc Build your grid after finish your initlaize 'Required'.
     * @access public
     * @param NULL
     * @return Array
     */
    public function build()
    {
        $this->_responsiveFun();
        $url = $this->_url;
        $id = $this->_ID;
        $pagerid = $this->_pagerID;
        $rownum = $this->_rowNum;
        $colnames = $this->_colNames;
        $colwidth = $this->_colWidth;
        $multiLanguage = $this->_arrayMultiLanguage;
        if ($rownum && !$this->_rowList) {
            $this->_rowList = array($rownum, 10, 20, 30);
            sort($this->_rowList);
        }
        if (!$this->_rowList) {
            $this->_rowList = array(10, 20, 30);
        }
        if (!$rownum) {
            $this->_rowNum = $this->_rowList[0];
        }
        $rowlist = $this->_rowList;
        if (!$url)
            $this->_errorArray[$this->_indexErrorArray++] = "Invalid URL";
        if (!$id)
            $this->_errorArray[$this->_indexErrorArray++] = "Invalid Grid ID";
        if (!$pagerid)
            $this->_errorArray[$this->_indexErrorArray++] = "Invalid Pager ID";
        if (!is_array($rowlist))
            $this->_errorArray[$this->_indexErrorArray++] = "RowList Must Be Array";

        if (!(is_array($colnames) || is_array($multiLanguage)))
            $this->_errorArray[$this->_indexErrorArray++] = "Must Use valid Array to Columns Model Or For Multi Language";
        if (!$this->_checkColWidth($colwidth))
            $this->_errorArray[$this->_indexErrorArray++] = "Columns Width must be int or Array Have Same Count Of Columns Names Array";
        if (!$this->_checkColModel())
            $this->_errorArray[$this->_indexErrorArray++] = "Columns Model must be Array Have Same Count Of Columns Names Array";
        if (!$this->_errorArray) {
            return $this->_grid();
        } else {
            return print_r($this->_errorArray);
        }
    }

    /**
     * @Desc Take array of row list and convert it to the right string to use it in the grid.
     * @access private
     * @param Array $rowlist
     * @return String
     */
    private function _getRowList($rowlist)
    {
        $rowlistarray = '[';
        for ($c = 0; $c < count($rowlist); $c++) {
            if ($c) {
                $rowlistarray.=',' . $rowlist[$c];
            } else {
                $rowlistarray.=$rowlist[$c];
            }
        }
        $rowlistarray.=']';

        return $rowlistarray;
    }

    /**
     * @Desc Take array of columns name and convert it to the right string to use it in the grid.
     * @access private
     * @param Array $colNames
     * @return String
     */
    private function _getColNames($colNames)
    {
        $colNamesarray = '';
        if (is_array($colNames)) {
            $colNamesarray = '[';
            for ($c = 0; $c < count($colNames); $c++) {
                if ($c) {
                    $colNamesarray.=', "' . $colNames[$c] . '"';
                } else {
                    $colNamesarray.='"' . $colNames[$c] . '"';
                }
            }

            $colNamesarray .= ']';
        }
        return $colNamesarray;
    }

    public function setEditUrl($url)
    {
        $this->_editUrl = $url;
        return $this;
    }

    /**
     * @Desc Order grid by ASC.
     * @access public
     * @param String $colName
     * @return Object $this
     */
    public function setOrderByAsc($colName)
    {
        if (!is_string($colName))
            $this->_errorArray[$this->_indexErrorArray++] = "SetOrder Function Must take String For Column ID Name";
        $this->_sortOrder = 'asc';
        $this->_sortName = $colName;

        return $this;
    }

    /**
     * @Desc order grid by DESC.
     * @access public
     * @param String $colName  
     * @return Object $this
     */
    public function setOrderByDesc($colName)
    {
        if (!is_string($colName))
            $this->_errorArray[$this->_indexErrorArray++] = "SetOrder Function Must take String For Column ID Name";
        $this->_sortOrder = 'desc';
        $this->_sortName = $colName;

        return $this;
    }

    /**
     * @Desc Take columns width and check if it int, make it default width for all columns in the grid,
     *  if was array make another check if it equal number of columns or not.
     * @access private
     * @param Array $colwidth || Integer $colwidth
     * @return Boolean
     */
    private function _checkColWidth($colwidth)
    {

        if (is_int($colwidth))
            return TRUE;
        elseif (is_array($colwidth) && count($colwidth) == $this->_numOfColumns)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * @Desc Take array of columns Model and convert it to the right string to use it in the grid.
     * @access private
     * @param NULL
     * @return String $ColModel
     */
    private function _colModel()
    {
        $colWidth = $this->_colWidth;
        $colModel = '';
        if (is_array($colWidth)) {
            $i = 0;
            foreach ($this->_colModel as $key => $value) {
                $colModel.='{name:"' . $key . '" ,width :' . $colWidth[$i] . ' ,' . $value . '},';
                $i++;
            }
        } else {
            foreach ($this->_colModel as $key => $value) {
                $colModel.='{name:"' . $key . '" ,width :' . $colWidth . ' ,' . $value . '},';
            }
        }
        return $colModel;
    }

    /**
     * @Desc Take columns Model  of columns, check if it equal number of columns or not and is array or not.
     * @access private
     * @param NULL
     * @return Boolean
     */
    private function _checkColModel()
    {
        if (count($this->_colModel) == $this->_numOfColumns && is_array($this->_colModel))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * @Desc Set url action that fill the grid 'Required'.
     * @access public
     * @example http://domain.com/index/fullgrid
     * @param String $url url for the grid
     * @return Object $this
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * @Desc Set grid id.
     * @access private
     * @param  Integer $id
     * @return Object $this
     */
    private function _setGridId($id)
    {
        $this->_ID = $id;
        return $this;
    }

    /**
     * @Desc Set grid pager id.
     * @access private
     * @param  Integer $pagerid
     * @return Object $this
     */
    private function _setPagerId($pagerid)
    {
        $this->_pagerID = $pagerid;
        return $this;
    }

    /**
     * @Desc Assign width for the grid 'Optional'.
     * @access public
     * @Default 'auto' 
     * @param  int $gridwidth
     * @return Object $this
     */
    public function setGridWidth($gridwidth)
    {
        $this->_gridWidth = $gridwidth;
        return $this;
    }

    /**
     * @Desc Assign height for the grid 'Optional'.
     * @access public
     * @Default 'auto'
     * @param  Integer $gridheight 
     * @return Object $this
     */
    public function setGridHeight($gridheight)
    {
        $this->_gridheight = $gridheight;
        return $this;
    }

    /**
     * @Desc Assign row numbers when initlaize grid 'Optional'.
     * @access public
     * @Default First Element in RowList array
     * @param  Integer $num
     * @return Object $this
     */
    public function setRowNum($num)
    {
        if (!is_int($num))
            $this->_errorArray[$this->_indexErrorArray++] = "setRowNum Function Must take int For number Of Row in Grid Page";
        $this->_rowNum = $num;
        return $this;
    }

    /**
     * @Desc assign list of row number which can display 'Optional'.
     * @access public
     * @Default Array of[10,20,30] 
     * @param  Array $list
     * @return Object $this
     */
    public function setRowList($list)
    {
        $this->_rowList = $list;
        return $this;
    }

    /**
     * @Desc Assign header title for grid 'Optional'.
     * @Default 'New Grid' 
     * @access public
     * @param  String $title
     * @return Object $this
     */
    public function setGridTitle($title)
    {
        if (!is_string($title))
            $this->_errorArray[$this->_indexErrorArray++] = "setGridTitle Function Must take String For Grid Title";
        $this->_gridTitle = $title;
        return $this;
    }

    /**
     * @Desc Assign coulumns names in grid 'Required'.
     * @access public
     * @param  Array $colNames
     * @example array("ID","Username","Email")
     * @return Object $this
     */
    public function setColumnNames($colNames)
    {
        $this->_colNames = $colNames;
        $this->_numOfColumns = count($colNames);
        return $this;
    }

    /**
     * @Desc Assign colunms width  in grid 'Optional'.
     * @access public
     * @default Integer value (50)
     * @param  Integer or Array
     * @return Object $this
     */
    public function setColunmWidth($colWidth)
    {
        $this->_colWidth = $colWidth;
        return $this;
    }

    /**
     * @Desc Assign model for the columns in grid 'Required'.
     * @access public
     * @param  Array $colModel
     * @example array("Username"=>"align: 'center', sortable: true, search: false, sorttype: 'int',frozen:true","Email"=>....)
     * @return Object $this
     */
    public function setColumnModel($colModel)
    {
        $this->_colModel = $colModel;
        return $this;
    }

    /**
     * @Desc This Function allow You to use filter toolbar search in your grid 'Optional'.
     * @Usage Decalre id grid before use it  and set search:true in COLModel Pro or search:false if don't need it.
     * @access public
     * @return Object $this
     */
    public function setFilterToolbar()
    {
        $this->_filterToolbar = ' jQuery("#' . $this->_ID . '").jqGrid(\'filterToolbar\',
            {stringResult: true, searchOnEnter: false, defaultSearch: \'cn\', searchOperators: true});';
        return $this;
    }

    /**
     * @Desc This Function allow You to use navGrid toolbar which contain buttons [view selected row, edit, print, ...] 'Optional'.
     * @Require Decalre pagerID before use it  
     * @access public
     * @return Object $this
     */
    public function setNavGrid($edit = 'false', $add = 'false', $del = 'false', $search = 'true', $refresh = 'true', $view = 'false')
    {
        $this->_navGrid = '.navGrid("#' . $this->_pagerID . '", {
        "edit": ' . $edit . ',
        "add": ' . $add . ',
        "del": ' . $del . ',
        "search": ' . $search . ',
        "refresh": ' . $refresh . ',
        "view": ' . $view . ',
        "excel": true,
        "pdf": true,
        "csv": true,
        "columns": false,
        "cloneToTop": true
    }, {
        "drag": true,
        "resize": true,
        "closeOnEscape": true,
        "dataheight": 150,
        "errorTextFormat": function(r) {
            return r.responseText;
        }
    }, {
        "drag": true,
        "resize": true,
        "closeOnEscape": true,
        "dataheight": 150,
        "errorTextFormat": function(r) {
            return r.responseText;
        }
    }, {
        "errorTextFormat": function(r) {
            return r.responseText;
        }
    }, {
        "drag": true,
        "closeAfterSearch": true,
        "multipleSearch": false,
        "multipleGroup": false,
        "showQuery": true,
    }, {
        "drag": true,
        "resize": true,
        "closeOnEscape": true,
        "dataheight": 150
    })';
        return $this;
    }

    /**
     * @Desc Add data to posted data with grid filling.
     * @example setPostData(array('key' => '$("#fieldId").val()'))
     * @access public
     * @param Array $postdata 
     * @return Object $this
     */
    public function setPostData($postdata)
    {
        if (!is_array($postdata))
            $this->_errorArray[$this->_indexErrorArray++] = "setPostData Function Must take Array For index and value to Post Data";
        $this->_postData = 'postData: {';
        foreach ($postdata as $k => $post) {
            $this->_postData .= $k . ":" . $post . ",";
        }
        $this->_postData .='},';
        return $this;
    }

    /**
     * @Desc Set page wanted when load the grid 'Optional'.
     * @access public
     * @default 1
     * @example setPage(2);
     * @param Integer $pageNumber
     * @return Object $this
     */
    public function setPage($pageNumber)
    {
        if (!is_int($pageNumber))
            $this->_errorArray[$this->_indexErrorArray++] = "setPage Function Must take Int for Intilaize grid Page";
        $this->_pageNumber = $pageNumber;
        return $this;
    }

    /**
     * @Desc Set loadComplete grid event  'Optional'.
     * @access public
     * @example setLoadComplete("functionName");
     * @param String $loadCompleteFunName
     * @return Object $this
     */
    public function setLoadComplete($loadCompleteFunName)
    {
        $this->_loadComplete = $loadCompleteFunName;
        return $this;
    }

    /**
     * @Desc Set gridComplete grid event 'Optional'.
     * @access public
     * @example setGridComplete("functionName");
     * @param String $gridCompleteFunName
     * @return Object $this
     */
    public function setGridComplete($gridCompleteFunName)
    {
        $this->_gridComplete = 'gridComplete: function(){  ' . $gridCompleteFunName . '},';
        return $this;
    }

    /**
     * @Desc Set OnDblClickRow grid event 'Optional'.
     * @access public
     * @example setOnDblClickRow(" $(this).trigger("reloadGrid") ;");
     * @param String $onDblClickFunName
     * @return Object $this
     */
    public function setOnDblClickRow($onDblClickFunName)
    {
        $this->_onDblClickRow = $onDblClickFunName;
        return $this;
    }
        public function setOnSelectRow($onRowClickFunName)
    {
        $this->_onSelectRow = $onRowClickFunName;
        return $this;
    }

    /**
     * @Desc Set multi Language to columns header in the grid 'Optional'.
     * @access public
     * @example setMultiLanguage(array('col_en'=>array('col1','col2','col3'),'col_ru'=>array('Инв','Инв','Инв')),"en")
     * @param Array $languageArray array of arrays, String $valueOfControll
     * @note use selColName()  and setMultiLanguage() at same time
     * @return Object $this
     */
    public function setMultiLanguage($languageArray, $valueOfControll)
    {
        $this->_arrayMultiLanguage = $languageArray;
        $this->_colNameArray = " colNames = {";
        foreach ($languageArray as $k => $val) {
            $this->_numOfColumns = count($val);
            $this->_multiLanguage.='' . $k . '=' . $this->_getColNames($val) . ',';
            $subLast2chr = substr($k, -2);
            $this->_colNameArray.=$subLast2chr . ':' . $k . ',';
        }
        $this->_colNameArray.="},";
        $this->_colNamesMultiLanguage = 'colNames[\'' . $valueOfControll . '\']';
        return $this;
    }

    /**
     * @Desc group columns in one cell with specific title 'Optional'.
     * @access public
     * @example setGroupHeader(array(array("first Col", 2, "title of group 1"),array("second Col", 2, "title of group 2")))
     * @param Array $HeaderGroupArray array of arrays 
     * @return Object $this
     */
    public function setGroupHeader($HeaderGroupArray)
    {
        if (!is_array($HeaderGroupArray))
            $this->_errorArray[$this->_indexErrorArray++] = "setGroupHeader Function Must take array of array which contains  ColumnName,Lenght and GroupNameHeader";
        foreach ($HeaderGroupArray as $arr) {
            if (!(is_string($arr[0]) && is_int($arr[1]) && is_string($arr[2])))
                $this->_errorArray[$this->_indexErrorArray++] = "setGroupHeader Function Must take String,int,sting for ColumnName,Lenght and GroupNameHeader";
        }
        $this->_groupHeader = ' $("#' . $this->_ID . '").jqGrid("setGroupHeaders", {
      useColSpanStyle: true, 
      groupHeaders:[';
        foreach ($HeaderGroupArray as $arr) {
            $this->_groupHeader .='{startColumnName: "' . $arr[0] . '", numberOfColumns: ' . $arr[1] . ', titleText: "<em>' . $arr[2] . '</em>"},';
        }
        $this->_groupHeader .=' ] });';
        return $this;
    }

    /**
     * @Desc Set columns to display in your navgrid 'Optional'.
     * @access public
     * @example setChooseColumns("id_top_div")
     * @param String $pagerTopID , the default id = list_toppager_left
     * @return Object $this
     */
    public function setChooseColumns()
    {
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_ChooseColumns = '$("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
                caption: "",
                buttonicon: "ui-icon-calculator",
                title: "Choose columns",
                onClickButton: function () {          
                $(this).jqGrid("columnChooser",{
                    done : function () {
                       fixPositionsOfFrozenDivs.call(this[0]);
                            }
                 });
                 }
                 }); 
                 $("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
                caption: "",
                buttonicon: "ui-icon-calculator",
                title: "Choose columns",
                onClickButton: function () {          
                $(this).jqGrid("columnChooser",{
                    done : function () {
                       fixPositionsOfFrozenDivs.call(this[0]);
                            }
                 });
                 }
                 });';
        $this->_fixPositionsOfFrozenDivs();

        return $this;
    }

    /**
     * @Desc Set $_fixPositionsOfFrozenDivs value that fixed the cells positions when using frozen.
     * @Not this function active when calling setFrozenColumns function. 
     * @param Null
     * @access private
     */
    private function _fixPositionsOfFrozenDivs()
    {
        $this->_frozenResizeColumns = '//frozen fixed function start
                fixPositionsOfFrozenDivs = function () {
                    var $rows;
                    if (this.grid.fbDiv !== undefined) {
                        $rows = $(\'>div>table.ui-jqgrid-btable>tbody>tr\', this.grid.bDiv);
                        $(\'>table.ui-jqgrid-btable>tbody>tr\', this.grid.fbDiv).each(function (i) {
                            var rowHight = $($rows[i]).height(), rowHightFrozen = $(this).height();
                            if ($(this).hasClass("jqgrow")) {
                                $(this).height(rowHight);
                                rowHightFrozen = $(this).height();
                                if (rowHight !== rowHightFrozen) {
                                    $(this).height(rowHight + (rowHight - rowHightFrozen));
                                }
                            }
                        });
                        $(this.grid.fbDiv).height(this.grid.bDiv.clientHeight);
                        $(this.grid.fbDiv).css($(this.grid.bDiv).position());
                    }
                    if (this.grid.fhDiv !== undefined) {
                        $rows = $(\'>div>table.ui-jqgrid-htable>thead>tr\', this.grid.hDiv);
                        $(\'>table.ui-jqgrid-htable>thead>tr\', this.grid.fhDiv).each(function (i) {
                            var rowHight = $($rows[i]).height(), rowHightFrozen = $(this).height();
                            $(this).height(rowHight);
                            rowHightFrozen = $(this).height();
                            if (rowHight !== rowHightFrozen) {
                                $(this).height(rowHight + (rowHight - rowHightFrozen));
                            }
                        });
                        $(this.grid.fhDiv).height(this.grid.hDiv.clientHeight);
                        $(this.grid.fhDiv).css($(this.grid.hDiv).position());
                    }
                };';
    }

    /**
     * @Desc set shrinkToFit gridParameter for true or false 'Optional'.
     * @access public
     * @param Boolean $shrinkToFit
     * @example setShrinkToFit('true')
     * @default setShrinkToFit('fasle');
     * @return Object $this
     */
    public function setShrinkToFit($shrinkToFit)
    {
        if ($shrinkToFit != 'true' && $shrinkToFit != 'false')
            $this->_errorArray[$this->_indexErrorArray++] = "setShrinkToFit Function Must take bool vaule for shrink to fit";
        $this->_shrinkToFit = $shrinkToFit;
        return $this;
    }

    /**
     * @Desc Get value of grid id.
     * @access public
     * @param Null
     * @return String $this->_ID
     */
    public function getGridId()
    {
        return $this->_ID;
    }

    /**
     * @Desc Get value of grid pager id.
     * @access public
     * @param Null
     * @return String $this->_pagerID
     */
    public function getPagerId()
    {
        return $this->_pagerID;
    }

    /**
     * @Desc set Multi Select grid 'Optional'.
     * @access public
     * @param Null
     * @example setMultiSelect()
     * @return Object $this
     */
    public function setMultiSelect()
    {
        $this->_multiSelect = '"multiselect": true,';
        return $this;
    }

    /**
     * @Desc create div menu which show when press right click on grid row.
     * @access private
     * @param Null
     * @return false
     */
    private function _setMenuRightClick($extended = null)
    {
        $this->_menuRightClick = '<div class="contextMenu" id="myMenu1' . $this->_ID . '" style="display:none">
        <ul style="width: 200px">
            <li id="add' . $this->_ID . '">
                <span class="ui-icon ui-icon-plus" style="float:left"></span>
                <span style="font-size:11px; font-family:Verdana">Add Row</span>
            </li>
            <li id="edit' . $this->_ID . '">
                <span class="ui-icon ui-icon-pencil" style="float:left"></span>
                <span style="font-size:11px; font-family:Verdana">Edit Row</span>
            </li>
            <li id="del' . $this->_ID . '">
                <span class="ui-icon ui-icon-trash" style="float:left"></span>
                <span style="font-size:11px; font-family:Verdana">Delete Row</span>
            </li>';
        if (is_array($extended)) {
            foreach ($extended as $k => $v) {
                $this->_menuRightClick .=
                        '<li id="' . $v['divID'] . '' . $this->_ID . '">'
                        . '<span class="ui-icon ui-icon-trash" style="float:left"></span>'
                        . '<span style="font-size:11px; font-family:Verdana">' . $v['title'] . '</span>'
                        . '</li>';
            }
        }
        $this->_menuRightClick .= ' 
        </ul>
        </div>';
        return false;
    }

    /**
     * @Desc set right click menu show  'Optional'.
     * @access public
     * @param Null
     * @example setRightClickMenu()
     * @return Object $this
     * @note use setRightClickMenu after use setDeleteLogo,setEditLogo and setAddLogo .
     */
    public function setRightClickMenu($extended = null)
    {
      
        $this->_setMenuRightClick($extended);
        $this->_rightClickAction = '  $("tr.jqgrow",this).contextMenu(\'myMenu1' . $this->_ID . '\', {
        bindings: {
         
            \'edit' . $this->_ID . '\': function(trigger) {
                // trigger is the DOM elemen t ("tr.jqgrow") which are triggered       
                rowid=trigger.id; if($("#' . $this->_ID . ' input:checked.cbox").length>1){showNotification("","' . 'application[select_corrected_row]' . '","' . 'application[select_corrected_row]' . '");
                return;}
                if($("#jqg_' . $this->_ID . '_"+trigger.id).is(":checked")){ ' . $this->_editLogoFunction . ' return;}
                    if($("#' . $this->_ID . ' input:checked.cbox").length>0 && !$("#jqg_' . $this->_ID . '_"+trigger.id).is(":checked")){ showNotification("","' . 'application[select_corrected_row]'. '","' . 'application[select_corrected_row]' . '"); return;}
               ' . $this->_editLogoFunction . ' 
            },
            \'add' . $this->_ID . '\': function() {
               
                ' . $this->_addLogoFunction . '
            },
            \'del' . $this->_ID . '\': function(trigger) {
                rowid=trigger.id;
                ' . $this->_deleteLogoFunction . '
            }';
        if (is_array($extended)) {
            foreach ($extended as $k => $v) {
                $this->_rightClickAction .= ',' . "$v[divID]" . $this->_ID . ': function(triger){'
                        . 'rowid=triger.id;'
                        . "$v[func]" . '},';
            }
        }
        $this->_rightClickAction .= '},
    
     });';
        return $this;
    }

    /**
     * @Desc Set edit in line allow to use edit in lide when double click row'Optional'.
     * @access public
     * @example setEditInLine('/Payments/Index/editInLine',array('id'=>'PAY.id'))
     * @param String $editUrl , Array $data
     * @return Object $this
     */
    public function setEditInLine($editUrl, $data)
    {
     
        $validEngineStr = '';
        $indexErrorValidenEditArray = 0;
        foreach ($data as $k => $val) {
            $dataStr = '';
            $validEngineReqStr = '';
            $dataStr.=$k . ':rowData["' . $val . '"],';
            if ($this->_errorValidenEditArray)
                if ($this->_errorValidenEditArray[$indexErrorValidenEditArray] != '')
                    $validEngineReqStr = 'validate[' . $this->_errorValidenEditArray[$indexErrorValidenEditArray] . ']';
            $validEngineStr.= ' $("input[id=\""+rowid+"_' . $val . '\"]").attr("class","editable ' . $validEngineReqStr . '").css("border","red solid 1px");';
            $indexErrorValidenEditArray++;
        }
        $this->_editInLine = ' if (rowid && rowid !== lastSelection) {
        $("#' . $this->_ID . '").jqGrid(\'restoreRow\', lastSelection);  
        parameters = {
	"keys" : true,
	"oneditfunc" : function (){      
          ' . $validEngineStr . '   
                    },
	"successfunc" : function (){ 
                                   },
	"url" : "clientArray",
        "extraparam" : {},
	"aftersavefunc" :function (){
        var rowData = $("#' . $this->_ID . '").getRowData(rowid); 
        $.ajax({
            type: "POST",
            url: "' . $editUrl . '",
            dataType: "JSON",
            data: {
            ' . $dataStr . '  
            },  
            success: function(data) {    
            if (data.succeed){  showNotification("success","' . 'application[success]'. '","' . 'application[record_edited_successfuly]' . '");
            $("#' . $this->_ID . '").trigger("reloadGrid")   }
            else if(data.inputError){ jQuery("#' . $this->_ID . '").jqGrid("editRow",rowid,  parameters);}

            }
            });
            },
	"errorfunc": null,
	"afterrestorefunc" : function (){},
	"restoreAfterError" : true,
	"mtype" : "POST"
                }
        var rowdata = jQuery("#' . $this->_ID . '").jqGrid("getRowData",rowid);
                fixPositionsOfFrozenDivs.call(this);
        jQuery("#' . $this->_ID . '").jqGrid("editRow",rowid,  parameters);
        lastSelection = rowid;
        var rowdata = jQuery("#' . $this->_ID . '").jqGrid("getRowData",lastSelection);
        fixPositionsOfFrozenDivs.call(this);
            }';
        $this->_lastSelection = 'var lastSelection';
        $this->_editUrl = '"editurl": "' . $editUrl . '",';
        return $this;
    }

    /**
     * @Desc Set format edit in select allow to use dropDownList in your grid filter edit cell'Optional'.
     * @access public
     * @example formatEditInSelect(array('1'=>'choose1','2'=>'choose2'))
     * @param Array $editoptions
     * @return String
     */
    public function formatEditInSelect($editoptions)
    {
        $Editoptions = " edittype:'select',editoptions:{ 'value':'";
        foreach ($editoptions as $key => $arr) {
            $Editoptions .=$key . ":" . $arr . ";";
        }
        $Editoptions = substr($Editoptions, 0, -1);
        $Editoptions .="', 'separator': ':',  'delimiter': ';'}";
        return $Editoptions;
    }

    /**
     * @Desc Set format edit in clander allow to use clander in your grid filter edit cell'Optional'.
     * @access public
     * @example formatSearchInClander()
     * @param NULL
     * @return String
     */
    public function formatEditInClander()
    {
        $calnder = "  'editoptions': {
                'dataInit': function(el) {
                    setTimeout(function() {
                        if (jQuery.ui) {
                            if (jQuery.ui.datepicker) {
                                jQuery(el).datepicker({
                                    'disabled': false,
                                    'dateFormat': 'dd.mm.yy'
                                });
                                jQuery('.ui-datepicker').css({
                                    'font-size': '75%'
                                });
                            }
                        }
                    }, 100);
                }
            }";

        return $calnder;
    }

    /**
     * @Desc Set format search in clander allow to use clander in your grid filter search'Optional'.
     * @access public
     * @example formatSearchInClander()
     * @param NULL
     * @return String
     */
    public function formatSearchInClander()
    {
        $calnder = "  'searchoptions': {
                sopt: ['eq','ne','','','','','','','','',''],
                'dataInit': function(el) {
                    setTimeout(function() {
                        if (jQuery.ui) {
                            if (jQuery.ui.datepicker) {
                                jQuery(el).datepicker({
                                    'disabled': false,
                                    'dateFormat': 'yy-mm-dd'
                                });
                                jQuery('.ui-datepicker').css({
                                    'font-size': '75%',
                                   'height':'150px',
                                  
                                   
                                });
                            }
                        }
                    }, 100);
                }
            }";
        return $calnder;
    }

    /**
     * @Desc Set sub grid that allow to load page below row as sub grid'Optional'.
     * @access public
     * @example setSubGrid('/controll_panel/employe/index')
     * @param String $subGridUrl , Boolen $expandOnLoad Default FALSE
     * @return Object $this
     */
    public function setSubGrid($subGridUrl, $expandOnLoad = FALSE)
    {
        if ($expandOnLoad == FALSE)
            $ExpandOnLoad = '"expandOnLoad": false';
        elseif ($expandOnLoad == TRUE)
            $ExpandOnLoad = '"expandOnLoad": true';
        $this->_subGrid = ' "subGridOptions": {
            "plusicon": "ui-icon-triangle-1-e",
            "minusicon": "ui-icon-triangle-1-s",
            "openicon": "ui-icon-arrowreturn-1-e",
            "reloadOnExpand" : false,
            "selectOnExpand" : true ,
            ' . $ExpandOnLoad . '
        },
        "subGrid": true,
        "subGridRowExpanded": function(subgridid, id) {
            var data = {
                subgrid: subgridid,
                rowid: id
            };
            $("#"+subgridid).load("' . $subGridUrl . '", data);
        },';
        return $this;
    }

    /**
     * @Desc Set option filter that allow to show and hide filter in grod toolbal'Optional'.
     * @access public
     * @example setOptionFilter() 
     * @param Null
     * @return Object $this
     */
    public function setOptionFilter()
    {
        $this->_optionFilter = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '",{ caption: "Filter", title: "Toggle Searching Toolbar",
        buttonicon: "ui-icon-pin-s",
        onClickButton: function () { jQuery("#' . $this->_ID . '")[0].toggleToolbar(); }
        });';
        return $this;
    }

    /**
     * @Desc Set Custom Search in Navbar for the grid that show Custom search textbox in grid navbar'Optional'.
     * @access public
     * @example setCustomSearchNavBar(array('TRA2.en','TRA.en')) 
     * @param array $colNames
     * @return Object $this
     */
    public function setCustomSearchNavBar($colName)
    {
        $field = '"field":"' . $colName[0] . '",';
        $indexFiled = 0;
        foreach ($colName as $val) {
            if ($indexFiled == 0) {
                $indexFiled++;
                continue;
            }

            $field.='"field' . ++$indexFiled . '":"' . $val . '",';
        }
        $uniqeid = uniqid();
        $this->_customSearchNavBar = '$("#' . $this->_pagerID . '_left table.navtable tbody tr").append ( 
            \'<span style="margin-left:10px;">   Filter </span> <input type="textbox" maxlength="50" class="SearchTxt" id="navSearchTxt' . $uniqeid . '" width="60px" />\');
    
        var stoppedTyping;
        $("#navSearchTxt' . $uniqeid . '").on("keypress", function(){
            if (stoppedTyping) clearTimeout(stoppedTyping);
            stoppedTyping = setTimeout(function(){
            if($("#navSearchTxt' . $uniqeid . '").val() == parseFloat($("#navSearchTxt' . $uniqeid . '").val()))
                 {var op ="eq";}
            else {var op ="icn";}
              $("#' . $this->_ID . '").jqGrid("setGridParam",{search:true, postData:{filters:\'{"groupOp":"AND","rules":[{' . $field . '"op":"\'+op+\'","data":"\'+$("#navSearchTxt' . $uniqeid . '").val()+\'"}]}\'}});     
              $("#' . $this->_ID . '").trigger("reloadGrid"); }, 1e3);
                                                    });';
        return $this;
    }

    /**
     * @Desc Set Cell Editing for the grid that make allow to edit in special cell 'Optional'.
     * @access public
     * @example setCellEdit('/controll_panel/employe/index') 
     * @param String $CellEditUrl
     * @return Object $this
     */
    public function setCellEdit($CellEditUrl)
    {
        $this->_cellEdit = 'cellEdit : true,
	"cellsubmit" : "remote",
	"cellurl" : "' . $CellEditUrl . '",';
        return $this;
    }

    /**
     * @Desc Set formatEditRules allow edit cell use validEngine js 'Optional'.
     * @access public
     * @example formatEditRules(array("numbers","letters","require","email"),6,10)
     * @param Array  $editRules ,int $minSize ,Int $maxSize 
     * @return String
     */
    public function formatEditRules($editRules, $minSize = 0, $maxSize = 0)
    {
        $functionName = uniqid();
        $formatEditString = '';

        $functionName = 'validLen' . $functionName;
        $this->_functionValiden.='function ' . $functionName . '(value, colName) { var errorValidenArray="";';
        if (in_array('numbers', $editRules)) {
            $this->_functionValiden.='  if(!$.isNumeric( value ))
        {
         errorValidenArray="must be number";
        }';
            $formatEditString.='custom[onlyNumberSp],';
        }
        if (in_array('letters', $editRules)) {
            $this->_functionValiden.='  
               
                if (!value.match(/^[A-Za-z\s]*$/) ) 
        {
         errorValidenArray="must be letter";
        
        }
        ';
            $formatEditString.='[custom[onlyLetterSp],';
        }
        if (in_array('require', $editRules)) {
            $this->_functionValiden.='  if(value.trim()=="")
        {
         errorValidenArray="Field is Required";
        }';
            $formatEditString.='required,';
        }
        if (in_array('email', $editRules)) {
            $this->_functionValiden.='  
               
                if (!value.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) ) 
        {
         errorValidenArray="must be email";
        
        }
        ';
            $formatEditString.='custom[email],';
        }
        if ($minSize != 0) {
            $this->_functionValiden.='  
                var min = value.length;
              
                if (min <' . $minSize . ' ) 
        {
         errorValidenArray="min size must be ' . $minSize . '";
        
        }
        ';
            $formatEditString.='minSize[' . $minSize . '],';
        }

        if ($maxSize != 0) {
            $this->_functionValiden.='  
                var max = value.length;
              
                if (max >' . $maxSize . ' ) 
        {
         errorValidenArray="min size must be ' . $maxSize . '";
        
        }
        ';
            $formatEditString.='maxSize[' . $maxSize . '],';
        }

        $this->_functionValiden.='if(errorValidenArray==""){  return[true,""];}else{ return[false,errorValidenArray];}};  ';
        $this->_errorValidenEditArray[$this->_indexErrorValidenEditArray++] = $formatEditString;
        return'editrules:{custom:true, custom_func:' . $functionName . '}';
    }

    /**
     * @Desc Set formatTrueFalse allow change value of boolean columns to another value'Optional'.
     * @access public
     * @example formatTrueFalse('true', 'false','<img src="/img/true.jpeg">', '<img src="/img/false.jpeg">')
     * @param String $true ,String $false ,String $trueChangeTo ,String $falseChangeTo ,
     * @return String
     */
    public function formatTrueFalse($true, $false, $trueChangeTo, $falseChangeTo)
    {
        $functionName = uniqid();
        $functionName = 'checkboxEditFun' . $functionName;
        $this->_checkboxEditFunction.="function " . $functionName . "(cellValue, options, rowObject) {
                if (cellValue == '" . $true . "'||cellValue == '" . $trueChangeTo . "')
                {
                    return '" . $trueChangeTo . "';
                }
                else if (cellValue == '" . $false . "'||cellValue == '" . $falseChangeTo . "')
                {
                    return '" . $falseChangeTo . "';
                }
                else {
                    return'';
                }
            };";

        return"edittype: 'checkbox', editoptions: {value: '" . $trueChangeTo . ":" . $falseChangeTo . "'}, editable: true,formatter:" . $functionName . ",formatoptions: {disabled: false}";
    }

    /**
     * @Desc Set ShowrowNumber allow show number od row in grid 'Optional'.
     * @access public
     * @example setShowrowNumber(50) 
     * @param Null
     * @return Object $this
     */
    public function setShowrowNumber($width = 35)
    {
        $this->_showRowNumber = 'true';
        $this->_widthRowNumber = $width;
        return $this;
    }

    /**
     * @Desc set function _exportExcelFunction enable to use export xls
     * @access private
     * @param Null
     * @return _exportExcel
     */
    private function _exportExcelFunction()
    {
        return $this->_exportExcel = '                  function exportExcel(type="",url="")
        {
            mya=jQuery("#' . $this->_ID . '").getDataIDs();  // Get All IDs
              $.ajax({
            type: "POST",
            url: "' . $this->_url . '",
            dataType: "JSON",
            data: {
            
                csvBuffer: type,
                _search: false,
                page: "' . $this->_pageNumber . '",
                rows:"' . $this->_rowNum . '",
                sidx:"' . $this->_sortName . '",
                sord:"' . $this->_sortOrder . '"

                },
                 success: function(data) {
      window.location ="http://"+url+"?typeOfFile="+type;
      }
                });
        }';
    }

    /* start Functionality  */

    /**
     * @Desc Set forzen for the grid that make columns fronzen in scrolling 'Optional'.
     * @access public
     * @example setFrozenColumns() 
     * @param Null
     * @note use it after use SetGridID function
     * @return Object $this
     */
    public function setFrozenColumns()
    {
        $this->_frozenColumns = 'jQuery("#' . $this->_ID . '").jqGrid("setFrozenColumns");';
        $this->_sortable = 'false';
        $this->_fixPositionsOfFrozenDivs();
        $this->_callFrozenFunction = ' fixPositionsOfFrozenDivs.call(this);';
        return $this;
    }

    /**
     * @Desc On press special key after select row , this function have rowId with it by default so can use it 'Optional'.
     * @access public
     * @example showRowMessage(array("Enter","alert("You enter a row with id:" + rowid);");
     * @param String $pressKey, String $rowFunction
     * @return Object $this
     */
    public function showRowMessage($pressKey, $rowFunction)
    {
        $this->_rowMessageShow = '                      $("#' . $this->_ID . '").jqGrid(\'bindKeys\', {
        "on' . $pressKey . '": function(rowid) {
            ' . $rowFunction . '
        }
    });';
        return $this;
    }

    /**
     * @Desc Set same tamplet to all columns in grid 'Optional'.
     * @access public 
     * @example setTamplet("searchOptionals: {sopt: [ 'cn','eq', 'ne']  }, width:30, sortable: true");
     * @param String $tamplet
     * @return Object $this
     */
    public function setTamplet($tamplet)
    {
        if (!is_string($tamplet))
            $this->_errorArray[$this->_indexErrorArray++] = "setTamplet Function Must take String for Tamplet in Columns";
        $this->_cmTamplet = "cmTemplate: {" . $tamplet . "},";
        return $this;
    }

    /**
     * @Desc Set direction language right to left 'Optional'.
     * @access public
     * @default Right to left direction
     * @example directionRTL();
     * @return Object $this
     */
    public function directionRTL()
    {
        $this->_direction = '"direction": "rtl",
        "recordpos": "left",';
        return $this;
    }

    /**
     * @Desc Set Direction language left to right 'Optional'.
     * @access public
     * @default Right to left direction.
     * @example directionLTR();
     * @return Object $this
     */
    public function directionLTR()
    {
        $this->_direction = '"direction": "ltr",
        "recordpos": "left",';
        return $this;
    }

    /**
     * @Desc Show grid columns footer 'Optional'. 
     * @access public
     * @example setGridFooter(array("colname1"=>"data show:1","colname2"=>"data show:2"));
     * @param Array $dataGridFooter
     * @return Object $this
     */
    public function setGridFooter($dataGridFooter)
    {
        if (!is_array($dataGridFooter))
            $this->_errorArray[$this->_indexErrorArray++] = "setGridFooter Function Must take Array for Footer Data which Index refer to columns name and value refer to data on it ";
        $this->_gridFooter = " \"footerrow\": true,";
        $this->_dataGridFooter = "jQuery('#" . $this->_ID . "').jqGrid('footerData', 'set', {";
        foreach ($dataGridFooter as $k => $val)
            $this->_dataGridFooter.='"' . $k . '":"' . $val . '",';
        $this->_dataGridFooter.='});';
        return $this;
    }

    /**
     * @Desc Set navgrid bar(Pager) in top of the grid 'Optional'.
     * @access public
     * @param Null
     * @example setTopToolbar()
     * @return Object $this
     */
    public function setTopToolbar()
    {
        $this->_topperToolbar = " toppager: true,";
        return $this;
    }

    /**
     * @Desc Set pdf logo in your navgrid 'Optional'.
     * @access public
     * @example setPdfLogo('controll/payments/index/test')
     * @param String $urlpdf
     * @return Object $this
     */
    public function setPdfLogo($urlPdf)
    {
        $this->_exportExcelFunction();
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_pdfLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        "caption": "",
        "title": "Export to Pdf",
        "onClickButton": function() {
         exportExcel(type="pdf",url="' . $urlPdf . '");},
        buttonicon: "ui-icon-newwin"
    });
    jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        "caption": "",
        "title": "Export to Pdf",
        
           "onClickButton": function() {
      try {
                jQuery("#' . $this->_ID . '").jqGrid(\'excelExport\', {
                    tag: \'pdf\',
                    url:\'' . $this->_url . '\'
                });
            } catch (e) {
                window.location = \'employe/add/grid.php?oper=pdf\';
            }
                                    },
        buttonicon: "ui-icon-newwin"
    });
    ';
        return $this;
    }

    /**
     * @Desc Set Add logo in your navgrid 'Optional'.
     * @access public
     * @example setAddLogo('$("#myModal").modal("show");')
     * @param String $functionAdd
     * @return Object $this
     */
    public function setAddLogo($functionAdd = '')
    {
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_addLogoFunction = $functionAdd . '; ';
        $this->_AddLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        "caption": "",
        "title": "Add New Row",
        "onClickButton": function() {
                ' . $functionAdd . '; },
        buttonicon: "ui-icon-plus"
    });
    jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        "caption": "",
        "title": "Add New Row",
        "onClickButton": function() {
                ' . $functionAdd . '; },
        buttonicon: "ui-icon-plus"
    });
    ';
        return $this;
    }

    /**
     * @Desc Set edit logo in your navgrid 'Optional'.
     * @access public
     * @example setEditLogo('$("#myModal").modal("show");')
     * @param String $functionEdit
     * @note Can Use Row Id In Your Function Code Variable Called rowid
     * @return Object $this
     */
    public function setEditLogo($functionEdit = '')
    {

        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_editLogoFunction = $functionEdit . '; ';
        $this->_EditLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        "caption": "",
        "title": "Edit Selected Row",
        "onClickButton": function() {
         var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selarrrow");
        if(rowid.length>1){   
              showNotification("","' . 'application[Worning]' . '","' . 'application[Please, Select One Row]' . '");}
        else{ 
            var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selrow");
            if(rowid){     
            ' . $functionEdit . '; }
        else{
              showNotification("","' . 'application[Worning]' . '","' . 'application[Please_Select_Row]' . '");}
                }
                },
        buttonicon: "ui-icon-pencil"
        });
        jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        "caption": "",
        "title": "Edit Selected Row",
        "onClickButton": function() {
        var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selarrrow");
        if(rowid.length>1){   
            
              showNotification("","' . 'application[Worning]' . '","' .'application[Please, Select One Row]' . '");}
        else{
            var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selrow");
            if(rowid){     
            ' . $functionEdit . '; }
        else{
                showNotification("","' . 'application[Worning]' . '","' . 'application[Please_Select_Row]' . '");}
                           }
                           },
        buttonicon: "ui-icon-pencil"
    });
    ';
        return $this;
    }

    /**
     * @Desc Set delete logo in your navgrid 'Optional'.
     * @access public
     * @example setDeleteLogo('for (i = 0; i < rowid.length; i++) {console.log(i); }','alert("done");')
     * @param String $functionDelete 
     * * @note Can Use Row Id In Your Function Code Variable Called rowid
     * @return Object $this
     */
    public function setDeleteLogo($functionDelete = '')
    {
       
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_deleteLogoFunction = $functionDelete . '; ';
        $this->_DeleteLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        "caption": "",
        "title": "Delete Selected Row",
        "onClickButton": function() {
        var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selarrrow");
        if(rowid.length){   
             ' . $functionDelete . '; }
        else{
            var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selrow");
            if(rowid){     
            ' . $functionDelete . '; }
            else{
             showNotification("","' . 'application[Worning]' . '","' . 'application[Please_Select_Row]' . '");}
                    }
            },
        buttonicon: "ui-icon-trash"
        });
        
        jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        "caption": "",
        "title": "Delete Selected Row",
        "onClickButton": function() {
        var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selarrrow");
        if(rowid.length){   
             ' . $functionDelete . '; }
        else{
                var rowid = $("#' . $this->_ID . '").jqGrid("getGridParam","selrow");
                if(rowid){     
                        ' . $functionDelete . '; }
                else{
                     showNotification("","' . 'application[Worning]' . '","' . 'application[Please_Select_Row]' . '");}
            }
        },
        buttonicon: "ui-icon-trash"
    });
    ';
        return $this;
    }

    /**
     * @Desc Set export excel logo in your navgrid 'Optional'.
     * @access public
     * @example setExportExcel("id_top_div")
     * @param NULL
     * @return Object $this
     */
    public function setExportExcel($urlPdf)
    {
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_exportExcelLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        id: "pager_excel",
        caption: "",
        title: "Export To Excel",
        onClickButton: function(e) {
            try {
              exportExcel(type="xls",url="' . $urlPdf . '");
            
            } catch (e) {
                window.location = "grid.php?oper=excel";
            }
        },
        buttonicon: "ui-icon-clipboard"
        });
        jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        id: "pager_excel",
        caption: "",
        title: "Export To Excel",
        onClickButton: function(e) {
            try {
            
            var postData = jQuery("#' . $this->_ID . '").jqGrid(\'getGridParam\',\'postData\');
            var str="";
             for(i in postData)
                str+=i+"="+postData[i]+"&";
           
               
                    
 
                window.location.href=("' . $this->_url . '?export=excel&"+str+ new Date().getTime());
         
             
            } catch (e) {
                window.location = "grid.php?oper=excel";
            }
        },
        buttonicon: "ui-icon-clipboard"
        });';
        return $this;
    }

    /**
     * @Desc Set export csv logo in your navgrid 'Optional'.
     * @access public
     * @example setExportCsv()
     * @param NULL
     * @return Object $this
     */
    public function setExportCsv()
    {
        $pagerTopID = '' . $this->_ID . '_toppager_left';
        $this->_exportCsvLogo = 'jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $this->_pagerID . '", {
        id: "pager_csv",
        caption: "",
        title: "Export To CSV",
        onClickButton: function(e) {
            try {
                exportExcel(type="csv");
                });
            } catch (e) {
                window.location = "grid.php?oper=csv";
            }
        },
        buttonicon: "ui-icon-document"
        });
        jQuery("#' . $this->_ID . '").jqGrid("navButtonAdd", "#' . $pagerTopID . '", {
        id: "pager_csv",
        caption: "",
        title: "Export To CSV",
        onClickButton: function(e) {
            try {
               jQuery("#' . $this->_ID . '").jqGrid("excelExport", {
                    tag: "csv",
                    url: "grid.php"
                });
            } catch (e) {
                window.location = "grid.php?oper=csv";
            }
        },
        buttonicon: "ui-icon-document"
        });';
        return $this;
    }

    private function _responsiveFun()
    {
        $this->_responsive = ' $(window).resize(function() { var $grid =$("#' . $this->_ID . '"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
    $grid.jqGrid("setGridWidth", newWidth, true);});';
    }

    /* end  Functionality  */

    public static function paginateGrid($count, $page, $limit)
    {
        if ($count > 0 && $limit > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $offset = $limit * $page - $limit;

        if ($offset < 0) {
            $offset = 0;
        }

        return array('offset' => $offset, 'page' => $page, 'total_pages' => $total_pages);
    }

    public function convertSrchStrToSQL($field, $searchOp, $searchStr)
    {
        //convert search string to sql format                
        if ($searchOp == "eq")
            $where = "$field = '$searchStr'";
        if ($searchOp == "ne")
            $where = "$field != '$searchStr'";
        if ($searchOp == "bw")
            $where = "$field LIKE '$searchStr%'";
        if ($searchOp == "ew")
            $where = "$field LIKE '%$searchStr'";
        if ($searchOp == "cn")
            $where = "$field LIKE '%$searchStr%'";
        if ($searchOp == "icn")
            $where = "LOWER($field) LIKE LOWER('%$searchStr%')";
        if ($searchOp == "nu")
            $where = "= '' ";
        if ($searchOp == "nn")
            $where = "!= '' ";
        return $where;
    }

}
