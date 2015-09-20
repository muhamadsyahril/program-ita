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
	
	function tampil_data(e){
		var th		= $("#th").val();
		var bln		= $("#bln").val();
		var no_rek 	= $("#no_rek").val();

		
		var string 	= "no_rek="+no_rek+"&th="+th+"&bln="+bln;
		var string2	= no_rek+"/"+th+"/"+bln;
		
		if(th.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf Tahun Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#th").focus();
			return false();
		}
		if(no_rek.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nomor Rekening Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#no_rek").focus();
			return false();
		}
		if(e=='cari'){
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/lap_buku_besar/view_data",
				data	: string,
				cache	: false,
				success	: function(data){
					$("#tampil_data").html(data);
				}
			});
		}else{
			window.open('<?php echo site_url();?>/lap_buku_besar/cetak_data/'+string2);
		}
	}
	
});
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/usulan">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/usulan">
cari budget coa : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Bulan</th>
    <th>Tahun</th>
	<th>Kode Cabang</th>
    <th>Nama Coa</th>
    <th>Aksi</th>
</tr>
<?php
	if($data1->num_rows()>0){
		//$jml_dr=0;
		//$jml_kr=0;
		$no =1;
		foreach($data1->result_array() as $db){  
		//$tgl = $this->app_model->tgl_indo($db['tgl_jurnal']);
		//$nama_rek = $this->app_model->CariNamaRek($db['no_rek']);
?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['periode_bulan']; ?></td>
            <td align="center" width="80"><?php echo $db['periode_tahun']; ?></td>
			<td align="center" width="80"><?php echo $db['kodecab']; ?></td>
			
            <td align="left"><?php echo $db['nama_coa']; ?></td>       
            <td align="center" width="80">
			<button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Input</button>
            </td>
    </tr>
    <?php
		//$jml_dr = $jml_dr+$db['debet'];
		//$jml_kr = $jml_kr+$db['kredit'];
		$no++;
		}
	}else{
		//$jml_dr = 0;
		//$jml_kr = 0;
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
    
</table>
</div>
