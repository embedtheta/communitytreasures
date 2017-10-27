<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Admin_order_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getOrdersAfro($per_page,$page){
        $this->db->select('AP.id,AP.grand_total,AP.payment_status,AP.payment_date,AU.firstName,AU.lastName,COUNT(DISTINCT(AOD.productId)) t_product');
        $this->db->from('afro_payment AP');
        $this->db->join('afro_user AU','AU.id = AP.user_id','LEFT');
        $this->db->join('afro_order_detail AOD','AOD.orderPaymentID = AP.id','LEFT');
        $this->db->group_by('AP.id');
        $this->db->order_by('AP.id','DESC');
        $this->db->limit($per_page,$page);
        $sql = $this->db->get();
        return $sql->result();
    }
    
    public function getTotalOrdersAfro(){
        return $this->db->count_all('afro_payment');
    }
    
    public function getOrderDetail($orderId = 0){
        $this->db->select('AP.*,AP.grand_total,AP.payment_status,AP.payment_date,AU.firstName,AU.lastName,
                            AOD.productId,AOD.productName,AOD.productPrice,AOD.productQuantity,AOD.mc_gross,AOD.mc_currency,
                            AOD.subTotal,PF.fileName,CT.city,CON.name');
        $this->db->from('afro_payment AP');
        $this->db->join('afro_user AU','AU.id = AP.user_id','LEFT');
		$this->db->join('city CT','CT.id = AP.shipCity','LEFT');
		$this->db->join('country CON','CON.country_id = AP.shipCountry','LEFT');
        $this->db->join('afro_order_detail AOD','AOD.orderPaymentID = AP.id','LEFT');
        $this->db->join('product_files PF',' PF.productId= AOD.productId AND PF.isMain=1','LEFT');
        $this->db->where('AP.id',$orderId);
        $sql = $this->db->get();
        return $sql->result();
    }
	public function getProductType($productId){
		$this->db->select('product_details.typeOfProduct');
        $this->db->from('product_details');
		$this->db->where('product_details.productID',$productId);
        $query  = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows()>0){
			$productType         = $query->result();
			return $productType[0]->typeOfProduct;
		
		}
	}
}
