<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (APPPATH . "models/Entities/DoctorSchedule.php");
require_once (APPPATH . "models/Entities/Specialty.php");

class Mod_specialty extends CI_Model {

    private $_em;

    public function __construct() {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    public function getAllSpecialty() {
        $res = $this->_em->createQueryBuilder()
                        ->select(" S.id as id,S.specialtyType as name")
                        ->from('Specialty', 'S')
                        ->orderBy("S.specialtyType", "asc")
                        ->getQuery()->getResult();
        return $res;
    }

    public function search($gridParameters) {
        $jqGrid = new jqGridClass();
        if ($gridParameters != null) {
            if ($gridParameters['_search'] == "true") {
                $objArr = json_decode($gridParameters['filters']);
                $where = '';
                if (!empty($objArr->rules)) {
                    foreach ($objArr->rules as $key) {
                        if ($key->field == 'specialtyType' && !NULL)
                            $key->field = 'S.' . $key->field;
                        else
                            continue;
                        $where .= $jqGrid->convertSrchStrToSQL($key->field, $key->op, $key->data) . ' & ';
                    }
                    $where = substr($where, 0, -2);
                } elseif (empty($gridParameters['filters'])) {   //if the sent request was Find
                    $gridParameters['searchField'] = 'S.' . $gridParameters['searchField'];

                    $field = $gridParameters['searchField'];
                    $searchOp = $gridParameters['searchOper'];
                    $searchStr = $gridParameters['searchString'];
                    $where = $jqGrid->convertSrchStrToSQL($field, $searchOp, pg_escape_string($searchStr));
                }
            } else {
                $where = "1=1";
            }

            $count = $this->getSpecialtyCount($where);
            $arrPaginate = $jqGrid->paginateGrid($count, $gridParameters['page'], $gridParameters['rows']);
            $query = $this->getSpecialtyData($gridParameters['sidx'], $gridParameters['sord'], $gridParameters['rows'], $arrPaginate['offset'], $where);
            return array('rows' => (array) $query, 'page' => $arrPaginate['page'], 'total' => $arrPaginate['total_pages'], 'records' => $count);
        }
        return false;
    }

    public function getSpecialtyCount($where = "1=1") {
        $count = $this->_em->createQueryBuilder()
                        ->select('count(S.id) specialtyId')
                        ->from('Specialty', 'S')
                        ->Where($where)->getQuery()->getResult();

        return $count[0]['specialtyId'];
    }

    public function getSpecialtyData($sortkey, $sorttype, $limit, $offset, $where) {
        $sortkey = 'S.' . $sortkey;

        $res = $this->_em->createQueryBuilder()
                        ->select('S.id as specialtyId, S.specialtyType')
                        ->from('Specialty', 'S')
                        ->Where($where)
                        ->orderBy("$sortkey", "$sorttype")
                        ->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getQuery()->getResult();
        return $res;
    }

    public function saveSpecialty($data) {
        if ($data['specialtyId'] != NULL || $data['specialtyId'] != '') {
            $specialty = $this->_em->find('Specialty', $data['specialtyId']);
            unset($data['specialtyId']);
        } else {
            $specialty = new Specialty();
            unset($data['specialtyId']);
        }
        $specialty->setSpecialtyType($data['specialtyName']);
        $this->_em->persist($specialty);
        $this->_em->flush();
        if ($specialty->getId())
            return TRUE;
        return FALSE;
    }

}
