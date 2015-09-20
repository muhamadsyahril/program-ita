<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/layout.css">
<link href="<?php echo base_url();?>asset/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/cupertino/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css">
<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/clock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
</head>
<script type="text/javascript">

</script>
<div id="view">
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/usulan/cari_inventaris">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Id Inventaris</th>
    <th>Item</th>
	<th>Detail</th>
	<th>Get</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['id_inventaris'];?></td>
            <td><?php echo $db['item']; ?></td>
			<td><?php echo $db['detail'];?></td>
            <td align="center" width="80">
            <a href="#" onclick="window.opener.document.getElementById('id_inventaris').value = '<?php echo $db['id_inventaris'];?>'; window.opener.document.getElementById('item').value = '<?php echo $db['item'];?>';
			window.close(); /*window.opener.document.location='refresh.html'*/;">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Ambil'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="6" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>

