<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	if($_POST){
		extract(html_entities($_POST));
		$Qry = "INSERT INTO bahan (nama_bahan_baku, harga, qty)
			VALUES ('".$nama_bahan_baku."', '".$harga."', '".$qty."')";
		$Res = mysql_query($Qry);
		if($Res){
			$message = "<div class='success'>Berhasil menambah record baru..</div>";
		} else {
			$message = "<div class='error'>".mysql_error()."</div>";
		}
		$_SESSION['msg'] = $message;
		header("Location: index.php?p=bahan");
	}
?>
<span class="page-title">Tambah Bahan Baku</span>
<div class="inner">
<form id="formContent" name="formContent" method="post" action="" onsubmit="return validateForm('formContent')">
  <table width="480" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="151">Nama Bahan Baku</td>
      <td width="3">:</td>
      <td width="242"><input type="text" class="input required" name="nama_bahan_baku" id="nama_bahan_baku" /></td>
    </tr>
    <tr>
      <td>Harga</td>
      <td>:</td>
      <td><input type="text"  class="input required" name="harga" id="harga" /></td>
    </tr>
    <tr>
      <td>Qty</td>
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