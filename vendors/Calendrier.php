<?php
/**
* Objet Calendrier
* Fait par Quentin Vecchio
* Octobre 2013
*/
require('Date.class.php');
class Calendrier extends AppHelper
{
	public $helpers = array('Html','link');
	//Variables
		private $_date1;
		private $_date2;
		private $_gereAjax;
		private $_cibleAjax;
	//Methodes
		//Constructeur
			function __construct($ajax = false, $cible = null)
			{
				$this->_date1 = new Date();//Par défaut on prend la date courante
				$this->_date2 = new Date();//Par défaut on prend la date courante
				$this->setAnnee($this->_date1->Annee());
				$this->setAjax($ajax);
				$this->setCibleAjax($cible);
			}
		//Setter
			public function setAnnee($annee)
			{
				$this->_date1->setAnnee($annee);
				$this->_date2->setAnnee($annee+1);
			}
			public function setAjax($ajax)
			{
				if($ajax == TRUE)
				{
					$this->_gereAjax = TRUE;
				}
				else
				{
					$this->_gereAjax = FALSE;
				}
			}
			public function setCibleAjax($cible)
			{
				$this->_cibleAjax = $cible;
			}
		//Getter
			public function Annee()
			{
				return $this->_date1->Annee();
			}
			public function Date()
			{
				return $this->_date1;
			}
			public function Ajax()
			{
				return $this->_gereAjax;
			}
			public function Cible()
			{
				return $this->_cibleAjax;
			}

			private function evenement($date,$tabEvent)
			{
				$nbEvent = 0;
				foreach ($tabEvent as $i => $value) {
					if($value["Loan"]["date"] == $date)
					{
						$nbEvent++;
					}
				}
				return $nbEvent;
			}

			public function getCalendrier($event,Date $focus = null)
			{
				if($focus != null)
				{
					$jour = $focus->Jour();
					$mois = $focus->Mois();
					$annee = $focus->Annee();
				}
				else
				{
					$jour = $this->_date1->Jour();
					$mois = $this->_date1->Mois();
					$annee = $this->_date1->Annee();
				}
				ob_start();
				?>
					<?php
					if($this->Ajax() == true)
					{?>
						<div class="calendrier" ajax="true" cible="">
					<?php
					}
					else
					{?>
						<div class="calendrier" ajax="false">
					<?php
					}
					?>
						<div id="hautCalendrier">
							<?php //Définition de l'annee du calendrier?>
							<div id="calendrierTitre">
								<div id="titreMois" val="<?php echo $mois;?>">
									<span class="scrollMA" id="moisBouge">Sep</span>
									<span class="scrollMA">Oct</span>
									<span class="scrollMA">Nov</span>
									<span class="scrollMA">Dec</span>
									<span class="scrollMA">Jan</span>
									<span class="scrollMA">Fev</span>
									<span class="scrollMA">Mar</span>
									<span class="scrollMA">Avr</span>
									<span class="scrollMA">Mai</span>
									<span class="scrollMA">Jui</span>
									<span class="scrollMA">Jui</span>
									<span class="scrollMA">Aou</span>
								</div>
								<div id="titreAnnee" val="<?php echo $annee;?>">
									<span id="anneeBouge" class="scrollMA"><?php echo $this->_date1->Annee();?></span></br>
									<span class="scrollMA"><?php echo $this->_date2->Annee();?></span></br>
								</div>
							</div>
							
							<?php //Définition des commandes de gestion des mois?>
							<div id="controleMois">
								<span class="btn icon-up-open" id="btnH"></span>
								<span class="btn icon-down-open" id="btnB"></span>
							</div>
						</div>
						<div id="basCalendrier">
							<div id="moisChange">
							<?php //Définition des tableaux de calendrier?>
							<?php
						//**************************ANNNEE1**************************************	
								$dates = $this->_date1->tabAnnee($this->_date1->Annee());
								$dates = current($dates);
								foreach ( $dates as $m => $days)
								{
									if($m >=9 )
									{?>
									<table class="mois" id="month<?php echo $m;?>">
										<thead>
											<tr>
											<?php
												foreach ($this->_date1->tabJour() as $d) 
												{?>
													<th class="nomJours">
														<?php echo substr($d,0,3);?>
													</th>
											<?php
												}
											?>
											</tr>
										</thead>
										<tbody>
											<tr><?php
												$end = end($days); 
												$nbLigne = 1;
												foreach ($days as $d => $w) 
												{
													if($d == 1 && $w != 1)
													{?>
														<td colspan="<?php echo $w-1;?>" class="padding"></td>
													<?php
													}
													$dateTraite = $this->_date1->Annee() . '-' . $m . '-' . (($d < 10)? '0'.$d: $d);
													$nbEvent = $this->evenement($dateTraite,$event);
													if($nbEvent != 0)
													{
													?>
													<td class="evenement" info="<?php echo $w;?>" id="days<?php echo $d;?>"><a href="view/<?php echo $dateTraite ?>" class="ajax"><?php echo $d; ?></a></td>
													<?php
													}
													else
													{?>
														<td class="days" info="<?php echo $w;?>" id="days<?php echo $d;?>"><a href="#"><?php echo $d;?></a></td>
													<?php
													}
													if($w == 7)
													{
														$nbLigne++;?>
														</tr><tr>
													<?php
													}
												}
												if($end != 7)
												{?>
													<td colspan="<?php echo 7-$end;?>" class="padding"></td>
												<?php
												}
												?>
											</tr>
										</tbody>
									</table>
									<span id="nbLigne<?php echo $m;?>" style="visibility : hidden;"><?php echo $nbLigne;?></span>
								<?php 
									}
								}
								//**************************ANNNEE2**************************************	
								$dates1 = $this->_date2->tabAnnee($this->_date2->Annee());
								$dates1 = current($dates1);
								foreach ( $dates1 as $m1 => $days1)
								{
									if($m1 <= 8 )
									{?>
									<table class="mois" id="month<?php echo $m1;?>">
										<thead>
											<tr>
											<?php
												foreach ($this->_date2->tabJour() as $d1) 
												{?>
													<th class="nomJours">
														<?php echo substr($d1,0,3);?>
													</th>
											<?php
												}
											?>
											</tr>
										</thead>
										<tbody>
											<tr><?php
												$end = end($days1); 
												$nbLigne1 = 1;
												foreach ($days1 as $d1 => $w1) 
												{
														
													if($d1 == 1 && $w1 != 1)
													{?>
														<td colspan="<?php echo $w1-1;?>" class="padding"></td>
													<?php
													}
													?>
													<td  class="days" id="days<?php echo $d1;?>"><?php echo $d1;?></td>
													<?php
													
													if($w1 == 7)
													{
														$nbLigne1++;?>
														</tr><tr>
													<?php
													}
												}
												if($end != 7)
												{?>
													<td colspan="<?php echo 7-$end;?>" class="padding"></td>
												<?php
												}
												?>
											</tr>
										</tbody>
									</table>
									<?php if($m1 == 8){?>
									<span id="nbLigne<?php echo $m1;?>" style="visibility : hidden;"><?php echo ($nbLigne1-1);?></span>
									<?php }else{?>
									<span id="nbLigne<?php echo $m1;?>" style="visibility : hidden;"><?php echo $nbLigne1;?></span>
									<?php }?>
								<?php 
									}
								}
								?>	
							</div>
						</div>
					<?php
				$contents = ob_get_contents();
				ob_end_clean();
				return $contents;
			}
}
?>