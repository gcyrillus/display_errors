<?php /**
* Plugin display_error - config page
*
* @package	PLX
* @version	1.0
* @date	22/10/23
* @author gc-nomade
* @site https://pluxopolis.net
**/
if(!defined("PLX_ROOT")) exit; ?>
<?php 
	if(!empty($_POST)) {
		$plxPlugin->setParam("active", plxUtils::strCheck($_POST["active"]), "numeric");

		$plxPlugin->saveParams();
		header("Location: parametres_plugin.php?p=display_error");
		exit;
	}
	$active=  $plxPlugin->getParam('active')=='' ? 0 : $plxPlugin->getParam('active');
?>
<style>
	h2 *{vertical-align:middle;}
	
</style>
<h2><img style="width:200px" src="<?php echo PLX_PLUGINS;?>display_error/icon.png"/><?php $plxPlugin->lang("L_TITLE") ?></h2>
<p><?php $plxPlugin->lang("L_DESCRIPTION") ?></p>
<form action="parametres_plugin.php?p=display_error" method="post" >
	<p class="alert blue" style="display:flex;gap:0.5em;align-items:center;width:max-content">
		<label><?php $plxPlugin->lang("L_ACTIVATE");?> : </label>
			<?php plxUtils::printSelect('active',array('1'=>L_YES,'0'=>L_NO),$active); ?>		
	</p>
	<input type="submit" name="submit" value="Enregistrer"/>
</form>