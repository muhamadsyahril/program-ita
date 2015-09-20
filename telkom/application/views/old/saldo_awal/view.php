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
		var periode		= $("#periode").val();
		var jml_data	= $("#jml_data").val();
		
		//var string = "rek_induk="+rek_induk+"&no_rek="+no_rek+"&nama_rek="+nama_rek;
		//alert('Jumlah data '+jml_data);
		
		if(periode.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf Periode Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
				
			$("#periode").focus();
			return false;
		}
		
		for(i=1;i<=jml_data;i++){
			var no_rek	= $("#no_rek"+i).val();
			var dr 		= $("#dr"+i).val();
			var kr 		= $("#kr"+i).val();
			
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/saldo_awal/simpan",
				data	: "periode="+periode+"&no_rek="+no_rek+"&dr="+dr+"&kr="+kr,
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
			url		: "<?php echo site_url(); ?>/rekening/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#no_rek").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/rekening');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rekening/edit",
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
<form name="form" method="post" action="<?php echo base_url();?>index.php/saldo_awal">
Periode : 
<select name="periode" id="periode" class="combo">
<option value="">-PILIH-</option>
<?php
$year_awal = date('Y')-1;
$year_akhir = date('Y');
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
    <th>No Rekening</th>
    <th>Nama Rekening</th>
    <th>Debet</th>
    <th>Kredit</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="150" ><?php echo $db['no_rek']; ?>
            <input type="hidden" name="no_rek<?php echo $no;?>" id="no_rek<?php echo $no;?>" value="<?php echo $db['no_rek'];?>" />
            </td>
            <td ><?php echo $db['nama_rek']; ?></td>
            <td align="center" width="100">
            <input type="text" name="dr<?php echo $no;?>" id="dr<?php echo $no;?>" class="angka" value="<?php echo $db['debet'];?>" size="15" maxlength="15" />
            </td>
            <td align="center" width="100">
            <input type="text" name="kr<?php echo $no;?>" id="kr<?php echo $no;?>" class="angka" value="<?php echo $db['kredit'];?>" size="15" maxlength="15" />
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
<input type="hidden" id="jml_data" value="<?php echo $no;?>" />