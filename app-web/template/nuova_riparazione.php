<section class="grande">
	<h2>Registra una riparazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<?php if($_SESSION["selezionatoCliente"]): ?>
					<select name="selezioneCliente" required disabled>
						<option value=<?php echo $_SESSION["cliente"]["codice_fiscale"]?>><?php echo $_SESSION["cliente"]["nome"]." ".$_SESSION["cliente"]["cognome"]." - ".$_SESSION["cliente"]["codice_fiscale"]?></option>			
				<?php else: ?>
					<select name="selezioneCliente" required>
					<?php foreach($_SESSION["clienti"] as $cliente) :?>
						<option value=<?php echo $cliente["codice_fiscale"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["codice_fiscale"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
			
			<?php if($_SESSION["selezionatoCliente"]): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<?php if($_SESSION["selezionatoVeicolo"]):?>
					<select name="selezioneVeicolo" required disabled>
						<option value=<?php echo $_SESSION["veicoloCod"]?>><?php echo $_SESSION["veicoloSpecific"]?></option>
				<?php else:?>
					<select name="selezioneVeicolo" required>
					<?php foreach($_SESSION["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["cod_veicolo"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]." (".$veicolo["data_produzione"].")"?></option>
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
							<input type="checkbox" name='meccaniciSelezionati[]' value='<?php echo($meccanico["codice_fiscale"])?>'><?php echo $meccanico["nome"]." ".$meccanico["cognome"]?>
						</li>
					<?php endforeach; ?>
					</ul>
				</fieldset>
			</li>
			<li>		
				<label for="nomeRiparazione"> Nome o breve descrizione della riparazione: </label>
				<input type="text" name="nomeRiparazione" placeholder="Nome riparazione" maxlength="50" required>
			</li>
			<li>
				<label for="selezionePezzi"> Seleziona gli eventuali pezzi di ricambio usati: </label>
				<fieldset>
					<ul>
					<?php foreach($_SESSION["pezzi"] as $pezzo) : ?>
						<li>
							<input type="checkbox" name='pezziSelezionati[]' value='<?php echo($pezzo["nome"])?>'><?php echo $pezzo["nome"]?>
						</li>
					<?php endforeach; ?>
					</ul>
				</fieldset>
			</li>
			<li>				
				<label for="dataInizio"> Data di inizio: </label>
				<input type="date" name="dataInizio" required>
			</li>
			<li>				
				<label for="dataFine"> Data di fine: </label>
				<input type="date" name="dataFine" required disabled>
			</li>
			<?php endif;?>


		</ul>		
		<input type="submit" name=<?php if($_SESSION["selezionatoVeicolo"]): echo "inserisciRiparazione"; else: echo "avanti"; endif?> value='<?php if($_SESSION["selezionatoVeicolo"]): echo "Inserisci riparazione";  else: echo "Avanti";endif;?>' >
	</form>

</section>

<section class="tabelle">
	<h2>Riparazioni registrate</h2>
	<table>
		<thead>
			<tr>
				<th>MECCANICI</th><th>CLIENTE</th><th>VEICOLO</th><th>DATA</th><th>TIPO</th><th>PREZZO</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($SetParameters["riparazioni"] as $riparazione) :?>
				<tr class="noform">
					<td><?php echo $riparazione["CF_meccanico"]; ?></td>
					<td><?php echo $riparazione["CF_cliente"]; ?></td>
					<td><?php echo $riparazione["cod_veicolo"]; ?></td>
					<td><?php echo $riparazione["data_riparazione"]; ?></td>
					<td><?php echo $riparazione["tipologia"]; ?></td>
					<td><?php echo $riparazione["prezzo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
