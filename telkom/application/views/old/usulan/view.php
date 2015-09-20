<script type="text/javascript">
$(document).ready(function(){
	$("#cari").click(function(){
		var e = 'cari';
		tampil_data(e);
	});
	
	$("#cetak").click(function(){
		var e = 'cetak';
		tampil_data(e);
		//window.open('<?php echo site_url();?>/lap_surat_keputusan/cetak/'+tgl1+'/'+tgl2);
	});
	$("#view").show();
	
	$("#cari").click(function(){
	$("#view").hide();
		//$("#tampil_data").html('hai...');
	});

	
	function tampil_data(e){
		var coa		= $("#coa").val();
		
		var string 	= "coa="+coa;
		if(coa.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Daftar kelompok budget COA harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#coa").focus();
			return false();
		}
		
		if(e=='cari'){
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/usulan/view_data",
				data	: string,
				cache	: false,
				success	: function(data){
					$("#tampil_data").html(data);
				}
			});
		}else{
			window.open('<?php echo site_url();?>/usulan/cetak_data/'+string2);
		}
	}
	
});
</script>	
<div id="view">
    <div style="padding-bottom:5px;" align="center">
    Kelompok Budget COA : 
    <select name="coa" id="coa" class="kosong">
    <option value="">-PILIH-</option>
    <?php
    foreach($data->result_array() as $t){
    ?>
    <option value="<?php echo $t['idcoa'];?>"><?php echo $t['idcoa'];?> | <?php echo $t['nama_coa'];?></option>
    <?php } ?>
    </select>
    <button type="button" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>

    </div>
</div>
<div id="tampil_data"></div>

