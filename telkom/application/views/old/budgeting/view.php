<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	$(".angka").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	$("#simpan").click(function(){
		var periode_bln		= $("#periode_bln").val();
		var periode_thn		= $("#periode_thn").val();
		var jml_data	= $("#jml_data").val();
		
		//var string = "rek_induk="+rek_induk+"&no_rek="+no_rek+"&nama_rek="+nama_rek;
		//alert('Jumlah data '+jml_data);
		
		if(periode_bln.length==0 || periode_thn.length==0){
			$.messager.show({
				title:'Info',
				msg:'Bulan & Tahun tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
				
			$("#periode_thn").focus();
			return false;
		}
		
		for(i=1;i<=jml_data;i++){
			var idcoa	= $("#idcoa"+i).val();
			var kodecab	= $("#kodecab"+i).val();
			var dr 		= $("#dr"+i).val();
			
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/budgeting/simpan",
				data	: "periode_bln="+periode_bln+"&periode_thn="+periode_thn+"&idcoa="+idcoa+"&kodecab="+kodecab+"&dr="+dr,
				cache	: false,
				success	: function(data){
					
				}
			});
		}
		
		$.messager.show({
			title:'Info',
			msg:'Data sukses disimpan',
			timeout:2000,
			showType:'slide'
		});
		
	});
	
	$("#tambah_data").click(function(){
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/budgeting/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#no_rek").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/budgeting');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/budgeting/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#no_rek").focus();
				
				$("#no_rek").val(id);
				$("#rek_induk").val(data.level);
				$("#nama_rek").val(data.nama_rek);
			}
	});
}
</script>
<div style="float:left; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/budgeting">
Nama Cabang : 
<select name="cabang" id="cabang" class="combo">
<option value="">-PILIH-</option>

    <?php
	foreach($list->result() as $t){
	?>
    <option value="<?php echo $t->kodecab;?>"><?php echo $t->namacabang;?></option>
    <?php } ?>
</select> <br />
Periode-Bln : 
<select name="periode_bln" id="periode_bln" class="combo">
<option value="">-PILIH-</option>
<?php
$month_akhir = date('m');
?>
<option value="<?php echo $month_akhir;?>"><?php echo $month_akhir;?></option>
</select>
Periode-Thn : 
<select name="periode_thn" id="periode_thn" class="combo">
<option value="">-PILIH-</option>
<?php
$year_awal = date('Y');
$year_akhir = date('Y')+1;
for($i=$year_awal;$i<=$year_akhir;$i++){
?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<? } ?>
</select>
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
<button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Simpan</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
	<th>Id Coa</th>
	<th>Kode Cabang</th>
    <th>Nama Coa</th>
    <th>Debet</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
			<td align="center" width="80" ><?php echo $db['idcoa']; ?>
			<input type="hidden" name="idcoa<?php echo $no;?>" id="idcoa<?php echo $no;?>" value="<?php echo $db['idcoa'];?>" />
			</td>
            <td align="center" width="80" ><?php echo $db['kodecab']; ?>
			<input type="hidden" name="kodecab<?php echo $no;?>" id="kodecab<?php echo $no;?>" value="<?php echo $db['kodecab'];?>" />
			</td>
			<td ><?php echo $db['nama_coa']; ?>
			</td>
            <td align="center" width="100">
            <input type="text" name="dr<?php echo $no;?>" id="dr<?php echo $no;?>" class="angka" value="<?php echo $db['debet']?>" size="15" maxlength="15" onkeyup="formatNumber(this);" onchange="formatNumber(this);" />
            </td>
		</tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="5" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<input type="hidden" id="jml_data" value="<?php echo $data->num_rows?>" />