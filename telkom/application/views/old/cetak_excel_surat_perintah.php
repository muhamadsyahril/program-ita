<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename = Surat_Perintah.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="2" align="center"><?php echo $judul;?></td>
    </tr>
    <tr>                          
    <th>No</th>
    <th>No Surat</th>
    <th>Tanggal</th>                            
    <th>Perihal</th>                            
    <th>Keterangan</th>                            
    </tr>
    <?php          
	$no=1;                  
    foreach($data->result() as $data)
	$tgl = $this->app_model->tgl_indo($data->tanggal);
    {
		echo '<tr>';                                
		echo '<td>'.$no.'</td>';
		echo '<td>'.$data->nomor_surat.'</td>';
		echo '<td>'.$tgl.'</td>';
		echo '<td>'.$data->perihal.'</td>';                            
		echo '<td>'.$data->ket.'</td>';                            
		echo '</tr>';                                
		$no++;
    }                      
    ;?>                                                                  
</table>