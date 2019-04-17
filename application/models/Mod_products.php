<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require(APPPATH . "models/Entities/Products.php");

class Mod_products extends CI_Model
{

    private $_em;

    public function __construct()
    {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    function search($gridParameters)
    {
        $jqGrid = new jqGridClass();
        if ($gridParameters != null) {
//            return $gridParameters;
            if ($gridParameters['_search'] == "true") {
                $objArr = json_decode($gridParameters['filters']);
                $where = '';
                if (!empty($objArr->rules)) {
                    foreach ($objArr->rules as $key) {
                        if ($key->field == 'productTypeCode')
                            $key->field = 'PT.productTypeCode';
                        elseif ($key->field != 'productId' && !NULL)
                            $key->field = 'P.' . $key->field;
                        else
                            continue;
                        $where .= $jqGrid->convertSrchStrToSQL($key->field, $key->op, $key->data) . ' & ';
                    }
                    $where = substr($where, 0, -2);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    if ($gridParameters['searchField'] == 'productTypeCode')
                        $gridParameters['searchField'] = 'PT.productTypeCode';
                    else
                        $gridParameters['searchField'] = 'P.' . $gridParameters['searchField'];

                    $field = $gridParameters['searchField'];
                    $searchOp = $gridParameters['searchOper'];
                    $searchStr = $gridParameters['searchString'];
                    $where = $jqGrid->convertSrchStrToSQL($field, $searchOp, pg_escape_string($searchStr));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getProductsCount($where);
            $arrPaginate = $jqGrid->paginateGrid($count, $gridParameters['page'], $gridParameters['rows']);
            $query = $this->getProductsData($gridParameters['sidx'], $gridParameters['sord'], $gridParameters['rows'], $arrPaginate['offset'], $where);
            return array('rows' => $query, 'page' => $arrPaginate['page'], 'total' => $arrPaginate['total_pages'], 'records' => $count);
        }
        return false;
    }

    public function getProductsCount($where = "1=1")
    {
        $count = $this->_em->createQueryBuilder()
                        ->select('count(P.productId) productId')
                        ->from('Products', 'P')
                        ->Where($where)->getQuery()->getResult();

        return $count[0]['productId'];
    }

    public function getProductsData($sortkey, $sorttype, $limit, $offset, $where)
    {
        $res = $this->_em->createQueryBuilder()
                        ->select('P.productId,P.productName,P.productPrice,P.productDescription')
                        ->from('Products', 'P')
                        ->Where($where)
                        ->orderBy("P.$sortkey", "$sorttype")
                        ->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getQuery()->getResult();
        return $res;
    }

    public function saveProducts($data)
    {
        if ($data['productId'] != NULL || $data['productId'] != '') {
            $product = $this->_em->find('Products', $data['productId']);
            unset($data['productId']);
        } else {
            $product = new Products();
             unset($data['productId']);
        }
        foreach ($data as $key => $value) {

            $key = 'set' . ucfirst($key);
            $product->$key($value);
        }
        $this->_em->persist($product);
        $this->_em->flush();
        if ($product->getProductId())
            return TRUE;
        return FALSE;
    }
    public function deleteProducts($productId) {
         $product = $this->_em->find('Products', $productId);
         if (empty($product)) {
            return false;
        }
        $this->_em->remove($product);
        $this->_em->flush();
        return true;
    }

}
