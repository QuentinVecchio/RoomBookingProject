<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Actions:</li>
			<li><?php echo $this->Html->Link('Importer',
								 array('controller' =>'users', 'action' => 'add', 'admin' => true)); ?></li>
			<li><?php echo $this->Html->Link('Modification',
								 array('controller' =>'users', 'action' => 'view', 'admin' => true)); ?></li>								 
		</ul>
	</nav>
</aside>