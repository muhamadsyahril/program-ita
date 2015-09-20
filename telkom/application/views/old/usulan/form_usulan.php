<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery.autocomplete.js'></script>

<link href='<?php echo base_url();?>asset/js/jquery.autocomplete.css' rel='stylesheet' />

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
	
	
</script>
<div id="form">
<fieldset>
<table width="100%">
<?php 
foreach($data1->result() as $db){$kodecab = $db->kodecab; $namacab = $db->namacabang;}
foreach($data->result() as $db){$idcoa= $db->idcoa; $namacoa = $db->nama_coa;$jenis = $db->jenis;}
$no_usulan = $this->app_model->MaxNoUsulan();
$nama = $this->session->userdata('nama');										
										
	?>
<tr>
	<td width="50%" valign="top">
        <table width="100%">
		<input type="hidden" name="user" id="user" size="40"  readonly="readonly" value="<?php echo $nama ?>"/>
        <tr>
            <td width="20%">Cabang</td>
            <td width="5">:</td>
            <td> 
            <input type="text" name="kodecab" id="kodecab" size="8"  readonly="readonly" value="<?php echo $kodecab ?>"/>
			<input type="text" name="namacab" id="namacab" size="10"  readonly="readonly" value="<?php echo $namacab ?>"/>
            </td>
        </tr>
        <tr>    
            <td>Kelompok COA</td>
            <td>:</td>
            <td>
            <input type="text" name="idcoa" id="idcoa" size="8"  readonly="readonly" value="<?php echo $idcoa?>"/>
			<input type="text" name="namacoa" id="namacoa" size="40"  readonly="readonly" value="<?php echo $namacoa ?>"/>
            </td>
        </tr>
		<tr>    
            <td>Jenis</td>
            <td>:</td>
            <td> <?php if($idcoa=='1000016') { ?>
			<select name="jenis" id="jenis"><option value="spp">spp</option><option value="atk">atk</option></select>
			<?php }else { ?>
			<input type="text" name="jenis" id="jenis" size="40"  readonly="readonly" value="<?php echo $jenis;?>"/>
			<?php } ?>
            </td>
        </tr>
        </table>
	</td>
    <td width="50%" valign="top">
        <table width="100%">
        <tr>
            <td width="20%">No Usulan</td>
            <td width="5">:</td>
            <td>
            <input type="text" name="nousulan" id="nousulan" size="20" maxlength="20" readonly="readonly" value="<?php echo $no_usulan;?>" />
            </td>
        </tr>
        <tr> <?php if($jenis=='ajuservice') { ?>   
            <td>Id Inventaris</td>
            <td>:</td>
            <td>
			<input type="text"  name='id_inventaris' id="id_inventaris" size="20" maxlength="20" />
			<input type="submit" name="button" id="button" value="Find"
			onclick="window.open('usulan/cari_inventaris', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=no,scrollbars=no,width=600,height=400');" />
            </td>
			<?php }else { ?>
			 <td></td>
            <td></td>
            <td>
            <input type="hidden" name="idinventaris" id="idinventaris" size="20" maxlength="20" />
            </td>
			<?php } ?>
        </tr><tr><td>Item</td><td>:</td><td><input type="text"  name='item' id="item"/></td></tr>
        </table>
	</td>
</tr>
</table>            
</fieldset>

<fieldset>
<table width="100%">
<tr>
	<td width="50%" valign="top">
        <table width="100%">
        <tr>    
            <td>Keterangan</td>
            <td>:</td>
            <td>
            <textarea name="ket" id="ket" style="width:300px; height:50px;"></textarea>
            </td>
        </tr>
        </table>
	</td>
</tr>
</table>            
</fieldset>
<div style="margin:5px;"></div>
<fieldset class="atas">
<table width="100%">
<tr>
	<th>Id Usulan</th>
	<th></th>
    <th>Detail</th>
	<th>Quantity</th>
    <th>Harga/unit</th>
    <th>Total</th>
</tr>    
<tr>
	<td align="center"><input type="text" name="idusulan" id="idusulan" class="" size="20" maxlength="20" /></td><td><input type="submit" name="detail_usulan" id="detail_usulan" value="Find"
			onclick="window.open('usulan/cari_detail', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=no,scrollbars=no,width=600,height=400');" /></td>
    <td align="center"><input type="text" name="detail" id="detail" class="" size="50" maxlength="50" readonly="readonly" /></td>
    <td align="center"><input type="text" name="qty" id="qty" class="angka" size="10" maxlength="10" /></td>
    <td align="center"><input type="text" name="harga" id="harga" class="angka" size="20" maxlength="20" /></td>
	<td align="center"><input type="text" name="total" id="total" class="angka" size="20" maxlength="20" /></td>
</tr>    
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-close'">TUTUP</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>
<div id="tampil_data"></div>