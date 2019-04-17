<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (APPPATH . "models/Entities/DoctorSchedule.php");
require_once (APPPATH . "models/Entities/Specialty.php");

class Mod_doctors extends CI_Model {

    private $_em;

    public function __construct() {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    function search($gridParameters) {
        $jqGrid = new jqGridClass();
        if ($gridParameters != null) {
//            return $gridParameters;
            if ($gridParameters['_search'] == "true") {
                $objArr = json_decode($gridParameters['filters']);
                $where = '';
                if (!empty($objArr->rules)) {
                    foreach ($objArr->rules as $key) {
                        if ($key->field == 'doctorName') {
                            $where .= $jqGrid->convertSrchStrToSQL('U.firstName', $key->op, $key->data) . ' or ';
                            $where .= $jqGrid->convertSrchStrToSQL('U.middleName', $key->op, $key->data) . ' or ';
                            $where .= $jqGrid->convertSrchStrToSQL('U.lastName', $key->op, $key->data) . ' or ';
                        }
                        if ($key->field2 == 'specialty' && !NULL)
                            $where .= $jqGrid->convertSrchStrToSQL('S.specialtyType', $key->op, $key->data) . ' or ';
                    }
                    $where = substr($where, 0, -3);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    if ($gridParameters['searchField'] == 'doctorName') {
                        $where = $jqGrid->convertSrchStrToSQL('U.firstName', $gridParameters['searchOper'], pg_escape_string($gridParameters['searchString'])) . " or ";
                        $where .= $jqGrid->convertSrchStrToSQL('U.middleName', $gridParameters['searchOper'], pg_escape_string($gridParameters['searchString'])) . " or ";
                        $where .= $jqGrid->convertSrchStrToSQL('U.lastName', $gridParameters['searchOper'], pg_escape_string($gridParameters['searchString']));
                    } else if ($gridParameters['searchField'] == 'specialty')
                        $where = $jqGrid->convertSrchStrToSQL('S.specialtyType', $gridParameters['searchOper'], pg_escape_string($gridParameters['searchString']));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getDoctorCount($where);
            $arrPaginate = $jqGrid->paginateGrid($count, $gridParameters['page'], $gridParameters['rows']);
            $query = $this->getProductsData($gridParameters['sidx'], $gridParameters['sord'], $gridParameters['rows'], $arrPaginate['offset'], $where);
            return array('rows' => $query, 'page' => $arrPaginate['page'], 'total' => $arrPaginate['total_pages'], 'records' => $count);
        }
        return false;
    }

    public function getDoctorCount($where = "1=1") {
        $count = $this->_em->createQueryBuilder()
                        ->select('count(U.id) userId')
                        ->from('Users', 'U')
                        ->leftJoin('DoctorSchedule', 'D', \Doctrine\ORM\Query\Expr\Join::WITH, 'U.id = D.user')
                        ->leftJoin('Specialty', 'S', \Doctrine\ORM\Query\Expr\Join::WITH, 'D.specialty = S.id')
                        ->Where("U.userType = 2 and " . $where)->getQuery()->getResult();

        return $count[0]['userId'];
    }

    public function getProductsData($sortkey, $sorttype, $limit, $offset, $where) {
        if ($sortkey == 'specialty')
            $sortkey = 'S.specialty';
        elseif ($sortkey == 'doctorName')
            $sortkey = 'U.firstName';
        else
            $sortkey = 'D.' . $sortkey;

        $res = $this->_em->createQueryBuilder()
                        ->select(" U.id as doctorId,CONCAT(U.firstName,CONCAT(' ',CONCAT(U.middleName,CONCAT(' ',U.lastName)))) as doctorName,S.specialtyType as specialty,D.saturday,D.sunday,D.monday,D.tuesday,D.wednesday,D.thursday,D.friday")
                        ->from('Users', 'U')
                        ->leftJoin('DoctorSchedule', 'D', \Doctrine\ORM\Query\Expr\Join::WITH, 'U.id = D.user')
                        ->leftJoin('Specialty', 'S', \Doctrine\ORM\Query\Expr\Join::WITH, 'D.specialty = S.id')
                        ->Where("U.userType = 2 and (" . $where . ")")
                        ->orderBy("$sortkey", "$sorttype")
                        ->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getQuery()->getResult();
        return $res;
    }

    public function getDoctorInfo($doctortId) {
        $res = $this->_em->createQueryBuilder()
                        ->select("U.firstName,U.middleName,U.lastName,S.id as specialty")
                        ->from('Users', 'U')
                        ->leftJoin('DoctorSchedule', 'D', \Doctrine\ORM\Query\Expr\Join::WITH, 'U.id = D.user')
                        ->leftJoin('Specialty', 'S', \Doctrine\ORM\Query\Expr\Join::WITH, 'D.specialty = S.id')
                        ->Where("U.id = $doctortId")
                        ->getQuery()->getResult();
        if (count($res)) {
            $res[0]["status"] = TRUE;
            return $res[0];
        } else {
            return array("status" => FALSE);
        }
    }

    public function saveProducts($data) {
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

    public function deleteProducts($productId) {
        $product = $this->_em->find('Products', $productId);
        if (empty($product)) {
            return false;
        }
        $this->_em->remove($product);
        $this->_em->flush();
        return true;
    }

    public function getAllDoctor() {
        $res = $this->_em->createQueryBuilder()
                        ->select(" U.id as doctorId,CONCAT(U.firstName,CONCAT(' ',CONCAT(U.middleName,CONCAT(' ',U.lastName)))) as doctorName")
                        ->from('Users', 'U')
                        ->leftJoin('DoctorSchedule', 'D', \Doctrine\ORM\Query\Expr\Join::WITH, 'U.id = D.user')
                        ->Where("U.userType = 2")
                        ->getQuery()->getResult();
        return $res;
    }

}
