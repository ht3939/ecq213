<?php 
try {
	$pdo = new PDO('mysql:host=localhost;dbname=yhecq;charset=utf8','root','nariki74',array(PDO::ATTR_EMULATE_PREPARES => false));
	
	$sql_sel = 'SELECT product_id, y1_price, total_price, data_speed_down, datasize, data_speed_up FROM dtb_products WHERE del_flg=0 AND status=1';
	$stmt_sel = $pdo->query($sql_sel);
	$data_list = array();
	$rank1_order_list = array();
	$rank2_order_list = array();
	$rank3_order_list = array();
	$rank4_order_list = array();
	$rank5_order_list = array();
	$rankpoint_order_list = array();
	while($result_sel = $stmt_sel -> fetch(PDO::FETCH_ASSOC)) {
		$data_list[] = array('product_id'=>$result_sel['product_id'],
							'y1_price'=>floatval($result_sel['y1_price']),
							'total_price'=>floatval($result_sel['total_price']),
							'data_speed_down'=>floatval($result_sel['data_speed_down']),
							'datasize'=>floatval($result_sel['datasize']),
							'data_speed_up'=>floatval($result_sel['data_speed_up']),);
		$rank1_order_list[$result_sel['product_id']] = 0;
		$rank2_order_list[$result_sel['product_id']] = 0;
		$rank3_order_list[$result_sel['product_id']] = 0;
		$rank4_order_list[$result_sel['product_id']] = 0;
		$rank5_order_list[$result_sel['product_id']] = 0;
		$rankpoint_order_list[$result_sel['product_id']] = 0;
	}
	
	//y1_price
	$sort_array = array();
	foreach($data_list as $key => $value){
		$sort_array[$key] = $value['y1_price'];
	}
	array_multisort($sort_array, SORT_ASC, $data_list);
	$counter = 0;
	$value_temp = -1;
	foreach($data_list as $data){
		if($value_temp==$data['y1_price']){
			$rank1_order_list[$data['product_id']] = $counter;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}else{
			$rank1_order_list[$data['product_id']] = $counter + 1;
			$counter++;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}
		$value_temp = $data['y1_price'];
	}
	
	//total_price
	$sort_array = array();
	foreach($data_list as $key => $value){
		$sort_array[$key] = $value['total_price'];
	}
	array_multisort($sort_array, SORT_ASC, $data_list);
	$counter = 0;
	$value_temp = -1;
	foreach($data_list as $data){
		if($value_temp==$data['total_price']){
			$rank2_order_list[$data['product_id']] = $counter;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
			
		}else{
			$rank2_order_list[$data['product_id']] = $counter + 1;
			$counter++;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}
		$value_temp = $data['total_price'];
	}
	
	//data_speed_down
	$sort_array = array();
	foreach($data_list as $key => $value){
		$sort_array[$key] = $value['data_speed_down'];
	}
	array_multisort($sort_array, SORT_DESC, $data_list);
	$counter = 0;
	$value_temp = -1;
	foreach($data_list as $data){
		if($value_temp==$data['data_speed_down']){
			$rank3_order_list[$data['product_id']] = $counter;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}else{
			$rank3_order_list[$data['product_id']] = $counter + 1;
			$counter++;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}
		$value_temp = $data['data_speed_down'];
	}
	
	//datasize
	$sort_array = array();
	foreach($data_list as $key => $value){
		$sort_array[$key] = $value['datasize'];
	}
	array_multisort($sort_array, SORT_DESC, $data_list);
	$counter = 0;
	$value_temp = -1;
	foreach($data_list as $data){
		if($value_temp==$data['datasize']){
			$rank4_order_list[$data['product_id']] = $counter;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}else{
			$rank4_order_list[$data['product_id']] = $counter + 1;
			$counter++;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}
		$value_temp = $data['datasize'];
	}
	
	//data_speed_up
	$sort_array = array();
	foreach($data_list as $key => $value){
		$sort_array[$key] = $value['data_speed_up'];
	}
	array_multisort($sort_array, SORT_DESC, $data_list);
	$counter = 0;
	$value_temp = -1;
	foreach($data_list as $data){
		if($value_temp==$data['data_speed_up']){
			$rank5_order_list[$data['product_id']] = $counter;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}else{
			$rank5_order_list[$data['product_id']] = $counter + 1;
			$counter++;
			if($counter<6){
				$rankpoint_order_list[$data['product_id']] += (6-$counter);
			}else{
				$rankpoint_order_list[$data['product_id']] += 1;
			}
		}
		$value_temp = $data['data_speed_up'];
	}

	foreach($data_list as $data){
		$sql_upd = 'update dtb_products set rank1_order = '.$rank1_order_list[$data['product_id']].', '.
			'rank2_order = '.$rank2_order_list[$data['product_id']].', '.
			'rank3_order = '.$rank4_order_list[$data['product_id']].', '.
			'rank4_order = '.$rank3_order_list[$data['product_id']].', '.
			'rank5_order = '.$rank5_order_list[$data['product_id']].', '.
			'rankpoint_order = '.($rankpoint_order_list[$data['product_id']]/5).' where product_id = '.$data['product_id'];
		$stmt_upd = $pdo -> prepare($sql_upd);
		$stmt_upd->execute();
	}
	
} catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}

$pdo = null;
echo 'ランキング更新完了<br>';
exit;