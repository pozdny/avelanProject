<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 30.09.14
 * Time: 14:19
 */
function catalog_pos2(){
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    global $smarty;
    $pos1 = $arResult->POS1;
    $pos2 = $arResult->POS2;
    $html = '';
    $query = "SELECT *
			  FROM ".CATALOG_MENU."
			  WHERE ".CATALOG_MENU.".eng LIKE '".$pos1."'
			  AND ".CATALOG_MENU.".eng NOT LIKE 'default%'";
    $mysqli->_execute($query);
    $row_err = $mysqli->fetch();
    $query = "SELECT *
			  FROM ".CATALOG_SUBMENU."
			  WHERE ".CATALOG_SUBMENU.".eng LIKE '".$pos2."'
			  AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'";
    $mysqli->_execute($query);
    $row_err2 = $mysqli->fetch();
    if($row_err == 0)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    elseif($row_err2 == 0)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    else
    {
        $query = 'SELECT '.CATALOG_SUBMENU.'.id, '.CATALOG_SUBMENU.'.content FROM '.CATALOG_SUBMENU.'
				  WHERE '.CATALOG_SUBMENU.'.eng LIKE "'.$pos2.'"';
        $mysqli->_execute($query);
        $row_c = $mysqli->fetch();

        $query = 'SELECT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.title,  '.CATALOG_ALL.'.eng AS pos3, '.CATALOG_SUBMENU.'.eng AS pos2 FROM '.CATALOG_ALL.'
	              INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_ALL.'.submenu_id = '.CATALOG_SUBMENU.'.id
				  WHERE '.CATALOG_SUBMENU.'.eng LIKE "'.$pos2.'"
				  AND '.CATALOG_ALL.'.eng NOT LIKE "default%"';
        $mysqli->_execute($query);
        $s = $mysqli->queryQ($query);
        $num_s = $mysqli->num_rows();
        if($num_s >0)
        {
            $html.= '<hr><ul class="ul_total">'."\n";
            while($row_s = $mysqli->fetchAssoc($s))
            {
                $pos2 = $row_s['pos2'];
                $pos3 = $row_s['pos3'];
                $title_elem = $row_s['title'];
                $html.= '<li><a href="/catalog/'.$pos1.'/'.$pos2.'/'.$pos3.'" '.STYLE6.'>'.$title_elem.'</a></li>'."\n";
            }
            $html.= '</ul><hr>'."\n";
        }

        $query = 'SELECT * FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$row_c["id"].' AND '.TABLE_IMAGES.'.img !="empty.jpg"  LIMIT 1';
        $mysqli->_execute($query);
        $row_img = $mysqli->fetch();
        $image = '';
        if($row_img > 0)
        {
            $link  = '<a href="/'.PATH_IMG_GLOB.FindImg($row_img['img'], 'catalog/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'" ><div class="lupa"></div></a>';
            $img = "<img src='/".PATH_IMG_SMALL.FindImg($row_img['img'], 'catalog/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."'>";
            $name = 'img_block_onecat';
            $smarty->assign('name', $name);
            $smarty->assign('link', $link);
            $smarty->assign('img', $img);
            $image = $smarty->fetch('inner-tpl/catalog-single-photo.tpl');
        }

        $content = print_page($row_c["content"]);
        $smarty->assign('image', $image);
        $smarty->assign('content', $content);
        $html.= $smarty->fetch('inner-tpl/catalog-pos2.tpl');

        return $html;
    }
}
function catalog_pos3()
{
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    global $smarty;
    $pos1 = $arResult->POS1;
    $pos2 = $arResult->POS2;
    $pos3 = $arResult->POS3;
    $query = "SELECT *
			  FROM ".CATALOG_MENU."
			  WHERE ".CATALOG_MENU.".eng LIKE '".$pos1."'
			  AND ".CATALOG_MENU.".eng NOT LIKE 'default%'";
    $mysqli->_execute($query);
    $row_err = $mysqli->fetch();
    $query = "SELECT *
			  FROM ".CATALOG_SUBMENU."
			  WHERE ".CATALOG_SUBMENU.".eng LIKE '".$pos2."'
			  AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'";
    $mysqli->_execute($query);
    $row_err2 = $mysqli->fetch();
    $query = "SELECT *
			  FROM ".CATALOG_ALL."
			  WHERE ".CATALOG_ALL.".eng LIKE '".$pos3."'
			  AND ".CATALOG_ALL.".eng NOT LIKE 'default%'";
    $mysqli->_execute($query);
    $row_err3 = $mysqli->fetch();

    if($row_err == 0)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    elseif($row_err2 == 0)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    elseif($row_err3 == 0)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    else
    {
        $content = '';
        $html = '';
        if($pos1 !='rashodnyye-materialy')
        {
            $query = 'SELECT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.title, '.CATALOG_ALL.'.content, '.CATALOG_ALL.'.content2  FROM '.CATALOG_ALL.' WHERE '.CATALOG_ALL.'.eng LIKE "'.$pos3.'"';
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $id = $row['id'];
            if($row['content'] !='')
            {
                $html= '<div class="cat_text">'.print_page($row['content']).'</div>'."\n";
            }
            if ($mysqli->num_rows() > 0)
            {

                $query = 'SELECT * FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$id.' AND line_id = 0 ORDER BY id ASC';
                $mysqli->_execute($query);
                $block_single = '';
                if($mysqli->num_rows() > 0)
                {
                    $block_img = '';

                    if($mysqli->num_rows() > 1)
                    {
                        $rel = 'data-fancybox-group="gellery"';
                    }
                    else
                    {
                        $rel = '';
                    }
                    while($row_img = $mysqli->fetch())
                    {
                        $link  = '<a href="/'.PATH_IMG_GLOB.FindImg($row_img['img'], 'catalog/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'" '.$rel.'><div class="lupa" ></div></a>';
                        $img = "<img src='/".PATH_IMG_SMALL.FindImg($row_img['img'], 'catalog/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."' >";
                        $name = 'img_block_one';
                        $title = $row_img['img_title'];
                        $smarty->assign('img', $img);
                        $smarty->assign('link', $link);
                        $smarty->assign('name', $name);
                        $smarty->assign('title', $title);
                        $block_img.= $smarty->fetch('inner-tpl/catalog-img-block.tpl');


                    }
                    $smarty->assign('content', $block_img);
                    $block_single = $smarty->fetch('inner-tpl/single-img-block.tpl');
                }
                $block_img = '';

                $content.= $html.$block_single;
                if($row['content2'] !='')
                {
                    $content.= '<div class="cat_text">'.print_page($row['content2']).'</div>';
                }

                /*выводим таблицу с ценами*/
                $dop4 = '';
                if($pos1 == 'teplovoye-oborudovaniye')
                {
                    $dop4 = '';
                    $query = 'SELECT DISTINCT line_id FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$id.' AND line_id IS NOT NULL AND line_id !=0 ORDER BY id ASC';
                    $mysqli->_execute($query);

                    if($mysqli->num_rows() > 0)
                    {
                        $array = array();
                        while($row_img = $mysqli->fetch())
                        {
                            $array[] = $row_img['line_id'];
                        }

                        $count = count($array);
                        if($count > 1)
                        {
                            for($j=0; $j<$count; $j++)
                            {
                                $dop4.= ' OR all_id LIKE "'.$array[$j].'-'.$row['id'].'"';
                            }
                        }
                        else
                        {
                            $dop4 = 'OR all_id LIKE "'.$array[0].'-'.$row['id'].'"';
                        }
                    }
                    $tab = TEPLO;
                }
                elseif($pos1 == 'konditsionery')
                {
                    $dop4 = '';
                    $query = 'SELECT DISTINCT line_id FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$id.' AND line_id IS NOT NULL AND line_id !=0 ORDER BY id ASC';
                    $mysqli->_execute($query);
                    if($mysqli->num_rows() > 0)
                    {
                        $array = array();
                        while($row_img = $mysqli->fetch())
                        {
                            $array[] = $row_img['line_id'];
                        }

                        $count = count($array);
                        if($count > 1)
                        {
                            for($j=0; $j<$count; $j++)
                            {
                                $dop4.= ' OR all_id LIKE "'.$array[$j].'-'.$id.'"';
                            }
                        }
                        else
                        {
                            $dop4 = 'OR all_id LIKE "'.$array[0].'-'.$id.'"';
                        }
                    }
                    $tab = COND;
                }
                elseif($pos1 == 'ventilyatsionnoye-oborudovaniye')
                {
                    $tab = VENT;
                }
                $head = $id + 20000;
                $dop  = $id + 10000;
                $dop2  = $id + 30000;
                $dop3  = $id + 40000;
                $query = 'SELECT * FROM '.$tab.'
					                WHERE all_id = '.$id.'
					                OR all_id = '.$head.' OR all_id = '.$dop.' OR all_id = '.$dop2.' OR all_id = '.$dop3.' '.$dop4;
                $price = $mysqli->queryQ($query);
                $category = $arResult->POS1;
                $markfull = $arResult->POS3;
                $mark_pos = strrpos($markfull, '-');
                $mark = substr($markfull, $mark_pos+1);
                if($mysqli->num_r($price) > 0){
                    if($category == 'konditsionery')
                    {
                        $table_price = get_konditsionery($row, $price, $mark, $markfull);
                    }
                    elseif($category == 'ventilyatsionnoye-oborudovaniye')
                    {
                        $table_price = get_vent($row, $price, $markfull);
                    }
                    elseif($category == 'teplovoye-oborudovaniye')
                    {
                        $table_price = get_teplo($row, $price, $markfull);
                    }
                }
                else{
                    $table_price = '';
                }

                $content.= $table_price;

            }

        }
        else
        {
            $query = 'SELECT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.title, '.CATALOG_ALL.'.content, '.CATALOG_ALL.'.content2  FROM '.CATALOG_ALL.' WHERE '.CATALOG_ALL.'.eng LIKE "'.$pos3.'"';
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $content = get_pos3_view($pos2, $pos3);
        }
        //перелинковка
        $perelink = perelinkContent($pos1, $row['id'],  $pos3);
        $content.=$perelink;
        return $content;
    }

}
function get_vent($row_s, $price, $markfull)
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    $content_price = '';

    while($row_price = $mysqli->fetchAssoc($price)){
        $col          = '';
        $header_tab   = '';
        $zag      = '';
        $flow     = $row_price['flow'];
        $db       = $row_price['db'];
        $nm       = $row_price['nm'];
        $n        = $row_price['n'];
        $vt       = $row_price['vt'];
        $a        = $row_price['a'];
        $b        = $row_price['b'];

        $flow_td  ='<td class="border_price" >'.$flow.'</td>';
        $db_td  ='<td class="border_price" >'.$db.'</td>';
        $nm_td  ='<td class="border_price" >'.$nm.'</td>';
        $n_td  ='<td class="border_price" >'.$n.'</td>';
        $vt_td  ='<td class="border_price" >'.$vt.'</td>';
        $a_td  ='<td class="border_price" >'.$a.'</td>';
        $b_td  ='<td class="border_price" >'.$b.'</td>';

        $price_td = $row_price['price'];
        $price2_td = $row_price['price2'];
        if($row_price['all_id'] == $row_s['id'] + 20000){
            $zag = 'class="table_price_z"';
            if($markfull == 'tsentrobezhnyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('price_td', $price_td);
                $smarty->assign('price2_td', $price2_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent.tpl');
            }
            elseif($markfull == 'kryshnyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent1.tpl');
            }
            elseif($markfull == 'osevyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent2.tpl');
            }
            else{
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('vt_td', $vt_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('b_td', $b_td);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-round.tpl');
            }
        }
        elseif($row_price['all_id'] == $row_s['id'] + 10000){
            if($markfull == 'kanalnyye-kruglyye-ventilyatory' || $markfull == 'kanalnyye-pryamougolnyye-ventilyatory')		$col = 'colspan="9"';
            elseif($markfull == 'tsentrobezhnyye-ventilyatory' || $markfull == 'kryshnyye-ventilyatory' || $markfull == 'osevyye-ventilyatory') $col ='colspan="8"';
            else $col ='colspan="2"';

            $td = '';
            $header_tab = 'class="table_price_h"';
        }
        else{
            $col = '';
            $header_tab   = '';
            if($markfull == 'tsentrobezhnyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('price_td', $price_td);
                $smarty->assign('price2_td', $price2_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent.tpl');
            }
            elseif($markfull == 'kryshnyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent1.tpl');
            }
            elseif($markfull == 'osevyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('price_td', sprintf("%0.2f", round($price_td, 1)));
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent2.tpl');
            }
            elseif($markfull == 'kanalnyye-kruglyye-ventilyatory' || $markfull == 'kanalnyye-pryamougolnyye-ventilyatory'){
                $smarty->assign('flow_td', $flow_td);
                $smarty->assign('db_td', $db_td);
                $smarty->assign('nm_td', $nm_td);
                $smarty->assign('n_td', $n_td);
                $smarty->assign('vt_td', $vt_td);
                $smarty->assign('a_td', $a_td);
                $smarty->assign('b_td', $b_td);
                $smarty->assign('price_td', sprintf("%0.2f", round($price_td, 1)));
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-round.tpl');
            }
            else{
                $smarty->assign('price_td', sprintf("%0.2f", round($price_td, 1)));
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-vent3.tpl');
            }
        }
        $title = $row_price['title'];

        $smarty->assign('zag', $zag);
        $smarty->assign('header_tab', $header_tab);
        $smarty->assign('col', $col);
        $smarty->assign('title', $title);
        $smarty->assign('td', $td);
        $content_price.= $smarty->fetch('inner-tpl/tables/table-price-tr.tpl');
    }
    if($mysqli->num_r($price) > 0)
    {
        if($markfull == 'kalorifery-nagrevateli' || $markfull == 'shumoglushiteli' || $markfull == 'rekuperatory'
            || $markfull == 'filtry' || $markfull == 'klapany-zaslonki-vozdushnyye' || $markfull == 'diffuzory-kvadratnyye-potolochnyye'
            || $markfull == 'reshetki-nastennyye' || $markfull == 'reshetki-naruzhnyye' || $markfull == 'diffuzory-kruglyye'
            || $markfull == 'gibkiye-vozdukhovody' || $markfull == 'filtry-sistem-ventilyatsii'){

            $val = '<th>Розница, руб.</th>';
            $smarty->assign('val', $val);
            $header_main = $smarty->fetch('inner-tpl/tables/header-main-vent.tpl');
        }
        /*elseif($markfull == 'kanalnyye-kruglyye-ventilyatory' ||$markfull == 'kanalnyye-pryamougolnyye-ventilyatory')  $header_main = file_get_contents( './templates/header_main_vent1.tpl' );*/
        else $header_main = '';

        $smarty->assign('header_main', $header_main);
        $smarty->assign('content_price', $content_price);
        $table_price = $smarty->fetch('inner-tpl/tables/table-price.tpl');
    }
    else
    {
        $table_price = '';
    }

    return $table_price;
}
function get_konditsionery($row_s, $price, $mark, $markfull)
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    $content_price = '';
    $i=1;
    while($row_price = $mysqli->fetchAssoc($price)){
        $col      = '';
        $header_tab = '';
        $zag      = '';
        $substr   = '';
        $block_single = '';
        $btu_c    = $row_price['btu_c'];
        $btu_h    = $row_price['btu_h'];
        $pipe     = $row_price['pipe'];
        $size     = $row_price['size'];
        $size1    = $row_price['size1'];
        $flow     = $row_price['flow'];
        $weight   = $row_price['weight'];
        $title    = $row_price['title'];
        $price_td = $row_price['price'];
        if($row_price['all_id'] == $row_s['id'] + 20000)
        {
            $zag = 'class="table_price_z"';
        }
        elseif($row_price['all_id'] == $row_s['id'] + 30000)
        {
            $zag = 'class="table_price_z1"';
            $title = '<a id="p'.$i.'"></a>'.strtoupper($row_price['title']);
            $i++;
        }
        elseif($row_price['all_id'] == $row_s['id'] + 40000)
        {
            $zag = 'class="table_price_z2"';
        }
        elseif($row_price['all_id'] == $row_s['id'])
        {
            if(!empty($price_td))
            {
                $price_td = sprintf("%0.2f", round($price_td, 1));
            }
        }
        elseif($row_price['all_id'] != $row_s['id'] + 10000)
        {
            $zag = 'class="table_price_z1"';
            $block_single = '';
            $substr = substr($row_price['all_id'], 0, 1);
            $query = "SELECT * FROM ".TABLE_IMAGES."
			          WHERE line_id = ".$substr."
					  AND all_id = ".$row_s['id'];
            $mysqli->_execute($query);
            if($mysqli->num_rows() > 0)
            {
                $block_img = '';

                if($mysqli->num_rows() > 1)
                {
                    $rel = 'data-fancybox-group="gellery'.$substr.'"';
                }
                else
                {
                    $rel = '';
                }
                while($row_img = $mysqli->fetch())
                {
                    $link  = '<a href="/'.PATH_IMG_GLOB.FindImg($row_img['img'], 'catalog/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'" '.$rel.'><div class="lupa" ></div></a>';
                    $img = "<img src='/".PATH_IMG_SMALL.FindImg($row_img['img'], 'catalog/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."'>";
                    $name = 'img_block';
                    $title = $row_img['img_title'];
                    $smarty->assign('img', $img);
                    $smarty->assign('link', $link);
                    $smarty->assign('name', $name);
                    $smarty->assign('title', $title);
                    $block_img.= $smarty->fetch('inner-tpl/catalog-img-block.tpl');

                }

                $smarty->assign('content', $block_img);
                $block_single = $smarty->fetch('inner-tpl/single-img-block.tpl');
            }
            $block_img = '';
        }
        if($row_price['all_id'] == $row_s['id'] + 10000 || $row_price['all_id'] == $row_s['id'] + 30000 || $row_price['all_id'] == $row_s['id'] + 40000 || $row_price['all_id'] == $substr.'-'.$row_s['id'])
        {
            if($markfull == 'nastennyye-split-sistemy' || $markfull == 'nastennyye-invertornyye-split-sistemy')
            {

                $col ='colspan="8"';


            }
            elseif($markfull == 'mobilnyye-konditsionery')
            {
                $col ='colspan="6"';

            }
            else
            {
                $col ='colspan="7"';

            }
            //выводим изображения
            if($block_single !='')
            {
                $title = $block_single;
            }
            $td = '';
            $header_tab = 'class="table_price_h"';
        }
        else
        {
            $col = '';
            $header_tab  = '';

            if($markfull == 'nastennyye-split-sistemy' || $markfull == 'nastennyye-invertornyye-split-sistemy')
            {
                $smarty->assign('btu_c', $btu_c);
                $smarty->assign('btu_h', $btu_h);
                $smarty->assign('pipe',  $pipe);
                $smarty->assign('size',  $size);
                $smarty->assign('size1', $size1);
                $smarty->assign('flow',  $flow);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-kond1.tpl');
            }
            elseif($markfull == 'mobilnyye-konditsionery')
            {
                $smarty->assign('btu_c', $btu_c);
                $smarty->assign('btu_h', $btu_h);
                $smarty->assign('size',  $size);
                $smarty->assign('size1', $size1);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-kond2.tpl');
            }
            else
            {
                $smarty->assign('btu_c', $btu_c);
                $smarty->assign('btu_h', $btu_h);
                $smarty->assign('pipe',  $pipe);
                $smarty->assign('size',  $size);
                $smarty->assign('flow',  $flow);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-kond.tpl');
            }
        }


        $smarty->assign('zag', $zag);
        $smarty->assign('header_tab', $header_tab);
        $smarty->assign('col', $col);
        $smarty->assign('title', $title);
        $smarty->assign('td', $td);
        $content_price.= $smarty->fetch('inner-tpl/tables/table-price-tr.tpl');
        $content = '';
    }

    if($mysqli->num_r($price) > 0)
    {
        if($markfull == 'mobilnyye-konditsionery') $header_main = $smarty->fetch( 'inner-tpl/tables/header-main-kond.tpl' );
        else $header_main = '';

        $smarty->assign('header_main', $header_main);
        $smarty->assign('content_price', $content_price);
        $table_price = $smarty->fetch('inner-tpl/tables/table-price.tpl');
    }
    else
    {
        $table_price = '';
    }
    return $table_price;
}
function get_teplo($row_s, $price, $markfull)
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    $content_price = '';
    $i=1;
    while($row_price = $mysqli->fetchAssoc($price)){
        $col      = '';
        $header_tab   = '';
        $zag      = '';
        $substr   = '';
        $block_single = '';
        $n        = $row_price['n'];
        $s        = $row_price['s'];
        $pr       = $row_price['pr'];
        $flow     = $row_price['flow'];
        $h        = $row_price['h'];
        $pos      = $row_price['pos'];
        $v        = $row_price['v'];
        $size     = $row_price['size'];
        $title    = $row_price['title'];

        $price_td = $row_price['price'];
        if($row_price['all_id'] == $row_s['id'] + 20000)
        {
            $zag = 'class="table_price_z"';

        }
        elseif($row_price['all_id'] == $row_s['id'] + 30000)
        {
            $zag = 'class="table_price_z1"';
            $title = '<a id="p'.$i.'"></a>'.strtoupper($row_price['title']);
            $i++;
        }
        elseif($row_price['all_id'] == $row_s['id'] + 40000)
        {
            $zag = 'class="table_price_z2"';
        }
        elseif($row_price['all_id'] == $row_s['id'])
        {
            if(!empty($price_td))
            {
                $price_td = sprintf("%0.2f", round($price_td, 1));
            }
        }
        elseif($row_price['all_id'] != $row_s['id'] + 10000)
        {
            $zag = 'class="table_price_z1"';
            $block_single = '';
            $substr = substr($row_price['all_id'], 0, 1);
            $query = "SELECT * FROM ".TABLE_IMAGES."
			          WHERE line_id = ".$substr."
					  AND all_id = ".$row_s['id'];
            $mysqli->_execute($query);
            if($mysqli->num_rows() > 0)
            {
                $block_img = '';
                if($mysqli->num_rows() > 1)
                {
                    $rel = 'data-fancybox-group="gellery'.$substr.'"';
                }
                else
                {
                    $rel = '';
                }
                while($row_img = $mysqli->fetch())
                {
                    $link  = '<a href="/'.PATH_IMG_GLOB.FindImg($row_img['img'], 'catalog/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'" '.$rel.'><div class="lupa" ></div></a>';
                    $img = "<img src='/".PATH_IMG_SMALL.FindImg($row_img['img'], 'catalog/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."'>";
                    $name = 'img_block';
                    $title = $row_img['img_title'];
                    $smarty->assign('img', $img);
                    $smarty->assign('link', $link);
                    $smarty->assign('name', $name);
                    $smarty->assign('title', $title);
                    $block_img.= $smarty->fetch('inner-tpl/catalog-img-block.tpl');

                }
                $smarty->assign('content', $block_img);
                $block_single = $smarty->fetch('inner-tpl/single-img-block.tpl');
            }
            $block_img = '';
        }

        if($row_price['all_id'] == $row_s['id'] + 10000 || $row_price['all_id'] == $row_s['id'] + 30000 || $row_price['all_id'] == $row_s['id'] + 40000 || $row_price['all_id'] == $substr.'-'.$row_s['id'])
        {
            if($markfull == 'gazovyye-dizelnyye-teplovie-pushki' || $markfull == 'elektricheskiye-teplovie-pushki' || $markfull == 'vodyanyye-teplovie-pushki' )
            {
                $col ='colspan="7"';
            }
            elseif($markfull == 'convectori-neoclima')
            {
                $col ='colspan="5"';
            }
            else
            {
                $col ='colspan="8"';
            }
            //выводим изображения
            if($block_single !='')
            {
                $title = $block_single;
            }
            $td = '';
            $header_tab = 'class="table_price_h"';
        }
        else
        {
            $col = '';
            $header_tab   = '';

            if($markfull == 'gazovyye-dizelnyye-teplovie-pushki' || $markfull == 'elektricheskiye-teplovie-pushki' || $markfull == 'vodyanyye-teplovie-pushki')
            {
                $smarty->assign('n', $n);
                $smarty->assign('flow', $flow);
                $smarty->assign('v', $v);
                $smarty->assign('s', $s);
                $smarty->assign('size', $size);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-teplo2.tpl');
            }
            elseif($markfull == 'maslyanyye-konvektory' || $markfull == 'elektricheskiye-konvektory')
            {
                if($row_price['all_id'] != $row_s['id'] + 20000)
                {
                    $al = 'align="left"';
                }
                if($markfull == 'elektricheskiye-konvektory')
                {
                    $n = '<div '.$al.'>'.print_page($n).'</div>';
                }
                if($markfull == 'maslyanyye-konvektory')
                {
                    $s = '<div '.$al.'>'.print_page($s).'</div>';
                }

                $smarty->assign('n', $n);
                $smarty->assign('v', $v);
                $smarty->assign('s', $s);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-teplo1.tpl');
            }
            else
            {
                $smarty->assign('n', $n);
                $smarty->assign('flow', $flow);
                $smarty->assign('h', $h);
                $smarty->assign('pos', $pos);
                $smarty->assign('v', $v);
                $smarty->assign('size', $size);
                $smarty->assign('price_td', $price_td);
                $td = $smarty->fetch('inner-tpl/tables/table-price-td-teplo.tpl');
            }
        }
        $smarty->assign('zag', $zag);
        $smarty->assign('header_tab', $header_tab);
        $smarty->assign('col', $col);
        $smarty->assign('title', $title);
        $smarty->assign('td', $td);
        $content_price.= $smarty->fetch('inner-tpl/tables/table-price-tr.tpl');
    }

    if($mysqli->num_r($price) > 0)
    {

        $header_main = '';
        $smarty->assign('header_main', $header_main);
        $smarty->assign('content_price', $content_price);
        $table_price = $smarty->fetch('inner-tpl/tables/table-price.tpl');
    }
    else
    {
        $table_price = '';
    }
    return $table_price;
}
function perelinkContent($pos1, $all_id, $pos3)
{
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    global $smarty;
    $pos2 = $arResult->POS2;
    $content = '';
    $query = 'SELECT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.eng AS all_eng, '.CATALOG_ALL.'.title, '.CATALOG_SUBMENU.'.titlepage, '.CATALOG_SUBMENU.'.keywords, '.CATALOG_SUBMENU.'.description, '.CATALOG_MENU.'.eng AS menu_eng
						FROM '.CATALOG_ALL.'
						INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_ALL.'.submenu_id = '.CATALOG_SUBMENU.'.id
						INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_SUBMENU.'.menu_id = '.CATALOG_MENU.'.id
						WHERE '.CATALOG_SUBMENU.'.eng LIKE "'.$pos2.'"
						AND '.CATALOG_ALL.'.eng NOT LIKE "default%"';
    $mysqli->_execute($query);
    $num_total = $mysqli->num_rows();
    $html = '';
    $num=$i=$j=$k=0;
    while($row = $mysqli->fetch())
    {
        $array[$i] = $row['id'];
        $num++;
        if($row['id'] == $all_id)
        {
            $k = $i;
        }
        $i++;
    }
    if($num > 3)
    {
        $count = 3;
    }
    else
    {
        $count = $num-1;
    }

    $position = $k+1;
    $mysqli->data_seek($position);
    $content.='<ul class="ul_total">';
    for($i=0;$i<$count; $position++)
    {
        $i++;

        if($position == $num_total)
        {
            $mysqli->data_seek(0);
            $position = -1;
        }

        $row = $mysqli->fetch();
        if((!in_array($row['id'], $array)) || $row['id'] == $all_id)
        {
            $i--;
            continue;
        }

        $content.=  get_pos2_view($pos1, $pos2, $row);

    }
    $content.='</ul>';
    if($count > 0)
    {
        $title = $smarty->fetch('inner-tpl/perelink-title.tpl');
        $smarty->assign('content', $content);
        $content = $smarty->fetch('inner-tpl/main-pos2.tpl');

        $smarty->assign('title', $title);
        $smarty->assign('content', $content);
        $html = $smarty->fetch('inner-tpl/perelink-main.tpl');
    }
    return $html;
}
function get_pos2_view($pos1, $pos2, $row_p)
{
    global $smarty;
    $title = '<li class="pos2_title"><a href="/catalog/'.$pos1.'/'.$pos2.'/'.$row_p["all_eng"].'" '.STYLE6.'>'.$row_p['title'].'</a></li>'."\n";

    $smarty->assign('title', $title);
    $content = $smarty->fetch('inner-tpl/content-pos2.tpl');


    return $content;
}
function get_pos3_view($pos2, $pos3)
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    $html = '';
    $query = "SELECT ".CATALOG_ALL.".id, ".CATALOG_ALL.".title, ".CATALOG_ALL.".content, ".CATALOG_ALL.".titlepage, ".CATALOG_ALL.".keywords, ".CATALOG_ALL.".description, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng
				FROM ".CATALOG_ALL."
				INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
				INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
				WHERE ".CATALOG_ALL.".eng LIKE '".$pos3."'";
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $num_all  = $mysqli->num_rows();
    $id = $row["id"];
    $content = $row["content"];
    $query = "SELECT ".DESC.".title, ".DESC.".price, ".DESC.".ed_izm, ".CATALOG_ALL.".title as all_title, ".CATALOG_ALL.".content
			  FROM ".DESC."
			  INNER JOIN ".CATALOG_ALL." ON ".CATALOG_ALL.".id = ".DESC.".all_id
			  INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".DESC.".all_id =".$id."
			  ORDER BY ".DESC.".title ASC";
    $mysqli->_execute($query);
    $num = $mysqli->num_rows();
    $content_price = '';
    while($row_s = $mysqli->fetch())
    {
        $title  = $row_s["title"];
        $ed_izm = $row_s["ed_izm"];
        $price  = sprintf("%0.2f", round($row_s["price"], 2));
        $smarty->assign('title', $title);
        $smarty->assign('ed', $ed_izm);
        $smarty->assign('price', $price);
        $content_price.= $smarty->fetch('inner-tpl/tables/table-rash-tr.tpl');

    }
    if($num > 0 )
    {
        $smarty->assign('content_price', $content_price);
        $table = $smarty->fetch('inner-tpl/tables/table-rash.tpl');
    }
    if($num_all > 0)
    {
        $query = 'SELECT * FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$id.' ORDER BY id ASC';
        $mysqli->_execute($query);
        $row_img = $mysqli->fetch();
        $image = '';
        if($mysqli->num_rows() > 0)
        {
            $link  = '<a href="/'.PATH_IMG_GLOB.FindImg($row_img['img'], 'catalog/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'"><div class="lupa" ></div></a>';
            $img = "<img src='/".PATH_IMG_SMALL.FindImg($row_img['img'], 'catalog/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."'>";
            $name = 'img_block_onecat';

            $smarty->assign('name', $name);
            $smarty->assign('link', $link);
            $smarty->assign('img', $img);
            $image = $smarty->fetch('inner-tpl/catalog-single-photo.tpl');
        }

        $content = print_page($content);

        $smarty->assign('image', $image);
        $smarty->assign('content', $content);
        $smarty->assign('table', $table);
        $html = $smarty->fetch('inner-tpl/pos3-rash.tpl');

    }
    return $html;
}