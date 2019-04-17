<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require(APPPATH . "models/Entities/Customers.php");

class Mod_customers extends CI_Model
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
                        if ($key->field == 'customerTypeCode')
                            $key->field = 'PT.customerTypeCode';
                        elseif ($key->field != 'customerId' && !NULL)
                            $key->field = 'C.' . $key->field;
                        else
                            continue;
                        $where .= $jqGrid->convertSrchStrToSQL($key->field, $key->op, $key->data) . ' & ';
                    }
                    $where = substr($where, 0, -2);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    if ($gridParameters['searchField'] == 'customerTypeCode')
                        $gridParameters['searchField'] = 'PT.customerTypeCode';
                    else
                        $gridParameters['searchField'] = 'C.' . $gridParameters['searchField'];

                    $field = $gridParameters['searchField'];
                    $searchOp = $gridParameters['searchOper'];
                    $searchStr = $gridParameters['searchString'];
                    $where = $jqGrid->convertSrchStrToSQL($field, $searchOp, pg_escape_string($searchStr));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getCustomersCount($where);
            $arrPaginate = $jqGrid->paginateGrid($count, $gridParameters['page'], $gridParameters['rows']);
            $query = $this->getCustomersData($gridParameters['sidx'], $gridParameters['sord'], $gridParameters['rows'], $arrPaginate['offset'], $where);
            return array('rows' => $query, 'page' => $arrPaginate['page'], 'total' => $arrPaginate['total_pages'], 'records' => $count);
        }
        return false;
    }

    public function getCustomersCount($where = "1=1")
    {
        $count = $this->_em->createQueryBuilder()
                        ->select('count(C.customerId) customerId')
                        ->from('Customers', 'C')
                        ->Where($where)->getQuery()->getResult();

        return $count[0]['customerId'];
    }

    public function getCustomersData($sortkey, $sorttype, $limit, $offset, $where)
    {
      
        if ($sortkey != 'customerId' && !NULL)
            $sortkey = 'C.' . $sortkey;
        else
            $sortkey = 'C.customerFirstName';

        $res = $this->_em->createQueryBuilder()
                        ->select('C.customerId,C.customerFirstName,C.customerMiddleName,C.customerLastName'
                                . ',C.gender,C.emailAddress,C.phoneNumber,C.street,C.otherDetails,C.city,C.zipCode,C.country')
                        ->from('Customers', 'C')
                        ->Where($where)
                        ->orderBy("$sortkey", "$sorttype")
                        ->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getQuery()->getResult();
        return $res;
    }

    public function saveCustomers($data)
    {
        if ($data['customerId'] != NULL || $data['customerId'] != '') {
            $customer = $this->_em->find('Customers', $data['customerId']);
            unset($data['customerId']);
        } else {
            $customer = new Customers();
             unset($data['customerId']);
        }
        foreach ($data as $key => $value) {

            $key = 'set' . ucfirst($key);
            $customer->$key($value);
        }
        $this->_em->persist($customer);
        $this->_em->flush();
        if ($customer->getCustomerId())
            return TRUE;
        return FALSE;
    }
    public function deleteCustomers($customerId) {
         $customer = $this->_em->find('Customers', $customerId);
         if (empty($customer)) {
            return false;
        }
        $this->_em->remove($customer);
        $this->_em->flush();
        return true;
    }

}
