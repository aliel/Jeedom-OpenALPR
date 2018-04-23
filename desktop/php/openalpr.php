<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'openalpr');
$eqLogics = eqLogic::byType('openalpr');
?>
<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default btn-sm tooltips snapshot" title="Snapshot"><i class="fa fa-camera"></i> {{}}</a>
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un groupe}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
                foreach ($eqLogics as $eqLogic) {
                    echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
	<div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
		<legend>{{Gestion}}</legend>
				<div class="eqLogicThumbnailContainer">
			<div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
				<center>
					<i class="fa fa-plus-circle" style="font-size : 5em;color:#406E88;"></i>
				</center>
				<span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#406E88"><center>{{Ajouter}}</center></span>
			</div>
			<div class="cursor eqLogicAction" data-action="gotoPluginConf" style="height: 120px; margin-bottom: 10px; padding: 5px; border-radius: 2px; width: 160px; margin-left: 10px; position: absolute; left: 170px; top: 0px; background-color: rgb(255, 255, 255);">
				<center>
			      		<i class="fa fa-wrench" style="font-size : 5em;color:#767676;"></i>
			    	</center>
			    	<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>Configuration</center></span>
			</div>
		
			<div class="cursor snapshot" style="background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
				<center>
					<i class="fa fa-camera" style="font-size : 5em;color:#767676;"></i>
				</center>
				<span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>{{Snapshot}}</center></span>
			</div>
			<div class="cursor logAlprd" style="background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
				<center>
					<i class="fa fa-heartbeat" style="font-size : 5em;color:#767676;"></i>
				</center>
				<span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>{{Information sur le logiciel ALPRD}}</center></span>
			</div>
		</div>
        <legend>{{Mes groupes de plaques d'immatriculation}}</legend>
		<input class="form-control" placeholder="{{Rechercher}}" style="margin-bottom:4px;" id="in_searchEqlogic" />
		<div class="eqLogicThumbnailContainer">
			<?php
				foreach ($eqLogics as $eqLogic) {
					$opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
					echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
					echo "<center>";
					echo '<img src="plugins/openalpr/plugin_info/openalpr_icon.png" height="105" width="95" />';
					echo "</center>";
					echo '<span class="name" style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
					echo '</div>';
				}
			?>
		</div>
    </div>
    <div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
		<a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> Sauvegarder</a>
		<a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> Supprimer</a>
		<a class="btn btn-default eqLogicAction pull-right" data-action="configure"><i class="fa fa-cogs"></i> Configuration avancée</a>
		<a class="btn btn-default eqLogicAction pull-right expertModeVisible " data-action="copy"><i class="fa fa-copy"></i>{{Dupliquer}}</a>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation">
				<a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay">
					<i class="fa fa-arrow-circle-left"></i>
				</a>
			</li>
			<li role="presentation" class="active">
				<a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
					<i class="fa fa-tachometer"></i> Equipement</a>
			</li>
			<li role="presentation" class="">
				<a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
					<i class="fa fa-list-alt"></i> Commandes</a>
			</li>
			<li role="presentation" class="">
				<a href="#conditiontab" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
					<i class="fa fa-cube"></i> {{Conditions d'exécution}}</a>
			</li>
			<li role="presentation" class="">
				<a href="#actiontab" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
					<i class="icon divers-viral"></i> {{Actions}}</a>
			</li>
		</ul>
		<div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
			<div role="tabpanel" class="tab-pane active" id="eqlogictab">
				<form class="form-horizontal">
					<fieldset>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-md-2 control-label">{{Nom du groupe}}</label>
								<div class="col-sm-3">
									<input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom du groupe}}"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label" >{{Objet parent}}</label>
								<div class="col-sm-3">
									<select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
										<option value="">{{Aucun}}</option>
										<?php
										foreach (object::all() as $object) {
											echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
										}
										?>
									</select>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-sm-2 control-label" ></label>
								<div class="col-sm-9">
									<label>{{Activer}}</label>
									<input type="checkbox" class="eqLogicAttr" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
									<label>{{Visible}}</label>
									<input type="checkbox" class="eqLogicAttr" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">{{Catégorie}}</label>
								<div class="col-md-8">
									<?php
									foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
										echo '<label class="checkbox-inline">';
										echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
										echo '</label>';
									}
									?>

								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">{{Mode de mise a jours}}</label>
								<div class="col-md-8">
									<select class="eqLogicAttr" data-l1key="configuration" data-l2key="UpdateMode" >
										<option value="toogle">Changement d'etat a chaque détéction</option>
										<option value="vue">Présent sur la camera</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">{{Camera autorisé}}</label>
								<div class="col-md-8">
									<select class="eqLogicAttr" data-l1key="configuration" data-l2key="AutoriseCamera" >
										<option value="all">Toutes</option>
										<?php
										$Cameras=config::byKey('configuration','openalpr');
										if(is_array($Cameras['id'])){
											foreach($Cameras['id'] as  $key =>$AlprCamera){
												if($AlprCamera!=''){
													echo '<option value="'.$AlprCamera.'">'.$Cameras['name'][$key].'</option>';
												}
											}
										}else{
											if($Cameras['id']!='')
												echo '<option value="0">'.$Cameras['name'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</fieldset> 
				</form>
			</div>
			<div role="tabpanel" class="tab-pane" id="commandtab">
				<a class="btn btn-success btn-sm cmdAction" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un plaque d'immatriculation}}</a><br/><br/-->
				<table id="table_cmd" class="table table-bordered table-condensed">
					<thead>
					<tr>
						<th>{{Nom}}</th>
						<th>{{Numero de la plaque}}</th>
						<th>{{Action}}</th>
						<th>{{}}</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>	
			<div role="tabpanel" class="tab-pane" id="conditiontab">
				<form class="form-horizontal">
					<fieldset>
						<legend>{{Les conditions d'exécution :}}
							<sup>
								<i class="fa fa-question-circle tooltips" title="Saisir toutes les conditions d'exécution de la gestion"></i>
							</sup>
							<a class="btn btn-success btn-xs conditionAttr" data-action="add" style="margin-left: 5px;">
								<i class="fa fa-plus-circle"></i>
								{{Ajouter une Condition}}
							</a>
						</legend>
					</fieldset>
				</form>			
				<table id="table_condition" class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th></th>
							<th>Condition</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>				
			<div role="tabpanel" class="tab-pane" id="actiontab">
				<form class="form-horizontal">
					<fieldset>
						<legend>{{Les actions:}}
							<sup>
								<i class="fa fa-question-circle tooltips" title="Saisir toutes les actions à mener à l'ouverture"></i>
							</sup>
							<a class="btn btn-success btn-xs ActionAttr" data-action="add" style="margin-left: 5px;">
								<i class="fa fa-plus-circle"></i>
								{{Ajouter une Action}}
							</a>
						</legend>
					</fieldset>
				</form>					
				<table id="table_action" class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>		
		</div>
	</div>
</div>
<?php include_file('desktop', 'openalpr', 'js', 'openalpr'); ?>
<?php include_file('core', 'plugin.template', 'js'); ?>
