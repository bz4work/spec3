<?php
//������ ��� �������� ����������� ���������� ��������
$res_query = array();
for ($i = 0 ; $i < $arr['count']; ++$i){
			/****** ��������� ������� ������ ******/
			$model = $test_obj->clearData($_POST["model_$i"]);
			$man = $test_obj->clearData($_POST["man_$i"]);
			$price = $test_obj->clearData($_POST["price_$i"]);
			$ah = $test_obj->clearData($_POST["ah_$i"]);
			$polar = $test_obj->clearData($_POST["polar_$i"]);
			$korpus = $test_obj->clearData($_POST["box_type_$i"]);
			$size = $test_obj->clearData($_POST["size_$i"]);
			$tok = $test_obj->clearData($_POST["tok_$i"]);
			/****** ��������� ������� ������ ******/
			
			
			/*************** ���������� ������ � ������� product - start ******************/
			/*************** �������� ����������� �������� ������� ************************
			** ����� product ��������� ��������:
			** 1e-��� ������, 2�-�������������, 3�-����
			** �� ������������� ���������:
			** 4�-���������� (default:99), 5�-����������(default:1000), 
			** 6�-������ ������� (default:7 - � �������), 7�-�������� (1) ��� ��������� (0) ��� ������ (default:0-�� ���������� �� �����)
			/*************** �������� ����������� �������� ������� ************************/
		
			$sql_product = $sql_obj->product($model, $man, $price);

			if ($test_obj->IncDB($sql_product)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product</b>  OK.<br><br>";
			}else{
				$res_query[] = $test_obj->IncDB($sql_product);
			}
			/*************** ���������� ������ � ������� product - end ******************/
	
			$prod_id = $test_obj->get_prod_id();
			
			/*************** ���������� ������ � ������� product_attribute - start ******************/
			$sql_prod_attr = $sql_obj->product_attr($ah, $polar, $korpus, $size, $tok, $prod_id);

			if ($test_obj->IncDB($sql_prod_attr)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product_attribute</b>.  OK<br><br>";
			}else{
				$res_query[] = $test_obj->IncDB($sql_prod_attr);
			}
			/*************** ���������� ������ � ������� product_attribute - end ******************/
			
			
			
			/*************** ���������� ������ � ������� product_to_category - start ******************/			
			$sql_prod_to_cat = $sql_obj->product_to_category($prod_id);
			
			if ($test_obj->IncDB($sql_prod_to_cat)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product_to_category</b>  OK.<br><br>";
			}else{
				$res_query[] = "�� ���������: ".$test_obj->IncDB($sql_prod_to_cat);
			}
			/*************** ���������� ������ � ������� product_attribute - end ******************/
			
			
			
			/*************** ���������� ������ � ������� product_to_layout - start ******************/			
			$sql_prod_to_lay = $sql_obj->product_to_layout($prod_id);

			if ($test_obj->IncDB($sql_prod_to_lay)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product_to_layout</b>  OK.<br><br>";
			}else{
				$res_query[] = $test_obj->IncDB($sql_prod_to_lay);
			}
			/*************** ���������� ������ � ������� product_to_layout - end ******************/
			
			
			
			/*************** ���������� ������ � ������� product_to_store - start ******************/			
			$sql_prod_to_store = $sql_obj->product_to_store($prod_id);

			if ($test_obj->IncDB($sql_prod_to_store)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product_to_store</b>  OK.<br><br>";
			}else{
				$res_query[] = $test_obj->IncDB($sql_prod_to_store);
			}
			/*************** ���������� ������ � ������� product_to_store - end ******************/
			
			
			/*************** ���������� ������ � ������� product_description - start ******************/	
			$name = $test_obj->clearData($_POST["name_$i"]);
			$text = $test_obj->clearData($_POST["text_$i"]);
			$m_title = $test_obj->clearData($_POST["mtitle_$i"]);
			$m_descr = $test_obj->clearData($_POST["mdescr_$i"]);
			
			$sql_prod_desc = $sql_obj->sql_prod_desc($prod_id, $name, $text, $m_title, $m_descr);

			if ($test_obj->IncDB($sql_prod_desc)){
				$res_query[] = "����� <b>".$_POST["name_$i"]."</b>. ��������� � ������� <b>product_description</b>  OK.<br><br>";
			}else{
				$res_query[] = $test_obj->IncDB($sql_prod_desc);
			}
			/*************** ���������� ������ � ������� product_description - end ******************/
			
			$res_query[] = "<hr color = 'green'>";
}//������ ��������� ����� FOR
$_SESSION['rq'] = $res_query;
header ('Location: index-mass-oop.php');


?>