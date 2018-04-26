<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	if($_POST){
		extract(html_entities($_POST));
		$Qry = "UPDATE roti SET nama_roti='".$nama_roti."', id_bahan='".$id_bahan."', 
			qty_yg_dibutuhkan='".$qty."' WHERE id='".$id."'";
		$Res = mysql_query($Qry);
		if($Res){
			$message = "<div class='success'>Berhasil mengupdate record..</div>";
		} else {
			$message = "<div class='error'>".mysql_error()."</div>";
		}
		$_SESSION['msg'] = $message;
		header("Location: index.php?p=roti");
	}
	
	$doSql = "SELECT * FROM roti INNER JOIN bahan ON roti.id_bahan = bahan.kode_bahan_baku WHERE id='".$_GET['id']."'";
	$doQry = mysql_query($doSql);
	$r = mysql_fetch_array($doQry);
	
?>
<span class="page-title">Edit Rekening</span>
<div class="inner">
<form id="formContent" name="formContent" method="post" action="" onsubmit="return validateForm('formContent')">
<input type="hidden" name="id" value="<?php echo $r['id'];?>" />
  <table width="480" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="151">Nama Roti</td>
      <td width="3">:</td>
      <td width="242"><input type="text" value="<?php echo $r['nama_roti'];?>" class="input required" name="nama_roti" id="nama_roti" /></td>
    </tr>
    <tr>
      <td>Bahan yang Digunakan</td>
      <td>:</td>
      <td><select name="id_bahan">
      <option value="<?=$r['id_bahan'];?>"><?= $r['nama_bahan_baku'];?></option>
		<?php
		$sql="SELECT * FROM bahan order by kode_bahan_baku";
		$query=mysql_query($sql);
		while($data=mysql_fetch_array($query)){
		if($data['kode_bahan_baku']==$kd_kredit){
			$cek="selected";
		}else{
			$cek="";
		}
			echo "<option value = $data[kode_bahan_baku]>$data[nama_bahan_baku]</option>";
		}
		?>
        </select>
    </td>
    </tr>
    <tr>
      <td>Qty yang Dibutuhkan</td>
      <td>:</td>
      <td><input type="text"  class="input required" value="<?php echo $r['qty'];?>" name="qty" id="qty" /></td>
    </tr>
  </table>
  <hr />
  <input type="button" value="Cancel" class="button" onclick="window.location='index.php?p=roti';" />
  <input type="submit" value="Simpan" class="button" />
</form>
<div class="clr"></div>
</div>