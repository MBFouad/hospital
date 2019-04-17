<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

class ProductsRepo extends EntityRepository {

    function search($param) {
        return "asd";
        $jqGrid = new jqGridClass();
        if ($gridParameters != null) {

            if ($gridParameters['_search'] == "true") {
                $objArr = json_decode($gridParameters['filters']);

                if (!empty($objArr->rules)) {

                    $arr = array();
                    $i = 0;
                    foreach ($objArr->rules as $key) {
                        $arr[$i]['field'] = $key->field;
                        $arr[$i]['searchOp'] = $key->op;
                        $arr[$i]['searchStr'] = $key->data;
                        $i++;
                    }

                    $where = '';
                    for ($i = 0; $i < count($arr); $i++) {
                        $where .= $jqGrid->convertSrchStrToSQL($arr[$i]['field'], $arr[$i]['searchOp'], pg_escape_string($arr[$i]['searchStr'])) . ' & ';
                    }
                    $where = substr($where, 0, -2);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    $field = $gridParameters['searchField'];
                    $searchOp = $gridParameters['searchOper'];
                    $searchStr = $gridParameters['searchString'];
                    $where = $jqGrid->convertSrchStrToSQL($field, $searchOp, pg_escape_string($searchStr));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getCustomerBasicsCount($where);

            $limit = $gridParameters['rows'];
            $page = $gridParameters['page'];
            $sortkey = $gridParameters['sidx'];
            $sorttype = $gridParameters['sord'];


            if ($count > 0 && $limit > 0) {
                $totalPages = ceil($count / $limit);
            } else {
                $totalPages = 0;
            }
            if ($page > $totalPages) {
                $page = $totalPages;
            }

            $offset = $limit * $page - $limit;

            if ($offset < 0) {
                $offset = 0;
            }

            $query = $this->getAll($sortkey, $sorttype, $limit, $offset, $where);

            return array('data' => $query, 'page' => $page, 'total' => $totalPages, 'records' => $count);
        }
        return false;
    }

}
