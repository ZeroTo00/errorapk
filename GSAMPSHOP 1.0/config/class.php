<?php
require 'connect.php';
class classweb_bypluem{
    function __construct()
	{
		$this->db = database();
	}
    public function login($username,$password){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE username = :username AND password = :password");
		$stmt->execute([':username'=>$username,':password'=>$password]);
		$result = $stmt->fetch();
		if ($stmt->RowCount() > 0) {
			$_SESSION['id'] = $result['id'];
			$_SESSION['username'] = $result['username'];
            echo json_encode(array('status'=>"success",'message'=>"เข้าสู่ระบบสำเร็จ")); 
		}else{
			echo json_encode(array('status'=>"error",'message'=>"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง"));
		}
    }
	public function register($username,$password){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE username = :username");
		$stmt->execute([':username'=>$username]);
		if ($stmt->RowCount() > 0) {
			echo json_encode(array('status'=>"error",'message'=>"มีชื่อผู้ใช้นี้แล้ว"));
		}else{
			$inseart = $this->db->prepare("INSERT INTO `tbl_username` (`username`, `password`,`date`) VALUES (:username, :password,CURRENT_TIMESTAMP);");
			try {
				$inseart->execute([':username'=>$username,':password'=>$password]);
				$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE username = :username");
				$stmt->execute([':username'=>$username]);
				$result = $stmt->fetch();
				$_SESSION['id'] = $result['id'];
				$_SESSION['username'] = $result['username'];
				echo json_encode(array('status'=>"success",'message'=>"สมัครสมาชิกสำเร็จ"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
    public function resultuser(){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE id = :id");
		$stmt->execute([':id'=>$_SESSION['id']]);
		$result = $stmt->fetch();
		return $result;
	}
	public function web_config(){
		$stmt = $this->db->prepare("SELECT * FROM web_config WHERE id = '1'");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function topup($link_topup){
		$web_config = $this->web_config();
		$phone = $web_config['phone'];
		$curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.xpluem.com/'.$link_topup.'/'.$phone,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($response);

		$codestatus = $result->code;
		$message = $result->message;
		$status = $result->status;
		if ($codestatus =="200"){
			$amount = $result->data->amount;
			$name = $result->data->name;
			$update = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
			$inserttopup = $this->db->prepare("INSERT INTO `history_topup` (`username`, `name`, `amount`, `link`, `date`) VALUES (:username, :name, :amount, :link, CURRENT_TIMESTAMP);");
			try {
				$inserttopup->execute([':username'=>$_SESSION['username'], ':name'=>$name, ':amount'=>$amount,':link'=>$link_topup]);
				$update->execute([':point'=>$amount,':id'=>$_SESSION['id']]);
				echo json_encode(array('status'=>$status,'message'=>$message));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}else{
			echo json_encode(array('status'=>$status,'message'=>$message));
		}
	}
	public function password($old_password,$new_password){
		$resultuser = $this->resultuser();
		if($resultuser['password'] == $old_password){
			$stmt = $this->db->prepare("UPDATE tbl_username SET password = :password WHERE id = :id");
			try {
				$stmt->execute([':password'=>$new_password,':id'=>$_SESSION['id']]);
				echo json_encode(array('status'=>"success",'message'=>"เปลี่ยนรหัสผ่านสำเร็จ"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}else{
			echo json_encode(array('status'=>"error",'message'=>"รหัสผ่านเก่าไม่ถูกต้อง"));
		}
	}
	public function show_card_product(){
		$stmt = $this->db->prepare("SELECT * FROM card_product");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function totalproduct($id_card){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM stock_id WHERE id_card = :id_card AND username_buy = '0'");
		$stmt->execute(['id_card'=>$id_card]);
		$result = $stmt->fetch();
		return $result;
	}
	public function allproduct(){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM stock_id");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function soldproduct(){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM stock_id WHERE username_buy != '0'");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function readyproduct(){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM stock_id WHERE username_buy = '0'");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function buyproduct($id_card){
		$resultuser = $this->resultuser();
		$card = $this->db->prepare("SELECT * FROM card_product WHERE id = :id");
        $card->execute([':id'=>$id_card]);
        $resultcard = $card->fetch();

		$stmtstock = $this->db->prepare("SELECT count(id) as total FROM stock_id WHERE id_card = :id_card AND username_buy = '0'");
		$stmtstock->execute(['id_card'=>$id_card]);
		$resultstock = $stmtstock->fetch();
		if($resultstock['total'] == 0){
			echo json_encode(array('status'=>"error",'message'=>"สินค้าหมด"));
		}else{
			if($resultuser['point'] < $resultcard['price']){
				echo json_encode(array('status'=>"error",'message'=>"ยอดเงินไม่เพียงพอ"));
			}else{
				$stmt = $this->db->prepare("SELECT * FROM stock_id WHERE id_card = :id_card AND username_buy = '0' LIMIT 1");
				$stmt->execute([':id_card'=>$id_card]);
				$result = $stmt->fetch();
				$updatepoint = $this->db->prepare("UPDATE `tbl_username` SET `point`= point - :point WHERE id = :id");
				$history_shop = $this->db->prepare("INSERT INTO `history_shop` (`username`, `name`, `details`, `price`, `date`) VALUES (:username, :name, :details, :price, CURRENT_TIMESTAMP);");
				$updatestock = $this->db->prepare("UPDATE `stock_id` SET `username_buy`= :username_buy WHERE id = :id");
				try {
					$updatepoint->execute([':point'=>$resultcard['price'],':id'=>$_SESSION['id']]);
					$history_shop->execute([':username'=>$_SESSION['username'],':name'=>$resultcard['name'],':details'=>$result['details'],':price'=>$resultcard['price']]);
					$updatestock->execute([':username_buy'=>$_SESSION['username'],':id'=>$result['id']]);
					echo json_encode(array('status'=>"success",'message'=>"ซื้อสินค้าสำเร็จ"));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}
		}
	}
	public function history_shop(){
		$stmt = $this->db->prepare("SELECT * FROM history_shop WHERE username = :username");
		$stmt->execute([':username'=>$_SESSION['username']]);
		$result = $stmt->fetchAll();
		return $result;
	}
	public function show_card_other(){
		$stmt = $this->db->prepare("SELECT * FROM card_other");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function show_card_productlimit(){
		$stmt = $this->db->prepare("SELECT * FROM card_product ORDER BY id DESC LIMIT 3");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function show_stock_item($id_card_other){
		$stmt = $this->db->prepare("SELECT * FROM stock_item WHERE id_card_other = :id_card_other");
		$stmt->execute([':id_card_other'=>$id_card_other]);
		$result = $stmt->fetchAll();
		return $result;
	}
	public function history_termgame(){
		$stmt = $this->db->prepare("SELECT * FROM history_termgame WHERE username = :username");
		$stmt->execute([':username'=>$_SESSION['username']]);
		$result = $stmt->fetchAll();
		return $result;
	}
	public function termgame($id_item,$username_tm,$password_tm){
		$resultuser = $this->resultuser();
		$card = $this->db->prepare("SELECT * FROM stock_item WHERE id = :id");
        $card->execute([':id'=>$id_item]);
        $resultcard = $card->fetch();
		if($resultuser['point'] < $resultcard['price']){
			echo json_encode(array('status'=>"error",'message'=>"ยอดเงินไม่เพียงพอ"));
		}else{
			$updatepoint = $this->db->prepare("UPDATE `tbl_username` SET `point`= point - :point WHERE id = :id");
			$termgame = $this->db->prepare("INSERT INTO `history_termgame` (`username`, `username_tm`, `password_tm`, `details`, `price`, `date`) VALUES (:username, :username_tm, :password_tm, :details, :price,CURRENT_TIMESTAMP);");
			try {
				$updatepoint->execute([':point'=>$resultcard['price'],':id'=>$_SESSION['id']]);
				$termgame->execute([':username'=>$_SESSION['username'],':username_tm'=>$username_tm,':password_tm'=>$password_tm,':details'=>$resultcard['details'],':price'=>$resultcard['price']]);
				echo json_encode(array('status'=>"success",'message'=>"ซื้อสินค้า ".$resultcard['details']." สำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function code($pass_code){
		$stmt = $this->db->prepare("SELECT * FROM stock_code WHERE code = :code");
		$stmt->execute([':code'=>$pass_code]);
		$result = $stmt->fetch();
		$stmt1 = $this->db->prepare("SELECT * FROM history_code WHERE code = :code AND username = :username");
		$stmt1->execute([':code'=>$pass_code,':username'=>$_SESSION['username']]);
		if ($stmt1->RowCount() > 0) {
			echo json_encode(array('status'=>"error",'message'=>'ท่านเคยใช้โค๊ดนี้ไปแล้ว'));
		}else{
			if ($pass_code == $result['code']){
				if ($result['amount'] == 0){
					echo json_encode(array('status'=>"error",'message'=>'โค๊ดถูกใช้งานหมดแล้ว'));
				}else{
					$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = (point + :point) WHERE id = :id");
					$updateamount = $this->db->prepare("UPDATE stock_code SET amount = (amount - 1) WHERE code = :code");
					$inseart = $this->db->prepare("INSERT INTO `history_code` (`username`, `code`, `amount`, `date`) VALUES (:username, :code, :amount,CURRENT_TIMESTAMP);");
					try {
						$updatepoint->execute([':point'=>$result['point'],':id'=>$_SESSION['id']]);
						$updateamount->execute([':code'=>$pass_code]);
						$inseart->execute([':username'=>$_SESSION['username'],':code'=>$pass_code,':amount'=>$result['point']]);
						echo json_encode(array('status'=>"success",'message'=>"แลกโค๊ด สำเร็จ ".$result['point']." บาท!!"));
					} catch (Exception $e) {
						echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
					}
				}
			}else{
				echo json_encode(array('status'=>"error",'message'=>'ไม่มีรหัสโค๊ดที่ท่านกรอกอยู่ในระบบ'));
			}
		}
	}
	public function gamespin(){
		$resultuser = $this->resultuser();
		$pointgame = 20;
		if($resultuser['point'] < $pointgame){
			echo json_encode(array('status1'=>"error",'title1'=>"เกิดข้อผิดพลาด",'message1'=>"ยอดเงินคงเหลือไม่เพียงพอ"));
		}else{
			$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point - :point WHERE id = :id");
			$updatepoint->execute([':point'=>$pointgame,':id'=>$_SESSION['id']]);
			$choices = [
				'a' => 50,
				'b' => 0,
				'c' => 0,
				'd' => 0,
				'e' => 0,
				'f' => 0,
				'g' => 50,
			];
			$total = array_sum($choices);
			$percent = rand(0, $total * 100) / 100;
			$award = null;
			$carry = 0;
			foreach ($choices as $key => $value) {
				$high = $carry + $value;
				$low = $carry;
				if ($percent > $low && $percent <= $high) {
					$award = $key;
					break;
				}
				$carry += $value;
			
			}
			if($award == "a"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"5",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 5 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 5 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "b"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"50",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 50 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 50 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "c"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"100",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 100 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 100 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "d"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"300",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 300 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 300 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "e"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"500",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 500 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 500 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "f"){
				$updatepoint = $this->db->prepare("UPDATE tbl_username SET point = point + :point WHERE id = :id");
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$updatepoint->execute([':point'=>"1000",':id'=>$_SESSION['id']]);
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณได้รับ 1,000 เครดิต"]);
					echo json_encode(array('status'=>"success",'title'=>"ยินดีด้วย",'message'=>"คุณได้รับ 1,000 เครดิต",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}elseif($award == "g"){
				$inseart = $this->db->prepare("INSERT INTO `history_random` (`username`, `details`, `date`) VALUES (:username, :details,CURRENT_TIMESTAMP);");
				try {
					$inseart->execute([':username'=>$_SESSION['username'],':details'=>"คุณไม่ได้รับรางวัล"]);
					echo json_encode(array('status'=>"error",'title'=>"เสียใจด้วย",'message'=>"คุณไม่ได้รับรางวัล",'spin_value'=>$award));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}
		}
	}
	public function history_random(){
		$stmt = $this->db->prepare("SELECT * FROM history_random WHERE username = :username");
		$stmt->execute([':username'=>$_SESSION['username']]);
		$result = $stmt->fetchAll();
		return $result;
	}
}
class classadmin_bypluem{
	function __construct()
	{
		$this->db = database();
	}
	public function resultuser(){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE id = :id");
		$stmt->execute([':id'=>$_SESSION['id']]);
		$result = $stmt->fetch();
		return $result;
	}
	public function totaluser(){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM tbl_username");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function totaltopup(){
		$stmt = $this->db->prepare("SELECT sum(amount) as total FROM history_topup");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function history_topup(){
		$stmt = $this->db->prepare("SELECT * FROM history_topup");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function history_shop(){
		$stmt = $this->db->prepare("SELECT * FROM history_shop");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function history_termgame(){
		$stmt = $this->db->prepare("SELECT * FROM history_termgame");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function termgame_success($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$stmt = $this->db->prepare("SELECT * FROM history_termgame WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$result = $stmt->fetch();
			if($result['status'] != "1"){
				$updatepoint = $this->db->prepare("UPDATE `history_termgame` SET `status`= '1' WHERE id = :id");
				try {
					$updatepoint->execute([':id'=>$id]);
					echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}else{
				echo json_encode(array('status'=>"error",'message'=>"ท่านได้บันทึกข้อมูลไปแล้ว"));
			}
		}
	}
	public function termgame_not_success($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$stmt = $this->db->prepare("SELECT * FROM history_termgame WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$result = $stmt->fetch();
			if($result['status'] != "2"){
				$updatepoint = $this->db->prepare("UPDATE `history_termgame` SET `status`= '2' WHERE id = :id");
				try {
					$updatepoint->execute([':id'=>$id]);
					echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}else{
				echo json_encode(array('status'=>"error",'message'=>"ท่านได้บันทึกข้อมูลไปแล้ว"));
			}
		}
	}
	public function show_userAll(){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function del_user($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_user = $this->db->prepare("DELETE FROM `tbl_username` WHERE id = :id");
			$del_user->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบผู้ใช้สำเร็จ"));
		}
	}
	public function show_user_id($id){
		$stmt = $this->db->prepare("SELECT * FROM tbl_username WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}
	public function edit_user($id,$username_ed,$password_ed,$point_ed,$class_ed){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$updatepoint = $this->db->prepare("UPDATE `tbl_username` SET `username`= :username, password = :password, point = :point, class = :class WHERE id = :id");
			try {
				$updatepoint->execute([':username'=>$username_ed,':password'=>$password_ed,':point'=>$point_ed,':class'=>$class_ed,':id'=>$id]);
				echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function show_card_product(){
		$stmt = $this->db->prepare("SELECT * FROM card_product");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function totalproduct($id_card){
		$stmt = $this->db->prepare("SELECT count(id) as total FROM stock_id WHERE id_card = :id_card AND username_buy = '0'");
		$stmt->execute(['id_card'=>$id_card]);
		$result = $stmt->fetch();
		return $result;
	}
	public function del_product($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_product = $this->db->prepare("DELETE FROM `card_product` WHERE id = :id");
			$del_product->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบสินค้าสำเร็จ"));
		}
	}
	public function add_product($name,$image,$price,$details){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$inseart = $this->db->prepare("INSERT INTO `card_product` (`name`, `image`, `price`, `details`) VALUES (:name, :image, :price, :details);");
			try {
				$inseart->execute([':name'=>$name,':image'=>$image,':price'=>$price,':details'=>$details]);
				echo json_encode(array('status'=>"success",'message'=>"เพิ่มข้อมูลสำเร็จ"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function show_product_id($id){
		$stmt = $this->db->prepare("SELECT * FROM card_product WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}
	public function edit_product($name,$image,$price,$details,$id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$edit_product = $this->db->prepare("UPDATE `card_product` SET `name`= :name, image = :image, price = :price, details = :details WHERE id = :id");
			try {
				$edit_product->execute([':name'=>$name,':image'=>$image,':price'=>$price,':details'=>$details,':id'=>$id]);
				echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function add_stock_id($details,$id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$string = preg_replace('~\R~u', "\n", $details);
			$exp_lines = explode("\n", $string);
			foreach ($exp_lines as $each_line) {
				$inseart = $this->db->prepare("INSERT INTO `stock_id` (`details`, `id_card`) VALUES (:details, :id_card);");
				$inseart->execute([':details'=>$each_line,':id_card'=>$id]);
			}
			echo json_encode(array('status'=>"success",'message'=>"เพิ่มข้อมูลสำเร็จ"));
		}
	}
	public function stock_id_id($id){
		$stmt = $this->db->prepare("SELECT * FROM stock_id WHERE id_card = :id_card AND username_buy = '0'");
		$stmt->execute([':id_card'=>$id]);
		$result = $stmt->fetchAll();
		return $result;
	}
	public function del_stock_id($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_product = $this->db->prepare("DELETE FROM `stock_id` WHERE id = :id");
			$del_product->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบสินค้าสำเร็จ"));
		}
	}
	public function show_web_config(){
		$stmt = $this->db->prepare("SELECT * FROM web_config WHERE id = '1'");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	public function show_card_other(){
		$stmt = $this->db->prepare("SELECT * FROM card_other");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function show_stock_item($id){
		$stmt = $this->db->prepare("SELECT * FROM stock_item WHERE id_card_other = :id_card_other");
		$stmt->execute([':id_card_other'=>$id]);
		$result = $stmt->fetchAll();
		return $result;
	}
	public function add_stock_item($details,$price,$image,$id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$inseart = $this->db->prepare("INSERT INTO `stock_item` (`details`, `price`, `image`, `id_card_other`) VALUES (:details, :price, :image, :id_card_other);");
			try {
				$inseart->execute([':details'=>$details,':price'=>$price,':image'=>$image,':id_card_other'=>$id]);
				echo json_encode(array('status'=>"success",'message'=>"เพิ่มข้อมูลสำเร็จ"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function del_stock_item($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_product = $this->db->prepare("DELETE FROM `stock_item` WHERE id = :id");
			$del_product->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบสินค้าสำเร็จ"));
		}
	}
	public function show_edit_stock_id($id){
		$stmt = $this->db->prepare("SELECT * FROM stock_item WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}
	public function edit_stock_id($details,$price,$image,$id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$edit_product = $this->db->prepare("UPDATE `stock_item` SET `details`= :details, price = :price, image = :image WHERE id = :id");
			try {
				$edit_product->execute([':details'=>$details,':price'=>$price,':image'=>$image,':id'=>$id]);
				echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function del_card_other($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_product = $this->db->prepare("DELETE FROM `card_other` WHERE id = :id");
			$del_product->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบสินค้าสำเร็จ"));
		}
	}
	public function add_card_other($image){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$inseart = $this->db->prepare("INSERT INTO `card_other` (`image`) VALUES (:image);");
			try {
				$inseart->execute([':image'=>$image]);
				echo json_encode(array('status'=>"success",'message'=>"เพิ่มข้อมูลสำเร็จ"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function settings_web($title,$logo,$phone,$contact,$image1,$image2,$image3,$news){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$settings_web = $this->db->prepare("UPDATE `web_config` SET `title`= :title, logo = :logo, phone = :phone, contact = :contact, image1 = :image1, image2 = :image2, image3 = :image3, news = :news WHERE id = '1'");
			try {
				$settings_web->execute([':title'=>$title,':logo'=>$logo,':phone'=>$phone,':contact'=>$contact,':image1'=>$image1,':image2'=>$image2,':image3'=>$image3,':news'=>$news]);
				echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function show_edit_card_other($id){
		$stmt = $this->db->prepare("SELECT * FROM card_other WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}
	public function edit_image_card_other($image,$id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$settings_web = $this->db->prepare("UPDATE `card_other` SET `image`= :image WHERE id = :id");
			try {
				$settings_web->execute([':image'=>$image,':id'=>$id]);
				echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
			} catch (Exception $e) {
				echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
			}
		}
	}
	public function history_random(){
		$stmt = $this->db->prepare("SELECT * FROM history_random");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function show_code(){
		$stmt = $this->db->prepare("SELECT * FROM stock_code");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function add_code($code,$point,$amount){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$stmt = $this->db->prepare("SELECT * FROM stock_code WHERE code = :code");
			$stmt->execute([':code'=>$code]);
			if ($stmt->RowCount() > 0) {
				echo json_encode(array('status'=>"error",'message'=>"มีโค๊ดนี้ในระบบแล้ว"));
			}else{
				$inseart = $this->db->prepare("INSERT INTO `stock_code` (`code`, `point`,`amount`) VALUES (:code, :point, :amount);");
				try {
					$inseart->execute([':code'=>$code,':point'=>$point,':amount'=>$amount]);
					echo json_encode(array('status'=>"success",'message'=>"บันทึกข้อมูลสำเร็จ!"));
				} catch (Exception $e) {
					echo json_encode(array('status'=>"error",'message'=>$e->getmessage()));
				}
			}
		}
	}
	public function del_code($id){
		$resultuser = $this->resultuser();
		if($resultuser['class'] != "1"){
			echo json_encode(array('status'=>"error",'message'=>"ไม่ใช่แอดมิน"));
		}else{
			$del_code = $this->db->prepare("DELETE FROM `stock_code` WHERE id = :id");
			$del_code->execute([':id'=>$id]);
			echo json_encode(array('status'=>"success",'message'=>"ลบโค๊ดสำเร็จ"));
		}
	}
}
?>