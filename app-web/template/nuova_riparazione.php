<section class="grande">
	<h2>Registra una riparazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<?php if($_SESSION["selezionatoCliente"]): ?>
					<select name="selezioneCliente" required disabled>
						<option value=<?php echo $_SESSION["cliente"]["CF_cliente"]?>><?php echo $_SESSION["cliente"]["nome"]." ".$_SESSION["cliente"]["cognome"]." - ".$_SESSION["cliente"]["CF_cliente"]?></option>			
				<?php else: ?>
					<select name="selezioneCliente" required>
					<?php foreach($_SESSION["clienti"] as $cliente) :?>
						<option value=<?php echo $cliente["CF_cliente"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["CF_cliente"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
		
			<?php if($_SESSION["selezionatoCliente"]): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<?php if($_SESSION["selezionatoVeicolo"]):?>
					<select name="selezioneVeicolo" required disabled>
						<option value=<?php echo $_SESSION["veicoloTarga"]?>><?php echo $_SESSION["veicoloSpecifiche"]?></option>
				<?php else:?>
					<select name="selezioneVeicolo" required>
					<?php foreach($_SESSION["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["targa"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]." (".$veicolo["anno_produzione"].")"?></option>
					<?php endforeach; endif; ?>
				</select>
			</li>
			<?php endif; ?>

			<?php if($_SESSION["selezionatoVeicolo"]):?>
			<li>
				<label for="selezioneMeccanici"> Seleziona i meccanici coinvolti (almeno uno): </label>
				<fieldset name="selezioneMeccanici">
					<ul>
					<?php foreach($_SESSION["meccanici"] as $meccanico) : ?>
						<li>
							<input type="checkbox" name='meccaniciSelezionati[]' value='<?php echo($meccanico["CF_meccanico"])?>'><?php echo $meccanico["nome"]." ".$meccanico["cognome"]?>
						</li>
					<?php endforeach; ?>
					</ul>
				</fieldset>
			</li>
			<?php if(!empty($_SESSION["pezzi"])) : ?>
				<li>
					<label for="selezionePezzi"> Seleziona gli eventuali pezzi di ricambio usati: </label>
					<fieldset>
						<ul>
						<?php foreach($_SESSION["pezzi"] as $pezzo) : ?>
							<li>
								<input type="checkbox" name='pezziSelezionati[]' value='<?php echo($pezzo["id_pezzo"])?>'><?php echo $pezzo["nome"]?>
							</li>
						<?php endforeach; ?>
						</ul>
					</fieldset>
				</li>
			<?php endif; ?>
			<li>				
				<label for="dataInizio"> Data di inizio: </label>
				<input type="date" name="dataInizio" required>
			</li>
			<li>				
				<label for="dataFine"> Data di fine: </label>
				<input type="date" name="dataFine" required disabled>
			</li>
			<li>
				<label for="costo_totale"> Costo totale: </label>
				<input type="number" name="costo_totale" required >
			</li>
			<?php endif;?>
		</ul>		
		<input type="submit" name=<?php if($_SESSION["selezionatoVeicolo"]): echo "inserisciRiparazione"; else: echo "avanti"; endif?> value='<?php if($_SESSION["selezionatoVeicolo"]): echo "Inserisci riparazione";  else: echo "Avanti";endif;?>' >
	</form>
</section>
<section <?php if(isset($SetParameters["ricercaCasaProd"])){echo "class='grande'";}?>>
	<h2>Visualizza le Case di produzione più carenti dell'anno</h2>
	<?php if(isset($SetParameters["ricercaCasaProd"])):?>
	<table>
		<thead>
			<tr>
				<th>NOME</th><th>N°RIPARAZIONI</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["ricercaCasaProd"] as $casa):?>
			<tr class="noform">
				<td><?php echo $casa["nome"]?></td>
				<td><?php echo $casa["n_riparazioni"]?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php else:?>
	<form action="#" method="POST">
		<label for="annoRicerca">Verrano mostrate quelle con più di 5 riparazioni effettuate: </label>
		<input type="number" min="1980" max="2023"  step="1" name="annoRicerca" placeholder="Anno" required>
		<input type="submit" name="ricerca" value="ricerca" >
	</form>
<?php endif;?>
</section>
<section class="tabelle">
	<h2>Riparazioni registrate</h2>
	<table>
		<thead>
			<tr>
				<th>CLIENTE</th><th>VEICOLO</th><th>DATA_INIZIO</th><th>DATA_FINE</th><th>COSTO</th><th>MECCANICI</th><th>PEZZI DI RICAMBIO</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($SetParameters["riparazioni"] as $riparazione) :
			$cliente = $db->checkClient($riparazione["CF_cliente"])[0];
			$meccanici = $db->getRepairMechanics($riparazione["id_riparazione"]);
			$pezzi = $db->getRepairPieces($riparazione["id_riparazione"]);?>
				<tr class="noform">
					<td><?php echo $cliente["nome"]." ".$cliente["cognome"]." (".$cliente["CF_cliente"].")"; ?></td>
					<td><?php echo $db->getVeicoloUsatoSpecifico($riparazione["targa"]); ?></td>
					<td><?php echo $riparazione["data_inizio"]; ?></td>
					<td><?php echo $riparazione["data_fine"]; ?></td>
					<td><?php echo $riparazione["costo_totale"]."€"; ?></td>
					<td class="elenco">
						<ul>
							<?php foreach($meccanici as $meccanico){echo "<li>".$meccanico["nome"]." ".$meccanico["cognome"]." - ".$meccanico["CF_meccanico"]."</li>";} ?>
						</ul>
					</td>
					<td class="elenco">
						<ul>
							<?php foreach($pezzi as $pezzo){echo "<li>".$pezzo["nome"]."</li>";} ?></td>
						</ul>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
