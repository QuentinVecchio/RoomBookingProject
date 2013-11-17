<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Actions:</li>
			<li><?php echo $this->Html->Link('Importer', array('controller' =>'users', 'action' => 'add', 'admin' => true), array('class' => 'ajax')); ?></li>
		</ul>
	</nav>
</aside>
<section id="gestion">
	
</section>
<?php 
$this->start('script');
	echo $this->Html->script('charge');
$this->end(); 
 ?>