<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(APPPATH . "models/Entities/ProductTypes.php");

class Mod_products_types extends CI_Model
{

    private $_em;

    public function __construct()
    {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    public function getAllProductTypesCode()
    {
        $res = $this->_em->createQueryBuilder()
                        ->select('PT.productTypeCode')
                        ->from('ProductTypes', 'PT')
                        ->orderBy("PT.productTypeCode", "asc")
                        ->getQuery()->getResult();
        return $res;
    }

    public function getProductTypeByProductTypeCode($code)
    {
        $productType = $this->_em->getRepository('ProductTypes')->findBy(array('productTypeCode' => $code));
        return $productType[0];
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
                        if ($key->field != 'productTypeCode' && !NULL)
                            $key->field = 'PT.' . $key->field;
                        else
                            continue;
                        $where .= $jqGrid->convertSrchStrToSQL($key->field, $key->op, $key->data) . ' & ';
                    }
                    $where = substr($where, 0, -2);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    $gridParameters['searchField'] = 'PT.' . $gridParameters['searchField'];

                    $field = $gridParameters['searchField'];
                    $searchOp = $gridParameters['searchOper'];
                    $searchStr = $gridParameters['searchString'];
                    $where = $jqGrid->convertSrchStrToSQL($field, $searchOp, pg_escape_string($searchStr));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getProductTypesCount($where);
            $arrPaginate = $jqGrid->paginateGrid($count, $gridParameters['page'], $gridParameters['rows']);
            $query = $this->getProductTypesData($gridParameters['sidx'], $gridParameters['sord'], $gridParameters['rows'], $arrPaginate['offset'], $where);
//            print_r($query);die;
            return array('rows' => (array)$query, 'page' => $arrPaginate['page'], 'total' => $arrPaginate['total_pages'], 'records' => $count);
        }
        return false;
    }

    public function getProductTypesCount($where = "1=1")
    {
        $count = $this->_em->createQueryBuilder()
                        ->select('count(PT.productTypeCode) productTypeCode')
                        ->from('ProductTypes', 'PT')
                        ->Where($where)->getQuery()->getResult();

        return $count[0]['productTypeCode'];
    }

    public function getProductTypesData($sortkey, $sorttype, $limit, $offset, $where)
    {
        if ($sortkey == 'productTypeCode')
            $sortkey = 'PT.productTypeCode';

        $res = $this->_em->createQueryBuilder()
                        ->select('PT.productTypeCode, PT.productTypeDescription, PT.vatRating, PT.parentProductTypeCode')
                        ->from('ProductTypes', 'PT')
                        ->Where($where)
                        ->orderBy("$sortkey", "$sorttype")
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
        $this->load->model('Mod_products_types');
        $data['productTypeCode'] = $this->Mod_products_types->getProductTypeByProductTypeCode($data['productTypeCode']);
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

    public function deleteProducts($productId)
    {
        $product = $this->_em->find('Products', $productId);
        if (empty($product)) {
            return false;
        }
        $this->_em->remove($product);
        $this->_em->flush();
        return true;
    }

}
