<?php
	$var='		<GNO>关联H2010项号</GNO>
				<ITEMNO>海关备案商品编号</ITEMNO>
				<SHELFGOODSNAME>商品上架品名</SHELFGOODSNAME>
				<DESCRIBE>商品描述</DESCRIBE>
				<GOODID>商品货号</GOODID>
				<GOODNAME>申报品名</GOODNAME>
				<SPECIFICATIONS>规格型号</SPECIFICATIONS>
				<BARCODE> HS编码</BARCODE>
				<TAXID>行邮税号</TAXID>
				<SOURCEPRODUCERCOUNTRY>原产国</SOURCEPRODUCERCOUNTRY>
				<COIN>币制</COIN>
				<UNIT>计量单位</UNIT>
				<AMOUNT>申报数量</AMOUNT>
				<GOODPRICE>成交单价</GOODPRICE>
				<ORDERSUM>成交总价</ORDERSUM>
				<FLAG>是否赠品 N:不是 Y:是</FLAG>
				<GOODIDINSP>检验检疫商品备案编号</GOODIDINSP>
				<ORDERID>订单编号</ORDERID>
				<GOODNAMEENGLISH>货物名称(英文)</GOODNAMEENGLISH>
				<WEIGTH>毛重</WEIGTH>
				<WEIGHTUNIT>重量单位代码</WEIGHTUNIT>
				<PACKCATEGORYINSP>包装类型代码(检验检疫)</PACKCATEGORYINSP>
				<WASTERORNOTINSP>废旧标识</WASTERORNOTINSP>
				<REMARKSINSP>备注</REMARKSINSP>
				<COININSP>币制（检验检疫代码）</COININSP>
				<UNITINSP>计量单位（检验检疫代码）</UNITINSP>
				<SRCCOUNTRYINSP>原产国（检验检疫代码）</SRCCOUNTRYINSP>';


				$prex='/<(.*)>(.*)<\/.*>/isU';
				preg_match_all($prex, $var, $regs);
				$i=1;
				foreach($regs[2] as $key=>$val){
					$mkey=strtolower($regs[1][$key]);
	
		
					echo 'if(!$'.'goods["'.$mkey.'"]){'."\r\n".'    $'.'errmsg[]='.'"商品[".$'.'goods["goods_id"]."]:'.$val.'不能为空";'."\r\n".'}'."\r\n";
					/**
						echo '<td width="13%"><div align="right"><strong>'.$val.'</strong></div></td>'."\r\n";
						echo '<td width="20%"><input name="goods[{$customgoods.id}]['.strtolower($regs[1][$key]).']" value="{$customgoods.'.strtolower($regs[1][$key]).'}"></td>'."\r\n";
						if($i%3==0){
							echo '</tr>'."\r\n".'<tr>'."\r\n";
						}
						$i=$i+1;
					**/
				}

		

?>