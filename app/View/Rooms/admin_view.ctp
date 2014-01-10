<h1>Gestion des salles du département <?php echo $name_department; ?></h1>

<?php 
	echo $this->Element('side_bar_department',
						array($side_department));
 ?>
<section>
	<table class="grille-gestion large">
	<thead>
		<tr>
			<th>Département</th>
			<th>Salle</th>			
			<th>Projecteur</th>
			<th>PC</th>
			<th>Capacité</th>
			<th><span class="icon-cog"></span></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if(!empty($rooms)){
				foreach ($rooms as $k => $v) {
					echo $this->Room->getView($v['Room'], $v['Department']);
				}
			}

			$t = $this->fetch('content');
			if($t != null){
				echo $t;
			}else{
				echo $this->Room->getEdit($departments, $id);
			}

		 ?>


	</tbody>
</table>
</section>
<?php 

$this->start('script');
	echo $this->Html->script('gestion_salle');
$this->end(); 

$this->start('css');
	echo $this->Html->css('table');
$this->end();

?>
