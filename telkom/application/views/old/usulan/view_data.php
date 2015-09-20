<script type="text/javascript">
$(function() {
	$("#dataTable tr:even").addClass("stripe1");
	$("#dataTable tr:odd").addClass("stripe2");
	$("#dataTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
$(document).ready(function(){
	$("#input").click(function(){
		var e = 'input';
		tampil_data(e);
	});
	
	$("#cetak").click(function(){
		var e = 'cetak';
		tampil_data(e);
		//window.open('<?php echo site_url();?>/lap_surat_keputusan/cetak/'+tgl1+'/'+tgl2);
	});
	function tampil_data(e){
		var idcoa		= $("#idcoa").val();
		var namacoa		= $("#namacoa").val();
		var jenis		= $("#jenis").val();
		
		var string 	= "idcoa="+idcoa+"&namacoa="+namacoa+"&jenis="+jenis;
		if(coa.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Daftar kelompok budget COA harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#idcoa").focus();
			return false();
		}
		
		if(e=='input'){
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/usulan/form_usulan",
				data	: string,
				cache	: false,
				success	: function(data){
					$("#tampil_data").html(data);
				}
			});

		}
	}
	
});
</script>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Coa</th>
	<th>Budget</th>
	<th>Realisasi</th>
	<th>Sisa</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db) { 
		$coa = $this->app_model->CariProceed($db['idcoa']);
		$budget = $db['debet'];
		$realisasi = $coa;
		$sisa_budget = $budget - $realisasi;		
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" ><?php echo $db['nama_coa']; ?></td>
			<td align="right" ><?php echo number_format($db['debet']); ?></td>
			<td align="right" ><?php echo number_format($coa); ?></td>
			<td align="right" ><?php echo number_format($sisa_budget); ?></td>
			<input type="hidden" name="idcoa" id="idcoa" value="<?php echo $db['idcoa'];?>" />
			<input type="hidden" name="namacoa" id="namacoa" value="<?php echo $db['nama_coa'];?>" />
			<input type="text" name="jenis" id="jenis" value="<?php echo $db['jenis'];?>" />
    </tr>
    <?php
		$no++;
	 }	
	}else{
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>	
</table>

	<?php 
	if ($sisa_budget >0) {
     ?>	
	<button name="input" id="input" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Input Usulan</button>
    <?php
     }else{ 
	 echo "Maaf, budget tidak mencukupi harap usulan penambahan budget";
	 }
	 ?>
	 
<div id="tampil_data"></div>

 