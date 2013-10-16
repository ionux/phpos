<?php
/*
**********************************

	PHPOS Web Operating system
	MIT License
	(c) 2013 Marcin Szczyglinski
	szczyglis83@gmail.com
	GitHUB: https://github.com/phpos/
	File version: 1.0.0, 2013.10.08
 
**********************************
*/
if(!defined('PHPOS'))	die();	


	if(!defined('PHPOS_EXPLORER_PLUGIN')) die();

	$items = null;
		
	$ftp = new phpos_ftp;
	$records = $ftp->get_my_ftp();

		 
/*
**************************
*/
 	

	if(count($records) != 0)
	{
		foreach($records as $row)
		{
			$tmp_title = '<span class="explorer_tree_item">'.string_cut($row['title'], 20).'</span>';			
			if($my_app->get_param('fs') == 'ftp' && $my_app->get_param('ftp_id') == $row['id']) $tmp_title = '<span  class="explorer_tree_item_marked">'.string_cut($row['title'], 20).'</span>';
			
			$items.= '<li data-options="iconCls:\'icon-ftp\'"><span><a title="'.$row['title'].' '.$row['host'].'"href="javascript:void(0);" onclick="'.link_action('index', 'tmp_shared_id:0,workgroup_id:0,dir_id:.,ftp_id:'.$row['id'].',fs:ftp').'"><span style="color: black">'.$tmp_title.'</span></a></span></li>';
		} 

	} else {
		
		$items.= '<li data-options="iconCls:\'icon-blank\'"><span>'.$txt['ftp_no_accounts'].'</span></li>';
	}

		 
/*
**************************
*/

$tmp_header = '<span class="explorer_tree_header">'.txt('ftp_folders').'</span>';
if(APP_ACTION == 'ftp' || (APP_ACTION == 'index' && $my_app->get_param('fs') == 'ftp')) $tmp_header = '<span class="explorer_tree_header_marked">'.txt('ftp_folders').'</span>';

 	
	$html['left_tree'].= '<br/><br/>
	<ul id="tt2" class="easyui-tree">
		<li data-options="iconCls:\'icon-ftp\'">
					 <span><a title="'.$txt['ftp_folders'].'" href="javascript:void(0);" onclick="'.link_action('ftp', 'tmp_shared_id:0,shared_id:0,workgroup_id:0,fs:ftp').'">'.$tmp_header .'</a></span>
					<ul>
					'.$items.'
					</ul>
		</li>
	</ul>';

	$items = null;
?>