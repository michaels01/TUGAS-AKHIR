<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	if($_POST){
		extract(html_entities($_POST));
		$Qry = "INSERT INTO roti (nama_roti, id_bahan, qty_yg_dibutuhkan)
			VALUES ('".$nama_roti."', '".$id_bahan."', '".$qty."')";
		$Res = mysql_query($Qry);
		if($Res){
			$message = "<div class='success'>Berhasil menambah record baru..</div>";
		} else {
			$message = "<div class='error'>".mysql_error()."</div>";
		}
		$_SESSION['msg'] = $message;
		header("Location: index.php?p=roti");
	}
?>
<span class="page-title">Tambah Roti</span>
<div class="inner">
<form id="formContent" name="formContent" method="post" action="" onsubmit="return validateForm('formContent')">
  <table width="480" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="151">Nama Roti</td>
      <td width="3">:</td>
      <td width="242"><input type="text" class="input required" name="nama_roti" id="nama_roti" /></td>
    </tr>
    <tr>
      <td>Bahan yang Digunakan</td>
      <td>:</td>
      <td><select name="id_bahan">
		<option>[Nama Bahan Baku]</option>
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
      <td><input type="text"  class="input required" name="qty" id="qty" /></td>
    </tr>
  </table>
  <hr />
  <input type="button" value="Cancel" class="button" onclick="window.location='index.php?p=bahan';" />
  <input type="submit" value="Simpan" class="button" />
</form>
<div class="clr"></div>
</div>